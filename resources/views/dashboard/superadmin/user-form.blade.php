@extends('layouts.dashboard')

@section('content')
    <div class="dashboard-header" style="margin-bottom: 30px;">
        <h1 style="font-size: 2rem; font-weight: 800; color: var(--brand-dark);">
            Edit Akun Pengguna
        </h1>
        <p style="color: #666; margin-top: 5px;">Silakan sesuaikan informasi profil dan hak akses pengguna di bawah ini.</p>
    </div>

    <div
        style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); max-width: 800px;">
        <form action="{{ route('dashboard.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div style="margin-bottom: 25px; display: flex; flex-direction: column; align-items: flex-start;">
                <label style="display: block; font-weight: 700; margin-bottom: 12px; color: var(--brand-dark);">Foto
                    Profil</label>
                <div style="display: flex; align-items: center; gap: 20px;">
                    <div
                        style="width: 80px; height: 80px; border-radius: 50%; background: var(--brand-cream); border: 2px solid #f0e6d2; display: flex; align-items: center; justify-content: center; overflow: hidden; font-weight: 800; color: var(--brand-primary); font-size: 1.5rem;">
                        @if($user->profile_picture)
                            <img id="userPreview" src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile"
                                style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <img id="userPreview" src="" alt="Profile"
                                style="width: 100%; height: 100%; object-fit: cover; display: none;">
                            <span id="userPlaceholder">{{ substr($user->name, 0, 1) }}</span>
                        @endif
                    </div>
                    <label
                        style="cursor: pointer; background: var(--brand-cream); padding: 10px 20px; border-radius: 10px; font-weight: 700; border: 2px solid #f0e6d2; color: var(--brand-dark);">
                        Upload Foto
                        <input type="file" name="profile_picture" style="display: none;" accept="image/*"
                            onchange="initCropper(this, 'userPreview')">
                    </label>
                </div>
                @error('profile_picture') <span
                    style="color: red; font-size: 0.85rem; margin-top: 5px;">{{ $message }}</span>
                @enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Nama Lengkap
                    *</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                    style="width: 100%; padding: 12px 15px; border: 2px solid #f0e6d2; border-radius: 8px; font-size: 1rem; outline: none;"
                    placeholder="Contoh: John Doe">
                @error('name') <span style="color: red; font-size: 0.85rem;">{{ $message }}</span> @enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Alamat Email
                    *</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                    style="width: 100%; padding: 12px 15px; border: 2px solid #f0e6d2; border-radius: 8px; font-size: 1rem; outline: none;"
                    placeholder="Contoh: user@email.com">
                @error('email') <span style="color: red; font-size: 0.85rem;">{{ $message }}</span> @enderror
            </div>

            <div style="margin-bottom: 30px;">
                <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Peran / Hak
                    Akses (Role) *</label>
                <select name="role" required
                    style="width: 100%; padding: 12px 15px; border: 2px solid #f0e6d2; border-radius: 8px; font-size: 1rem; outline: none; background: white;">
                    @php $roles = ['superadmin', 'admin', 'waiter', 'kasir', 'barista', 'koki', 'staf_gudang', 'owner', 'pelanggan']; @endphp
                    @foreach($roles as $role)
                        <option value="{{ $role }}" {{ old('role', $user->role) == $role ? 'selected' : '' }}>
                            {{ ucwords(str_replace('_', ' ', $role)) }}
                        </option>
                    @endforeach
                </select>
                @error('role') <span style="color: red; font-size: 0.85rem;">{{ $message }}</span> @enderror
            </div>

            <div style="display: flex; gap: 15px;">
                <button type="submit" class="btn-primary" style="padding: 12px 30px; border-radius: 10px;">
                    Simpan Perubahan
                </button>
                <a href="{{ route('dashboard.users') }}"
                    style="padding: 12px 30px; border-radius: 10px; text-decoration: none; color: var(--brand-dark); background: #f0e6d2; font-weight: 700;">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection