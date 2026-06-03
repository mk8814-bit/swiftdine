@extends('layouts.dashboard')

@section('content')
<div class="dashboard-header" style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h1 style="font-size: 2rem; font-weight: 800; color: var(--brand-dark);">Inventaris Barang</h1>
        <p style="color: #666; margin-top: 5px;">Kelola stok barang mentah restoran (masuk & keluar).</p>
    </div>
    <div style="display: flex; gap: 10px;">
        <a href="#" class="btn-primary" style="padding: 10px 20px; border-radius: 8px; background: white; color: var(--brand-dark); border: 2px solid #e0d5c1;" onclick="alert('Fitur riwayat transaksi sedang dalam pengembangan.')">
            Riwayat Barang
        </a>
        <a href="{{ route('dashboard.inventories.create') }}" class="btn-primary" style="padding: 10px 20px; border-radius: 8px;">
            + Tambah Barang Baru
        </a>
    </div>
</div>

<div style="background: white; border-radius: 15px; padding: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="border-bottom: 2px solid #f0e6d2;">
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Nama Barang</th>
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Satuan</th>
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Stok Saat Ini</th>
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($inventories as $item)
            <tr style="border-bottom: 1px solid #f9f6f0;">
                <td style="padding: 15px; font-weight: 600;">{{ $item->name }}</td>
                <td style="padding: 15px; text-transform: uppercase; color: #666;">{{ $item->unit }}</td>
                <td style="padding: 15px; font-weight: 700; color: {{ $item->stock < 10 ? '#dc3545' : 'var(--brand-primary)' }};">
                    {{ $item->stock }}
                </td>
                <td style="padding: 15px;">
                    <a href="{{ route('dashboard.inventories.edit', $item->id) }}" style="background: none; border: none; font-size: 1.2rem; text-decoration: none; cursor: pointer; transition: transform 0.2s; display: inline-block; margin-right: 10px;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'" title="Edit">✏️</a>
                    <form action="{{ route('dashboard.inventories.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus barang ini?');">
                        @csrf @method('DELETE')
                        <button style="background: none; border: none; font-size: 1.2rem; cursor: pointer; transition: transform 0.2s; display: inline-block;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'" title="Hapus">🗑️</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="padding: 30px; text-align: center; color: #888;">Belum ada data barang di inventaris.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div style="margin-top: 20px;">
        {{ $inventories->links() }}
    </div>
</div>
@endsection
