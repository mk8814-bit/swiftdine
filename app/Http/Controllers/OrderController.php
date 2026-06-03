<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

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
                'menu_id'  => $menu->id,
                'quantity' => 1,
                'price'    => $menu->price,
            ]);
        }

        $this->updateOrderTotal($order);

        return redirect()->back()->with('success', 'Menu ditambahkan ke keranjang.');
    }

    public function updateCart(Request $request, OrderItem $item)
    {
        if ($item->order->user_id !== Auth::id()) abort(403);

        $request->validate(['quantity' => 'required|integer|min:1']);
        
        $item->update(['quantity' => $request->quantity]);
        $this->updateOrderTotal($item->order);

        return redirect()->back()->with('success', 'Keranjang diperbarui.');
    }

    public function removeFromCart(OrderItem $item)
    {
        if ($item->order->user_id !== Auth::id()) abort(403);
        
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

        // Set Midtrans Configuration
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        \Midtrans\Config::$isSanitized = env('MIDTRANS_IS_SANITIZED', true);
        \Midtrans\Config::$is3ds = env('MIDTRANS_IS_3DS', true);

        if (!$order->snap_token) {
            $params = [
                'transaction_details' => [
                    'order_id' => 'ORD-' . $order->id . '-' . time(),
                    'gross_amount' => $order->total_price,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                ],
            ];

            try {
                $snapToken = \Midtrans\Snap::getSnapToken($params);
                $order->snap_token = $snapToken;
                $order->save();
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }

        return response()->json(['snap_token' => $order->snap_token]);
    }

    public function success()
    {
        $order = Order::where('user_id', Auth::id())->where('status', 'pending')->first();
        if ($order) {
            $order->update(['status' => 'paid']);
        }
        
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
        $total = $order->orderItems->sum(function($item) {
            return $item->quantity * $item->price;
        });
        $order->update(['total_price' => $total]);
    }
}
