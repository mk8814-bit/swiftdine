@extends('layouts.dashboard')

@section('content')
<style>
    .section-title {
        font-size: 1.6rem;
        font-weight: 800;
        color: var(--brand-dark);
        margin-bottom: 5px;
    }
    .section-sub {
        color: #888;
        font-size: 0.95rem;
        margin-bottom: 25px;
    }
    .table-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }
    .table-card {
        border-radius: 16px;
        padding: 25px 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.25s ease;
        position: relative;
        overflow: hidden;
    }
    .table-card.empty {
        background: #F0FDF4;
        border: 2px solid #86EFAC;
    }
    .table-card.occupied {
        background: #FFF5F5;
        border: 2px solid #FCA5A5;
    }
    .table-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.12);
    }
    .table-card .table-number {
        font-size: 2rem;
        font-weight: 900;
        margin-bottom: 8px;
    }
    .table-card.empty .table-number { color: #16A34A; }
    .table-card.occupied .table-number { color: #DC2626; }
    .table-card .table-status {
        font-size: 0.82rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        padding: 4px 12px;
        border-radius: 20px;
        display: inline-block;
        margin-bottom: 8px;
    }
    .table-card.empty .table-status { background: #DCFCE7; color: #15803D; }
    .table-card.occupied .table-status { background: #FEE2E2; color: #B91C1C; }
    .table-card .table-icon {
        font-size: 2.8rem;
        margin-bottom: 10px;
        display: block;
    }
    .table-card .table-info {
        font-size: 0.8rem;
        color: #999;
        margin-top: 6px;
    }
    .table-card.occupied .table-info { color: #EF4444; font-weight: 600; }
    .occupied-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 12px;
        height: 12px;
        background: #EF4444;
        border-radius: 50%;
        animation: pulse 1.4s infinite;
    }
    .empty-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 12px;
        height: 12px;
        background: #22C55E;
        border-radius: 50%;
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(1.3); }
    }
    .legend {
        display: flex;
        gap: 20px;
        align-items: center;
        margin-bottom: 20px;
    }
    .legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
        font-weight: 600;
        color: #555;
    }
    .legend-dot {
        width: 14px;
        height: 14px;
        border-radius: 50%;
    }
    .stat-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-bottom: 35px;
    }
    .stat-card {
        background: white;
        border-radius: 14px;
        padding: 20px 22px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.04);
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        flex-shrink: 0;
    }
    .stat-val { font-size: 1.7rem; font-weight: 900; color: var(--brand-dark); }
    .stat-label { font-size: 0.82rem; color: #888; font-weight: 600; }
</style>

<div style="max-width: 1100px;">
    {{-- Header --}}
    <div class="dashboard-header" style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h1 style="font-size: 2rem; font-weight: 900; color: var(--brand-dark); margin-bottom: 4px;">
                Halo, <span style="color: var(--brand-primary);">{{ Auth::user()->name }}</span>! 👋
            </h1>
            <p style="color: #888; font-size: 1rem;">Pantau ketersediaan meja restoran secara real-time.</p>
        </div>
        <a href="{{ route('dashboard.waiter.orders') }}" class="btn-primary" style="padding: 12px 24px; font-size: 1rem; border-radius: 50px; display: flex; align-items: center; gap: 8px;">
            📝 Daftar Pesanan
        </a>
    </div>

    {{-- Stats Row --}}
    @php
        $tables = $dummyTables;
        $totalTables    = count($tables);
        $occupiedTables = collect($tables)->where('status', 'occupied')->count();
        $emptyTables    = $totalTables - $occupiedTables;
    @endphp
    <div class="stat-row">
        <div class="stat-card">
            <div class="stat-icon" style="background: #EFF6FF;">🪑</div>
            <div>
                <div class="stat-val">{{ $totalTables }}</div>
                <div class="stat-label">Total Meja</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: #FFF5F5;">🔴</div>
            <div>
                <div class="stat-val" style="color: #DC2626;">{{ $occupiedTables }}</div>
                <div class="stat-label">Meja Terisi</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: #F0FDF4;">🟢</div>
            <div>
                <div class="stat-val" style="color: #16A34A;">{{ $emptyTables }}</div>
                <div class="stat-label">Meja Kosong</div>
            </div>
        </div>
    </div>

    {{-- Legend --}}
    <div class="legend">
        <span style="font-size: 1rem; font-weight: 800; color: var(--brand-dark); margin-right: 8px;">Denah Meja</span>
        <div class="legend-item">
            <div class="legend-dot" style="background: #22C55E;"></div>
            Kosong
        </div>
        <div class="legend-item">
            <div class="legend-dot" style="background: #EF4444;"></div>
            Terisi
        </div>
    </div>

    {{-- Table Grid --}}
    <div class="table-grid">
        @foreach($dummyTables as $table)
        <div class="table-card {{ $table['status'] }}" onclick="showTableDetail({{ $table['number'] }}, '{{ $table['status'] }}', '{{ $table['guest'] ?? '' }}', '{{ $table['since'] ?? '' }}')">
            @if($table['status'] === 'occupied')
                <div class="occupied-badge"></div>
            @else
                <div class="empty-badge"></div>
            @endif
            <span class="table-icon">🪑</span>
            <div class="table-number">{{ $table['number'] }}</div>
            <div class="table-status">
                {{ $table['status'] === 'occupied' ? 'Terisi' : 'Kosong' }}
            </div>
            <div class="table-info">
                @if($table['status'] === 'occupied')
                    {{ $table['guest'] }}
                @else
                    Tersedia
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- Modal Detail Meja --}}
<div id="tableModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999; align-items:center; justify-content:center;">
    <div style="background:white; border-radius:20px; padding:35px; max-width:400px; width:90%; position:relative; box-shadow: 0 20px 60px rgba(0,0,0,0.2);">
        <button onclick="closeModal()" style="position:absolute; top:15px; right:18px; background:none; border:none; font-size:1.4rem; cursor:pointer; color:#999;">✕</button>
        <div id="modalContent"></div>
    </div>
