<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ \App\Models\Setting::where('key', 'site_name')->value('value') ?? 'SwiftDine' }} - Landing Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;700;800;900&display=swap" rel="stylesheet">
    <style>`r`n        .social-icons .fb { color: #1877F2 !important; }`r`n        .social-icons .tw { color: #1DA1F2 !important; }`r`n        .social-icons .ig { color: #E1306C !important; }`r`n        .social-icons .yt { color: #FF0000 !important; }
        :root {
            /* Palette: Putih, Coklat Muda, Cream */
            --brand-primary: #C19A6B; /* Coklat muda */
            --brand-cream: #FDFBF7; /* Cream lembut */
            --brand-dark: #4A3B32; /* Coklat gelap untuk teks */
            --brand-light: #FFFFFF; /* Putih */
            --brand-accent: #A67B5B; /* Coklat muda sedikit gelap untuk hover */
            --brand-banner: #D4A373; /* Coklat muda banner */
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: var(--brand-cream);
            color: var(--brand-dark);
            overflow-x: hidden;
        }

        /* Top Banner */
        .top-banner {
            background-color: var(--brand-banner);
            color: var(--brand-light);
            text-align: center;
            padding: 12px 20px;
            font-size: 1.1rem;
            position: relative;
            z-index: 100;
        }
        
        .top-banner strong {
            font-weight: 800;
            color: var(--brand-dark);
        }

        .close-banner {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--brand-light);
            font-size: 1.5rem;
            cursor: pointer;
            font-weight: bold;
            transition: transform 0.3s ease;
        }

        .close-banner:hover {
            transform: translateY(-50%) scale(1.2);
        }

        /* Header Navigation */
        .header {
            background: var(--brand-light);
            padding: 20px 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 99;
        }

        .logo {
            position: absolute;
            left: 50px;
        }

        .logo h2 {
            font-weight: 900;
            color: var(--brand-primary);
            font-size: 2rem;
            letter-spacing: -1px;
            transition: transform 0.3s ease;
        }
        
        .logo h2:hover {
            transform: scale(1.05);
        }

        .nav-links {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--brand-dark);
            font-weight: 600;
            font-size: 1.05rem;
            position: relative;
            transition: color 0.3s ease;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 3px;
            bottom: -5px;
            left: 50%;
            background-color: var(--brand-primary);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-links a:hover {
            color: var(--brand-primary);
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .nav-links .highlight {
            font-style: italic;
            font-weight: 900;
            color: var(--brand-primary);
            font-size: 1.1rem;
        }

        .nav-links .location {
            display: flex;
            align-items: center;
            gap: 5px;
            border-left: 1px solid #e0d5c1;
            padding-left: 30px;
        }

        /* Dropdown Menu */
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            background-color: var(--brand-light);
            min-width: 160px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            z-index: 1;
            border-radius: 8px;
            padding: 10px 0;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .dropdown:hover .dropdown-content {
            display: flex;
            flex-direction: column;
            opacity: 1;
            animation: fadeIn 0.3s forwards;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translate(-50%, 10px); }
            to { opacity: 1; transform: translate(-50%, 0); }
        }
        .dropdown-content a {
            color: var(--brand-dark);
            padding: 10px 20px;
            text-decoration: none;
            display: block;
            font-size: 0.95rem;
            text-align: center;
        }
        .dropdown-content a::after {
            display: none;
        }
        .dropdown-content a:hover {
            background-color: var(--brand-cream);
        }

        /* Hero Section */
        .hero {
            background-color: var(--brand-cream);
            position: relative;
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 50px 10%;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -10%;
            right: -5%;
            width: 500px;
            height: 500px;
            background: var(--brand-primary);
            opacity: 0.1;
            border-radius: 50%;
            z-index: 0;
        }

        .hero-bg-glow {
            position: absolute;
            width: 1000px;
            height: 1000px;
            background: radial-gradient(circle, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0) 60%);
            top: 50%;
            left: 30%;
            transform: translate(-50%, -50%);
            z-index: 1;
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 600px;
        }

        .hero-content .mym-logo {
            margin-bottom: 20px;
            background: var(--brand-light);
            padding: 10px 30px;
            border-radius: 50px;
            display: inline-block;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            color: var(--brand-primary);
            font-weight: 800;
            font-size: 1.2rem;
            border: 1px solid #f0e6d2;
        }

        .hero-content h1 {
            font-size: 3.2rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 20px;
            color: var(--brand-dark);
        }

        .hero-content h1 span {
            color: var(--brand-primary);
        }

        .hero-content p {
            font-size: 1.8rem;
            font-weight: 500;
            margin-bottom: 40px;
            color: var(--brand-dark);
            opacity: 0.8;
        }

        .btn-primary {
            background-color: var(--brand-primary);
            color: var(--brand-light);
            border: none;
            padding: 20px 40px;
            font-size: 1.3rem;
            font-weight: 700;
            border-radius: 10px;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(193, 154, 107, 0.3);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 25px rgba(193, 154, 107, 0.4);
            background-color: var(--brand-accent);
        }

        .hero-image {
            position: relative;
            z-index: 2;
            flex-basis: 40%;
            display: flex;
            justify-content: center;
        }

        .phone-mockup {
            background-color: var(--brand-primary);
            border-radius: 40px;
            padding: 20px;
            width: 350px;
            box-shadow: 0 20px 50px rgba(74, 59, 50, 0.15);
            position: relative;
            border: 10px solid var(--brand-light);
            transform: rotate(2deg);
            transition: transform 0.5s ease;
        }
        
        .phone-mockup:hover {
            transform: rotate(0deg) scale(1.02);
        }

        .phone-screen {
            background: var(--brand-light);
            border-radius: 20px;
            height: 500px;
            padding: 30px 20px;
            text-align: center;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .phone-screen h2 {
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 10px;
            color: var(--brand-dark);
        }

        .phone-screen h2 span {
            color: var(--brand-primary);
        }

        .rewards-items {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
        }

        .reward-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        .reward-item .circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 2px solid var(--brand-primary);
            background: var(--brand-cream);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 8px;
        }
        
        .reward-item .circle img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .reward-item span {
            font-size: 0.65rem;
            font-weight: 700;
            color: var(--brand-dark);
        }

        .app-stores {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 20px;
        }

        .app-stores img {
            height: 35px;
            cursor: pointer;
            transition: transform 0.2s ease;
        }
        
        .app-stores img:hover {
            transform: scale(1.05);
        }

        /* Floating elements */
        .floating-icon {
            position: absolute;
            width: 70px;
            height: 70px;
            background: var(--brand-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 20px rgba(193, 154, 107, 0.15);
            z-index: 1;
            border: 2px solid var(--brand-cream);
            animation: float 6s ease-in-out infinite;
            font-size: 2rem;
        }

        .icon-1 { top: 15%; left: 10%; transform: rotate(-15deg); animation-delay: 0s; }
        .icon-2 { top: 20%; right: 40%; transform: rotate(10deg); animation-delay: 2s; }
        .icon-3 { bottom: 15%; left: 8%; transform: rotate(20deg); animation-delay: 1s; }
        .icon-4 { bottom: 25%; right: 38%; transform: rotate(-10deg); animation-delay: 3s; }

        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(10deg); }
            100% { transform: translateY(0) rotate(0deg); }
        }

        /* Sliding Button */
        .slide-btn {
            position: fixed;
            right: -170px; /* Hidden text initially */
            top: 25%;
            background-color: var(--brand-light);
            color: var(--brand-dark);
            padding: 12px 25px 12px 15px;
            border-radius: 30px 0 0 30px;
            display: flex;
            align-items: center;
            gap: 15px;
            font-weight: 800;
            font-size: 1.1rem;
            box-shadow: -5px 5px 25px rgba(0,0,0,0.1);
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: pointer;
            z-index: 9999;
            text-decoration: none;
            border: 2px solid var(--brand-primary);
            border-right: none;
        }

        .slide-btn::before {
            content: '';
            position: absolute;
            top: -2px; left: -2px; right: -2px; bottom: -2px;
            background: linear-gradient(45deg, var(--brand-primary), var(--brand-cream));
            z-index: -1;
            border-radius: 32px 0 0 32px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .slide-btn:hover {
            right: 0;
        }

        .slide-btn:hover::before {
            opacity: 1;
        }

        .slide-btn .icon-bg {
            background-color: var(--brand-primary);
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(193, 154, 107, 0.4);
            flex-shrink: 0;
            color: var(--brand-light);
            font-size: 1.2rem;
        }

        @keyframes ride {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-4px); }
        }
        .slide-btn .icon-bg svg {
            animation: ride 0.5s ease-in-out infinite;
        }

        /* Info Section */
        .info-section {
            padding: 80px 10%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: var(--brand-light);
            gap: 50px;
        }

        .info-text {
            flex: 1;
        }

        .info-text h2 {
            font-size: 2.2rem;
            color: var(--brand-dark);
            margin-bottom: 15px;
            margin-top: 40px;
            font-weight: 800;
        }

        .info-text h2:first-child {
            margin-top: 0;
        }

        .info-text p {
            font-size: 1.1rem;
            color: #666;
            line-height: 1.6;
        }

        .info-image {
            flex: 1;
            display: flex;
            justify-content: flex-end;
        }

        .info-image img {
            max-width: 100%;
            height: auto;
        }

        /* Steps Section */
        .steps-section {
            padding: 50px 10%;
            background-color: var(--brand-light);
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
        }

        .step-column {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .step-header {
            background-color: var(--brand-primary);
            color: var(--brand-light);
            text-align: center;
            padding: 15px 30px;
            border-radius: 30px;
            font-size: 1.5rem;
            font-weight: 800;
            position: relative;
        }
        
        .step-header::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            border-width: 10px 10px 0;
            border-style: solid;
            border-color: var(--brand-primary) transparent transparent transparent;
        }

        .step-item {
            display: flex;
            align-items: center;
            gap: 20px;
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
        }
        
        .step-item:last-child {
            border-bottom: none;
        }

        .step-number {
            font-size: 5rem;
            font-weight: 900;
            color: var(--brand-banner);
            line-height: 1;
            opacity: 0.8;
            min-width: 60px;
        }

        .step-text h4 {
            font-size: 1.2rem;
            color: var(--brand-dark);
            font-weight: 800;
            margin-bottom: 5px;
        }

        .step-text p {
            font-size: 1rem;
            color: #666;
            line-height: 1.4;
        }

        /* Banner Section */
        .banner-info {
            background-color: var(--brand-primary);
            background-image: radial-gradient(var(--brand-banner) 20%, transparent 20%);
            background-size: 10px 10px;
            padding: 60px 20px;
            text-align: center;
            color: var(--brand-dark);
        }

        .banner-info h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 30px;
        }

        .banner-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .banner-buttons a {
            background-color: var(--brand-light);
            color: var(--brand-dark);
            text-decoration: none;
            padding: 12px 50px;
            border-radius: 30px;
            font-weight: 800;
            font-size: 1.2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.2s ease;
        }

        .banner-buttons a:hover {
            transform: translateY(-3px);
        }

        /* Footer */
        .footer {
            background-color: var(--brand-cream);
            padding: 50px 10%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            color: var(--brand-dark);
        }

        .footer-col h4 {
            font-size: 1.3rem;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .footer-links {
            list-style: none;
            display: flex;
            gap: 50px;
        }

        .footer-links li {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .footer-links a {
            text-decoration: none;
            color: #666;
            font-size: 1rem;
            font-weight: 500;
        }

        .footer-links a:hover {
            color: var(--brand-primary);
        }

        .social-icons {
            display: flex;
            gap: 15px;
        }
        
        .social-icons svg {
            width: 24px;
            height: 24px;
            color: var(--brand-primary);
            cursor: pointer;
            transition: transform 0.2s ease;
        }
        
        .social-icons svg:hover {
            color: var(--brand-dark);
            transform: scale(1.1);
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .info-section {
                flex-direction: column;
            }
            .steps-section, .footer {
                grid-template-columns: 1fr;
            }
            .hero {
                flex-direction: column;
                text-align: center;
                gap: 50px;
            }
            .hero-content {
                max-width: 100%;
            }
            .nav-links {
                display: none;
            }
            .slide-btn {
                top: auto;
                bottom: 20px;
                right: -150px;
            }
        }
    </style>
</head>
<body>

    <!-- Top Banner -->
    <div class="top-banner">
        <p>{{ \App\Models\Setting::where('key', 'spesial_hari_ini')->value('value') ?? 'Spesial Hari Ini! Nikmati potongan harga hingga Rp 10.000. Pesan sekarang juga!' }}</p>
        <button class="close-banner" onclick="this.parentElement.style.display='none'">&times;</button>
    </div>

    <!-- Header Navigation -->
    <header class="header">
        <div class="logo">
            <a href="#" style="text-decoration: none;">
                <h2>{{ \App\Models\Setting::where('key', 'site_name')->value('value') ?? 'SwiftDine' }}</h2>
            </a>
        </div>
        <nav class="nav-links">
            @guest
                <div class="dropdown">
                    <a href="#">Menu</a>
                    <div class="dropdown-content">
                        <a href="{{ route('menu.show', 'minuman') }}">Minuman</a>
                        <a href="{{ route('menu.show', 'camilan') }}">Camilan</a>
                        <a href="{{ route('menu.show', 'makanan') }}">Makanan</a>
                        <a href="{{ route('menu.show', 'roti') }}">Roti</a>
                        <a href="{{ route('menu.show', 'sarapan-pagi') }}">Sarapan Pagi</a>
                    </div>
                </div>
                <a href="#">Paket Hemat</a>
                <a href="#" class="highlight">PESAN, LANGSUNG SIAPP!</a>
                <a href="#">Berita Terkini</a>
            @else
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'highlight' : '' }}">Dashboard</a>
                
                @if(Auth::user()->role === 'superadmin')
                    <a href="{{ route('dashboard.menus') }}" class="{{ request()->routeIs('dashboard.menus*') ? 'highlight' : '' }}">Kelola Menu</a>
                    <a href="{{ route('dashboard.users') }}" class="{{ request()->routeIs('dashboard.users*') ? 'highlight' : '' }}">Kelola User</a>
                    <a href="{{ route('dashboard.settings') }}" class="{{ request()->routeIs('dashboard.settings*') ? 'highlight' : '' }}">Pengaturan</a>
                @elseif(Auth::user()->role === 'admin')
                    <a href="#">Kelola Menu</a>
                @elseif(Auth::user()->role === 'waiter')
                    <a href="#">Daftar Pesanan</a>
                @elseif(Auth::user()->role === 'kasir')
                    <a href="#">Transaksi</a>
                @elseif(Auth::user()->role === 'pelanggan')
                    <div class="dropdown">
                        <a href="#">Kategori</a>
                        <div class="dropdown-content">
                            <a href="{{ route('menu.show', 'minuman') }}">Minuman</a>
                            <a href="{{ route('menu.show', 'makanan') }}">Makanan</a>
                        </div>
                    </div>
                    <a href="#" class="highlight">Pesan Sekarang</a>
                    <a href="#">Riwayat</a>
                @endif
            @endguest


            @guest
                <a href="{{ route('login') }}" class="btn-login-nav" style="background: var(--brand-primary); color: white; padding: 8px 20px; border-radius: 20px;">Login / Register</a>
            @else
                <div class="dropdown">
                    <a href="#" style="background: var(--brand-cream); padding: 8px 20px; border-radius: 20px; display: flex; align-items: center; gap: 5px;">
                        👤 {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-content">
                        <form method="POST" action="{{ route('logout') }}" style="display: block;">
                            @csrf
                            <button type="submit" style="background: none; border: none; padding: 10px 20px; width: 100%; text-align: center; cursor: pointer; color: var(--brand-dark); font-family: 'Outfit', sans-serif; font-size: 0.95rem;">Logout</button>
                        </form>
                    </div>
                </div>
            @endguest
        </nav>
    </header>

    <!-- Sliding Button -->
    <a href="#" class="slide-btn">
        <div class="icon-bg">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="10" width="6" height="6" rx="1"/>
                <path d="M8 12h5l3-4h4a1 1 0 0 1 1 1v6"/>
                <circle cx="6" cy="18" r="2"/>
                <circle cx="18" cy="18" r="2"/>
                <path d="M12 12v6"/>
            </svg>
        </div>
        <span>Pesan Sekarang</span>
    </a>

    @yield('content')

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-col">
            <h4>SwiftDine</h4>
            <ul class="footer-links">
                <li>
                    <a href="#">Hubungi Kami</a>
                </li>
                <li>
                    <a href="#">Layanan</a>
                </li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Hubungi Kami</h4>
            <div class="social-icons">
                <svg class="fb" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                <svg class="fb" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                <svg class="fb" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                <svg class="fb" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33 2.78 2.78 0 0 0 1.94 2c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.33 29 29 0 0 0-.46-5.33z"></path><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon></svg>
            </div>
        </div>
    </footer>

</body>
</html>



