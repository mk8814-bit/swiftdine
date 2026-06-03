@extends('layouts.dashboard')

@section('content')
<style>
    .cart-container {
        max-width: 800px;
        margin: 0 auto;
        padding-bottom: 50px;
    }
    
    .cart-header {
        margin-bottom: 30px;
    }

    .cart-header h1 {
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--brand-dark);
    }

    .cart-item {
        background: var(--brand-light);
        border-radius: 20px;
        padding: 20px;
        margin-bottom: 20px;
        display: flex;
        gap: 20px;
        box-shadow: 0 5px 15px rgba(193, 154, 107, 0.08);
        align-items: center;
        position: relative;
        transition: transform 0.2s;
    }
    
    .cart-item:hover {
        transform: scale(1.01);
    }

    .cart-item-img {
        width: 100px;
        height: 100px;
        border-radius: 15px;
        object-fit: cover;
        background-color: var(--brand-cream);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        flex-shrink: 0;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .cart-item-info {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100px;
    }

    .cart-item-title {
        font-size: 1.2rem;
        font-weight: 800;
        color: var(--brand-dark);
        margin-bottom: 4px;
        padding-right: 30px; /* Space for delete btn */
    }

    .cart-item-price {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--brand-primary);
    }

    .qty-controls {
        display: flex;
        align-items: center;
        gap: 15px;
        background: var(--brand-cream);
        padding: 5px;
        border-radius: 50px;
        width: fit-content;
        margin-top: auto;
    }

    .btn-qty {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: none;
        background: var(--brand-light);
        color: var(--brand-primary);
        font-size: 1.2rem;
        font-weight: bold;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        transition: all 0.2s;
    }

    .btn-qty:hover {
        background: var(--brand-primary);
        color: var(--brand-light);
    }

    .qty-input {
        width: 30px;
        border: none;
        background: transparent;
        text-align: center;
        font-weight: 800;
        font-size: 1.1rem;
        color: var(--brand-dark);
        -moz-appearance: textfield;
    }
    .qty-input::-webkit-outer-spin-button,
    .qty-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .btn-delete {
        position: absolute;
        top: 20px;
        right: 20px;
        background: none;
        border: none;
        color: #ff6b6b;
        cursor: pointer;
        opacity: 0.7;
        transition: opacity 0.2s, transform 0.2s;
    }

    .btn-delete:hover {
        opacity: 1;
        transform: scale(1.1);
    }

    /* Checkout Bar */
    .checkout-bar {
        background: var(--brand-light);
        border-radius: 25px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(193, 154, 107, 0.15);
        margin-top: 30px;
    }

    .checkout-form .form-group {
        margin-bottom: 20px;
    }

    .checkout-form label {
        display: block;
        font-weight: 700;
        color: var(--brand-dark);
        margin-bottom: 8px;
        font-size: 0.95rem;
    }

    .checkout-form input, .checkout-form textarea {
        width: 100%;
        padding: 15px 20px;
        border: 2px solid #f0e6d2;
        border-radius: 15px;
        font-family: inherit;
        font-size: 1rem;
        background: var(--brand-cream);
        color: var(--brand-dark);
        transition: all 0.3s;
    }

    .checkout-form input:focus, .checkout-form textarea:focus {
        outline: none;
        border-color: var(--brand-primary);
        background: var(--brand-light);
        box-shadow: 0 0 0 4px rgba(193, 154, 107, 0.1);
    }

    .checkout-summary {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 30px;
        padding-top: 25px;
        border-top: 2px dashed #f0e6d2;
    }

    .total-price-wrap {
        display: flex;
        flex-direction: column;
    }

    .total-label {
        font-size: 0.9rem;
        color: #888;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .total-amount {
        font-size: 1.8rem;
        font-weight: 900;
        color: var(--brand-primary);
    }

    .btn-checkout {
        background: var(--brand-primary);
        color: white;
        border: none;
        padding: 16px 40px;
        border-radius: 50px;
        font-size: 1.1rem;
        font-weight: 800;
        cursor: pointer;
        box-shadow: 0 8px 20px rgba(193, 154, 107, 0.3);
        transition: all 0.3s;
    }

    .btn-checkout:hover {
        background: var(--brand-accent);
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(193, 154, 107, 0.4);
    }

    .empty-cart {
        text-align: center;
        padding: 80px 20px;
        background: var(--brand-light);
        border-radius: 25px;
        box-shadow: 0 5px 15px rgba(193, 154, 107, 0.08);
    }

    .empty-cart-icon {
        font-size: 6rem;
        margin-bottom: 20px;
        opacity: 0.8;
    }

    .empty-cart h3 {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--brand-dark);
        margin-bottom: 10px;
    }

    .empty-cart p {
        color: #888;
        margin-bottom: 30px;
        font-size: 1.1rem;
    }

    .btn-shop {
        display: inline-block;
        background: var(--brand-primary);
        color: white;
        text-decoration: none;
        padding: 15px 40px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1.1rem;
        transition: background 0.3s;
        box-shadow: 0 8px 20px rgba(193, 154, 107, 0.3);
    }
    .btn-shop:hover {
        background: var(--brand-accent);
        transform: translateY(-2px);
    }
