@extends('layouts.dashboard')

@section('content')
<style>
    .order-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.82rem;
        font-weight: 700;
    }
    .order-card {
        background: white;
        border-radius: 14px;
        padding: 20px 22px;
        margin-bottom: 16px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.04);
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-left: 5px solid transparent;
        transition: all 0.2s;
    }
    .order-card.pending { border-left-color: #F59E0B; }
    .order-card.serving { border-left-color: #3B82F6; }
    .order-card.done    { border-left-color: #22C55E; }
    .order-card:hover   { box-shadow: 0 8px 25px rgba(0,0,0,0.1); }
    .order-table-num {
        font-size: 1.8rem;
        font-weight: 900;
        color: var(--brand-dark);
    }
</style>

<div style="max-width: 900px;">
    <div class="dashboard-header" style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h1 style="font-size: 2rem; font-weight: 900; color: var(--brand-dark); margin-bottom: 4px;">📋 Daftar Pesanan</h1>
            <p style="color: #888; font-size: 1rem;">Pesanan pelanggan yang perlu dilayani saat ini.</p>
        </div>
        <a href="{{ route('dashboard') }}" style="padding: 10px 20px; border-radius: 8px; background: #f0e6d2; color: var(--brand-dark); text-decoration: none; font-weight: 700; display: flex; align-items: center; gap: 8px;">
            🪑 Lihat Meja
        </a>
    </div>

    {{-- Filter Tabs --}}
    <div style="display: flex; gap: 10px; margin-bottom: 25px;">
        <button onclick="filterOrders('all')" id="tab-all" class="filter-tab active-tab" style="padding: 8px 18px; border-radius: 8px; border: 2px solid var(--brand-primary); background: var(--brand-primary); color: white; font-weight: 700; cursor: pointer;">Semua</button>
        <button onclick="filterOrders('pending')" id="tab-pending" class="filter-tab" style="padding: 8px 18px; border-radius: 8px; border: 2px solid #F59E0B; background: white; color: #F59E0B; font-weight: 700; cursor: pointer;">⏳ Menunggu</button>
        <button onclick="filterOrders('serving')" id="tab-serving" class="filter-tab" style="padding: 8px 18px; border-radius: 8px; border: 2px solid #3B82F6; background: white; color: #3B82F6; font-weight: 700; cursor: pointer;">🚀 Diantar</button>
        <button onclick="filterOrders('done')" id="tab-done" class="filter-tab" style="padding: 8px 18px; border-radius: 8px; border: 2px solid #22C55E; background: white; color: #22C55E; font-weight: 700; cursor: pointer;">✅ Selesai</button>
    </div>

    {{-- Orders List --}}
    <div id="orders-list">
        @foreach($dummyOrders as $order)
        <div class="order-card {{ $order['status'] }}" data-status="{{ $order['status'] }}">
            <div style="display: flex; align-items: center; gap: 20px;">
                <div style="text-align: center; min-width: 55px;">
                    <div style="font-size: 0.7rem; text-transform: uppercase; font-weight: 700; color: #aaa; letter-spacing: 1px;">Meja</div>
                    <div class="order-table-num">{{ $order['table'] }}</div>
                </div>
                <div style="width: 1px; background: #f0e6d2; height: 50px;"></div>
                <div>
                    <div style="font-weight: 800; font-size: 1rem; color: var(--brand-dark); margin-bottom: 4px;">{{ $order['customer'] }}</div>
                    <div style="font-size: 0.87rem; color: #666;">{{ $order['items'] }}</div>
                    <div style="font-size: 0.8rem; color: #aaa; margin-top: 3px;">🕐 {{ $order['time'] }}</div>
                </div>
            </div>
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="text-align: right;">
                    @if($order['status'] === 'pending')
                        <span class="order-badge" style="background:#FEF3C7; color:#92400E;">⏳ Menunggu</span>
                    @elseif($order['status'] === 'serving')
                        <span class="order-badge" style="background:#DBEAFE; color:#1D4ED8;">🚀 Sedang Diantar</span>
                    @else
                        <span class="order-badge" style="background:#DCFCE7; color:#166534;">✅ Selesai</span>
                    @endif
                    <div style="font-weight: 800; color: var(--brand-primary); margin-top: 5px;">Rp {{ number_format($order['total'], 0, ',', '.') }}</div>
                </div>
                @if($order['status'] === 'pending')
                <button onclick="updateStatus(this, 'serving')" style="padding: 8px 14px; background: #3B82F6; color: white; border: none; border-radius: 8px; font-weight: 700; cursor: pointer; font-size: 0.85rem;">Antar</button>
                @elseif($order['status'] === 'serving')
                <button onclick="updateStatus(this, 'done')" style="padding: 8px 14px; background: #22C55E; color: white; border: none; border-radius: 8px; font-weight: 700; cursor: pointer; font-size: 0.85rem;">Selesai</button>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    <p style="text-align: center; color: #ccc; font-size: 0.85rem; margin-top: 20px; font-style: italic;">
        * Data pesanan saat ini bersifat demonstrasi. Koneksikan dengan sistem pesanan untuk data riil.
    </p>
</div>

<script>
function filterOrders(status) {
    var cards = document.querySelectorAll('.order-card');
    cards.forEach(function(card) {
        if (status === 'all' || card.dataset.status === status) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });

    // Update tab styles
    var tabs = document.querySelectorAll('.filter-tab');
    tabs.forEach(function(tab) { tab.classList.remove('active-tab'); });
    var activeEl = document.getElementById('tab-' + status);
    if (activeEl) activeEl.classList.add('active-tab');
}

function updateStatus(btn, newStatus) {
    var card = btn.closest('.order-card');
    card.dataset.status = newStatus;

    var badgeEl = card.querySelector('.order-badge');
    var btnContainer = btn.parentElement;

    if (newStatus === 'serving') {
        card.className = 'order-card serving';
        badgeEl.style.background = '#DBEAFE';
        badgeEl.style.color = '#1D4ED8';
        badgeEl.textContent = '🚀 Sedang Diantar';
        btn.style.background = '#22C55E';
        btn.textContent = 'Selesai';
        btn.onclick = function() { updateStatus(btn, 'done'); };
    } else if (newStatus === 'done') {
        card.className = 'order-card done';
        badgeEl.style.background = '#DCFCE7';
        badgeEl.style.color = '#166534';
        badgeEl.textContent = '✅ Selesai';
        btn.remove();
    }
}
</script>
@endsection
