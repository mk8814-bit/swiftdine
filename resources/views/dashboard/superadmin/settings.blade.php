@extends('layouts.dashboard')

@section('content')
<div class="dashboard-header" style="margin-bottom: 30px;">
    <h1 style="font-size: 2rem; font-weight: 800; color: var(--brand-dark);">Pengaturan Situs</h1>
    <p style="color: #666; margin-top: 5px;">Kelola informasi dasar aplikasi SwiftDine</p>
</div>

<div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); max-width: 800px;">
    <form action="{{ route('dashboard.settings.update') }}" method="POST">
        @csrf
        
        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Nama Situs / Restoran</label>
            <input type="text" name="site_name" value="{{ $settings['site_name']?->value ?? 'SwiftDine' }}" required style="width: 100%; padding: 12px 15px; border: 2px solid #f0e6d2; border-radius: 8px; font-size: 1rem; outline: none;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Tagline</label>
            <input type="text" name="tagline" value="{{ $settings['tagline']?->value ?? 'Gampang Daftarnya, Gampang Dapat Poinnya' }}" style="width: 100%; padding: 12px 15px; border: 2px solid #f0e6d2; border-radius: 8px; font-size: 1rem; outline: none;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Lokasi Utama</label>
            <textarea name="location" rows="3" style="width: 100%; padding: 12px 15px; border: 2px solid #f0e6d2; border-radius: 8px; font-size: 1rem; outline: none; font-family: inherit;">{{ $settings['location']?->value ?? 'Pusat Operasional' }}</textarea>
        </div>

        <div style="margin-bottom: 30px;">
            <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Teks Spesial Hari Ini</label>
            <textarea name="spesial_hari_ini" rows="2" style="width: 100%; padding: 12px 15px; border: 2px solid #f0e6d2; border-radius: 8px; font-size: 1rem; outline: none; font-family: inherit;">{{ $settings['spesial_hari_ini']?->value ?? 'Spesial Hari Ini! Nikmati potongan harga hingga Rp 10.000. Pesan sekarang juga!' }}</textarea>
        </div>

        <button type="submit" class="btn-primary" style="padding: 12px 30px; width: 100%; border-radius: 8px;">
            Simpan Pengaturan
        </button>
    </form>
</div>
@endsection
