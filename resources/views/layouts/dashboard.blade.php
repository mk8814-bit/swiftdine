<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - {{ \App\Models\Setting::where('key', 'site_name')->value('value') ?? 'SwiftDine' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <style>
        :root {
            --brand-primary: #C19A6B;
            /* Coklat muda */
            --brand-cream: #FDFBF7;
            /* Cream lembut */
            --brand-dark: #4A3B32;
            /* Coklat gelap untuk teks */
            --brand-light: #FFFFFF;
            /* Putih */
            --brand-accent: #A67B5B;
            /* Coklat muda sedikit gelap */
            --brand-banner: #D4A373;
            /* Coklat muda banner */

            --sidebar-width: 280px;
            --topbar-height: 80px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: #F8F5F0;
            /* Sedikit lebih gelap dari cream untuk bedakan background dengan card */
            color: var(--brand-dark);
            overflow-x: hidden;
            display: flex;
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background-color: var(--brand-light);
            position: fixed;
            left: 0;
            top: 0;
            box-shadow: 2px 0 20px rgba(0, 0, 0, 0.05);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
        }

        .sidebar-header {
            height: var(--topbar-height);
            display: flex;
            align-items: center;
            padding: 0 30px;
            border-bottom: 1px solid #f0e6d2;
        }

        .sidebar-header a {
            text-decoration: none;
            color: var(--brand-primary);
            font-weight: 900;
            font-size: 1.8rem;
            letter-spacing: -1px;
        }

        .sidebar-menu {
            padding: 20px 0;
            overflow-y: auto;
            flex: 1;
        }

        .menu-title {
            padding: 10px 30px;
            font-size: 0.8rem;
            text-transform: uppercase;
            font-weight: 800;
            color: #a09386;
            letter-spacing: 1px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 15px 30px;
            color: var(--brand-dark);
            text-decoration: none;
            font-weight: 600;
            font-size: 1.05rem;
            transition: all 0.2s ease;
            gap: 15px;
            position: relative;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background-color: var(--brand-cream);
            color: var(--brand-primary);
        }

        .sidebar-menu a.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 5px;
            background-color: var(--brand-primary);
            border-radius: 0 5px 5px 0;
        }

        .sidebar-menu a svg {
            width: 20px;
            height: 20px;
            opacity: 0.7;
        }

        .sidebar-menu a:hover svg,
        .sidebar-menu a.active svg {
            opacity: 1;
        }

        /* Topbar Styles */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            flex: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.3s ease;
        }

        .topbar {
            height: var(--topbar-height);
            background-color: var(--brand-light);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 40px;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--brand-dark);
            cursor: pointer;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--brand-cream);
            padding: 8px 15px 8px 8px;
            border-radius: 50px;
            cursor: pointer;
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            background-color: var(--brand-primary);
            color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 800;
            font-size: 1.1rem;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 700;
            font-size: 0.95rem;
            line-height: 1.2;
        }

        .user-role {
            font-size: 0.75rem;
            color: #888;
            text-transform: capitalize;
            font-weight: 500;
        }

        .btn-logout {
            background-color: #FFF0F0;
            color: #E53935;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background 0.2s;
        }

        .btn-logout:hover {
            background-color: #FFE5E5;
        }

        /* Content Area */
        .main-content {
            padding: 40px;
            flex: 1;
        }

        /* General Buttons */
        .btn-primary {
            background-color: var(--brand-primary);
            color: var(--brand-light);
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: 700;
            border-radius: 10px;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(193, 154, 107, 0.2);
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(193, 154, 107, 0.3);
            background-color: var(--brand-accent);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-wrapper {
                margin-left: 0;
            }

            .mobile-toggle {
                display: block;
            }

            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
            }

            .overlay.show {
                display: block;
            }
        }

        /* Pagination Styles */
        .pagination {
            display: flex;
            list-style: none;
            padding-left: 0;
            gap: 5px;
            margin-top: 20px;
            align-items: center;
            justify-content: center;
        }

        .page-item .page-link {
            color: var(--brand-dark);
            background-color: var(--brand-light);
            border: 1px solid #f0e6d2;
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s;
        }

        .page-item.active .page-link {
            background-color: var(--brand-primary);
            color: white;
            border-color: var(--brand-primary);
        }

        .page-item .page-link:hover:not(.active) {
            background-color: var(--brand-cream);
            color: var(--brand-primary);
        }

        .page-item.disabled .page-link {
            color: #ccc;
            background-color: #f9f6f0;
            border-color: #f0e6d2;
            cursor: not-allowed;
        }

        /* Circular Cropper Style */
        .cropper-view-box,
        .cropper-face {
            border-radius: 50%;
        }
    </style>
</head>

