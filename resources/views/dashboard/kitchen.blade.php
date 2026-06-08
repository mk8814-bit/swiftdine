@extends('layouts.dashboard')

@section('content')
    <div class="header-section"
        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h1
                style="font-size: 2.2rem; font-weight: 900; color: var(--brand-dark); margin-bottom: 5px; text-transform: capitalize;">
                Dashboard {{ $role }}
            </h1>
            <p style="color: #666; font-size: 1.05rem;">Daftar pesanan aktif yang harus segera disiapkan</p>
        </div>
        <div>
            <span
                style="background: #FFF3CD; color: #856404; padding: 10px 20px; border-radius: 10px; font-weight: 800; border: 1px solid #FFEEBA; display: inline-flex; align-items: center; gap: 8px;">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                {{ count($pendingItems) }} Pesanan Aktif
            </span>
        </div>
    </div>

    @if(count($pendingItems) > 0)
        <div class="kds-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
            @foreach($pendingItems as $idx => $item)
                <div
                    style="background: white; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); overflow: hidden; border: 1px solid #f0e6d2; display: flex; flex-direction: column;">
                    <div
                        style="background: var(--brand-dark); color: white; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center;">
                        <div style="font-weight: 800; font-size: 1.2rem;">{{ $item->table }}</div>
                        <div
                            style="font-size: 0.85rem; font-weight: 600; opacity: 0.8; display: flex; align-items: center; gap: 5px;">
                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            {{ $item->time }}
                        </div>
                    </div>
                    <div style="padding: 25px 20px; flex: 1;">
                        <div style="display: flex; align-items: flex-start; gap: 15px;">
                            <div
                                style="background: var(--brand-cream); color: var(--brand-primary); font-size: 1.5rem; font-weight: 900; width: 45px; height: 45px; display: flex; justify-content: center; align-items: center; border-radius: 12px; flex-shrink: 0;">
                                {{ $item->qty }}x
                            </div>
                            <div>
                                <h3
                                    style="font-size: 1.25rem; font-weight: 800; color: var(--brand-dark); margin-bottom: 5px; line-height: 1.2;">
                                    {{ $item->menu_name }}
                                </h3>
                                <p style="color: #666; font-size: 0.9rem; margin-top: 10px;">
                                    <em>- Tanpa Catatan -</em>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div style="padding: 15px 20px; background: #faf9f7; border-top: 1px dashed #e0d8c8;">
                        <form action="#" method="POST" style="margin: 0;">
                            @csrf
                            <button type="button" onclick="alert('Pesanan selesai disiapkan!')"
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
            <h2 style="font-size: 1.5rem; font-weight: 800; color: var(--brand-dark); margin-bottom: 10px;">Dapur Sedang Kosong
            </h2>
            <p style="color: #888; font-size: 1rem;">Luar biasa! Belum ada pesanan aktif saat ini.</p>
        </div>
    @endif

@endsection