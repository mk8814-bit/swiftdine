@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                    <div class="card-header bg-white border-0 py-4 px-4 d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="fw-900 mb-1 color-primary ls-1">LAPORAN KEHADIRAN</h4>
                            <p class="text-muted mb-0 small">Daftar presensi seluruh staf berdasarkan verifikasi wajah.</p>
                        </div>
                        <div>
                            <button class="btn btn-primary rounded-pill px-4" onclick="window.print()">
                                <i class="fas fa-print me-2"></i> Cetak Laporan
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr class="text-uppercase small fw-bold text-muted ls-1">
                                        <th class="px-4 py-3">Pekerja</th>
                                        <th class="py-3">Role</th>
                                        <th class="py-3">Tanggal</th>
                                        <th class="py-3">Jam Masuk</th>
                                        <th class="py-3">Jam Pulang</th>
                                        <th class="py-3">Verifikasi</th>
                                        <th class="py-3">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($attendances as $attendance)
                                        <tr>
                                            <td class="px-4 py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-primary rounded-circle text-white d-flex align-items-center justify-content-center me-3"
                                                        style="width: 40px; height: 40px; font-weight: 800;">
                                                        @if($attendance->user->profile_picture)
                                                            <img src="{{ asset('storage/' . $attendance->user->profile_picture) }}"
                                                                class="rounded-circle w-100 h-100" style="object-fit: cover;">
                                                        @else
                                                            {{ substr($attendance->user->name, 0, 1) }}
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <div class="fw-bold">{{ $attendance->user->name }}</div>
                                                        <div class="text-muted small">{{ $attendance->user->email }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-3">
                                                <span
                                                    class="badge bg-secondary opacity-75 rounded-pill px-3">{{ ucfirst($attendance->user->role) }}</span>
                                            </td>
                                            <td class="py-3">
                                                <div class="fw-600">
                                                    {{ \Carbon\Carbon::parse($attendance->date)->translatedFormat('d M Y') }}
                                                </div>
                                            </td>
                                            <td class="py-3 text-success fw-bold">
                                                {{ $attendance->clock_in ? \Carbon\Carbon::parse($attendance->clock_in)->format('H:i:s') : '--:--' }}
                                            </td>
                                            <td class="py-3 text-danger fw-bold">
                                                {{ $attendance->clock_out ? \Carbon\Carbon::parse($attendance->clock_out)->format('H:i:s') : '--:--' }}
                                            </td>
                                            <td class="py-3">
                                                <div class="d-flex gap-2">
                                                    @if($attendance->face_verification_in)
                                                        <a href="{{ asset('storage/' . $attendance->face_verification_in) }}"
                                                            target="_blank" class="verification-thumb shadow-sm" title="Foto Masuk">
                                                            <img src="{{ asset('storage/' . $attendance->face_verification_in) }}"
                                                                class="rounded-3 border border-2 border-white"
                                                                style="width: 45px; height: 45px; object-fit: cover;">
                                                        </a>
                                                    @endif
                                                    @if($attendance->face_verification_out)
                                                        <a href="{{ asset('storage/' . $attendance->face_verification_out) }}"
                                                            target="_blank" class="verification-thumb shadow-sm"
                                                            title="Foto Pulang">
                                                            <img src="{{ asset('storage/' . $attendance->face_verification_out) }}"
                                                                class="rounded-3 border border-2 border-white"
                                                                style="width: 45px; height: 45px; object-fit: cover;">
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="py-3">
                                                @if($attendance->status === 'present')
                                                    <span class="text-success"><i class="fas fa-check-circle me-1"></i> Hadir</span>
                                                @else
                                                    <span class="text-warning"><i class="fas fa-info-circle me-1"></i>
                                                        {{ ucfirst($attendance->status) }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 py-4 px-4">
                        {{ $attendances->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .verification-thumb {
            transition: transform 0.2s, z-index 0.2s;
            display: inline-block;
        }

        .verification-thumb:hover {
            transform: scale(1.5);
            z-index: 10;
            position: relative;
        }

        .fw-600 {
            font-weight: 600;
        }

        .color-primary {
            color: #4e73df;
        }

        .fw-900 {
            font-weight: 900;
        }
    </style>
@endsection