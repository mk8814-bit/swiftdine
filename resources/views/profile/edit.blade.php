@extends('layouts.dashboard')

@section('content')
<div class="dashboard-header" style="margin-bottom: 30px;">
    <h1 style="font-size: 2rem; font-weight: 800; color: var(--brand-dark);">Edit Profil</h1>
    <p style="color: #666; margin-top: 5px;">Perbarui informasi pribadi dan foto profil Anda</p>
</div>

<div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); max-width: 600px;">
    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 25px; display: flex; flex-direction: column; align-items: center;">
            <div style="width: 120px; height: 120px; background-color: var(--brand-primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 3rem; font-weight: 800; margin-bottom: 15px; overflow: hidden; border: 4px solid #f0e6d2;">
                @if(Auth::user()->profile_picture)
                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    {{ substr(Auth::user()->name, 0, 1) }}
                @endif
            </div>
            
            <label style="cursor: pointer; background: var(--brand-cream); padding: 8px 15px; border-radius: 8px; font-weight: 600; color: var(--brand-dark); border: 1px solid #e0d5c1; transition: background 0.2s;">
                Pilih Foto Profil Baru
                <input type="file" name="profile_picture" style="display: none;" accept="image/*" onchange="document.getElementById('file-name').textContent = this.files[0].name">
            </label>
            <div id="file-name" style="margin-top: 10px; font-size: 0.9rem; color: #666;"></div>
            @error('profile_picture')
                <div style="color: #dc3545; font-size: 0.9rem; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required style="width: 100%; padding: 12px 15px; border: 2px solid #f0e6d2; border-radius: 8px; font-size: 1rem; outline: none;">
            @error('name')
                <div style="color: #dc3545; font-size: 0.9rem; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>
        
        <div style="margin-bottom: 30px;">
            <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Email (Tidak dapat diubah)</label>
            <input type="email" value="{{ Auth::user()->email }}" disabled style="width: 100%; padding: 12px 15px; border: 2px solid #f0e6d2; border-radius: 8px; font-size: 1rem; outline: none; background: #f9f6f0; color: #888;">
        </div>

        <button type="submit" class="btn-primary" style="padding: 12px 30px; width: 100%; border-radius: 8px;">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection
