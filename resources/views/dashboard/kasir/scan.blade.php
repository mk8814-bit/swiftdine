@extends('layouts.dashboard')

@section('content')
    <div class="dashboard-header" style="margin-bottom: 30px;">
        <h1 style="font-size: 2rem; font-weight: 800; color: var(--brand-dark);">Scan Barang</h1>
        <p style="color: #666; margin-top: 5px;">Arahkan alat scanner ke barcode produk untuk memindai barang masuk ke keranjang.</p>
    </div>

    <!-- Form Scanner -->
    <div style="background: white; border-radius: 15px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); margin-bottom: 30px;">
        <form action="{{ route('dashboard.kasir.scan.process') }}" method="POST" style="width: 100%;">
            @csrf
            <div style="position: relative;">
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#999" stroke-width="2"
                    style="position: absolute; left: 15px; top: 13px;">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="9" y1="3" x2="9" y2="21"></line>
                </svg>
                <input type="text" name="kode_barcode" placeholder="Mulai scan barcode di sini..." autofocus autocomplete="off"
                    style="width: 100%; padding: 15px 15px 15px 50px; border: 2px solid var(--brand-primary); border-radius: 12px; font-size: 1.1rem; outline: none; transition: all 0.3s; box-shadow: 0 0 10px rgba(193, 154, 107, 0.2);">
            </div>
            <button type="submit" style="display: none;">Submit</button>
        </form>
    </div>

    <!-- Daftar Barang (Keranjang Kasir) -->
    <div style="background: white; border-radius: 15px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 2px solid #f0e6d2; padding-bottom: 15px;">
            <h3 style="font-weight: 800; color: var(--brand-dark); margin: 0; font-size: 1.3rem;">Daftar Barang Scan</h3>
            @if(count($cart) > 0)
            <form action="{{ route('dashboard.kasir.scan.clear') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengosongkan daftar?');">
                @csrf
                <button type="submit" style="background: #FFEBEE; color: #C62828; border: none; padding: 8px 15px; border-radius: 8px; font-weight: 700; cursor: pointer; display: flex; align-items: center; gap: 5px;">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                    Bersihkan Daftar
                </button>
            </form>
            @endif
        </div>

        @if(count($cart) > 0)
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="text-align: left; padding: 12px 15px; color: #a09386; font-weight: 600; border-bottom: 1px solid #f0e6d2;">No</th>
                            <th style="text-align: left; padding: 12px 15px; color: #a09386; font-weight: 600; border-bottom: 1px solid #f0e6d2;">Produk</th>
                            <th style="text-align: right; padding: 12px 15px; color: #a09386; font-weight: 600; border-bottom: 1px solid #f0e6d2;">Harga</th>
                            <th style="text-align: center; padding: 12px 15px; color: #a09386; font-weight: 600; border-bottom: 1px solid #f0e6d2;">Jml</th>
                            <th style="text-align: right; padding: 12px 15px; color: #a09386; font-weight: 600; border-bottom: 1px solid #f0e6d2;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                            $no = 1;
                        @endphp
                        @foreach($cart as $item)
                        @php
                            $subtotal = $item['harga'] * $item['quantity'];
                            $total += $subtotal;
                        @endphp
                        <tr style="border-bottom: 1px solid #f9f6f0; transition: background 0.2s;">
                            <td style="padding: 15px; font-weight: 500;">{{ $no++ }}</td>
                            <td style="padding: 15px;">
                                <div style="font-weight: 700; color: var(--brand-dark); margin-bottom: 3px;">{{ $item['nama_barang'] }}</div>
                                <div style="font-size: 0.8rem; color: #888;">{{ $item['kode_barang'] }}</div>
                            </td>
                            <td style="padding: 15px; text-align: right;">Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                            <td style="padding: 15px; text-align: center;">
                                <span style="background: var(--brand-cream); color: var(--brand-primary); padding: 5px 12px; border-radius: 5px; font-weight: 800; border: 1px solid #f0e6d2;">{{ $item['quantity'] }}</span>
                            </td>
                            <td style="padding: 15px; text-align: right; font-weight: 700;">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" style="text-align: right; padding: 20px 15px; font-size: 1.2rem; font-weight: 800; color: var(--brand-dark);">T O T A L :</td>
                            <td style="text-align: right; padding: 20px 15px; font-size: 1.4rem; font-weight: 900; color: var(--brand-primary);">Rp {{ number_format($total, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Button Lanjutkan Pembayaran (Mockup) -->
            <div style="margin-top: 30px; display: flex; justify-content: flex-end;">
                <button class="btn-primary" style="padding: 15px 30px; font-size: 1.1rem; display: flex; align-items: center; gap: 10px;">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2" ry="2"></rect><line x1="2" y1="10" x2="22" y2="10"></line></svg>
                    Proses Pembayaran
                </button>
            </div>
        @else
            <!-- Placeholder Jika Kosong -->
            <div style="width: 100%; padding: 40px; border-radius: 12px; text-align: center; border: 2px dashed #e2e8f0; opacity: 0.6;">
                <svg viewBox="0 0 24 24" width="64" height="64" fill="none" stroke="#ccc" stroke-width="1.5" style="margin-bottom: 15px;">
                    <circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                <p style="margin: 0; color: #999; font-weight: 600; font-size: 1.1rem;">Belum ada barang yang discan.</p>
            </div>
        @endif
    </div>

    <!-- Script to ensure barcode scanner focuses easily and is ready -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputField = document.querySelector('input[name="kode_barcode"]');
            
            // Auto focus
            if(inputField) {
                inputField.focus();

                // Keep focus on input if they click anywhere on the page outside of links/buttons 
                document.addEventListener('click', function(e) {
                    if (e.target.tagName !== 'A' && e.target.tagName !== 'BUTTON' && !e.target.closest('button')) {
                        inputField.focus();
                    }
                });
            }
        });
    </script>
@endsection