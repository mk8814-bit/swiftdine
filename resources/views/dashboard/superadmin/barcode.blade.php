@extends('layouts.dashboard')

@section('content')
    <div class="dashboard-header"
        style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h1 style="font-size: 2rem; font-weight: 800; color: var(--brand-dark);">Scan Meja</h1>
            <p style="color: #666; margin-top: 5px;">Kelola meja dan cetak QR Code untuk pemesanan mandiri.</p>
        </div>
        <a href="{{ route('dashboard.meja.create') }}" class="btn-primary" style="padding: 10px 20px; border-radius: 8px;">
            + Tambah Meja
        </a>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 25px;">
        @forelse($mejas as $meja)
            <div
                style="background: white; border-radius: 15px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); text-align: center; position: relative; border: 1px solid #f0e6d2;">
                <div style="position: absolute; top: 15px; right: 15px; display: flex; gap: 8px;">
                    <a href="{{ route('dashboard.meja.edit', $meja->id) }}"
                        style="text-decoration: none; font-size: 1rem; color: #666;" title="Edit">✏️</a>
                    <form action="{{ route('dashboard.meja.destroy', $meja->id) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus meja ini?');" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            style="background: none; border: none; font-size: 1rem; cursor: pointer; color: #666;"
                            title="Hapus">🗑️</button>
                    </form>
                </div>

                <div
                    style="width: 150px; height: 150px; background: #f9f6f0; margin: 20px auto 20px auto; display: flex; align-items: center; justify-content: center; border: 2px solid var(--brand-primary); border-radius: 15px; overflow: hidden; padding: 10px;">
                    @php
                        $qrData = $baseUrl . '/login?table=' . $meja->number;
                        // Alternatively, if the app supports direct menu access with table
                        // $qrData = $baseUrl . '/menu/makanan?table=' . $meja->number;
                    @endphp
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode($qrData) }}"
                        alt="QR Code Meja {{ $meja->number }}" style="width: 100%; height: 100%; border-radius: 5px;">
                </div>

                <h3 style="font-size: 1.3rem; color: var(--brand-dark); margin-bottom: 5px;">Meja {{ $meja->number }}</h3>

                <div style="margin-bottom: 15px;">
                    @if($meja->status == 'occupied')
                        <span
                            style="background: #FEE2E2; color: #B91C1C; padding: 4px 10px; border-radius: 50px; font-weight: 700; font-size: 0.75rem; text-transform: uppercase;">Terisi</span>
                        <p style="font-size: 0.85rem; color: #888; margin-top: 5px;">Oleh: {{ $meja->guest_name ?? 'Tamu' }}</p>
                    @else
                        <span
                            style="background: #DCFCE7; color: #15803D; padding: 4px 10px; border-radius: 50px; font-weight: 700; font-size: 0.75rem; text-transform: uppercase;">Kosong</span>
                        <p style="font-size: 0.85rem; color: #888; margin-top: 5px;">Tersedia</p>
                    @endif
                </div>

                <div style="display: flex; gap: 10px; justify-content: center; margin-top: 20px;">
                    <button class="btn-primary" style="padding: 8px 15px; font-size: 0.9rem;"
                        onclick="printQR('{{ $meja->number }}', '{{ $qrData }}')">
                        🖨️ Cetak QR
                    </button>
                    <a href="https://api.qrserver.com/v1/create-qr-code/?size=500x500&data={{ urlencode($qrData) }}"
                        download="QR_Meja_{{ $meja->number }}.png" target="_blank"
                        style="padding: 8px 15px; border-radius: 10px; background: var(--brand-cream); color: var(--brand-dark); border: 1px solid #e0d5c1; font-weight: 700; cursor: pointer; text-decoration: none; font-size: 0.9rem;">
                        📥 Unduh
                    </a>
                </div>
            </div>
        @empty
            <div
                style="grid-column: 1 / -1; background: white; border-radius: 15px; padding: 50px; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                <p style="color: #666;">Belum ada meja yang terdaftar.</p>
                <a href="{{ route('dashboard.meja.create') }}" class="btn-primary" style="margin-top: 15px;">Tambah Meja
                    Sekarang</a>
            </div>
        @endforelse
    </div>

    <script>
        function printQR(number, data) {
            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
            <html>
                <head>
                    <title>Cetak QR Meja ${number}</title>
                    <style>
                        body { font-family: sans-serif; text-align: center; padding: 50px; }
                        .qr-container { border: 2px solid #000; padding: 30px; display: inline-block; border-radius: 20px; }
                        h1 { margin-bottom: 20px; }
                        img { width: 300px; height: 300px; }
                        p { margin-top: 20px; font-size: 1.2rem; font-weight: bold; }
                    </style>
                </head>
                <body>
                    <div class="qr-container">
                        <h1>SwiftDine</h1>
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=${encodeURIComponent(data)}" alt="QR Code">
                        <p>MEJA ${number}</p>
                        <p style="font-size: 0.8rem; font-weight: normal; color: #666;">Scan untuk memesan</p>
                    </div>
                    <script>
                        window.onload = function() {
                            window.print();
                            setTimeout(() => window.close(), 500);
                        }
                    <\/script>
                </body>
            </html>
        `);
            printWindow.document.close();
        }
    </script>
@endsection