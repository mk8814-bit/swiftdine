@extends('layouts.dashboard')

@section('content')
    <div class="header-section" style="margin-bottom: 30px;">
        <h1 style="font-size: 2.2rem; font-weight: 900; color: var(--brand-dark); margin-bottom: 5px;">
            Riwayat Pesanan Bar
        </h1>
        <p style="color: #666; font-size: 1.05rem;">Daftar semua minuman yang telah diselesaikan</p>
    </div>

    <div
        style="background: white; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); border: 1px solid #f0e6d2; overflow: hidden;">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background: #faf9f7; border-bottom: 1px solid #f0e6d2;">
                        <th
                            style="padding: 20px 25px; font-weight: 800; color: #a09386; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">
                            Meja</th>
                        <th
                            style="padding: 20px 25px; font-weight: 800; color: #a09386; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">
                            Pesanan</th>
                        <th
                            style="padding: 20px 25px; font-weight: 800; color: #a09386; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">
                            Qty</th>
                        <th
                            style="padding: 20px 25px; font-weight: 800; color: #a09386; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">
                            Waktu Selesai</th>
                        <th
                            style="padding: 20px 25px; font-weight: 800; color: #a09386; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">
                            Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($historyItems as $item)
                        <tr style="border-bottom: 1px solid #f9f6ef;">
                            <td style="padding: 20px 25px;">
                                <span style="font-weight: 800; color: var(--brand-dark);">Meja
                                    {{ $item->order->table_number }}</span>
                            </td>
                            <td style="padding: 20px 25px;">
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div
                                        style="width: 40px; height: 40px; background: var(--brand-cream); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                                        ☕
                                    </div>
                                    <span style="font-weight: 700; color: var(--brand-dark);">{{ $item->menu->name }}</span>
                                </div>
                            </td>
                            <td style="padding: 20px 25px;">
                                <span
                                    style="background: var(--brand-cream); color: var(--brand-primary); padding: 5px 12px; border-radius: 8px; font-weight: 800;">
                                    {{ $item->quantity }}x
                                </span>
                            </td>
                            <td style="padding: 20px 25px; color: #666; font-size: 0.95rem;">
                                {{ $item->updated_at->format('d M Y, H:i') }}
                                <div style="font-size: 0.8rem; color: #aaa;">{{ $item->updated_at->diffForHumans() }}</div>
                            </td>
                            <td style="padding: 20px 25px;">
                                <span
                                    style="background: #D4EDDA; color: #155724; padding: 6px 15px; border-radius: 50px; font-weight: 700; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 5px;">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="3">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                    Selesai
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding: 60px 25px; text-align: center; color: #888;">
                                <svg width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="#ddd" stroke-width="1"
                                    style="margin-bottom: 15px;">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                </svg>
                                <p>Belum ada riwayat pesanan yang diselesaikan.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div style="margin-top: 30px;">
        {{ $historyItems->links() }}
    </div>
@endsection