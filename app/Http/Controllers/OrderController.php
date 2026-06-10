<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

require_once base_path('vendor/midtrans/midtrans-php/Midtrans.php');

class OrderController extends Controller
{
    public function cart()
    {
        $order = Order::where('user_id', Auth::id())->where('status', 'pending')->first();
        return view('dashboard.pelanggan.cart', compact('order'));
    }

    public function addToCart(Request $request, Menu $menu)
    {
        $order = Order::firstOrCreate(
            ['user_id' => Auth::id(), 'status' => 'pending'],
            ['total_price' => 0]
        );

        $orderItem = OrderItem::where('order_id', $order->id)
            ->where('menu_id', $menu->id)
            ->first();

        if ($orderItem) {
            $orderItem->quantity += 1;
            $orderItem->save();
        } else {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $menu->id,
                'quantity' => 1,
                'price' => $menu->price,
            ]);
        }

        $this->updateOrderTotal($order);

        return redirect()->back()->with('success', 'Menu ditambahkan ke keranjang.');
    }

    public function updateCart(Request $request, OrderItem $item)
    {
        if ($item->order->user_id !== Auth::id())
            abort(403);

        $request->validate(['quantity' => 'required|integer|min:1']);

        $item->update(['quantity' => $request->quantity]);
        $this->updateOrderTotal($item->order);

        return redirect()->back()->with('success', 'Keranjang diperbarui.');
    }

    public function removeFromCart(OrderItem $item)
    {
        if ($item->order->user_id !== Auth::id())
            abort(403);

        $order = $item->order;
        $item->delete();
        $this->updateOrderTotal($order);

        return redirect()->back()->with('success', 'Item dihapus dari keranjang.');
    }

    public function checkout(Request $request)
    {
        $order = Order::where('user_id', Auth::id())->where('status', 'pending')->first();
        if (!$order || $order->orderItems->isEmpty()) {
            return response()->json(['error' => 'Keranjang belanja kosong.'], 400);
        }

        $request->validate([
            'table_number' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $order->update([
            'table_number' => ($request->table_number ?: $order->table_number) ?: 'Tanpa Meja',
            'notes' => $request->notes,
        ]);

        // Set Midtrans Configuration
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');

        // Always generate a new snap token if checking out again to avoid order_id conflicts or stale data
        $params = [
            'transaction_details' => [
                'order_id' => 'ORD-' . $order->id . '-' . time(),
                'gross_amount' => (int) $order->total_price,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
            'item_details' => $order->orderItems->map(function ($item) {
                return [
                    'id' => $item->menu_id,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'name' => $item->menu->name,
                ];
            })->toArray(),
            'enabled_payments' => ['qris', 'bank_transfer'],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            $order->update(['snap_token' => $snapToken]);
            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function callback(Request $request)
    {
        $serverKey = config('services.midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                // Extract order ID: ORD-{id}-{timestamp}
                $parts = explode('-', $request->order_id);
                $orderId = $parts[1];
                $order = Order::find($orderId);
                if ($order) {
                    $order->update(['status' => 'paid']);
                }
            }
        }

        return response()->json(['status' => 'success']);
    }

    public function success()
    {
        return view('dashboard.pelanggan.thankyou');
    }

    public function history()
    {
        $orders = Order::where('user_id', Auth::id())
            ->whereIn('status', ['paid', 'completed', 'cancelled'])
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('dashboard.pelanggan.history', compact('orders'));
    }

    private function updateOrderTotal(Order $order)
    {
        $total = $order->orderItems()->selectRaw('SUM(quantity * price) as total')->value('total') ?? 0;
        $order->update(['total_price' => $total]);
    }
}
