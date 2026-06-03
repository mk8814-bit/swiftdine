@extends('layouts.dashboard')

@section('content')
<div class="dashboard-header" style="margin-bottom: 30px;">
    <h1 style="font-size: 2rem; font-weight: 800; color: var(--brand-dark);">Cetak Barcode</h1>
    <p style="color: #666; margin-top: 5px;">Buat dan cetak barcode/QR untuk keperluan aplikasi</p>
</div>

<div style="background: white; border-radius: 15px; padding: 40px; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.03); max-width: 600px; margin: 0 auto;">
    
    <div style="width: 250px; height: 250px; background: #f9f6f0; margin: 0 auto 30px auto; display: flex; align-items: center; justify-content: center; border: 2px dashed var(--brand-primary); border-radius: 20px;">
        <!-- Placeholder for QR Code generation, normally you'd use a package like simplesoftwareio/simple-qrcode -->
        <svg width="150" height="150" viewBox="0 0 24 24" fill="none" stroke="var(--brand-dark)" stroke-width="1.5">
            <rect x="3" y="3" width="7" height="7"></rect>
            <rect x="14" y="3" width="7" height="7"></rect>
            <rect x="14" y="14" width="7" height="7"></rect>
            <rect x="3" y="14" width="7" height="7"></rect>
            <rect x="5" y="5" width="3" height="3"></rect>
            <rect x="16" y="5" width="3" height="3"></rect>
            <rect x="16" y="16" width="3" height="3"></rect>
            <rect x="5" y="16" width="3" height="3"></rect>
            <line x1="9" y1="3" x2="11" y2="3"></line>
            <line x1="13" y1="3" x2="13" y2="5"></line>
            <line x1="11" y1="5" x2="11" y2="7"></line>
            <line x1="11" y1="7" x2="13" y2="7"></line>
            <line x1="9" y1="9" x2="15" y2="9"></line>
            <line x1="9" y1="11" x2="15" y2="11"></line>
            <line x1="9" y1="13" x2="11" y2="13"></line>
            <line x1="13" y1="13" x2="13" y2="15"></line>
            <line x1="9" y1="15" x2="11" y2="15"></line>
            <line x1="9" y1="17" x2="9" y2="21"></line>
            <line x1="11" y1="17" x2="11" y2="19"></line>
            <line x1="11" y1="21" x2="13" y2="21"></line>
            <line x1="13" y1="17" x2="15" y2="17"></line>
        </svg>
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
