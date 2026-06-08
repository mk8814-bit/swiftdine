@extends('layouts.dashboard')

@section('content')
    <div class="header-section"
        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h1 style="font-size: 2.2rem; font-weight: 900; color: var(--brand-dark); margin-bottom: 5px;">
                @if(request('view') == 'barang-masuk')
                    Input Barang Masuk
                @elseif(request('view') == 'barang-keluar')
                    Input Barang Keluar
                @else
                    Dashboard Staf Gudang
                @endif
            </h1>
            <p style="color: #666; font-size: 1.05rem;">
                @if(request('view') == 'barang-masuk')
                    Catat penerimaan stok bahan baku dari supplier
                @elseif(request('view') == 'barang-keluar')
                    Catat pengambilan bahan baku untuk keperluan dapur dan bar
                @else
                    Pantau pergerakan stok dan ketersediaan bahan baku hari ini
                @endif
            </p>
        </div>
    </div>

    @if(request('view') == 'barang-masuk' || request('view') == 'barang-keluar')
        <!-- Input Form View -->
        <div
            style="background: white; border-radius: 20px; padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); max-width: 800px;">
            <form action="#" method="POST">
                @csrf
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                    <div>
                        <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Nama
                            Barang</label>
                        <input type="text" placeholder="Cari bahan baku..."
                            style="width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 10px; outline: none; font-family: 'Outfit', sans-serif;">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Tanggal
                            Transaksi</label>
                        <input type="date" value="{{ date('Y-m-d') }}"
                            style="width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 10px; outline: none; font-family: 'Outfit', sans-serif;">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                    <div>
                        <label
                            style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Jumlah</label>
                        <input type="number" placeholder="Contoh: 50"
                            style="width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 10px; outline: none; font-family: 'Outfit', sans-serif;">
                    </div>
                    <div>
                        <label
                            style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Satuan</label>
                        <select
                            style="width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 10px; outline: none; font-family: 'Outfit', sans-serif; background: #fff;">
                            <option>Kg</option>
                            <option>Liter</option>
                            <option>Pcs</option>
                            <option>Porsi</option>
                        </select>
                    </div>
                </div>

                <div style="margin-bottom: 30px;">
                    <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Keterangan
                        Tambahan</label>
                    <textarea rows="3"
                        placeholder="{{ request('view') == 'barang-masuk' ? 'Contoh: Beras Premium dari Supplier A' : 'Contoh: Diambil oleh Chef Budi untuk shift malam' }}"
                        style="width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 10px; outline: none; font-family: 'Outfit', sans-serif; resize: none;"></textarea>
                </div>

                <div style="display: flex; gap: 15px; justify-content: flex-end;">
                    <a href="{{ route('dashboard') }}"
                        style="padding: 12px 25px; border: 1px solid #ddd; border-radius: 10px; color: #666; font-weight: 700; text-decoration: none;">Batal</a>
                    <button type="button" class="btn-primary"
                        style="padding: 12px 30px; font-weight: 800; background: {{ request('view') == 'barang-masuk' ? '#28a745' : '#dc3545' }};"
                        onclick="alert('Data berhasil disimpan!')">
                        Simpan Data Keluar
                    </button>
                </div>
            </form>
        </div>

    @else

        <!-- Dashboard Ringkasan View -->
        <div class="stats-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 30px;">
            <div
                style="background: white; padding: 25px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); display: flex; align-items: center; gap: 20px; border-left: 5px solid #17A2B8;">
                <div
                    style="width: 60px; height: 60px; background: #E0F3F8; border-radius: 15px; display: flex; justify-content: center; align-items: center; color: #17A2B8;">
                    <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2">
                        <path
                            d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                        </path>
                    </svg>
                </div>
                <div>
                    <div style="color: #888; font-size: 0.9rem; font-weight: 700; text-transform: uppercase;">Total Tipe Barang
                    </div>
                    <div style="font-size: 2rem; font-weight: 900; color: var(--brand-dark);">128</div>
                </div>
            </div>

            <div
                style="background: white; padding: 25px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); display: flex; align-items: center; gap: 20px; border-left: 5px solid #28A745;">
                <div
                    style="width: 60px; height: 60px; background: #E8F5E9; border-radius: 15px; display: flex; justify-content: center; align-items: center; color: #28A745;">
                    <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                </div>
                <div>
                    <div style="color: #888; font-size: 0.9rem; font-weight: 700; text-transform: uppercase;">Barang Masuk Hari
                        Ini</div>
                    <div style="font-size: 2rem; font-weight: 900; color: var(--brand-dark);">15 <span
                            style="font-size:1rem; color:#888; font-weight:600;">transaksi</span></div>
                </div>
            </div>

            <div
                style="background: white; padding: 25px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); display: flex; align-items: center; gap: 20px; border-left: 5px solid #DC3545;">
                <div
                    style="width: 60px; height: 60px; background: #FFEBEE; border-radius: 15px; display: flex; justify-content: center; align-items: center; color: #DC3545;">
                    <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                </div>
                <div>
                    <div style="color: #888; font-size: 0.9rem; font-weight: 700; text-transform: uppercase;">Barang Keluar Hari
                        Ini</div>
                    <div style="font-size: 2rem; font-weight: 900; color: var(--brand-dark);">42 <span
                            style="font-size:1rem; color:#888; font-weight:600;">transaksi</span></div>
                </div>
            </div>
        </div>

        <div class="content-grid" style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
            <!-- Alert Minimum Stock -->
            <div style="background: white; border-radius: 20px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                <h3
                    style="font-weight: 800; margin-bottom: 20px; color: var(--brand-dark); font-size: 1.2rem; display: flex; align-items: center; gap: 10px;">
                    <span style="color: #dc3545;">
                        <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z">
                            </path>
                            <line x1="12" y1="9" x2="12" y2="13"></line>
                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                        </svg>
                    </span>
                    Peringatan Stok Menipis
                </h3>

                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background: #fcfbf9; border-bottom: 2px solid #f0e6d2;">
                                <th
                                    style="padding: 12px 15px; text-align: left; font-weight: 800; color: #888; font-size: 0.85rem; text-transform: uppercase;">
                                    Barang</th>
                                <th
                                    style="padding: 12px 15px; text-align: center; font-weight: 800; color: #888; font-size: 0.85rem; text-transform: uppercase;">
                                    Stok Saat Ini</th>
                                <th
                                    style="padding: 12px 15px; text-align: center; font-weight: 800; color: #888; font-size: 0.85rem; text-transform: uppercase;">
                                    Batas Minimum</th>
                                <th
                                    style="padding: 12px 15px; text-align: right; font-weight: 800; color: #888; font-size: 0.85rem; text-transform: uppercase;">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lowStockItems as $item)
                                <tr style="border-bottom: 1px solid #f9f6f0;">
                                    <td style="padding: 15px; font-weight: 700; color: var(--brand-dark);">{{ $item->name }}</td>
                                    <td style="padding: 15px; text-align: center;">
                                        <span
                                            style="background: #FFF3CD; color: #856404; padding: 4px 10px; border-radius: 20px; font-weight: 800; font-size: 0.85rem;">
                                            {{ $item->current_stock }} {{ $item->unit }}
                                        </span>
                                    </td>
                                    <td style="padding: 15px; text-align: center; color: #666; font-weight: 600;">
                                        {{ $item->min_stock }} {{ $item->unit }}</td>
                                    <td style="padding: 15px; text-align: right;">
                                        <a href="{{ route('dashboard', ['view' => 'barang-masuk']) }}"
                                            style="background: var(--brand-primary); color: white; padding: 6px 12px; border-radius: 8px; font-weight: 700; text-decoration: none; font-size: 0.85rem; display: inline-block;">Restok</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Quick Actions -->
            <div style="background: white; border-radius: 20px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                <h3 style="font-weight: 800; margin-bottom: 20px; color: var(--brand-dark); font-size: 1.2rem;">Jalan Pintas
                </h3>
                <div style="display: flex; flex-direction: column; gap: 15px;">
                    <a href="{{ route('dashboard', ['view' => 'barang-masuk']) }}"
                        style="background: #fcfbf9; border: 1px solid #f0e6d2; padding: 20px; border-radius: 15px; text-decoration: none; display: flex; align-items: center; gap: 15px; transition: transform 0.2s;">
                        <div
                            style="background: #E8F5E9; color: #28a745; width: 45px; height: 45px; border-radius: 10px; display: flex; justify-content: center; align-items: center;">
                            <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                        </div>
                        <div>
                            <div style="font-weight: 800; color: var(--brand-dark); font-size: 1.1rem;">Input Barang Masuk</div>
                            <div style="color: #888; font-size: 0.85rem; margin-top: 3px;">Penerimaan stok dari supplier</div>
                        </div>
                    </a>
                    <a href="{{ route('dashboard', ['view' => 'barang-keluar']) }}"
                        style="background: #fcfbf9; border: 1px solid #f0e6d2; padding: 20px; border-radius: 15px; text-decoration: none; display: flex; align-items: center; gap: 15px; transition: transform 0.2s;">
                        <div
                            style="background: #FFEBEE; color: #dc3545; width: 45px; height: 45px; border-radius: 10px; display: flex; justify-content: center; align-items: center;">
                            <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                        </div>
                        <div>
                            <div style="font-weight: 800; color: var(--brand-dark); font-size: 1.1rem;">Input Barang Keluar
                            </div>
                            <div style="color: #888; font-size: 0.85rem; margin-top: 3px;">Pengeluaran stok ke dapur</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    @endif

@endsection