</style>

<div class="cart-container">
    <div class="cart-header">
        <h1>Keranjang Belanja</h1>
    </div>

    @if(!$order || $order->orderItems->isEmpty())
        <div class="empty-cart">
            <div class="empty-cart-icon">🛒</div>
            <h3>Keranjang Masih Kosong</h3>
            <p>Silakan pilih menu spesial kami terlebih dahulu.</p>
            <a href="{{ route('dashboard') }}" class="btn-shop">Lihat Menu</a>
        </div>
    @else
        <!-- Cart Items -->
        <div class="cart-items-wrapper">
            @foreach($order->orderItems as $item)
                <div class="cart-item">
                    @if($item->menu->image && (strpos($item->menu->image, '/') !== false || strpos($item->menu->image, '.') !== false))
                        <img src="{{ asset('storage/' . $item->menu->image) }}" class="cart-item-img" alt="{{ $item->menu->name }}">
                    @else
                        <div class="cart-item-img">{{ $item->menu->image ?? '🍽️' }}</div>
                    @endif
                    
                    <div class="cart-item-info">
                        <div>
                            <div class="cart-item-title">{{ $item->menu->name }}</div>
                            <div class="cart-item-price">Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                        </div>
                        
                        <form action="{{ route('dashboard.pelanggan.cart.update', $item->id) }}" method="POST" id="form-qty-{{ $item->id }}">
                            @csrf
                            @method('PUT')
                            <div class="qty-controls">
                                <button type="button" class="btn-qty" onclick="updateQty({{ $item->id }}, -1)">-</button>
                                <input type="number" name="quantity" id="qty-{{ $item->id }}" value="{{ $item->quantity }}" class="qty-input" min="1" readonly>
                                <button type="button" class="btn-qty" onclick="updateQty({{ $item->id }}, 1)">+</button>
                            </div>
                        </form>
                    </div>

                    <form action="{{ route('dashboard.pelanggan.cart.remove', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete" title="Hapus item">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2.5" fill="none" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        <!-- Checkout Section -->
        <div class="checkout-bar">
            <form action="{{ route('dashboard.pelanggan.cart.checkout') }}" method="POST" id="checkout-form" class="checkout-form">
                @csrf
                <div class="checkout-summary" style="margin-top: 0; padding-top: 0; border-top: none;">
                    <div class="total-price-wrap">
                        <span class="total-label">Total Pembayaran</span>
                        <span class="total-amount">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                    <button type="button" id="pay-button" class="btn-checkout">Checkout Sekarang</button>
                </div>
            </form>
        </div>
    @endif
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script>
    document.getElementById('pay-button').onclick = function () {
        // Fetch snap token from backend
        fetch("{{ route('dashboard.pelanggan.cart.checkout') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.snap_token) {
                // Trigger snap popup
                window.snap.pay(data.snap_token, {
                    onSuccess: function(result){
                        window.location.href = "{{ route('dashboard.pelanggan.cart.success') }}";
                    },
                    onPending: function(result){
                        alert("Waiting for your payment!");
                    },
                    onError: function(result){
                        alert("Payment failed!");
                    },
                    onClose: function(){
                        console.log('Customer closed the popup without finishing the payment');
                    }
                });
            } else if (data.error) {
                alert(data.error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Terjadi kesalahan sistem saat memproses checkout.");
        });
    };

    function updateQty(itemId, change) {
        const input = document.getElementById('qty-' + itemId);
        let newValue = parseInt(input.value) + change;
        
        if (newValue >= 1) {
            input.value = newValue;
            // Submit form automatically to update backend
            document.getElementById('form-qty-' + itemId).submit();
        }
    }
</script>
@endsection
