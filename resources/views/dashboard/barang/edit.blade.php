@extends('layouts.dashboard')

@section('content')
    <div class="header-action"
        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h2 style="font-weight: 800; color: var(--brand-dark); font-size: 1.8rem; margin-bottom: 5px;">Edit Barang</h2>
            <p style="color: #666;">Perbarui detail data barang.</p>
        </div>
        <a href="{{ route('dashboard.barang.index') }}" class="btn-primary"
            style="background-color: #f9f6f0; color: var(--brand-dark); box-shadow: none; border: 1px solid #ddd;">
            Kembali
        </a>
    </div>

    <div
        style="background: white; border-radius: 15px; padding: 25px; box-shadow: 0 5px 20px rgba(0,0,0,0.03); max-width: 600px;">
        <form action="{{ route('dashboard.barang.update', $barang->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; margin-bottom: 8px;">Kode Barang (*)</label>
                <input type="text" name="kode_barang" value="{{ old('kode_barang', $barang->kode_barang) }}" required
                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
                @error('kode_barang') <span
                    style="color: #E53935; font-size: 0.85rem; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; margin-bottom: 8px;">Nama Barang (*)</label>
                <input type="text" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" required
                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
                @error('nama_barang') <span
                    style="color: #E53935; font-size: 0.85rem; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: 600; margin-bottom: 8px;">Harga (Rp) (*)</label>
                <input type="number" name="harga" value="{{ old('harga', $barang->harga) }}" required min="0"
                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
                @error('harga') <span
                    style="color: #E53935; font-size: 0.85rem; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-primary" style="width: 100%; padding: 12px; font-size: 1.1rem;">Perbarui
                Barang</button>
        </form>
    </div>
@endsection