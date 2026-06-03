@extends('layouts.dashboard')

@section('content')
<div class="dashboard-header" style="margin-bottom: 30px;">
    <h1 style="font-size: 2rem; font-weight: 800; color: var(--brand-dark);">
        {{ isset($menu) ? 'Edit Menu' : 'Tambah Menu Baru' }}
    </h1>
    <p style="color: #666; margin-top: 5px;">Silakan isi formulir di bawah ini dengan lengkap.</p>
</div>

<div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); max-width: 800px;">
    <form action="{{ isset($menu) ? route('dashboard.menus.update', $menu->id) : route('dashboard.menus.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($menu))
            @method('PUT')
        @endif

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Nama Menu *</label>
            <input type="text" name="name" value="{{ old('name', $menu->name ?? '') }}" required style="width: 100%; padding: 12px 15px; border: 2px solid #f0e6d2; border-radius: 8px; font-size: 1rem; outline: none;" placeholder="Contoh: Kopi Susu Aren">
            @error('name') <span style="color: red; font-size: 0.85rem;">{{ $message }}</span> @enderror
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
            <div>
                <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Kategori *</label>
                <select name="category" required style="width: 100%; padding: 12px 15px; border: 2px solid #f0e6d2; border-radius: 8px; font-size: 1rem; outline: none; background: white;">
                    @php $categories = ['minuman', 'makanan', 'camilan', 'roti', 'sarapan-pagi', 'paket-hemat']; @endphp
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ old('category', $menu->category ?? '') == $cat ? 'selected' : '' }}>{{ ucfirst(str_replace('-', ' ', $cat)) }}</option>
                    @endforeach
                </select>
                @error('category') <span style="color: red; font-size: 0.85rem;">{{ $message }}</span> @enderror
            </div>
            <div>
                <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Harga (Rp) *</label>
                <input type="number" name="price" value="{{ old('price', $menu->price ?? '') }}" min="0" required style="width: 100%; padding: 12px 15px; border: 2px solid #f0e6d2; border-radius: 8px; font-size: 1rem; outline: none;" placeholder="Contoh: 25000">
                @error('price') <span style="color: red; font-size: 0.85rem;">{{ $message }}</span> @enderror
            </div>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Gambar Makanan (Opsional)</label>
            @if(isset($menu) && $menu->image)
                <div style="margin-bottom: 12px; display: flex; align-items: center; gap: 15px;">
                    @if(strpos($menu->image, '/') !== false || strpos($menu->image, '.') !== false)
                        <img src="{{ asset('storage/' . $menu->image) }}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 10px; border: 2px solid #f0e6d2;">
                    @else
                        <span style="font-size: 2.5rem; background: #f9f6f0; padding: 8px 12px; border-radius: 10px; border: 2px solid #f0e6d2; display: inline-block;">{{ $menu->image }}</span>
                    @endif
                    <span style="color: #666; font-size: 0.9rem; font-weight: 600;">Gambar / Icon Saat Ini</span>
                </div>
            @endif
            <input type="file" name="image" accept="image/*" style="width: 100%; padding: 12px 15px; border: 2px solid #f0e6d2; border-radius: 8px; font-size: 1rem; outline: none; background: white;">
            <span style="font-size: 0.85rem; color: #888;">*Unggah file foto makanan (Format: JPG, PNG, WebP, max 2MB). Kosongkan jika ingin tetap mempertahankan yang lama.</span>
            @error('image') <span style="color: red; font-size: 0.85rem;">{{ $message }}</span> @enderror
        </div>

        <div style="margin-bottom: 25px;">
            <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Deskripsi Singkat</label>
            <textarea name="description" rows="4" style="width: 100%; padding: 12px 15px; border: 2px solid #f0e6d2; border-radius: 8px; font-size: 1rem; outline: none; font-family: inherit;">{{ old('description', $menu->description ?? '') }}</textarea>
            @error('description') <span style="color: red; font-size: 0.85rem;">{{ $message }}</span> @enderror
        </div>


        <div style="display: flex; gap: 15px;">
            <button type="submit" class="btn-primary" style="padding: 12px 30px;">
                {{ isset($menu) ? 'Simpan Perubahan' : 'Tambah Menu' }}
            </button>
            <a href="{{ route('dashboard.menus') }}" style="padding: 12px 30px; border-radius: 10px; text-decoration: none; color: var(--brand-dark); background: #f0e6d2; font-weight: 700;">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
