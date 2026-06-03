@extends('layouts.dashboard')

@section('content')
<div class="dashboard-header" style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h1 style="font-size: 2rem; font-weight: 800; color: var(--brand-dark);">Daftar Paket Hemat</h1>
        <p style="color: #666; margin-top: 5px;">Kelola bundel (gabungan) beberapa menu menjadi satu paket dengan harga menarik.</p>
    </div>
    <a href="{{ route('dashboard.packages.create') }}" class="btn-primary" style="padding: 10px 20px; border-radius: 8px;">
        + Buat Paket Baru
    </a>
</div>

<div style="background: white; border-radius: 15px; padding: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="border-bottom: 2px solid #f0e6d2;">
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Nama Paket</th>
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Isi Paket (Menu)</th>
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Harga Paket</th>
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Status</th>
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($packages as $package)
            <tr style="border-bottom: 1px solid #f9f6f0;">
                <td style="padding: 15px; font-weight: 800; color: var(--brand-primary); font-size: 1.1rem;">
                    {{ $package->name }}
                    <div style="font-size: 0.85rem; font-weight: normal; color: #777; margin-top: 5px;">{{ Str::limit($package->description, 50) }}</div>
                </td>
                <td style="padding: 15px; color: #555;">
                    <ul style="margin-left: 15px; margin-top: 5px; font-size: 0.9rem;">
                        @foreach($package->menus as $item)
                            <li>{{ $item->name }}</li>
                        @endforeach
                    </ul>
                </td>
                <td style="padding: 15px; font-weight: 700; color: #28a745;">Rp {{ number_format($package->price, 0, ',', '.') }}</td>
                <td style="padding: 15px;">
                    <span style="background: {{ $package->is_active ? '#D4EDDA' : '#F8D7DA' }}; color: {{ $package->is_active ? '#155724' : '#721C24' }}; padding: 5px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 700;">
                        {{ $package->is_active ? 'Tersedia' : 'Disembunyikan' }}
                    </span>
                </td>
                <td style="padding: 15px;">
                    <a href="{{ route('dashboard.packages.edit', $package->id) }}" style="background: none; border: none; font-size: 1.2rem; text-decoration: none; cursor: pointer; transition: transform 0.2s; display: inline-block; margin-right: 10px;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'" title="Edit">✏️</a>
                    <form action="{{ route('dashboard.packages.destroy', $package->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus paket ini?');">
                        @csrf @method('DELETE')
                        <button style="background: none; border: none; font-size: 1.2rem; cursor: pointer; transition: transform 0.2s; display: inline-block;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'" title="Hapus">🗑️</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="padding: 30px; text-align: center; color: #888;">Belum ada paket hemat yang dibuat.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div style="margin-top: 20px;">
        {{ $packages->links() }}
    </div>
</div>
@endsection
