@extends('layouts.dashboard')

@section('content')
    <div class="header-section"
        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h1 style="font-size: 2.2rem; font-weight: 900; color: var(--brand-dark); margin-bottom: 5px;">Dashboard Owner
            </h1>
            <p style="color: #666; font-size: 1.05rem;">Ringkasan performa dan manajemen operasional SwiftDine</p>
        </div>
    </div>

    <div class="stats-grid"
        style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 40px;">
        <!-- Stat Card 1 -->
        <div
            style="background: white; padding: 25px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); display: flex; align-items: center; gap: 20px; transition: transform 0.3s ease; border-bottom: 4px solid var(--brand-primary);">
            <div
                style="width: 60px; height: 60px; background: var(--brand-cream); border-radius: 15px; display: flex; justify-content: center; align-items: center; color: var(--brand-primary);">
                <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="1" x2="12" y2="23"></line>
                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                </svg>
            </div>
            <div>
                <div
                    style="color: #888; font-size: 0.9rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px;">
                    Total Pendapatan</div>
                <div style="font-size: 1.8rem; font-weight: 800; color: var(--brand-dark);">Rp
                    {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                <div style="font-size: 0.85rem; color: #28A745; margin-top: 5px; font-weight: 600;">+12.5% dari bulan lalu
                </div>
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div
            style="background: white; padding: 25px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); display: flex; align-items: center; gap: 20px; transition: transform 0.3s ease; border-bottom: 4px solid var(--brand-accent);">
            <div
                style="width: 60px; height: 60px; background: var(--brand-cream); border-radius: 15px; display: flex; justify-content: center; align-items: center; color: var(--brand-accent);">
                <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
            </div>
            <div>
                <div
                    style="color: #888; font-size: 0.9rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px;">
                    Karyawan Aktif</div>
                <div style="font-size: 1.8rem; font-weight: 800; color: var(--brand-dark);">{{ $activeEmployees }} Orang
                </div>
                <div style="font-size: 0.85rem; color: #666; margin-top: 5px; font-weight: 600;">Kinerja operasional stabil
                </div>
            </div>
        </div>

        <!-- Stat Card 3 -->
        <div
            style="background: white; padding: 25px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); display: flex; align-items: center; gap: 20px; transition: transform 0.3s ease; border-bottom: 4px solid #D4A373;">
            <div
                style="width: 60px; height: 60px; background: var(--brand-cream); border-radius: 15px; display: flex; justify-content: center; align-items: center; color: #D4A373;">
                <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                </svg>
            </div>
            <div>
                <div
                    style="color: #888; font-size: 0.9rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px;">
                    Total Menu</div>
                <div style="font-size: 1.8rem; font-weight: 800; color: var(--brand-dark);">{{ $totalMenus }} Menu</div>
                <div style="font-size: 0.85rem; color: #28A745; margin-top: 5px; font-weight: 600;">3 Menu Baru Rilis</div>
            </div>
        </div>
    </div>

    <div class="content-grid" style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
        <div class="chart-section"
            style="background: white; border-radius: 20px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
            <h3 style="font-weight: 800; margin-bottom: 20px; color: var(--brand-dark); font-size: 1.2rem;">Grafik
                Pertumbuhan Pendapatan</h3>
            <div
                style="height: 300px; display: flex; align-items: flex-end; gap: 10px; justify-content: center; background: #fcfbf9; border-radius: 10px; padding: 20px; border: 1px dashed #f0e6d2;">
                <!-- Simple CSS Bar Chart Simulation -->
                @php $heights = [40, 60, 45, 80, 55, 90, 75];
                $days = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min']; @endphp
                @foreach($heights as $idx => $h)
                    <div style="display: flex; flex-direction: column; align-items: center; gap: 10px; width: 100%;">
                        <div
                            style="height: {{ $h }}%; width: 100%; background: linear-gradient(180deg, var(--brand-primary) 0%, var(--brand-accent) 100%); border-radius: 5px 5px 0 0; position: relative;">
                            <div
                                style="position: absolute; top: -25px; left: 50%; transform: translateX(-50%); font-size: 0.75rem; font-weight: 700; color: var(--brand-primary);">
                                {{ $h }}M</div>
                        </div>
                        <div style="font-size: 0.8rem; font-weight: 600; color: #888;">{{ $days[$idx] }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="quick-actions"
            style="background: white; border-radius: 20px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
            <h3 style="font-weight: 800; margin-bottom: 20px; color: var(--brand-dark); font-size: 1.2rem;">Aktivitas
                Terkini</h3>
            <ul style="list-style: none; padding: 0; margin: 0;">
                <li
                    style="display: flex; align-items: center; gap: 15px; padding: 15px 0; border-bottom: 1px solid #f9f6f0;">
                    <div style="width: 10px; height: 10px; border-radius: 50%; background: #28A745;"></div>
                    <div style="flex: 1;">
                        <div style="font-weight: 700; font-size: 0.95rem; color: var(--brand-dark);">Laporan Bulanan Dibuat
                        </div>
                        <div style="font-size: 0.8rem; color: #888; margin-top: 3px;">10 Menit yang lalu</div>
                    </div>
                </li>
                <li
                    style="display: flex; align-items: center; gap: 15px; padding: 15px 0; border-bottom: 1px solid #f9f6f0;">
                    <div style="width: 10px; height: 10px; border-radius: 50%; background: var(--brand-primary);"></div>
                    <div style="flex: 1;">
                        <div style="font-weight: 700; font-size: 0.95rem; color: var(--brand-dark);">Gaji Pekerja Dibayarkan
                        </div>
                        <div style="font-size: 0.8rem; color: #888; margin-top: 3px;">Kemarin, 09:00</div>
                    </div>
                </li>
                <li style="display: flex; align-items: center; gap: 15px; padding: 15px 0;">
                    <div style="width: 10px; height: 10px; border-radius: 50%; background: #17A2B8;"></div>
                    <div style="flex: 1;">
                        <div style="font-weight: 700; font-size: 0.95rem; color: var(--brand-dark);">Restok Inventaris
                            Selesai</div>
                        <div style="font-size: 0.8rem; color: #888; margin-top: 3px;">2 Hari yang lalu</div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
@endsection