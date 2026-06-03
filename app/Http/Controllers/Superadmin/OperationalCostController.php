<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OperationalCostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $costs = \App\Models\OperationalCost::latest()->paginate(10);
        return view('dashboard.superadmin.operational_costs.index', compact('costs'));
    }

    public function create()
    {
        return view('dashboard.superadmin.operational_costs.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'name' => 'required|string|max:191',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string'
        ]);

        \App\Models\OperationalCost::create($request->all());
        return redirect()->route('dashboard.operational-costs.index')->with('success', 'Catatan pengeluaran berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        // Unused
    }

    public function edit(string $id)
    {
        $cost = \App\Models\OperationalCost::findOrFail($id);
        return view('dashboard.superadmin.operational_costs.form', compact('cost'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'date' => 'required|date',
            'name' => 'required|string|max:191',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string'
        ]);

        $cost = \App\Models\OperationalCost::findOrFail($id);
        $cost->update($request->all());
        return redirect()->route('dashboard.operational-costs.index')->with('success', 'Data pengeluaran berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $cost = \App\Models\OperationalCost::findOrFail($id);
        $cost->delete();
        return redirect()->route('dashboard.operational-costs.index')->with('success', 'Catatan pengeluaran berhasil dihapus!');
    }
}
