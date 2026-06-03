<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salaries = \App\Models\Salary::with('user')->latest()->paginate(10);
        return view('dashboard.superadmin.salaries.index', compact('salaries'));
    }

    public function create()
    {
        $users = \App\Models\User::whereNotIn('role', ['pelanggan', 'superadmin'])->get();
        return view('dashboard.superadmin.salaries.form', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'month' => 'required|string|max:191',
            'year' => 'required|string|max:191',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:paid,unpaid'
        ]);

        \App\Models\Salary::create($request->all());
        return redirect()->route('dashboard.salaries.index')->with('success', 'Data gaji berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        // Unused
    }

    public function edit(string $id)
    {
        $salary = \App\Models\Salary::findOrFail($id);
        $users = \App\Models\User::whereNotIn('role', ['pelanggan', 'superadmin'])->get();
        return view('dashboard.superadmin.salaries.form', compact('salary', 'users'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'month' => 'required|string|max:191',
            'year' => 'required|string|max:191',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:paid,unpaid'
        ]);

        $salary = \App\Models\Salary::findOrFail($id);
        $salary->update($request->all());
        return redirect()->route('dashboard.salaries.index')->with('success', 'Data gaji berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $salary = \App\Models\Salary::findOrFail($id);
        $salary->delete();
        return redirect()->route('dashboard.salaries.index')->with('success', 'Data gaji berhasil dihapus!');
    }
}
