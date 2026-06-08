@extends('layouts.dashboard')

@section('content')
    <div class="dashboard-header"
        style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h1 style="font-size: 2rem; font-weight: 800; color: var(--brand-dark);">Kelola Ketersediaan Meja</h1>
            <p style="color: #666; margin-top: 5px;">Kelola status meja kosong atau terisi.</p>
        </div>
        <a href="{{ route('dashboard.meja.create') }}" class="btn-primary" style="padding: 10px 20px; border-radius: 8px;">
            + Tambah Meja
        </a>
    </div>

    <div style="background: white; border-radius: 15px; padding: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="border-bottom: 2px solid #f0e6d2;">
                    <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Nomor Meja</th>
                    <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Status</th>
                    <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Tamu</th>
                    <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Waktu Pesan</th>
                    <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mejas as $meja)
                    <tr style="border-bottom: 1px solid #f9f6f0;">
                        <td style="padding: 15px; font-weight: 600;">Meja {{ $meja->number }}</td>
                        <td style="padding: 15px;">
                            @if($meja->status == 'occupied')
                                <span
                                    style="background: #FEE2E2; color: #B91C1C; padding: 5px 10px; border-radius: 5px; font-weight: 600; font-size: 0.85rem;">Terisi</span>
                            @else
                                <span
                                    style="background: #DCFCE7; color: #15803D; padding: 5px 10px; border-radius: 5px; font-weight: 600; font-size: 0.85rem;">Kosong</span>
                            @endif
                        </td>
                        <td style="padding: 15px; color: #555;">{{ $meja->guest_name ?? '-' }}</td>
                        <td style="padding: 15px; color: #555;">
                            {{ $meja->reserved_since ? \Carbon\Carbon::parse($meja->reserved_since)->format('H:i') : '-' }}</td>
                        <td style="padding: 15px; display: flex; align-items: center; gap: 12px;">
                            <a href="{{ route('dashboard.meja.edit', $meja->id) }}"
                                style="text-decoration: none; font-size: 1.2rem; display: inline-block; transition: transform 0.2s;"
                                onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'"
                                title="Edit">
                                ✏️
                            </a>
                            <form action="{{ route('dashboard.meja.destroy', $meja->id) }}" method="POST"
                                style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus meja ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    style="background: none; border: none; font-size: 1.2rem; cursor: pointer; transition: transform 0.2s; display: inline-block;"
                                    onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'"
                                    title="Hapus">
                                    🗑️
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding: 30px; text-align: center; color: #888;">Belum ada meja.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection