<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = \App\Models\MenuPackage::with('menus')->latest()->paginate(10);
        return view('dashboard.superadmin.packages.index', compact('packages'));
    }

    public function create()
    {
        $menus = \App\Models\Menu::where('is_active', true)->orderBy('category')->get();
        return view('dashboard.superadmin.packages.form', compact('menus'));
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'menus' => 'required|array',
            'menus.*' => 'exists:menus,id'
        ]);

        $package = \App\Models\MenuPackage::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'is_active' => $request->has('is_active')
        ]);

        // Attach menus (assuming qty 1 for simplicity in this implementation)
        $package->menus()->attach($request->menus);

        return redirect()->route('dashboard.packages.index')->with('success', 'Paket Hemat berhasil ditambahkan!');
    }

    public function show(string $id) { }

    public function edit(string $id)
    {
        $package = \App\Models\MenuPackage::with('menus')->findOrFail($id);
        $menus = \App\Models\Menu::where('is_active', true)->orderBy('category')->get();
        return view('dashboard.superadmin.packages.form', compact('package', 'menus'));
    }

    public function update(\Illuminate\Http\Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'menus' => 'required|array',
            'menus.*' => 'exists:menus,id'
        ]);

        $package = \App\Models\MenuPackage::findOrFail($id);
        $package->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'is_active' => $request->has('is_active')
        ]);

        $package->menus()->sync($request->menus);

        return redirect()->route('dashboard.packages.index')->with('success', 'Paket Hemat berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $package = \App\Models\MenuPackage::findOrFail($id);
        $package->delete();
        return back()->with('success', 'Paket berhasil dihapus!');
    }
}
