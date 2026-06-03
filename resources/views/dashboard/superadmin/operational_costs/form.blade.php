@extends('layouts.dashboard')

@section('content')
<div class="dashboard-header" style="margin-bottom: 30px;">
    <h1 style="font-size: 2rem; font-weight: 800; color: var(--brand-dark);">
        {{ isset($cost) ? 'Edit Pengeluaran' : 'Catat Pengeluaran Baru' }}
    </h1>
    <p style="color: #666; margin-top: 5px;">Kelola catatan biaya operasional restoran.</p>
</div>

<div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); max-width: 600px;">
    <form action="{{ isset($cost) ? route('dashboard.operational-costs.update', $cost->id) : route('dashboard.operational-costs.store') }}" method="POST">
        @csrf
        @if(isset($cost))
            @method('PUT')
        @endif

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Tanggal Pengeluaran</label>
            <input type="date" name="date" value="{{ old('date', isset($cost) ? \Carbon\Carbon::parse($cost->date)->format('Y-m-d') : date('Y-m-d')) }}" required style="width: 100%; padding: 12px 15px; border: 2px solid #f0e6d2; border-radius: 8px; font-size: 1rem; outline: none;">
            @error('date') <div style="color: #dc3545; font-size: 0.9rem; margin-top: 5px;">{{ $message }}</div> @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Nama Pengeluaran</label>
            <input type="text" name="name" value="{{ old('name', $cost->name ?? '') }}" required placeholder="Misal: Tagihan Listrik Bulan Ini" style="width: 100%; padding: 12px 15px; border: 2px solid #f0e6d2; border-radius: 8px; font-size: 1rem; outline: none;">
            @error('name') <div style="color: #dc3545; font-size: 0.9rem; margin-top: 5px;">{{ $message }}</div> @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Nominal (Rp)</label>
            <input type="number" step="0.01" name="amount" value="{{ old('amount', $cost->amount ?? '') }}" required min="0" style="width: 100%; padding: 12px 15px; border: 2px solid #f0e6d2; border-radius: 8px; font-size: 1rem; outline: none;">
            @error('amount') <div style="color: #dc3545; font-size: 0.9rem; margin-top: 5px;">{{ $message }}</div> @enderror
        </div>

        <div style="margin-bottom: 30px;">
            <label style="display: block; font-weight: 700; margin-bottom: 8px; color: var(--brand-dark);">Deskripsi (Opsional)</label>
            <textarea name="description" rows="3" style="width: 100%; padding: 12px 15px; border: 2px solid #f0e6d2; border-radius: 8px; font-size: 1rem; outline: none; font-family: inherit;">{{ old('description', $cost->description ?? '') }}</textarea>
            @error('description') <div style="color: #dc3545; font-size: 0.9rem; margin-top: 5px;">{{ $message }}</div> @enderror
        </div>

        <div style="display: flex; gap: 15px;">
            <a href="{{ route('dashboard.operational-costs.index') }}" style="flex: 1; padding: 12px; text-align: center; border-radius: 8px; background: #f0e6d2; color: var(--brand-dark); text-decoration: none; font-weight: 600;">Batal</a>
            <button type="submit" class="btn-primary" style="flex: 2; padding: 12px; border-radius: 8px;">
                {{ isset($cost) ? 'Simpan Perubahan' : 'Catat Pengeluaran' }}
            </button>
        </div>
    </form>
</div>
@endsection
