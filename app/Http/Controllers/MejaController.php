<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Http\Request;

class MejaController extends Controller
{
    public function index()
    {
        $mejas = Meja::orderBy('number')->get();
        return view('dashboard.meja.index', compact('mejas'));
    }

    public function create()
    {
        return view('dashboard.meja.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|string|unique:mejas,number',
            'status' => 'required|in:empty,occupied',
            'guest_name' => 'nullable|string',
            'reserved_since' => 'nullable|date',
        ]);

        Meja::create($request->all());

        return redirect()->route('dashboard.barcode')->with('success', 'Meja berhasil ditambahkan!');
    }

    public function edit(Meja $meja)
    {
        return view('dashboard.meja.form', compact('meja'));
    }

    public function update(Request $request, Meja $meja)
    {
        $request->validate([
            'number' => 'required|string|unique:mejas,number,' . $meja->id,
            'status' => 'required|in:empty,occupied',
            'guest_name' => 'nullable|string',
            'reserved_since' => 'nullable|date',
        ]);

        $meja->update($request->all());

        return redirect()->route('dashboard.barcode')->with('success', 'Meja berhasil diperbarui!');
    }

    public function destroy(Meja $meja)
    {
        $meja->delete();

        return redirect()->route('dashboard.barcode')->with('success', 'Meja berhasil dihapus!');
    }
}
