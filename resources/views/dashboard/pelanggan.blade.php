@extends('layouts.dashboard')

@section('content')
<style>
    .dashboard-container {
        padding: 0;
        min-height: 70vh;
    }
    
    .dashboard-header {
        margin-bottom: 50px;
        text-align: center;
    }
    
    .dashboard-header h1 {
        font-size: 2.8rem;
        font-weight: 900;
        color: var(--brand-dark);
        margin-bottom: 15px;
    }
    
    .dashboard-header h1 span {
        color: var(--brand-primary);
    }
    
    .dashboard-header p {
        font-size: 1.2rem;
        color: #666;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

    .category-section {
        margin-bottom: 60px;
    }

    .category-title {
        font-size: 2rem;
        font-weight: 800;
        color: var(--brand-dark);
        margin-bottom: 30px;
        text-transform: capitalize;
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .category-title::after {
        content: '';
        flex: 1;
        height: 2px;
        background: var(--brand-cream);
        margin-left: 10px;
    }

    .menu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 30px;
    }

    .menu-card {
        background: var(--brand-light);
        border-radius: 25px;
        padding: 30px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(193, 154, 107, 0.08);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .menu-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(193, 154, 107, 0.15);
    }
    
    .menu-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 100px;
        background: var(--brand-cream);
        z-index: 0;
        border-radius: 25px 25px 0 0;
    }

    .menu-icon {
        font-size: 5rem;
        margin-bottom: 20px;
        position: relative;
        z-index: 1;
        text-shadow: 0 10px 20px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }
    
    .menu-icon img {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid var(--brand-cream);
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        vertical-align: middle;
    }
    
    .menu-card:hover .menu-icon {
        transform: scale(1.1) rotate(5deg);
    }

    .menu-title {
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--brand-dark);
        margin-bottom: 10px;
        position: relative;
        z-index: 1;
    }

    .menu-desc {
        font-size: 0.9rem;
        color: #777;
        margin-bottom: 20px;
        line-height: 1.5;
        position: relative;
        z-index: 1;
        min-height: 40px;
    }

    .menu-price {
        color: var(--brand-primary);
        font-weight: 900;
        font-size: 1.5rem;
        margin-bottom: 20px;
        position: relative;
        z-index: 1;
    }
    
    .btn-order {
        background: var(--brand-primary);
        color: var(--brand-light);
        border: none;
        padding: 12px 0;
        width: 100%;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1.1rem;
        cursor: pointer;
        transition: background 0.3s ease;
        position: relative;
        z-index: 1;
    }
    
    .btn-order:hover {
        background: var(--brand-accent);
    }

</style>

<div class="dashboard-container">
    <div class="dashboard-header">
        <h1>Mau pesan apa hari ini, <span>{{ Auth::user()->name }}</span>?</h1>
        <p>Pilih dari berbagai menu spesial kami yang disiapkan dengan bahan berkualitas terbaik khusus untuk Anda.</p>
    </div>

    @forelse($menus as $category => $categoryMenus)
        <div class="category-section">
            <h2 class="category-title">{{ str_replace('-', ' ', $category) }}</h2>
            
            <div class="menu-grid">
                @foreach($categoryMenus as $menu)
                    <div class="menu-card">
                        <div class="menu-icon">
                            @if($menu->image && (strpos($menu->image, '/') !== false || strpos($menu->image, '.') !== false))
                                <img src="{{ asset('storage/' . $menu->image) }}">
                            @else
                                {{ $menu->image ?? '🍽️' }}
                            @endif
                        </div>
                        <div class="menu-title">{{ $menu->name }}</div>
                        <div class="menu-desc">{{ $menu->description ?? 'Nikmati kelezatan menu ini.' }}</div>
                        <div class="menu-price">Rp {{ number_format($menu->price, 0, ',', '.') }}</div>
                        <form action="{{ route('dashboard.pelanggan.cart.add', $menu->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-order">+ Pesan Sekarang</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    @empty
        <div style="text-align: center; padding: 50px; color: #666;">
            <h3>Maaf, belum ada menu yang tersedia saat ini.</h3>
        </div>
    @endforelse
</div>
@endsection
