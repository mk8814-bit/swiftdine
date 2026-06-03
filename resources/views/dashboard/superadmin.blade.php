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
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        margin-bottom: 50px;
    }

    .stat-card {
        background: var(--brand-light);
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(193, 154, 107, 0.1);
        position: relative;
        overflow: hidden;
        border-top: 5px solid var(--brand-primary);
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(193, 154, 107, 0.15);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: -20px;
        right: -20px;
        width: 100px;
        height: 100px;
        background: var(--brand-cream);
        border-radius: 50%;
        z-index: 0;
        opacity: 0.5;
    }

    .stat-card-content {
        position: relative;
        z-index: 1;
    }

    .stat-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #666;
        margin-bottom: 15px;
    }

    .stat-value {
        font-size: 3rem;
        font-weight: 900;
        color: var(--brand-dark);
        line-height: 1;
    }

    .stat-detail {
        margin-top: 15px;
        font-size: 0.9rem;
        color: var(--brand-primary);
        font-weight: 700;
    }

    .roles-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .role-card {
        background: var(--brand-cream);
        padding: 20px;
        border-radius: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: 1px solid #f0e6d2;
    }

    .role-card .role-name {
        font-weight: 800;
        color: var(--brand-dark);
        text-transform: capitalize;
    }

    .role-card .role-count {
        background: var(--brand-primary);
        color: var(--brand-light);
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-weight: 800;
    }

    .section-title {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--brand-dark);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .section-title::before {
        content: '';
        display: inline-block;
        width: 8px;
        height: 30px;
        background: var(--brand-primary);
        border-radius: 4px;
    }
</style>

<div class="dashboard-container">
    <div class="dashboard-header">
        <div>
            <h1>Halo, <span>{{ Auth::user()->name }}</span>!</h1>
            <p>Selamat datang di Dashboard Superadmin <strong>{{ $siteName }}</strong></p>
        </div>
        <div>
            <button class="btn-primary" style="padding: 12px 25px; font-size: 1.1rem; border-radius: 50px;">
                ⚙️ Pengaturan Situs
            </button>
        </div>
    </div>

    <div class="stats-grid">
        <!-- Users Stat -->
        <div class="stat-card">
            <div class="stat-card-content">
                <div class="stat-title">Total Pengguna</div>
                <div class="stat-value">{{ $totalUsers }}</div>
                <div class="stat-detail">✓ {{ $activeUsers }} Pengguna Internal Aktif</div>
            </div>
        </div>

        <!-- Menus Stat -->
        <div class="stat-card">
            <div class="stat-card-content">
                <div class="stat-title">Total Menu Tersedia</div>
                <div class="stat-value">{{ $totalMenus }}</div>
                <div class="stat-detail">⚠ {{ $hiddenMenus }} Menu Disembunyikan</div>
            </div>
        </div>

        <!-- Location Stat -->
        <div class="stat-card">
            <div class="stat-card-content">
                <div class="stat-title">Lokasi Utama</div>
                <div class="stat-value" style="font-size: 1.8rem; margin-top: 15px;">{{ $location }}</div>
                <div class="stat-detail">Pusat Operasional</div>
            </div>
        </div>
    </div>

    <h2 class="section-title">Distribusi Role Pengguna</h2>
    <div class="roles-grid">
        @foreach($usersByRole as $roleData)
            <div class="role-card">
                <span class="role-name">🛡️ {{ $roleData->role }}</span>
                <span class="role-count">{{ $roleData->total }}</span>
            </div>
        @endforeach
    </div>
</div>
@endsection
