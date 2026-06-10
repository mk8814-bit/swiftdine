<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class KasirController extends Controller
{
    public function scan(Request $request)
    {
        $cart = session()->get('kasir_cart', []);
        return view('dashboard.kasir.scan', compact('cart'));
    }

    public function processScan(Request $request)
    {
        $kode = $request->input('kode_barcode');
        if (!$kode) {
            return redirect()->back();
        }

        $barang = Barang::where('kode_barang', $kode)->first();

        if ($barang) {
            $cart = session()->get('kasir_cart', []);

            // Check if already in cart
            if (isset($cart[$kode])) {
                $cart[$kode]['quantity']++;
            } else {
                $cart[$kode] = [
                    'nama_barang' => $barang->nama_barang,
                    'kode_barang' => $barang->kode_barang,
                    'harga' => $barang->harga,
                    'quantity' => 1
                ];
            }

            session()->put('kasir_cart', $cart);
            return redirect()->route('dashboard.kasir.scan')->with('success', 'Barang ' . $barang->nama_barang . ' berhasil di-scan.');
        }

        return redirect()->route('dashboard.kasir.scan')->with('error', 'Barang tidak ditemukan!');
    }

    public function clearScan()
    {
        session()->forget('kasir_cart');
        return redirect()->route('dashboard.kasir.scan')->with('info', 'Daftar scan telah dibersihkan.');
    }
}
