@extends('layouts.app')

@section('content')

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-bg-glow"></div>

        <!-- Floating Icons (Using text emoji or you can use image) -->
        <div class="floating-icon icon-1">☕</div>
        <div class="floating-icon icon-2">🥐</div>
        <div class="floating-icon icon-3">🍰</div>
        <div class="floating-icon icon-4">🥪</div>

        <div class="hero-content">
            <div class="mym-logo">
                ✨ SwiftDine Rewards
            </div>
            <h1>{!! \App\Models\Setting::where('key', 'tagline')->value('value') ?? 'Gampang Daftarnya<br>Gampang Dapat Poinnya<br><span>Gampang Nikmatinnya</span>' !!}</h1>
            <p>Hanya di Aplikasi SwiftDine</p>
            <button class="btn-primary">Scan Member Rewards Sekarang</button>
        </div>

        <div class="hero-image">
            <div class="phone-mockup">
                <div class="phone-screen">
                    <div>
                        <h2>Daftar Sekarang dan Langsung<br><span>Nikmatin Rewards-nya</span></h2>
                        <div id="food-container" class="rewards-items">
                            <!-- Food items will be injected here -->
                        </div>
                        <script>
                            const foods = [
                                {emoji: '🍦', name: 'Ice Cream'},
                                {emoji: '🍩', name: 'Donuts'},
                                {emoji: '🥤', name: 'Iced Coffee'},
                                {emoji: '🍔', name: 'Burger'},
                                {emoji: '🍕', name: 'Pizza'},
                                {emoji: '🍣', name: 'Sushi'},
                                {emoji: '🥗', name: 'Salad'}
                            ];
                            function renderFoods() {
                                const container = document.getElementById('food-container');
                                container.innerHTML = '';
                                const shuffled = foods.sort(() => 0.5 - Math.random()).slice(0,4);
                                shuffled.forEach(item => {
                                    const div = document.createElement('div');
                                    div.className = 'reward-item';
                                    div.innerHTML = `
                                        <div class="circle"><span style="font-size: 2rem;">${item.emoji}</span></div>
                                        <span>${item.name}</span>
                                    `;
                                    container.appendChild(div);
                                });
                            }
                            document.addEventListener('DOMContentLoaded', renderFoods);
                        </script>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </section>

    <!-- Info Section -->
    <section class="info-section">
        <div class="info-text">
            <h2>Mulai dapatkan Poin-mu sekarang</h2>
            <p>SwiftDine Rewards kini hadir di Aplikasi SwiftDine. Setiap transaksi Rp10.000, kamu berhak mendapatkan 1 poin. Poin tersebut dapat ditukar dengan berbagai macam penawaran menarik di SwiftDine Rewards.</p>
            
            <h2>Sudah punya Aplikasi SwiftDine?</h2>
            <p>Cukup dengan scan QR Code Kartu SwiftDine Rewards di gerai (Kasir atau Self-Order Kiosk), kamu akan mendapatkan poin.</p>
        </div>
        <div class="info-image">
            <!-- SVG Illustration of Hand and Coins adapted to theme colors -->
            <svg width="300" height="300" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Abstract hand holding coins -->
                <circle cx="150" cy="150" r="40" fill="var(--brand-primary)" opacity="0.2"/>
                <path d="M120 180 C140 180 180 160 180 120 C180 100 160 80 140 90 C120 100 100 120 100 140" fill="#E6C2A5" stroke="#D1A78B" stroke-width="4"/>
                <circle cx="100" cy="80" r="25" fill="var(--brand-light)" stroke="var(--brand-primary)" stroke-width="4"/>
                <text x="82" y="85" font-size="14" font-weight="900" fill="var(--brand-primary)">Poin</text>
                <circle cx="60" cy="110" r="20" fill="var(--brand-light)" stroke="var(--brand-banner)" stroke-width="3"/>
                <text x="47" y="114" font-size="11" font-weight="900" fill="var(--brand-banner)">Poin</text>
                <circle cx="120" cy="40" r="15" fill="var(--brand-light)" stroke="var(--brand-accent)" stroke-width="2"/>
                <text x="111" y="44" font-size="8" font-weight="900" fill="var(--brand-accent)">Pts</text>
            </svg>
        </div>
    </section>

    <!-- Steps Section -->
    <section class="steps-section">
        <!-- Get Points -->
        <div class="step-column">
            <div class="step-header">Cara Dapatkan Poin</div>
            
            <div class="step-item">
                <div class="step-number">1</div>
                <div class="step-icon">
                    <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" width="60" height="60">
                        <rect x="20" y="10" width="24" height="40" rx="4" fill="var(--brand-primary)"/>
                        <rect x="22" y="14" width="20" height="32" fill="var(--brand-light)"/>
                        <path d="M16 40 C 20 40, 30 50, 48 50 C 48 50, 48 60, 30 60 C 16 60, 16 50, 16 40 Z" fill="#E6C2A5"/>
                    </svg>
                </div>
                <div class="step-text">
                    <h4>Buka Aplikasi</h4>
                    <p>SwiftDine</p>
                </div>
            </div>
            
            <div class="step-item">
                <div class="step-number">2</div>
                <div class="step-icon">
                    <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" width="60" height="60">
                        <rect x="20" y="10" width="24" height="40" rx="4" fill="var(--brand-primary)"/>
                        <rect x="22" y="14" width="20" height="32" fill="var(--brand-light)"/>
                        <rect x="26" y="20" width="4" height="4" fill="var(--brand-dark)"/>
                        <rect x="34" y="20" width="4" height="4" fill="var(--brand-dark)"/>
                        <rect x="26" y="28" width="4" height="4" fill="var(--brand-dark)"/>
                        <rect x="34" y="28" width="4" height="4" fill="var(--brand-dark)"/>
                        <rect x="30" y="24" width="4" height="4" fill="var(--brand-dark)"/>
                        <path d="M16 40 C 20 40, 30 50, 48 50 C 48 50, 48 60, 30 60 C 16 60, 16 50, 16 40 Z" fill="#E6C2A5"/>
                    </svg>
                </div>
                <div class="step-text">
                    <h4>Scan QR Code</h4>
                    <p>Kartu SwiftDine Rewards<br>pada halaman Penawaran</p>
                </div>
            </div>
            
            <div class="step-item">
                <div class="step-number">3</div>
                <div class="step-icon">
                    <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" width="60" height="60">
                        <path d="M20 20 L44 20 L48 54 L16 54 Z" fill="var(--brand-primary)"/>
                        <path d="M20 20 L24 10 L40 10 L44 20 Z" fill="var(--brand-banner)"/>
                        <circle cx="32" cy="38" r="8" fill="var(--brand-light)"/>
                    </svg>
                </div>
                <div class="step-text">
                    <h4>Pesan</h4>
                    <p>Melalui Kasir, Drive-Thru,<br>Self-Order Kiosk (SOK) dan<br>Delivery</p>
                </div>
            </div>
            
            <div class="step-item">
                <div class="step-number">4</div>
                <div class="step-icon">
                    <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" width="60" height="60">
                        <ellipse cx="32" cy="44" rx="16" ry="6" fill="var(--brand-banner)" stroke="var(--brand-light)" stroke-width="2"/>
                        <ellipse cx="32" cy="38" rx="16" ry="6" fill="var(--brand-primary)" stroke="var(--brand-light)" stroke-width="2"/>
                        <ellipse cx="32" cy="32" rx="16" ry="6" fill="var(--brand-banner)" stroke="var(--brand-light)" stroke-width="2"/>
                        <ellipse cx="32" cy="26" rx="16" ry="6" fill="var(--brand-primary)" stroke="var(--brand-light)" stroke-width="2"/>
                        <text x="24" y="29" font-size="8" font-weight="bold" fill="var(--brand-light)">Poin</text>
                    </svg>
                </div>
                <div class="step-text">
                    <h4>Dapatkan Poin</h4>
                    <p>Rp10.000 = 1 Poin</p>
                </div>
            </div>
        </div>

        <!-- Redeem Points -->
        <div class="step-column">
            <div class="step-header">Cara Menukar Rewards</div>
            
            <div class="step-item">
                <div class="step-number">1</div>
                <div class="step-icon">
                    <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" width="60" height="60">
                        <rect x="20" y="10" width="24" height="40" rx="4" fill="var(--brand-primary)"/>
                        <rect x="22" y="14" width="20" height="32" fill="var(--brand-light)"/>
                        <path d="M16 40 C 20 40, 30 50, 48 50 C 48 50, 48 60, 30 60 C 16 60, 16 50, 16 40 Z" fill="#E6C2A5"/>
                    </svg>
                </div>
                <div class="step-text">
                    <h4>Buka Aplikasi</h4>
                    <p>SwiftDine dan pilih<br>halaman Penawaran</p>
                </div>
            </div>
            
            <div class="step-item">
                <div class="step-number">2</div>
                <div class="step-icon">
                    <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" width="60" height="60">
                        <rect x="20" y="10" width="24" height="40" rx="4" fill="var(--brand-primary)"/>
                        <rect x="22" y="14" width="20" height="32" fill="var(--brand-light)"/>
                        <circle cx="32" cy="26" r="6" fill="var(--brand-banner)"/> 
                        <path d="M32 30 C 32 30, 45 45, 50 45 C 50 55, 40 60, 32 55 L 28 40 Z" fill="#E6C2A5"/> 
                    </svg>
                </div>
                <div class="step-text">
                    <h4>Pilih penawaran</h4>
                    <p><strong>Rewards</strong> yang ingin<br>ditukarkan</p>
                </div>
            </div>
            
            <div class="step-item">
                <div class="step-number">3</div>
                <div class="step-icon">
                    <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" width="60" height="60">
                        <rect x="20" y="10" width="24" height="40" rx="4" fill="var(--brand-primary)"/>
                        <rect x="22" y="14" width="20" height="32" fill="var(--brand-light)"/>
                        <rect x="26" y="20" width="4" height="4" fill="var(--brand-dark)"/>
                        <rect x="34" y="20" width="4" height="4" fill="var(--brand-dark)"/>
                        <rect x="26" y="28" width="4" height="4" fill="var(--brand-dark)"/>
                        <rect x="34" y="28" width="4" height="4" fill="var(--brand-dark)"/>
                        <rect x="30" y="24" width="4" height="4" fill="var(--brand-dark)"/>
                        <path d="M16 40 C 20 40, 30 50, 48 50 C 48 50, 48 60, 30 60 C 16 60, 16 50, 16 40 Z" fill="#E6C2A5"/>
                    </svg>
                </div>
                <div class="step-text">
                    <h4>Scan QR Code</h4>
                    <p>Penawaran SwiftDine Rewards</p>
                </div>
            </div>
            
            <div class="step-item">
                <div class="step-number">4</div>
                <div class="step-icon">
                    <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" width="60" height="60">
                        <rect x="16" y="20" width="12" height="24" fill="var(--brand-primary)"/>
                        <line x1="18" y1="16" x2="20" y2="20" stroke="var(--brand-banner)" stroke-width="2"/>
                        <line x1="22" y1="14" x2="22" y2="20" stroke="var(--brand-banner)" stroke-width="2"/>
                        <line x1="26" y1="16" x2="24" y2="20" stroke="var(--brand-banner)" stroke-width="2"/>
                        <path d="M26 36 C 26 26, 46 26, 46 36 Z" fill="var(--brand-banner)"/> 
                        <rect x="26" y="38" width="20" height="4" rx="2" fill="var(--brand-dark)"/> 
                        <rect x="26" y="44" width="20" height="6" rx="3" fill="var(--brand-banner)"/> 
                        <path d="M26 43 Q 31 40 36 43 T 46 43" fill="#8cb96c" stroke="#8cb96c" stroke-width="2"/>
                    </svg>
                </div>
                <div class="step-text">
                    <h4>Nikmati</h4>
                    <p>Menu favoritmu!</p>
                </div>
            </div>
        </div>
    </section>

    

    @endsection


