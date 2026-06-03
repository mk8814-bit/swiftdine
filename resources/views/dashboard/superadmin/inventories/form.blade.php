@extends('layouts.dashboard')

@section('content')
<div class="dashboard-header" style="margin-bottom: 30px;">
    <h1 style="font-size: 2rem; font-weight: 800; color: var(--brand-dark);">
        {{ isset($inventory) ? 'Edit Barang Inventaris' : 'Tambah Barang Baru' }}
    </h1>
    <p style="color: #666; margin-top: 5px;">Kelola informasi dan stok barang di inventaris.</p>
</div>

<div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); max-width: 600px;">
    <form action="{{ isset($inventory) ? route('dashboard.inventories.update', $inventory->id) : route('dashboard.inventories.store') }}" method="POST">
        @csrf
        @if(isset($inventory))
            @method('PUT')
        @endif

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Nama Barang</label>
            <input type="text" name="name" value="{{ old('name', $inventory->name ?? '') }}" required placeholder="Contoh: Beras, Minyak Goreng, Daging Ayam" style="width: 100%; padding: 12px 15px; border: 2px solid #f0e6d2; border-radius: 8px; font-size: 1rem; outline: none;">
            @error('name') <div style="color: #dc3545; font-size: 0.9rem; margin-top: 5px;">{{ $message }}</div> @enderror
        </div>

        <div style="display: flex; gap: 20px; margin-bottom: 30px;">
            <div style="flex: 1;">
                <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Stok Saat Ini</label>
                <input type="number" step="0.01" name="stock" value="{{ old('stock', $inventory->stock ?? '') }}" required min="0" style="width: 100%; padding: 12px 15px; border: 2px solid #f0e6d2; border-radius: 8px; font-size: 1rem; outline: none;">
                @error('stock') <div style="color: #dc3545; font-size: 0.9rem; margin-top: 5px;">{{ $message }}</div> @enderror
            </div>
            <div style="flex: 1;">
                <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Satuan</label>
                <input type="text" name="unit" value="{{ old('unit', $inventory->unit ?? '') }}" required placeholder="kg, liter, pcs, gram" style="width: 100%; padding: 12px 15px; border: 2px solid #f0e6d2; border-radius: 8px; font-size: 1rem; outline: none;">
                @error('unit') <div style="color: #dc3545; font-size: 0.9rem; margin-top: 5px;">{{ $message }}</div> @enderror
            </div>
        </div>

        <div style="display: flex; gap: 15px;">
            <a href="{{ route('dashboard.inventories.index') }}" style="flex: 1; padding: 12px; text-align: center; border-radius: 8px; background: #f0e6d2; color: var(--brand-dark); text-decoration: none; font-weight: 600;">Batal</a>
            <button type="submit" class="btn-primary" style="flex: 2; padding: 12px; border-radius: 8px;">
                {{ isset($inventory) ? 'Simpan Perubahan' : 'Tambah Barang' }}
            </button>
        </div>
    </form>
</div>
@endsection
