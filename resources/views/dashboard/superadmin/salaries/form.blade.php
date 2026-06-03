@extends('layouts.dashboard')

@section('content')
<div class="dashboard-header" style="margin-bottom: 30px;">
    <h1 style="font-size: 2rem; font-weight: 800; color: var(--brand-dark);">
        {{ isset($salary) ? 'Edit Gaji Pekerja' : 'Catat Gaji Baru' }}
    </h1>
    <p style="color: #666; margin-top: 5px;">Isi formulir di bawah untuk mencatat gaji karyawan.</p>
</div>

<div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); max-width: 600px;">
    <form action="{{ isset($salary) ? route('dashboard.salaries.update', $salary->id) : route('dashboard.salaries.store') }}" method="POST">
        @csrf
        @if(isset($salary))
            @method('PUT')
        @endif

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Pilih Karyawan</label>
            <select name="user_id" required style="width: 100%; padding: 12px 15px; border: 2px solid #f0e6d2; border-radius: 8px; font-size: 1rem; outline: none; background: white;">
                <option value="">Pilih Karyawan</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ (old('user_id', $salary->user_id ?? '')) == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ ucfirst($user->role) }})
                    </option>
                @endforeach
            </select>
            @error('user_id') <div style="color: #dc3545; font-size: 0.9rem; margin-top: 5px;">{{ $message }}</div> @enderror
        </div>

        <div style="display: flex; gap: 20px; margin-bottom: 20px;">
            <div style="flex: 1;">
                <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Bulan</label>
                <select name="month" required style="width: 100%; padding: 12px 15px; border: 2px solid #f0e6d2; border-radius: 8px; font-size: 1rem; outline: none; background: white;">
                    @foreach(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $m)
                        <option value="{{ $m }}" {{ (old('month', $salary->month ?? date('F'))) == $m ? 'selected' : '' }}>{{ $m }}</option>
                    @endforeach
                </select>
            </div>
            <div style="flex: 1;">
                <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Tahun</label>
                <input type="number" name="year" value="{{ old('year', $salary->year ?? date('Y')) }}" required style="width: 100%; padding: 12px 15px; border: 2px solid #f0e6d2; border-radius: 8px; font-size: 1rem; outline: none;">
            </div>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Nominal Gaji (Rp)</label>
            <input type="number" name="amount" value="{{ old('amount', $salary->amount ?? '') }}" required min="0" style="width: 100%; padding: 12px 15px; border: 2px solid #f0e6d2; border-radius: 8px; font-size: 1rem; outline: none;">
            @error('amount') <div style="color: #dc3545; font-size: 0.9rem; margin-top: 5px;">{{ $message }}</div> @enderror
        </div>

        <div style="margin-bottom: 30px;">
            <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Status</label>
            <select name="status" required style="width: 100%; padding: 12px 15px; border: 2px solid #f0e6d2; border-radius: 8px; font-size: 1rem; outline: none; background: white;">
                <option value="unpaid" {{ (old('status', $salary->status ?? 'unpaid')) == 'unpaid' ? 'selected' : '' }}>Belum Lunas (Unpaid)</option>
                <option value="paid" {{ (old('status', $salary->status ?? '')) == 'paid' ? 'selected' : '' }}>Lunas (Paid)</option>
            </select>
        </div>

        <div style="display: flex; gap: 15px;">
            <a href="{{ route('dashboard.salaries.index') }}" style="flex: 1; padding: 12px; text-align: center; border-radius: 8px; background: #f0e6d2; color: var(--brand-dark); text-decoration: none; font-weight: 600;">Batal</a>
            <button type="submit" class="btn-primary" style="flex: 2; padding: 12px; border-radius: 8px;">
                {{ isset($salary) ? 'Simpan Perubahan' : 'Catat Gaji' }}
            </button>
        </div>
    </form>
</div>
@endsection
