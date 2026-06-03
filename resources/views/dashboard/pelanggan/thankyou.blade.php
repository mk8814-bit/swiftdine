@extends('layouts.dashboard')

@section('content')
<style>
    .thankyou-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 70vh;
    }
    
    .thankyou-card {
        background: var(--brand-light);
        border-radius: 30px;
        padding: 50px 40px;
        text-align: center;
        box-shadow: 0 15px 40px rgba(193, 154, 107, 0.15);
        max-width: 500px;
        width: 100%;
        position: relative;
        overflow: hidden;
    }

    .thankyou-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 10px;
        background: var(--brand-primary);
    }

    .success-icon {
        width: 100px;
        height: 100px;
        background: #e8f5e9;
        color: #4caf50;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        margin: 0 auto 30px;
        animation: scaleIn 0.5s ease-out;
    }

    @keyframes scaleIn {
        0% { transform: scale(0); }
        80% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }

    .thankyou-title {
        font-size: 2.2rem;
        font-weight: 900;
        color: var(--brand-dark);
        margin-bottom: 15px;
    }

    .thankyou-text {
        font-size: 1.1rem;
        color: #666;
        line-height: 1.6;
        margin-bottom: 40px;
    }

    .btn-action {
        display: inline-block;
        background: var(--brand-primary);
        color: white;
        text-decoration: none;
        padding: 15px 40px;
        border-radius: 50px;
        font-weight: 800;
        font-size: 1.1rem;
        transition: all 0.3s;
        box-shadow: 0 8px 20px rgba(193, 154, 107, 0.3);
    }

    .btn-action:hover {
        background: var(--brand-accent);
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(193, 154, 107, 0.4);
    }
</style>

<div class="thankyou-container">
    <div class="thankyou-card">
        <div class="success-icon">
            <svg viewBox="0 0 24 24" width="50" height="50" stroke="currentColor" stroke-width="3" fill="none" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
        </div>
        <h1 class="thankyou-title">Terima Kasih!</h1>
        <p class="thankyou-text">Pembayaran Anda telah berhasil kami terima. Pesanan Anda akan segera diproses oleh tim kami. Selamat menikmati hidangan spesial dari SwiftDine!</p>
        
        <a href="{{ route('dashboard.pelanggan.history') }}" class="btn-action">Lihat Riwayat Pesanan</a>
    </div>
</div>
@endsection
