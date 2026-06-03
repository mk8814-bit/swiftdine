<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventories = \App\Models\Inventory::latest()->paginate(10);
        return view('dashboard.superadmin.inventories.index', compact('inventories'));
    }

    public function create()
    {
        return view('dashboard.superadmin.inventories.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'unit' => 'required|string|max:191',
            'stock' => 'required|numeric|min:0'
        ]);

        \App\Models\Inventory::create($request->all());
        return redirect()->route('dashboard.inventories.index')->with('success', 'Barang berhasil ditambahkan ke inventaris!');
    }

    public function show(string $id)
    {
        // Unused
    }

    public function edit(string $id)
    {
        $inventory = \App\Models\Inventory::findOrFail($id);
        return view('dashboard.superadmin.inventories.form', compact('inventory'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'unit' => 'required|string|max:191',
            'stock' => 'required|numeric|min:0'
        ]);

        $inventory = \App\Models\Inventory::findOrFail($id);
        $inventory->update($request->all());
        return redirect()->route('dashboard.inventories.index')->with('success', 'Data barang berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $inventory = \App\Models\Inventory::findOrFail($id);
        $inventory->delete();
        return redirect()->route('dashboard.inventories.index')->with('success', 'Barang berhasil dihapus dari inventaris!');
    }
}