<body>

    <div class="overlay" id="overlay"></div>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ url('/') }}" style="display: flex; align-items: center; gap: 10px;">
                <img src="{{ \App\Models\Setting::where('key', 'site_logo')->value('value') ? asset('storage/' . \App\Models\Setting::where('key', 'site_logo')->value('value')) : asset('img/logo.png') }}"
                    alt="Logo" style="height: 35px; width: 35px; border-radius: 50%; object-fit: cover;"
                    onerror="this.style.display='none'">
                <span>{{ \App\Models\Setting::where('key', 'site_name')->value('value') ?? 'SwiftDine' }}</span>
            </a>
        </div>

        <div class="sidebar-menu">
            <div class="menu-title">Utama</div>
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                Dashboard
            </a>

            @if(Auth::user()->role === 'superadmin')
                <div class="menu-title" style="margin-top: 15px;">Manajemen Situs</div>
                <a href="{{ route('dashboard.settings') }}"
                    class="{{ request()->routeIs('dashboard.settings*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="3"></circle>
                        <path
                            d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                        </path>
                    </svg>
                    Pengaturan
                </a>
            @endif

            @if(Auth::user()->role === 'superadmin')
                <div class="menu-title" style="margin-top: 15px;">Manajemen Sistem</div>
                <a href="{{ route('dashboard.menus') }}"
                    class="{{ request()->routeIs('dashboard.menus*') && request('category') !== 'paket-hemat' ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                    Kelola Menu
                </a>
                <a href="{{ route('dashboard.meja.index') }}"
                    class="{{ request()->routeIs('dashboard.meja*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    Ketersediaan Meja
                </a>
                <a href="{{ route('dashboard.packages.index') }}"
                    class="{{ request()->routeIs('dashboard.packages*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 12v10H4V12"></path>
                        <path d="M2 7h20v5H2z"></path>
                        <line x1="12" y1="22" x2="12" y2="7"></line>
                        <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path>
                        <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path>
                    </svg>
                    Menu Paket Hemat
                </a>
                <a href="{{ route('dashboard.users') }}"
                    class="{{ request()->routeIs('dashboard.users*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    Kelola Pengguna
                </a>
                <a href="{{ route('dashboard.reports') }}"
                    class="{{ request()->routeIs('dashboard.reports*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                    Laporan Transaksi
                </a>
                <a href="{{ route('dashboard.barcode') }}"
                    class="{{ request()->routeIs('dashboard.barcode*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="9" y1="3" x2="9" y2="21"></line>
                    </svg>
                    Cetak Barcode / Scan Meja
                </a>

                <div class="menu-title" style="margin-top: 15px;">Operasional & Keuangan</div>
                <a href="{{ route('dashboard.salaries.index') }}"
                    class="{{ request()->routeIs('dashboard.salaries*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="1" x2="12" y2="23"></line>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                    Gaji Pekerja
                </a>
                <a href="{{ route('dashboard.inventories.index') }}"
                    class="{{ request()->routeIs('dashboard.inventories*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path
                            d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                        </path>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                    </svg>
                    Inventaris Barang
                </a>
                <a href="{{ route('dashboard.operational-costs.index') }}"
                    class="{{ request()->routeIs('dashboard.operational-costs*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="2" y="4" width="20" height="16" rx="2" ry="2"></rect>
                        <line x1="6" y1="12" x2="18" y2="12"></line>
                        <line x1="12" y1="6" x2="12" y2="18"></line>
                    </svg>
                    Biaya Operasional
                </a>
                <a href="{{ route('dashboard.addons.index') }}"
                    class="{{ request()->routeIs('dashboard.addons*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                        <line x1="9" y1="9" x2="9.01" y2="9"></line>
                        <line x1="15" y1="9" x2="15.01" y2="9"></line>
                    </svg>
                    Kelola Topping
                </a>
            @elseif(Auth::user()->role === 'admin')
                <div class="menu-title" style="margin-top: 15px;">Manajemen Restoran</div>
                <a href="{{ route('dashboard.menus') }}"
                    class="{{ request()->routeIs('dashboard.menus*') && request('category') !== 'paket-hemat' ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                    Kelola Menu
                </a>
                <a href="{{ route('dashboard.meja.index') }}"
                    class="{{ request()->routeIs('dashboard.meja*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    Ketersediaan Meja
                </a>
                <a href="{{ route('dashboard.packages.index') }}"
                    class="{{ request()->routeIs('dashboard.packages*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 12v10H4V12"></path>
                        <path d="M2 7h20v5H2z"></path>
                        <line x1="12" y1="22" x2="12" y2="7"></line>
                        <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path>
                        <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path>
                    </svg>
                    Menu Paket Hemat
                </a>
                <a href="{{ route('dashboard.users') }}"
                    class="{{ request()->routeIs('dashboard.users*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    Kelola Pengguna
                </a>
                <a href="{{ route('dashboard.reports') }}"
                    class="{{ request()->routeIs('dashboard.reports*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                    Laporan Transaksi
                </a>
                <a href="{{ route('dashboard.barcode') }}"
                    class="{{ request()->routeIs('dashboard.barcode*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="9" y1="3" x2="9" y2="21"></line>
                    </svg>
                    Cetak Barcode / Scan Meja
                </a>
            @elseif(Auth::user()->role === 'waiter')
                <div class="menu-title" style="margin-top: 15px;">Tugas</div>
                <a href="{{ route('dashboard.waiter.orders') }}"
                    class="{{ request()->routeIs('dashboard.waiter.orders*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                    Daftar Pesanan
                </a>
                <a href="{{ route('dashboard') }}"
                    class="{{ request()->routeIs('dashboard') && !request()->routeIs('dashboard.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    Ketersediaan Meja
                </a>
            @elseif(Auth::user()->role === 'kasir')
                <div class="menu-title" style="margin-top: 15px;">Transaksi</div>
                <a href="{{ route('dashboard.kasir.scan') }}"
                    class="{{ request()->routeIs('dashboard.kasir.scan') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="9" y1="3" x2="9" y2="21"></line>
                    </svg>
                    Scan Barang
                </a>
                <a href="#">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="2" y="5" width="20" height="14" rx="2" ry="2"></rect>
                        <line x1="2" y1="10" x2="22" y2="10"></line>
                    </svg>
                    Pembayaran
                </a>
                <a href="#">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                    Riwayat Transaksi
                </a>
            @elseif(Auth::user()->role === 'owner')
                <div class="menu-title" style="margin-top: 15px;">Manajemen & Laporan</div>

                <a href="{{ route('dashboard.owner.reports.finance') }}"
                    class="{{ request()->routeIs('dashboard.owner.reports.finance') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="1" x2="12" y2="23"></line>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                    Laporan Keuangan
                </a>
                <a href="{{ route('dashboard.owner.reports.monthly') }}"
                    class="{{ request()->routeIs('dashboard.owner.reports.monthly') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 3v18h18"></path>
                        <path d="M18.7 8l-5.1 5.2-2.8-2.7L7 14.3"></path>
                    </svg>
                    Laporan Bulanan
                </a>
            @elseif(in_array(Auth::user()->role, ['koki', 'barista']))
                <div class="menu-title" style="margin-top: 15px;">Dapur & Bar</div>
                <a href="{{ route('dashboard') }}" class="active">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                    Daftar Pesanan Baru
                </a>
            @elseif(Auth::user()->role === 'staf_gudang')
                <div class="menu-title" style="margin-top: 15px;">Gudang & Stok</div>
                <a href="{{ route('dashboard') }}"
                    class="{{ request()->routeIs('dashboard') && empty(request()->all()) ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path
                            d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                        </path>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                    </svg>
                    Ringkasan Stok
                </a>
                <a href="{{ route('dashboard', ['view' => 'barang-masuk']) }}"
                    class="{{ request('view') == 'barang-masuk' ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Barang Masuk
                </a>
                <a href="{{ route('dashboard', ['view' => 'barang-keluar']) }}"
                    class="{{ request('view') == 'barang-keluar' ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Barang Keluar
                </a>
            @elseif(Auth::user()->role === 'pelanggan')
                <div class="menu-title" style="margin-top: 15px;">Pemesanan</div>
                <a href="{{ route('dashboard.pelanggan.cart') }}"
                    class="{{ request()->routeIs('dashboard.pelanggan.cart') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                    Pesan Baru
                </a>
                <a href="{{ route('dashboard.pelanggan.history') }}"
                    class="{{ request()->routeIs('dashboard.pelanggan.history') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                    Riwayat Pesanan
                </a>
            @endif
        </div>
    </aside>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Topbar -->
        <header class="topbar">
            <div class="topbar-left">
                <button class="mobile-toggle" id="mobileToggle">☰</button>
            </div>

            <div class="topbar-right">
                <a href="{{ route('profile.edit') }}" style="text-decoration: none; color: inherit;">
                    <div class="user-profile">
                        <div class="user-avatar" style="overflow: hidden;">
                            @if(Auth::user()->profile_picture)
                                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile"
                                    style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                            @else
                                {{ substr(Auth::user()->name, 0, 1) }}
                            @endif
                        </div>
                        <div class="user-info">
                            <span class="user-name">{{ Auth::user()->name }}</span>
                            <span class="user-role">{{ Auth::user()->role }}</span>
                        </div>
                    </div>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </header>

        <!-- Main Content -->
        <main class="main-content">
            @if(session('success'))
                <div
                    style="background-color: #D4EDDA; color: #155724; padding: 15px 20px; border-radius: 10px; margin-bottom: 20px; border-left: 5px solid #28A745;">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div
                    style="background-color: #F8D7DA; color: #721C24; padding: 15px 20px; border-radius: 10px; margin-bottom: 20px; border-left: 5px solid #DC3545;">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('info'))
                <div
                    style="background-color: #D1ECF1; color: #0C5460; padding: 15px 20px; border-radius: 10px; margin-bottom: 20px; border-left: 5px solid #17A2B8;">
                    {{ session('info') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script>
        document.getElementById('mobileToggle').addEventListener('click', function () {
            document.getElementById('sidebar').classList.add('show');
            document.getElementById('overlay').classList.add('show');
        });

        document.getElementById('overlay').addEventListener('click', function () {
            document.getElementById('sidebar').classList.remove('show');
            document.getElementById('overlay').classList.remove('show');
        });
    </script>

    <!-- Crop Modal -->
    <div id="cropModal"
        style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.85); z-index:9999; align-items:center; justify-content:center; flex-direction:column;">
        <div
            style="background:white; padding:25px; border-radius:15px; width:90%; max-width:500px; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
            <h3 style="margin-bottom:20px; text-align:center; font-weight:800; color:var(--brand-dark);">Sesuaikan
                Gambar</h3>
            <div
                style="max-height:400px; overflow:hidden; display:flex; justify-content:center; background:#f9f6f0; border-radius:10px;">
                <img id="cropImage" src="" style="max-width:100%; max-height:400px;">
            </div>
            <div style="margin-top:25px; display:flex; justify-content:flex-end; gap:15px;">
                <button type="button" onclick="closeCropModal()"
                    style="padding:12px 25px; border:1px solid #ddd; background:white; color:var(--brand-dark); font-weight:700; border-radius:8px; cursor:pointer;">Batal</button>
                <button type="button" id="cropBtn"
                    style="padding:12px 25px; background:var(--brand-primary); color:white; font-weight:700; border:none; border-radius:8px; cursor:pointer;">Potong
                    & Simpan</button>
            </div>
        </div>
    </div>

    <!-- Cropper.js Logic -->
    <script>
        let cropper;
        let currentFileInput;
        let currentPreviewImg;

        function initCropper(inputElement, previewElementId) {
            if (inputElement.files && inputElement.files[0]) {
                currentFileInput = inputElement;
                currentPreviewImg = document.getElementById(previewElementId);

                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('cropImage').src = e.target.result;
                    document.getElementById('cropModal').style.display = 'flex';

                    if (cropper) { cropper.destroy(); }

                    cropper = new Cropper(document.getElementById('cropImage'), {
                        aspectRatio: 1,
                        viewMode: 1,
                        dragMode: 'move',
                        autoCropArea: 0.8,
                        restore: false,
                        guides: false,
                        center: false,
                        highlight: false,
                        cropBoxMovable: true,
                        cropBoxResizable: true,
                        toggleDragModeOnDblclick: false,
                    });
                }
                reader.readAsDataURL(inputElement.files[0]);
            }
        }

        function closeCropModal() {
            document.getElementById('cropModal').style.display = 'none';
            if (cropper) { cropper.destroy(); }
            if (currentFileInput) { currentFileInput.value = ''; }
        }

        document.addEventListener('DOMContentLoaded', function () {
            let cropBtn = document.getElementById('cropBtn');
            if (cropBtn) {
                cropBtn.addEventListener('click', function () {
                    if (!cropper) return;

                    cropper.getCroppedCanvas({
                        width: 500,
                        height: 500,
                        imageSmoothingEnabled: true,
                        imageSmoothingQuality: 'high',
                    }).toBlob(function (blob) {
                        let file = new File([blob], "cropped.jpg", { type: "image/jpeg", lastModified: new Date().getTime() });
                        let container = new DataTransfer();
                        container.items.add(file);
                        currentFileInput.files = container.files;

                        let url = URL.createObjectURL(blob);
                        currentPreviewImg.src = url;
                        currentPreviewImg.style.display = 'block';

                        let placeholder = currentPreviewImg.parentElement.querySelector('span');
                        if (placeholder) placeholder.style.display = 'none';

                        let filenameDisplay = document.getElementById('file-name');
                        if (filenameDisplay) filenameDisplay.textContent = "Foto siap disimpan";

                        document.getElementById('cropModal').style.display = 'none';
                        if (cropper) { cropper.destroy(); }
                        currentFileInput = null; // prevent reset on close
                    }, 'image/jpeg', 0.9);
                });
            }
        });
    </script>
</body>

</html>