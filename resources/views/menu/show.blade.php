@extends('layouts.app')

@section('content')
<style>
    .menu-header {
        background-color: var(--brand-cream);
        text-align: center;
        padding: 60px 20px;
        position: relative;
    }
    
    .menu-header h1 {
        font-size: 3rem;
        font-weight: 900;
        color: var(--brand-dark);
        margin-bottom: 15px;
    }
    
    .menu-header h1 span {
        color: var(--brand-primary);
    }
    
    .menu-header p {
        font-size: 1.2rem;
        color: #666;
        max-width: 600px;
        margin: 0 auto;
    }

    .menu-container {
        padding: 50px 10%;
        background-color: var(--brand-light);
        min-height: 50vh;
    }

    .menu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 40px;
    }

    .menu-card {
        background: var(--brand-cream);
        border-radius: 20px;
        padding: 30px;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 2px solid transparent;
    }

    .menu-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(193, 154, 107, 0.2);
        border-color: var(--brand-primary);
    }

    .menu-image {
        font-size: 5rem;
        margin-bottom: 20px;
        display: inline-block;
        background: var(--brand-light);
        width: 120px;
        height: 120px;
        line-height: 120px;
        border-radius: 50%;
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }

    .menu-title {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--brand-dark);
        margin-bottom: 10px;
    }

    .menu-desc {
        color: #666;
        font-size: 0.95rem;
        margin-bottom: 20px;
        line-height: 1.5;
    }

    .menu-price {
        font-size: 1.3rem;
        font-weight: 900;
        color: var(--brand-primary);
        margin-bottom: 20px;
    }

    .menu-btn {
        background-color: var(--brand-primary);
        color: var(--brand-light);
        border: none;
        padding: 12px 30px;
        border-radius: 30px;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
        width: 100%;
    }

    .menu-btn:hover {
        background-color: var(--brand-accent);
    }

    .breadcrumb {
        padding: 20px 10%;
        background: var(--brand-light);
        font-size: 0.9rem;
    }
    .breadcrumb a {
        color: var(--brand-primary);
        text-decoration: none;
        font-weight: 600;
    }
    .breadcrumb span {
        color: #999;
        margin: 0 10px;
    }
</style>

<div class="breadcrumb">
    <a href="{{ url('/') }}">Home</a> <span>/</span> Menu <span>/</span> {{ $menuData['title'] }}
</div>

<div class="menu-header">
    <h1>Menu <span>{{ $menuData['title'] }}</span></h1>
    <p>{{ $menuData['description'] }}</p>
</div>

<div class="menu-container">
    <div class="menu-grid">
        @forelse($menuData['items'] as $item)
        <div class="menu-card">
            <div class="menu-image">
                {{ $item->image }}
            </div>
            <h3 class="menu-title">{{ $item->name }}</h3>
            <p class="menu-desc">{{ $item->description }}</p>
            <div class="menu-price">Rp {{ number_format($item->price, 0, ',', '.') }}</div>
            <button class="menu-btn">Pesan Sekarang</button>
        </div>
        @empty
        <div style="grid-column: 1/-1; text-align: center; padding: 60px; color: #999;">
            <div style="font-size: 3rem; margin-bottom: 16px;">🍽️</div>
            <p style="font-size: 1.2rem;">Belum ada menu tersedia untuk kategori ini.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
