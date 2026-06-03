@extends('layouts.dashboard')

@section('content')
<style>
    .dashboard-container {
        padding: 0;
        min-height: 70vh;
    }
    
    .dashboard-header {
        margin-bottom: 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .dashboard-header h1 {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--brand-dark);
    }
    
    .dashboard-header h1 span {
        color: var(--brand-primary);
    }
    
    .dashboard-header p {
        font-size: 1.1rem;
        color: #666;
        margin-top: 5px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-bottom: 50px;
    }

    .stat-card {
        background: var(--brand-light);
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(193, 154, 107, 0.1);
        position: relative;
        overflow: hidden;
        border-top: 5px solid var(--brand-primary);
        transition: transform 0.3s ease;
        text-align: center;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(193, 154, 107, 0.15);
    }

    .stat-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #666;
        margin-bottom: 20px;
    }

    .stat-value {
        font-size: 4rem;
        font-weight: 900;
        color: var(--brand-dark);
        line-height: 1;
    }

    .quick-actions {
        display: flex;
        gap: 20px;
        justify-content: center;
        margin-top: 50px;
    }

    .btn-action {
        background: var(--brand-cream);
        color: var(--brand-dark);
        border: 2px solid var(--brand-primary);
        padding: 20px 40px;
        font-size: 1.2rem;
        font-weight: 800;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .btn-action:hover {
        background: var(--brand-primary);
        color: var(--brand-light);
        transform: translateY(-3px);
    }
</style>

<div class="dashboard-container">
    <div class="dashboard-header">
        <div>
            <h1>Halo, <span>{{ Auth::user()->name }}</span>!</h1>
            <p>Sistem Kasir & Transaksi SwiftDine</p>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-title">Menu Tersedia Hari Ini</div>
            <div class="stat-value">{{ $activeMenus }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-title">Member Terdaftar</div>
            <div class="stat-value">{{ $totalMembers }}</div>
        </div>
    </div>
    
    <div class="quick-actions">
        <button class="btn-action">💵 Buka Transaksi Baru</button>
        <button class="btn-action">📱 Scan QR Member</button>
    </div>
</div>
@endsection
