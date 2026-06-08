@extends('layouts.dashboard')

@section('content')
    <div class="dashboard-header" style="margin-bottom: 30px;">
        <h1 style="font-size: 2rem; font-weight: 800; color: var(--brand-dark);">
            {{ isset($meja) ? 'Edit Meja' : 'Tambah Meja' }}
        </h1>
        <p style="color: #666; margin-top: 5px;">Mohon isi data meja dengan benar.</p>
    </div>

    <div
        style="background: white; border-radius: 15px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); max-width: 600px;">
        <form action="{{ isset($meja) ? route('dashboard.meja.update', $meja->id) : route('dashboard.meja.store') }}"
            method="POST">
            @csrf
            @if(isset($meja))
                @method('PUT')
            @endif

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--brand-dark);">Nomor
                    Meja</label>
                <input type="text" name="number" value="{{ old('number', $meja->number ?? '') }}" required
                    style="width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem; transition: border-color 0.2s;"
                    onfocus="this.style.borderColor='var(--brand-primary)'" onblur="this.style.borderColor='#ddd'">
                @error('number')<div style="color: #DC3545; font-size: 0.85rem; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label
                    style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--brand-dark);">Status</label>
                <select name="status" required
                    style="width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem; background: white;">
                    <option value="empty" {{ old('status', $meja->status ?? '') == 'empty' ? 'selected' : '' }}>Kosong
                    </option>
                    <option value="occupied" {{ old('status', $meja->status ?? '') == 'occupied' ? 'selected' : '' }}>Terisi
                    </option>
                </select>
                @error('status')<div style="color: #DC3545; font-size: 0.85rem; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--brand-dark);">Nama Tamu
                    (Jika Terisi)</label>
                <input type="text" name="guest_name" value="{{ old('guest_name', $meja->guest_name ?? '') }}"
                    style="width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
                @error('guest_name')<div style="color: #DC3545; font-size: 0.85rem; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--brand-dark);">Waktu
                    Tersedia (Jika Terisi)</label>
                <input type="datetime-local" name="reserved_since"
                    value="{{ old('reserved_since', isset($meja) && $meja->reserved_since ? date('Y-m-d\TH:i', strtotime($meja->reserved_since)) : '') }}"
                    style="width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
                @error('reserved_since')<div style="color: #DC3545; font-size: 0.85rem; margin-top: 5px;">{{ $message }}
                </div>@enderror
            </div>

            <div style="display: flex; gap: 10px;">
                <a href="{{ route('dashboard.meja.index') }}"
                    style="padding: 12px 20px; background: #f0e6d2; color: var(--brand-dark); text-decoration: none; border-radius: 8px; font-weight: 600; text-align: center; flex: 1;">Batal</a>
                <button type="submit"
                    style="padding: 12px 20px; background: var(--brand-primary); color: white; border: none; border-radius: 8px; font-weight: 700; cursor: pointer; flex: 1; font-size: 1rem;">Simpan
                    Meja</button>
            </div>
        </form>
    </div>
@endsection