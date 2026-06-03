@extends('layouts.dashboard')

@section('content')
<div class="dashboard-header" style="margin-bottom: 30px;">
    <h1 style="font-size: 2rem; font-weight: 800; color: var(--brand-dark);">
        {{ isset($addon) ? 'Edit Topping' : 'Tambah Topping Baru' }}
    </h1>
    <p style="color: #666; margin-top: 5px;">Kelola nama dan biaya tambahan untuk topping menu.</p>
</div>

<div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); max-width: 600px;">
    <form action="{{ isset($addon) ? route('dashboard.addons.update', $addon->id) : route('dashboard.addons.store') }}" method="POST">
        @csrf
        @if(isset($addon))
            @method('PUT')
        @endif

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Nama Topping / Ekstra</label>
            <input type="text" name="name" value="{{ old('name', $addon->name ?? '') }}" required placeholder="Contoh: Keju, Ekstra Pedas, Nasi Putih" style="width: 100%; padding: 12px 15px; border: 2px solid #f0e6d2; border-radius: 8px; font-size: 1rem; outline: none;">
            @error('name') <div style="color: #dc3545; font-size: 0.9rem; margin-top: 5px;">{{ $message }}</div> @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Biaya Tambahan (Rp)</label>
            <input type="number" step="0.01" name="price" value="{{ old('price', $addon->price ?? '') }}" required min="0" style="width: 100%; padding: 12px 15px; border: 2px solid #f0e6d2; border-radius: 8px; font-size: 1rem; outline: none;">
            @error('price') <div style="color: #dc3545; font-size: 0.9rem; margin-top: 5px;">{{ $message }}</div> @enderror
        </div>

        <div style="margin-bottom: 30px;">
            <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Status</label>
            <select name="is_active" required style="width: 100%; padding: 12px 15px; border: 2px solid #f0e6d2; border-radius: 8px; font-size: 1rem; outline: none; background: white;">
                <option value="1" {{ (old('is_active', $addon->is_active ?? 1)) == 1 ? 'selected' : '' }}>Tersedia</option>
                <option value="0" {{ (old('is_active', $addon->is_active ?? 1)) == 0 ? 'selected' : '' }}>Habis</option>
            </select>
        </div>

        <div style="display: flex; gap: 15px;">
            <a href="{{ route('dashboard.addons.index') }}" style="flex: 1; padding: 12px; text-align: center; border-radius: 8px; background: #f0e6d2; color: var(--brand-dark); text-decoration: none; font-weight: 600;">Batal</a>
            <button type="submit" class="btn-primary" style="flex: 2; padding: 12px; border-radius: 8px;">
                {{ isset($addon) ? 'Simpan Perubahan' : 'Tambah Topping' }}
            </button>
        </div>
    </form>
</div>
@endsection
