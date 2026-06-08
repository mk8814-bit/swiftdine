@extends('layouts.dashboard')

@section('content')
<style>
    @media print {
        body * { visibility: hidden; }
        .main-content, .main-content * { visibility: visible; }
        .main-content { position: absolute; left: 0; top: 0; width: 100%; padding: 0 !important; }
        .no-print, .topbar, .sidebar { display: none !important; }
        .stats-grid { gap: 10px !important; margin-bottom: 20px !important; }
        .stats-grid > div { box-shadow: none !important; border: 1px solid #ddd !important; padding: 15px !important; border-top-width: 3px !important; }
        select { display: none !important; }
    }
</style>
    <div class="header-section"
        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h1 style="font-size: 2.2rem; font-weight: 900; color: var(--brand-dark); margin-bottom: 5px;">Laporan Keuangan
            </h1>
            <p style="color: #666; font-size: 1.05rem;" class="no-print">Pantau arus kas, pendapatan, dan pengeluaran</p>
        </div>
        <div class="no-print" style="display: flex; gap: 10px;">
            <button class="btn-primary" style="display: flex; align-items: center; gap: 8px; background: #dc3545;">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16h16V8l-6-6z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                    <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
                Export PDF
            </button>
            <button class="btn-primary" style="display: flex; align-items: center; gap: 8px; background: #28a745;">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16h16V8l-6-6z"></path>
                    <path d="M14 2v6h6"></path>
                    <line x1="12" y1="18" x2="12" y2="12"></line>
                    <line x1="9" y1="15" x2="15" y2="15"></line>
                </svg>
                Export Excel
            </button>
            <button onclick="window.print()" class="btn-primary" style="display: flex; align-items: center; gap: 8px; background: #4a3b32;">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="6 9 6 2 18 2 18 9"></polyline>
                    <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                    <rect x="6" y="14" width="12" height="8"></rect>
                </svg>
                Print
            </button>
        </div>
    </div>

    <div class="stats-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 40px;">
        <div
            style="background: white; padding: 25px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); border-top: 5px solid var(--brand-primary); text-align: center;">
            <div
                style="color: #888; font-size: 0.95rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px;">
                Total Pendapatan</div>
            <div style="font-size: 2.2rem; font-weight: 900; color: var(--brand-dark);">Rp
                {{ number_format($revenue, 0, ',', '.') }}</div>
        </div>
        <div
            style="background: white; padding: 25px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); border-top: 5px solid #dc3545; text-align: center;">
            <div
                style="color: #888; font-size: 0.95rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px;">
                Total Pengeluaran</div>
            <div style="font-size: 2.2rem; font-weight: 900; color: var(--brand-dark);">Rp
                {{ number_format($expenses, 0, ',', '.') }}</div>
        </div>
        <div
            style="background: white; padding: 25px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); border-top: 5px solid #28a745; text-align: center;">
            <div
                style="color: #888; font-size: 0.95rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px;">
                Laba Bersih</div>
            <div style="font-size: 2.2rem; font-weight: 900; color: var(--brand-dark);">Rp
                {{ number_format($profit, 0, ',', '.') }}</div>
        </div>
    </div>

    <div style="background: white; border-radius: 20px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 style="font-weight: 800; color: var(--brand-dark); font-size: 1.2rem;">Rincian Transaksi Terbaru</h3>
            <select
                style="padding: 10px 15px; border: 1px solid #ddd; border-radius: 10px; outline: none; font-weight: 600; color: var(--brand-dark);">
                <option>Hari Ini</option>
                <option>Minggu Ini</option>
                <option>Bulan Ini</option>
            </select>
        </div>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #fcfbf9; border-bottom: 2px solid #f0e6d2;">
                        <th
                            style="padding: 15px; text-align: left; font-weight: 800; color: #888; font-size: 0.9rem; text-transform: uppercase;">
                            ID Trx</th>
                        <th
                            style="padding: 15px; text-align: left; font-weight: 800; color: #888; font-size: 0.9rem; text-transform: uppercase;">
                            Tanggal</th>
                        <th
                            style="padding: 15px; text-align: left; font-weight: 800; color: #888; font-size: 0.9rem; text-transform: uppercase;">
                            Keterangan</th>
                        <th
                            style="padding: 15px; text-align: left; font-weight: 800; color: #888; font-size: 0.9rem; text-transform: uppercase;">
                            Tipe</th>
                        <th
                            style="padding: 15px; text-align: right; font-weight: 800; color: #888; font-size: 0.9rem; text-transform: uppercase;">
                            Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-bottom: 1px solid #f9f6f0;">
                        <td style="padding: 15px; font-weight: 600;">TRX-9901</td>
                        <td style="padding: 15px; color: #666;">Ahad, 07 Jun</td>
                        <td style="padding: 15px; color: var(--brand-dark); font-weight: 500;">Pemasukan Harian Kasir</td>
                        <td style="padding: 15px;"><span
                                style="background: #d4edda; color: #155724; padding: 5px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700;">Masuk</span>
                        </td>
                        <td style="padding: 15px; text-align: right; font-weight: 800; color: #28a745;">+ Rp 2.500.000</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #f9f6f0;">
                        <td style="padding: 15px; font-weight: 600;">TRX-9902</td>
                        <td style="padding: 15px; color: #666;">Sabtu, 06 Jun</td>
                        <td style="padding: 15px; color: var(--brand-dark); font-weight: 500;">Belanja Bahan Baku (Supplier
                            A)</td>
                        <td style="padding: 15px;"><span
                                style="background: #f8d7da; color: #721c24; padding: 5px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700;">Keluar</span>
                        </td>
                        <td style="padding: 15px; text-align: right; font-weight: 800; color: #dc3545;">- Rp 1.200.000</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #f9f6f0;">
                        <td style="padding: 15px; font-weight: 600;">TRX-9903</td>
                        <td style="padding: 15px; color: #666;">Sabtu, 06 Jun</td>
                        <td style="padding: 15px; color: var(--brand-dark); font-weight: 500;">Pemasukan Harian Kasir</td>
                        <td style="padding: 15px;"><span
                                style="background: #d4edda; color: #155724; padding: 5px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700;">Masuk</span>
                        </td>
                        <td style="padding: 15px; text-align: right; font-weight: 800; color: #28a745;">+ Rp 3.100.000</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection