@extends('layouts.dashboard')

@section('content')
<div class="dashboard-header" style="margin-bottom: 30px;">
    <h1 style="font-size: 2rem; font-weight: 800; color: var(--brand-dark);">
        {{ isset($package) ? 'Edit Paket Hemat' : 'Buat Paket Hemat Baru' }}
    </h1>
    <p style="color: #666; margin-top: 5px;">Pilih menu-menu yang ingin dibundling dengan harga khusus.</p>
</div>

<form action="{{ isset($package) ? route('dashboard.packages.update', $package->id) : route('dashboard.packages.store') }}" method="POST" style="display: flex; gap: 30px; flex-wrap: wrap;">
    @csrf
    @if(isset($package))
        @method('PUT')
    @endif

    <!-- Kiri: Detail Paket -->
    <div style="flex: 1; min-width: 300px; background: white; border-radius: 15px; padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
        <h2 style="font-size: 1.2rem; font-weight: 800; color: var(--brand-primary); margin-bottom: 20px; border-bottom: 2px solid #f0e6d2; padding-bottom: 10px;">Detail Paket</h2>
        
        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Nama Paket *</label>
            <input type="text" name="name" value="{{ old('name', $package->name ?? '') }}" required style="width: 100%; padding: 12px 15px; border: 2px solid #f0e6d2; border-radius: 8px; font-size: 1rem; outline: none;" placeholder="Contoh: Paket Keluarga Besar">
            @error('name') <span style="color: red; font-size: 0.85rem;">{{ $message }}</span> @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Harga Bundling (Rp) *</label>
            <input type="number" name="price" value="{{ old('price', $package->price ?? '') }}" min="0" required style="width: 100%; padding: 12px 15px; border: 2px solid #f0e6d2; border-radius: 8px; font-size: 1rem; outline: none;" placeholder="Contoh: 150000">
            <span style="font-size: 0.85rem; color: #888;">*Harga khusus setelah menu-menu digabung.</span>
            @error('price') <span style="color: red; font-size: 0.85rem;">{{ $message }}</span> @enderror
        </div>

        <div style="margin-bottom: 25px;">
            <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Deskripsi Singkat</label>
            <textarea name="description" rows="3" style="width: 100%; padding: 12px 15px; border: 2px solid #f0e6d2; border-radius: 8px; font-size: 1rem; outline: none; font-family: inherit;">{{ old('description', $package->description ?? '') }}</textarea>
        </div>

        <div style="margin-bottom: 30px; display: flex; align-items: center; gap: 10px;">
            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $package->is_active ?? true) ? 'checked' : '' }} style="width: 18px; height: 18px; accent-color: var(--brand-primary);">
            <label for="is_active" style="font-weight: 600; cursor: pointer;">Tersedia (Aktif)</label>
        </div>
    </div>

    <!-- Kanan: Pilihan Menu -->
    <div style="flex: 2; min-width: 400px; background: white; border-radius: 15px; padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
        <h2 style="font-size: 1.2rem; font-weight: 800; color: var(--brand-primary); margin-bottom: 20px; border-bottom: 2px solid #f0e6d2; padding-bottom: 10px;">Pilih Isi Paket (Checklist)</h2>
        @error('menus') <div style="color: red; font-size: 0.85rem; margin-bottom: 15px; font-weight: 700;">{{ $message }}</div> @enderror
        
        @php
            $groupedMenus = $menus->groupBy('category');
            $selectedMenus = isset($package) ? $package->menus->pluck('id')->toArray() : [];
        @endphp

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 25px;">
            @foreach($groupedMenus as $category => $items)
                @if($category !== 'paket-hemat')
                <div>
                    <h3 style="font-size: 1rem; color: #a09386; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 15px;">{{ str_replace('-', ' ', $category) }}</h3>
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        @foreach($items as $item)
                        <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer; padding: 10px; background: #f9f6f0; border-radius: 8px; border: 1px solid #f0e6d2; transition: background 0.2s;">
                            <input type="checkbox" name="menus[]" value="{{ $item->id }}" {{ in_array($item->id, old('menus', $selectedMenus)) ? 'checked' : '' }} style="margin-top: 3px; width: 16px; height: 16px; accent-color: var(--brand-primary);">
                            <div>
                                <div style="font-weight: 700; color: var(--brand-dark);">{{ $item->name }}</div>
                                <div style="font-size: 0.85rem; color: var(--brand-primary); font-weight: 600;">Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endif
            @endforeach
        </div>

        <div style="margin-top: 40px; padding-top: 20px; border-top: 2px solid #f0e6d2; display: flex; gap: 15px; justify-content: flex-end;">
            <a href="{{ route('dashboard.packages.index') }}" style="padding: 12px 30px; border-radius: 10px; text-decoration: none; color: var(--brand-dark); background: #f0e6d2; font-weight: 700;">Batal</a>
            <button type="submit" class="btn-primary" style="padding: 12px 30px;">
                {{ isset($package) ? 'Simpan Perubahan Paket' : 'Buat Paket Sekarang' }}
            </button>
        </div>
    </div>
</form>
@endsection
