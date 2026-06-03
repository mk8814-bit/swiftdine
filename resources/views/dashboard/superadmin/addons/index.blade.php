@extends('layouts.dashboard')

@section('content')
<div class="dashboard-header" style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h1 style="font-size: 2rem; font-weight: 800; color: var(--brand-dark);">Kelola Topping (Biaya Tambahan)</h1>
        <p style="color: #666; margin-top: 5px;">Kelola topping atau pilihan ekstra berbayar untuk menu restoran.</p>
    </div>
    <a href="{{ route('dashboard.addons.create') }}" class="btn-primary" style="padding: 10px 20px; border-radius: 8px;">
        + Tambah Topping
    </a>
</div>

<div style="background: white; border-radius: 15px; padding: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="border-bottom: 2px solid #f0e6d2;">
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Nama Topping / Ekstra</th>
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Biaya Tambahan</th>
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Status</th>
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($addons as $addon)
            <tr style="border-bottom: 1px solid #f9f6f0;">
                <td style="padding: 15px; font-weight: 600;">{{ $addon->name }}</td>
                <td style="padding: 15px; font-weight: 700; color: var(--brand-primary);">+ Rp {{ number_format($addon->price, 0, ',', '.') }}</td>
                <td style="padding: 15px;">
                    <span style="background: {{ $addon->is_active ? '#D4EDDA' : '#F8D7DA' }}; color: {{ $addon->is_active ? '#155724' : '#721C24' }}; padding: 5px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 700;">
                        {{ $addon->is_active ? 'Tersedia' : 'Habis' }}
                    </span>
                </td>
                <td style="padding: 15px;">
                    <a href="{{ route('dashboard.addons.edit', $addon->id) }}" style="background: none; border: none; font-size: 1.2rem; text-decoration: none; cursor: pointer; transition: transform 0.2s; display: inline-block; margin-right: 10px;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'" title="Edit">✏️</a>
                    <form action="{{ route('dashboard.addons.destroy', $addon->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus topping ini?');">
                        @csrf @method('DELETE')
                        <button style="background: none; border: none; font-size: 1.2rem; cursor: pointer; transition: transform 0.2s; display: inline-block;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'" title="Hapus">🗑️</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="padding: 30px; text-align: center; color: #888;">Belum ada topping / biaya tambahan yang terdaftar.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div style="margin-top: 20px;">
        {{ $addons->links() }}
    </div>
</div>
@endsection