</div>

<script>
function showTableDetail(number, status, guest, since) {
    var modal = document.getElementById('tableModal');
    var content = document.getElementById('modalContent');
    if (status === 'occupied') {
        content.innerHTML = `
            <div style="text-align:center; margin-bottom:20px;">
                <div style="font-size:3rem;">🪑</div>
                <h2 style="font-weight:900; margin:10px 0 5px; color:#1a1a1a;">Meja ${number}</h2>
                <span style="background:#FEE2E2; color:#B91C1C; padding:5px 15px; border-radius:20px; font-size:0.85rem; font-weight:700;">Sedang Terisi</span>
            </div>
            <div style="background:#FFF5F5; border-radius:12px; padding:16px; margin-bottom:20px;">
                <div style="display:flex; justify-content:space-between; margin-bottom:10px;">
                    <span style="color:#888; font-size:0.9rem;">Nama Tamu</span>
                    <span style="font-weight:700;">${guest}</span>
                </div>
                <div style="display:flex; justify-content:space-between;">
                    <span style="color:#888; font-size:0.9rem;">Duduk Sejak</span>
                    <span style="font-weight:700;">${since}</span>
                </div>
            </div>
            <button onclick="closeModal()" style="width:100%; padding:12px; background:var(--brand-primary); color:white; border:none; border-radius:10px; font-weight:700; cursor:pointer; font-size:1rem;">Tutup</button>
        `;
    } else {
        content.innerHTML = `
            <div style="text-align:center; margin-bottom:20px;">
                <div style="font-size:3rem;">🪑</div>
                <h2 style="font-weight:900; margin:10px 0 5px; color:#1a1a1a;">Meja ${number}</h2>
                <span style="background:#DCFCE7; color:#15803D; padding:5px 15px; border-radius:20px; font-size:0.85rem; font-weight:700;">Tersedia / Kosong</span>
            </div>
            <p style="text-align:center; color:#666; margin-bottom:20px;">Meja ini siap digunakan untuk tamu baru.</p>
            <button onclick="closeModal()" style="width:100%; padding:12px; background:var(--brand-primary); color:white; border:none; border-radius:10px; font-weight:700; cursor:pointer; font-size:1rem;">Tutup</button>
        `;
    }
    modal.style.display = 'flex';
}
function closeModal() {
    document.getElementById('tableModal').style.display = 'none';
}
</script>
@endsection
