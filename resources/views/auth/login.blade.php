@extends('layouts.app')

@section('content')
<style>
    .auth-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
        background-color: var(--brand-cream);
        padding: 40px 20px;
    }
    .auth-card {
        background: var(--brand-light);
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(74, 59, 50, 0.05);
        width: 100%;
        max-width: 400px;
        border: 2px solid #f0e6d2;
    }
    .auth-header {
        text-align: center;
        margin-bottom: 30px;
    }
    .auth-header h1 {
        font-size: 2rem;
        font-weight: 800;
        color: var(--brand-dark);
        margin-bottom: 10px;
    }
    .auth-header p {
        color: #666;
        font-size: 0.95rem;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 700;
        color: var(--brand-dark);
        font-size: 0.9rem;
    }
    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.3s ease;
        font-family: 'Outfit', sans-serif;
    }
    .form-control:focus {
        outline: none;
        border-color: var(--brand-primary);
        box-shadow: 0 0 0 3px rgba(193, 154, 107, 0.2);
    }
    .btn-auth {
        width: 100%;
        background-color: var(--brand-primary);
        color: var(--brand-light);
        border: none;
        padding: 15px;
        border-radius: 10px;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 10px;
    }
    .btn-auth:hover {
        background-color: var(--brand-accent);
        transform: translateY(-2px);
    }
    .auth-footer {
        text-align: center;
        margin-top: 20px;
        font-size: 0.95rem;
    }
    .auth-footer a {
        color: var(--brand-primary);
        text-decoration: none;
        font-weight: 700;
    }
    .auth-footer a:hover {
        text-decoration: underline;
    }
    .error-msg {
        color: #e74c3c;
        font-size: 0.85rem;
        margin-top: 5px;
    }
    .alert-danger {
        background-color: #fce4e4;
        color: #c0392b;
        padding: 10px 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 0.9rem;
        border: 1px solid #f8caca;
    }
</style>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1>Login</h1>
            <p>Selamat datang kembali di SwiftDine</p>
        </div>

        @if($errors->has('email'))
            <div class="alert-danger">
                {{ $errors->first('email') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus placeholder="Masukkan email Anda">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required placeholder="Masukkan password Anda">
            </div>

            <button type="submit" class="btn-auth">Login</button>
        </form>

        <div class="auth-footer">
            Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
        </div>
    </div>
</div>
@endsection
