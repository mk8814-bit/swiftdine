<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::latest()->get();
        return view('dashboard.barang.index', compact('barangs'));
    }

    public function create()
    {
        return view('dashboard.barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|max:255|unique:barangs',
            'harga' => 'required|numeric|min:0',
        ]);

        Barang::create($request->all());

        return redirect()->route('dashboard.barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function edit(Barang $barang)
    {
        return view('dashboard.barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|max:255|unique:barangs,kode_barang,' . $barang->id,
            'harga' => 'required|numeric|min:0',
        ]);

        $barang->update($request->all());

        return redirect()->route('dashboard.barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();

        return redirect()->route('dashboard.barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
