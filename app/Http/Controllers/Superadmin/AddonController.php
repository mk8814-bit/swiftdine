<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addons = \App\Models\Addon::latest()->paginate(10);
        return view('dashboard.superadmin.addons.index', compact('addons'));
    }

    public function create()
    {
        return view('dashboard.superadmin.addons.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'price' => 'required|numeric|min:0',
            'is_active' => 'required|boolean'
        ]);

        \App\Models\Addon::create($request->all());
        return redirect()->route('dashboard.addons.index')->with('success', 'Topping berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        // Unused
    }

    public function edit(string $id)
    {
        $addon = \App\Models\Addon::findOrFail($id);
        return view('dashboard.superadmin.addons.form', compact('addon'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'price' => 'required|numeric|min:0',
            'is_active' => 'required|boolean'
        ]);

        $addon = \App\Models\Addon::findOrFail($id);
        $addon->update($request->all());
        return redirect()->route('dashboard.addons.index')->with('success', 'Data topping berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $addon = \App\Models\Addon::findOrFail($id);
        $addon->delete();
        return redirect()->route('dashboard.addons.index')->with('success', 'Topping berhasil dihapus!');
    }
}
