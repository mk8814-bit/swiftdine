@extends('layouts.dashboard')

@section('content')
<div class="dashboard-header" style="margin-bottom: 30px;">
    <h1 style="font-size: 2rem; font-weight: 800; color: var(--brand-dark);">Cetak Barcode</h1>
    <p style="color: #666; margin-top: 5px;">Buat dan cetak barcode/QR untuk keperluan aplikasi</p>
</div>

<div style="background: white; border-radius: 15px; padding: 40px; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.03); max-width: 600px; margin: 0 auto;">
    
    <div style="width: 250px; height: 250px; background: #f9f6f0; margin: 0 auto 30px auto; display: flex; align-items: center; justify-content: center; border: 2px dashed var(--brand-primary); border-radius: 20px; overflow: hidden;">
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode($baseUrl) }}" alt="QR Code" style="width: 200px; height: 200px; border-radius: 10px;">
    </div>

    <h2 style="font-size: 1.5rem; color: var(--brand-dark); margin-bottom: 10px;">{{ $baseUrl }}</h2>
    <p style="color: #666; margin-bottom: 30px;">Ini adalah URL utama aplikasi Anda yang dapat discan oleh pelanggan untuk mendaftar atau memesan.</p>
    
    <div style="display: flex; gap: 15px; justify-content: center;">
        <button class="btn-primary" style="padding: 12px 30px;" onclick="window.print()">
            🖨️ Cetak QR Code
        </button>
        <button style="padding: 12px 30px; border-radius: 10px; background: var(--brand-cream); color: var(--brand-dark); border: 1px solid #e0d5c1; font-weight: 700; cursor: pointer;">
            Unduh PNG
        </button>
    </div>
</div>
@endsection
