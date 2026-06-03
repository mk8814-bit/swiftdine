@extends('layouts.dashboard')

@section('content')
<div class="dashboard-header" style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h1 style="font-size: 2rem; font-weight: 800; color: var(--brand-dark);">Kelola Menu</h1>
        <p style="color: #666; margin-top: 5px;">Daftar menu yang tersedia di sistem SwiftDine</p>
    </div>
    <a href="{{ route('dashboard.menus.create') }}" class="btn-primary" style="padding: 10px 20px; border-radius: 8px;">
        + Tambah Menu Baru
    </a>
</div>

<div style="background: white; border-radius: 15px; padding: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="border-bottom: 2px solid #f0e6d2;">
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Gambar</th>
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Nama Menu</th>
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Kategori</th>
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Harga</th>
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($menus as $menu)
            <tr style="border-bottom: 1px solid #f9f6f0;">
                <td style="padding: 15px;">
                    @if($menu->image && (strpos($menu->image, '/') !== false || strpos($menu->image, '.') !== false))
                        <img src="{{ asset('storage/' . $menu->image) }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px; border: 1px solid #f0e6d2;">
                    @else
                        <span style="font-size: 2rem;">{{ $menu->image ?? '🍽️' }}</span>
                    @endif
                </td>
                <td style="padding: 15px; font-weight: 600;">{{ $menu->name }}</td>
                <td style="padding: 15px; text-transform: capitalize;">{{ $menu->category }}</td>
                <td style="padding: 15px; font-weight: 700; color: var(--brand-primary);">Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                <td style="padding: 15px; display: flex; align-items: center; gap: 12px; height: 80px;">
                    <form action="{{ route('dashboard.menus.toggle', $menu->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" title="{{ $menu->is_active ? 'Sembunyikan Menu (Sembunyikan)' : 'Tampilkan Menu (Aktifkan)' }}" style="background: none; border: none; padding: 5px; cursor: pointer; border-radius: 5px; transition: background-color 0.2s; display: inline-flex; align-items: center; justify-content: center;">
                            @if($menu->is_active)
                                <!-- Mata Terbuka (Aktif) -->
                                <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="#28a745" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            @else
                                <!-- Mata Tertutup (Disembunyikan) -->
                                <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="#dc3545" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
                            @endif
                        </button>
                    </form>
                    <a href="{{ route('dashboard.menus.edit', $menu->id) }}" style="background: none; border: none; font-size: 1.2rem; text-decoration: none; cursor: pointer; transition: transform 0.2s; display: inline-block;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'" title="Edit">
                        ✏️
                    </a>
                    <form action="{{ route('dashboard.menus.destroy', $menu->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus menu ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: none; border: none; font-size: 1.2rem; cursor: pointer; transition: transform 0.2s; display: inline-block;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'" title="Hapus">
                            🗑️
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="padding: 30px; text-align: center; color: #888;">Belum ada menu.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div style="margin-top: 20px;">
        {{ $menus->links() }}
    </div>
</div>
@endsection
