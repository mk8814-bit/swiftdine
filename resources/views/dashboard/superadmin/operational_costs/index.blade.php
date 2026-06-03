@extends('layouts.dashboard')

@section('content')
<div class="dashboard-header" style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h1 style="font-size: 2rem; font-weight: 800; color: var(--brand-dark);">Biaya Operasional</h1>
        <p style="color: #666; margin-top: 5px;">Kelola catatan pengeluaran harian, bulanan, atau insidental restoran.</p>
    </div>
    <a href="{{ route('dashboard.operational-costs.create') }}" class="btn-primary" style="padding: 10px 20px; border-radius: 8px;">
        + Catat Pengeluaran Baru
    </a>
</div>

<div style="background: white; border-radius: 15px; padding: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="border-bottom: 2px solid #f0e6d2;">
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Tanggal</th>
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Nama Pengeluaran</th>
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Nominal</th>
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Deskripsi</th>
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($costs as $cost)
            <tr style="border-bottom: 1px solid #f9f6f0;">
                <td style="padding: 15px;">{{ \Carbon\Carbon::parse($cost->date)->format('d M Y') }}</td>
                <td style="padding: 15px; font-weight: 600;">{{ $cost->name }}</td>
                <td style="padding: 15px; font-weight: 700; color: #dc3545;">Rp {{ number_format($cost->amount, 0, ',', '.') }}</td>
                <td style="padding: 15px; color: #666;">{{ Str::limit($cost->description, 30) ?: '-' }}</td>
                <td style="padding: 15px;">
                    <a href="{{ route('dashboard.operational-costs.edit', $cost->id) }}" style="background: none; border: none; font-size: 1.2rem; text-decoration: none; cursor: pointer; transition: transform 0.2s; display: inline-block; margin-right: 10px;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'" title="Edit">✏️</a>
                    <form action="{{ route('dashboard.operational-costs.destroy', $cost->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus data pengeluaran ini?');">
                        @csrf @method('DELETE')
                        <button style="background: none; border: none; font-size: 1.2rem; cursor: pointer; transition: transform 0.2s; display: inline-block;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'" title="Hapus">🗑️</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="padding: 30px; text-align: center; color: #888;">Belum ada catatan biaya operasional.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div style="margin-top: 20px;">
        {{ $costs->links() }}
    </div>
</div>
@endsection
