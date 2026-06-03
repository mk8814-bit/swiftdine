@extends('layouts.dashboard')

@section('content')
<div class="dashboard-header" style="margin-bottom: 30px;">
    <h1 style="font-size: 2rem; font-weight: 800; color: var(--brand-dark);">Kelola Pengguna</h1>
    <p style="color: #666; margin-top: 5px;">Daftar seluruh akun yang terdaftar di SwiftDine</p>
</div>

<div style="background: white; border-radius: 15px; padding: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="border-bottom: 2px solid #f0e6d2;">
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Nama</th>
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Email</th>
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Role</th>
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Tanggal Bergabung</th>
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr style="border-bottom: 1px solid #f9f6f0;">
                <td style="padding: 15px; font-weight: 600;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <div style="width: 35px; height: 35px; border-radius: 50%; background: var(--brand-cream); display: flex; align-items: center; justify-content: center; color: var(--brand-primary); font-weight: 800; overflow: hidden;">
                            @if($user->profile_picture)
                                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                {{ substr($user->name, 0, 1) }}
                            @endif
                        </div>
                        {{ $user->name }}
                    </div>
                </td>
                <td style="padding: 15px; color: #555;">{{ $user->email }}</td>
                <td style="padding: 15px;">
                    @php
                        $roleColors = [
                            'superadmin' => '#4A3B32',
                            'admin' => '#C19A6B',
                            'waiter' => '#2196F3',
                            'kasir' => '#4CAF50',
                            'pelanggan' => '#9E9E9E'
                        ];
                        $bgColor = $roleColors[$user->role] ?? '#9E9E9E';
                    @endphp
                    <span style="background: {{ $bgColor }}20; color: {{ $bgColor }}; padding: 5px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 700; text-transform: capitalize;">
                        {{ $user->role }}
                    </span>
                </td>
                <td style="padding: 15px; color: #777; font-size: 0.9rem;">
                    {{ $user->created_at->format('d M Y') }}
                </td>
                <td style="padding: 15px;">
                    <a href="{{ route('dashboard.users.edit', $user->id) }}" style="background: none; border: none; font-size: 1.2rem; text-decoration: none; cursor: pointer; transition: transform 0.2s; display: inline-block;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'" title="Edit">
                        ✏️
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="padding: 30px; text-align: center; color: #888;">Belum ada pengguna terdaftar.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div style="margin-top: 20px;">
        {{ $users->links() }}
    </div>
</div>
@endsection
