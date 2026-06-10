@extends('layouts.dashboard')

@section('content')
    <div class="header-action"
        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h2 style="font-weight: 800; color: var(--brand-dark); font-size: 1.8rem; margin-bottom: 5px;">Kelola Menu
                Barang</h2>
            <p style="color: #666;">Manajemen data nama barang, kode, dan harga.</p>
        </div>
        <a href="{{ route('dashboard.barang.create') }}" class="btn-primary"
            style="display: flex; align-items: center; gap: 8px;">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Tambah Barang
        </a>
    </div>

    <div style="background: white; border-radius: 15px; padding: 25px; box-shadow: 0 5px 20px rgba(0,0,0,0.03);">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 2px solid #f0e6d2;">
                        <th style="text-align: left; padding: 15px; color: #a09386; font-weight: 600;">No</th>
                        <th style="text-align: left; padding: 15px; color: #a09386; font-weight: 600;">Kode Barang</th>
                        <th style="text-align: left; padding: 15px; color: #a09386; font-weight: 600;">Nama Barang</th>
                        <th style="text-align: right; padding: 15px; color: #a09386; font-weight: 600;">Harga (Rp)</th>
                        <th style="text-align: right; padding: 15px; color: #a09386; font-weight: 600;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barangs as $index => $item)
                        <tr style="border-bottom: 1px solid #f9f6f0; transition: background 0.2s;">
                            <td style="padding: 15px; font-weight: 500;">{{ $index + 1 }}</td>
                            <td style="padding: 15px;">{{ $item->kode_barang }}</td>
                            <td style="padding: 15px; font-weight: 600;">{{ $item->nama_barang }}</td>
                            <td style="padding: 15px; text-align: right;">{{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td style="padding: 15px; text-align: right;">
                                <a href="{{ route('dashboard.barang.edit', $item->id) }}"
                                    style="background: #FFF8E1; color: #F57F17; border: none; padding: 8px 12px; border-radius: 8px; cursor: pointer; text-decoration: none; margin-right: 5px;">Edit</a>
                                <form action="{{ route('dashboard.barang.destroy', $item->id) }}" method="POST"
                                    style="display:inline-block;"
                                    onsubmit="return confirm('Yakin ingin menghapus barang ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        style="background: #FFEBEE; color: #C62828; border: none; padding: 8px 12px; border-radius: 8px; cursor: pointer;">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding: 30px; text-align: center; color: #888;">Belum ada data barang.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection