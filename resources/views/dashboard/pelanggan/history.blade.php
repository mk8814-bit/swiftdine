@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="font-weight: 800; color: var(--brand-dark);">Riwayat Pesanan</h1>
    </div>

    @if($orders->isEmpty())
        <div class="alert alert-info text-center" style="background-color: var(--brand-cream); color: var(--brand-dark); border: none; padding: 40px; border-radius: 20px;">
            <h4 style="font-weight: 700; margin-bottom: 10px;">Belum Ada Riwayat Pesanan</h4>
            <p>Anda belum pernah melakukan pemesanan sebelumnya.</p>
        </div>
    @else
        <div class="row">
            @foreach($orders as $order)
                <div class="col-lg-6 mb-4">
                    <div class="card shadow" style="border-radius: 20px; border: none; transition: transform 0.3s ease;">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background-color: var(--brand-cream); border-bottom: none; border-radius: 20px 20px 0 0;">
                            <h6 class="m-0 font-weight-bold" style="color: var(--brand-primary); font-size: 1.1rem;">
                                Pesanan #{{ $order->id }}
                                <span class="badge" style="background-color: {{ $order->status === 'paid' ? '#4CAF50' : ($order->status === 'cancelled' ? '#F44336' : '#2196F3') }}; color: white; margin-left: 10px; font-weight: normal; font-size: 0.8rem; padding: 5px 10px; border-radius: 10px;">
                                    {{ strtoupper($order->status) }}
                                </span>
                            </h6>
                            <small style="color: #888; font-weight: 600;">{{ $order->updated_at->format('d M Y, H:i') }}</small>
                        </div>
                        <div class="card-body">
                            <p style="margin-bottom: 5px;"><strong>Meja:</strong> {{ $order->table_number ?? '-' }}</p>
                            @if($order->notes)
                                <p style="margin-bottom: 15px; color: #666; font-style: italic;">"{{ $order->notes }}"</p>
                            @else
                                <div style="margin-bottom: 15px;"></div>
                            @endif

                            <div style="border-top: 1px dashed #ddd; padding-top: 15px;">
                                @foreach($order->orderItems as $item)
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>{{ $item->quantity }}x {{ $item->menu->name }}</span>
                                        <span style="color: #666;">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                                    </div>
                                @endforeach
                            </div>
                            
                            <div class="d-flex justify-content-between mt-3 pt-3" style="border-top: 2px solid var(--brand-cream); font-weight: 800; font-size: 1.1rem;">
                                <span>Total</span>
                                <span style="color: var(--brand-primary);">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
