@extends('layouts.dashboard')

@section('content')
<div class="dashboard-header" style="margin-bottom: 30px;">
    <h1 style="font-size: 2rem; font-weight: 800; color: var(--brand-dark);">Pengaturan Situs</h1>
    <p style="color: #666; margin-top: 5px;">Kelola informasi dasar aplikasi SwiftDine</p>
</div>

<div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); max-width: 800px;">
    <form action="{{ route('dashboard.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div style="margin-bottom: 25px; display: flex; align-items: center; gap: 20px;">
            <div style="width: 80px; height: 80px; border-radius: 50%; border: 2px solid #f0e6d2; overflow: hidden; background: #f9f6f0; display: flex; align-items: center; justify-content: center;">
                <img id="logoPreview" src="{{ isset($settings['site_logo']) ? asset('storage/' . $settings['site_logo']->value) : asset('img/logo.png') }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.style.display='none'; document.getElementById('logoPlaceholder').style.display='block';">
                <span id="logoPlaceholder" style="color: #aaa; font-size: 0.8rem; display: none;">Logo</span>
            </div>
            <div>
                <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Logo Situs</label>
                <input type="file" name="logo" accept="image/*" onchange="initCropper(this, 'logoPreview')" style="font-size: 0.9rem; padding: 5px;">
                <div style="font-size: 0.8rem; color: #888; margin-top: 5px;">Format: JPG, PNG.</div>
            </div>
        </div>
        
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

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('logoPreview');
            output.src = reader.result;
            output.style.display = 'block';
            document.getElementById('logoPlaceholder').style.display = 'none';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
