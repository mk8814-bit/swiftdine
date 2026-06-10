@extends('layouts.dashboard')

@section('content')
    <div class="header-section" style="margin-bottom: 30px;">
        <h1
            style="font-size: 2.2rem; font-weight: 900; color: var(--brand-dark); margin-bottom: 5px; text-transform: capitalize;">
            Dashboard Barista
        </h1>
        <p style="color: #666; font-size: 1.05rem;">Ringkasan dan manajemen pesanan minuman hari ini</p>
    </div>

    <!-- Statistik Barista -->
    <div
        style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-bottom: 40px;">
        <div
            style="background: white; padding: 25px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); border: 1px solid #f0e6d2;">
            <div
                style="color: #666; font-size: 0.9rem; font-weight: 600; margin-bottom: 10px; display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 8h1a4 4 0 0 1 0 8h-1"></path>
                    <path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path>
                    <line x1="6" y1="1" x2="6" y2="4"></line>
                    <line x1="10" y1="1" x2="10" y2="4"></line>
                    <line x1="14" y1="1" x2="14" y2="4"></line>
                </svg>
                Pesanan Minuman Hari Ini
            </div>
            <div style="font-size: 2rem; font-weight: 900; color: var(--brand-dark);">{{ $todayDrinkOrders }}</div>
        </div>

        <div
            style="background: white; padding: 25px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); border: 1px solid #f0e6d2;">
            <div
                style="color: #666; font-size: 0.9rem; font-weight: 600; margin-bottom: 10px; display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="1" x2="12" y2="23"></line>
                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                </svg>
                Penjualan Minuman Hari Ini
            </div>
            <div style="font-size: 2rem; font-weight: 900; color: var(--brand-primary);">Rp
                {{ number_format($todayDrinkSales, 0, ',', '.') }}</div>
        </div>

        <div
            style="background: #FFF3CD; padding: 25px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); border: 1px solid #FFEEBA;">
            <div
                style="color: #856404; font-size: 0.9rem; font-weight: 600; margin-bottom: 10px; display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                Pesanan Menunggu
            </div>
            <div style="font-size: 2rem; font-weight: 900; color: #856404;">{{ $countPending }}</div>
        </div>

        <div
            style="background: #D4EDDA; padding: 25px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); border: 1px solid #C3E6CB;">
            <div
                style="color: #155724; font-size: 0.9rem; font-weight: 600; margin-bottom: 10px; display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                Pesanan Selesai Hari Ini
            </div>
            <div style="font-size: 2rem; font-weight: 900; color: #155724;">{{ $countCompletedToday }}</div>
        </div>
    </div>

    <!-- Voice Selection Column (Moved to top) -->
    <div style="background: white; padding: 25px; border-radius: 20px; margin-bottom: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); border: 1px solid #f0e6d2; display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 20px;">
        <div style="display: flex; align-items: center; gap: 15px; flex: 1; min-width: 300px;">
            <div style="background: var(--brand-cream); padding: 10px; border-radius: 12px; color: var(--brand-primary);">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"></path>
                    <path d="M19 10v2a7 7 0 0 1-14 0v-2"></path>
                    <line x1="12" y1="19" x2="12" y2="23"></line>
                    <line x1="8" y1="23" x2="16" y2="23"></line>
                </svg>
            </div>
            <div style="flex: 1;">
                <label for="voice-select" style="display: block; font-weight: 800; color: var(--brand-dark); margin-bottom: 5px; font-size: 0.9rem;">Pilih Suara Antrean</label>
                <select id="voice-select" style="width: 100%; padding: 12px; border-radius: 12px; border: 2px solid #f0e6d2; background: #faf9f7; font-family: inherit; font-weight: 600; color: #555; outline: none; transition: border-color 0.2s;">
                    <option value="id-ID">Bahasa Indonesia</option>
                    <option value="en-US">English (US)</option>
                    <option value="en-GB">English (UK)</option>
                    <option value="ja-JP">日本語 (Japanese)</option>
                    <option value="ko-KR">한국어 (Korean)</option>
                </select>
            </div>
        </div>
        <div style="display: flex; gap: 10px;">
            <button onclick="testVoice()" style="background: white; color: var(--brand-dark); border: 2px solid #f0e6d2; padding: 12px 25px; border-radius: 12px; font-weight: 800; cursor: pointer; transition: all 0.2s; white-space: nowrap;">
                Tes Suara
            </button>
            <button onclick="localStorage.setItem('barista_voice_lang', voiceSelect.value); alert('Pengaturan disimpan!')" style="background: var(--brand-primary); color: white; border: none; padding: 12px 25px; border-radius: 12px; font-weight: 800; cursor: pointer; transition: all 0.2s; white-space: nowrap; box-shadow: 0 4px 10px rgba(220, 168, 86, 0.3);">
                Simpan
            </button>
        </div>
    </div>

    <div class="header-section"
        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="font-size: 1.5rem; font-weight: 800; color: var(--brand-dark);">Daftar Antrean Minuman</h2>
        <div id="notification-status" style="font-size: 0.85rem; color: #888;">
            @if($countPending > 0)
                <span style="color: #d9534f; font-weight: 700; display: flex; align-items: center; gap: 5px;">
                    <span
                        style="display: inline-block; width: 8px; height: 8px; background: #d9534f; border-radius: 50%; animation: pulse 1.5s infinite;"></span>
                    Menunggu diproses
                </span>
            @else
                Semua pesanan telah selesai
            @endif
        </div>
    </div>

    @if($countPending > 0)
        <div class="kds-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
            @foreach($pendingItems as $item)
                <div
                    style="background: white; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); overflow: hidden; border: 1px solid #f0e6d2; display: flex; flex-direction: column;">
                    <div
                        style="background: var(--brand-dark); color: white; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center;">
                        <div style="font-weight: 800; font-size: 1.2rem;">Meja {{ $item->order->table_number }}</div>
                        <div style="font-size: 0.85rem; font-weight: 600; opacity: 0.8;">{{ $item->created_at->diffForHumans() }}
                        </div>
                    </div>
                    <div style="padding: 25px 20px; flex: 1;">
                        <div style="display: flex; align-items: flex-start; gap: 15px;">
                            <div
                                style="background: var(--brand-cream); color: var(--brand-primary); font-size: 1.5rem; font-weight: 900; width: 45px; height: 45px; display: flex; justify-content: center; align-items: center; border-radius: 12px; flex-shrink: 0;">
                                {{ $item->quantity }}x
                            </div>
                            <div>
                                <h3
                                    style="font-size: 1.25rem; font-weight: 800; color: var(--brand-dark); margin-bottom: 5px; line-height: 1.2;">
                                    {{ $item->menu->name }}
                                </h3>
                                @if($item->order->notes)
                                    <p style="color: #d9534f; font-size: 0.9rem; margin-top: 10px; font-weight: 600;">
                                        Note: {{ $item->order->notes }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div style="padding: 15px 20px; background: #faf9f7; border-top: 1px dashed #e0d8c8;">
                        <form action="{{ route('dashboard.barista.order.item.complete', $item->id) }}" method="POST"
                            style="margin: 0;">
                            @csrf
                            <button type="submit"
                                style="width: 100%; background: #28a745; color: white; border: none; padding: 12px; border-radius: 10px; font-weight: 800; font-size: 1rem; cursor: pointer; display: flex; justify-content: center; align-items: center; gap: 8px; box-shadow: 0 4px 10px rgba(40, 167, 69, 0.2); transition: all 0.2s;">
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                Tandai Selesai
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div
            style="background: white; border-radius: 20px; padding: 60px 20px; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
            <div style="color: var(--brand-cream); margin-bottom: 20px;">
                <svg viewBox="0 0 24 24" width="80" height="80" fill="none" stroke="var(--brand-primary)" stroke-width="1"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                </svg>
            </div>
            <h2 style="font-size: 1.5rem; font-weight: 800; color: var(--brand-dark); margin-bottom: 10px;">Bar Sedang Kosong
            </h2>
            <p style="color: #888; font-size: 1rem;">Luar biasa! Belum ada pesanan minuman yang perlu disiapkan.</p>
        </div>
    @endif

    <style>
        #voice-select:focus { border-color: var(--brand-primary); }
        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.2); opacity: 0.7; }
            100% { transform: scale(1); opacity: 1; }
        }
    </style>

    <script>
        const voiceSelect = document.getElementById('voice-select');
        let voices = [];

        function populateVoiceList() {
            voices = window.speechSynthesis.getVoices();
        }

        if (speechSynthesis.onvoiceschanged !== undefined) {
            speechSynthesis.onvoiceschanged = populateVoiceList;
        }

        function speak(text) {
            if (window.speechSynthesis.speaking) window.speechSynthesis.cancel();
            const utter = new SpeechSynthesisUtterance(text);
            const selectedLang = voiceSelect.value;
            
            // Find voice for selected language
            const voice = voices.find(v => v.lang.startsWith(selectedLang));
            if (voice) utter.voice = voice;
            utter.lang = selectedLang;
            utter.pitch = 1.1; // Slightly higher for clarity
            utter.rate = 0.95; // Slightly slower for clarity
            utter.volume = 1;
            window.speechSynthesis.speak(utter);
        }

        function getTranslation(lang, table, menu) {
            const templates = {
                'id-ID': `Pesanan baru, Meja ${table}, ${menu}`,
                'en-US': `New order, Table ${table}, ${menu}`,
                'en-GB': `Attention, Table ${table}, ${menu}`,
                'ja-JP': `新しい注文です、${table}番テーブルの、${menu}`,
                'ko-KR': `새 주문이 있습니다, ${table}번 테이블의, ${menu}`
            };
            return templates[lang] || templates['id-ID'];
        }

        function testVoice() {
            const firstItem = document.querySelector('.kds-grid > div');
            if (firstItem) {
                const table = firstItem.querySelector('[style*="font-weight: 800"]').innerText.replace('Meja ', '');
                const menu = firstItem.querySelector('h3').innerText;
                const text = getTranslation(voiceSelect.value, table, menu);
                speak(text);
            } else {
                const text = getTranslation(voiceSelect.value, "15", "Caramel Macchiato");
                speak(text);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            populateVoiceList();
            
            const savedLang = localStorage.getItem('barista_voice_lang');
            if (savedLang) voiceSelect.value = savedLang;

            const pendingCount = {{ $countPending }};

            // Announce PENDING orders
            @if($countPending > 0)
                setTimeout(() => {
                    const lang = voiceSelect.value;
                    const items = [
                        @foreach($pendingItems as $item)
                        { table: '{{ $item->order->table_number }}', menu: '{{ $item->menu->name }}' },
                        @endforeach
                    ];
                    
                    // Only announce the first/top one to avoid noise
                    if (items.length > 0) {
                        // Double check the top-most visible table from DOM to be sure it matches UI
                        const firstCard = document.querySelector('.kds-grid > div');
                        let table = items[0].table;
                        let menu = items[0].menu;
                        
                        if (firstCard) {
                            const domTable = firstCard.querySelector('[style*="font-weight: 800"]').innerText.replace('Meja ', '');
                            const domMenu = firstCard.querySelector('h3').innerText;
                            if (domTable) table = domTable;
                            if (domMenu) menu = domMenu;
                        }
                        
                        const text = getTranslation(lang, table, menu);
                        
                        // Prevent repetitive announcements by checking last announced
                        const lastAnnounced = sessionStorage.getItem('last_announced_order');
                        const currentOrder = `${table}-${menu}`;
                        
                        if (lastAnnounced !== currentOrder) {
                            speak(text);
                            sessionStorage.setItem('last_announced_order', currentOrder);
                        }
                    }
                }, 1000);
            @endif

            // Polling simulation every 30 seconds
            setTimeout(() => {
                window.location.reload();
            }, 30000);
        });
    </script>
@endsection