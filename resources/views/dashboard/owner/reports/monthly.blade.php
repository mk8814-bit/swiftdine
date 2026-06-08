@extends('layouts.dashboard')

@section('content')
    <div class="header-section"
        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h1 style="font-size: 2.2rem; font-weight: 900; color: var(--brand-dark); margin-bottom: 5px;">Laporan Bulanan
            </h1>
            <p style="color: #666; font-size: 1.05rem;">Analisis tren penjualan dan performa bisnis bulanan</p>
        </div>
        <div>
            <select
                style="padding: 10px 20px; border: 1px solid #ddd; border-radius: 10px; outline: none; font-weight: 600; color: var(--brand-dark); font-size: 1.05rem; background: white; cursor: pointer;">
                <option>Tahun 2026</option>
                <option>Tahun 2025</option>
            </select>
        </div>
    </div>

    <div class="chart-container"
        style="background: white; border-radius: 20px; padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); margin-bottom: 30px;">
        <h3 style="font-weight: 800; color: var(--brand-dark); font-size: 1.2rem; margin-bottom: 30px; text-align: center;">
            Tren Penjualan Bulanan (Juta Rupiah)</h3>
        <div
            style="height: 350px; display: flex; align-items: flex-end; gap: 20px; justify-content: space-around; padding-bottom: 30px; border-bottom: 2px solid #f0e6d2; position: relative;">
            @php $maxSales = max($salesData); @endphp
            @foreach($months as $index => $month)
                @php $percentage = ($salesData[$index] / $maxSales) * 100; @endphp
                <div style="display: flex; flex-direction: column; align-items: center; gap: 15px; width: 40px; height: 100%;">
                    <div style="flex: 1; display: flex; align-items: flex-end; width: 100%;">
                        <div style="width: 100%; height: {{ $percentage }}%; background: var(--brand-primary); border-radius: 8px 8px 0 0; position: relative; transition: height 0.5s ease; cursor: pointer;"
                            title="Rp {{ number_format($salesData[$index], 0, ',', '.') }}">
                            <div
                                style="position: absolute; top: -30px; left: 50%; transform: translateX(-50%); font-weight: 800; color: var(--brand-dark); font-size: 0.85rem; width: max-content;">
                                {{ round($salesData[$index] / 1000000, 1) }}M
                            </div>
                        </div>
                    </div>
                    <div style="font-weight: 700; color: #888;">{{ $month }}</div>
                </div>
            @endforeach
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
        <div style="background: white; border-radius: 20px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
            <h3 style="font-weight: 800; color: var(--brand-dark); font-size: 1.1rem; margin-bottom: 20px;">Menu Terlaris
                Bulan Ini</h3>
            <ul style="list-style: none; padding: 0; margin: 0;">
                <li
                    style="display: flex; justify-content: space-between; padding: 15px 0; border-bottom: 1px solid #f9f6f0; font-weight: 600;">
                    <span style="color: var(--brand-dark);">1. Nasi Goreng Spesial</span>
                    <span style="color: var(--brand-primary);">420 Porsi</span>
                </li>
                <li
                    style="display: flex; justify-content: space-between; padding: 15px 0; border-bottom: 1px solid #f9f6f0; font-weight: 600;">
                    <span style="color: var(--brand-dark);">2. Mie Goreng Seafood</span>
                    <span style="color: var(--brand-primary);">315 Porsi</span>
                </li>
                <li style="display: flex; justify-content: space-between; padding: 15px 0; font-weight: 600;">
                    <span style="color: var(--brand-dark);">3. Ayam Bakar Madu</span>
                    <span style="color: var(--brand-primary);">280 Porsi</span>
                </li>
            </ul>
        </div>

        <div style="background: white; border-radius: 20px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
            <h3 style="font-weight: 800; color: var(--brand-dark); font-size: 1.1rem; margin-bottom: 20px;">Statistik
                Pertumbuhan</h3>
            <div style="margin-bottom: 20px;">
                <div
                    style="display: flex; justify-content: space-between; margin-bottom: 5px; font-weight: 600; font-size: 0.95rem;">
                    <span style="color: #666;">Target Penjualan (Tahun Ini)</span>
                    <span style="color: var(--brand-dark);">75%</span>
                </div>
                <div style="width: 100%; height: 10px; background: #f0e6d2; border-radius: 5px; overflow: hidden;">
                    <div style="width: 75%; height: 100%; background: #28a745;"></div>
                </div>
            </div>
            <div>
                <div
                    style="display: flex; justify-content: space-between; margin-bottom: 5px; font-weight: 600; font-size: 0.95rem;">
                    <span style="color: #666;">Retensi Pelanggan</span>
                    <span style="color: var(--brand-dark);">82%</span>
                </div>
                <div style="width: 100%; height: 10px; background: #f0e6d2; border-radius: 5px; overflow: hidden;">
                    <div style="width: 82%; height: 100%; background: var(--brand-primary);"></div>
                </div>
            </div>
        </div>
    </div>
@endsection