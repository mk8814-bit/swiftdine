@extends('layouts.dashboard')

@section('content')
<div class="dashboard-header" style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h1 style="font-size: 2rem; font-weight: 800; color: var(--brand-dark);">Gaji Pekerja</h1>
        <p style="color: #666; margin-top: 5px;">Kelola catatan penggajian karyawan (Kasir, Waiter, Admin).</p>
    </div>
    <a href="{{ route('dashboard.salaries.create') }}" class="btn-primary" style="padding: 10px 20px; border-radius: 8px;">
        + Catat Gaji Baru
    </a>
</div>

<div style="background: white; border-radius: 15px; padding: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="border-bottom: 2px solid #f0e6d2;">
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Karyawan</th>
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Role</th>
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Periode</th>
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Nominal</th>
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Status</th>
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($salaries as $salary)
            <tr style="border-bottom: 1px solid #f9f6f0;">
                <td style="padding: 15px; font-weight: 600;">{{ $salary->user->name ?? 'Unknown' }}</td>
                <td style="padding: 15px; text-transform: capitalize;">{{ $salary->user->role ?? '-' }}</td>
                <td style="padding: 15px;">{{ $salary->month }} {{ $salary->year }}</td>
                <td style="padding: 15px; font-weight: 700; color: var(--brand-primary);">Rp {{ number_format($salary->amount, 0, ',', '.') }}</td>
                <td style="padding: 15px;">
                    <span style="background: {{ $salary->status == 'paid' ? '#D4EDDA' : '#FFF3CD' }}; color: {{ $salary->status == 'paid' ? '#155724' : '#856404' }}; padding: 5px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 700;">
                        {{ ucfirst($salary->status) }}
                    </span>
                </td>
                <td style="padding: 15px;">
                    <a href="{{ route('dashboard.salaries.edit', $salary->id) }}" style="background: none; border: none; font-size: 1.2rem; text-decoration: none; cursor: pointer; transition: transform 0.2s; display: inline-block; margin-right: 10px;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'" title="Edit">✏️</a>
                    <form action="{{ route('dashboard.salaries.destroy', $salary->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus data gaji ini?');">
                        @csrf @method('DELETE')
                        <button style="background: none; border: none; font-size: 1.2rem; cursor: pointer; transition: transform 0.2s; display: inline-block;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'" title="Hapus">🗑️</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="padding: 30px; text-align: center; color: #888;">Belum ada catatan gaji.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div style="margin-top: 20px;">
        {{ $salaries->links() }}
    </div>
</div>
@endsection
