@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-5 overflow-hidden mb-4">
                    <div class="card-body p-0 position-relative">
                        <!-- Progress Bar -->
                        <div id="scan-progress" class="position-absolute top-0 start-0 bg-success"
                            style="height: 6px; width: 0%; transition: width 0.3s; z-index: 1060;"></div>

                        <!-- Camera Wrapper -->
                        <div id="camera-wrapper" class="position-relative bg-dark"
                            style="aspect-ratio: 16/9; min-height: 450px;">
                            <video id="video" class="w-100 h-100" autoplay playsinline muted
                                style="object-fit: cover;"></video>
                            <canvas id="canvas" class="d-none"></canvas>

                            <!-- Top Controls -->
                            <div class="position-absolute top-0 end-0 p-3" style="z-index: 1080;">
                                <button id="btn-retry" class="btn btn-light btn-sm rounded-pill px-3 shadow-sm d-none">
                                    <i class="fas fa-redo me-1"></i> Ulangi Scan
                                </button>
                            </div>

                            <!-- Scanner Overlay -->
                            <div
                                class="scanner-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                                <div id="scanner-frame" class="scanner-frame">
                                    <!-- Success Mark -->
                                    <div id="success-mark"
                                        class="d-none position-absolute top-50 start-50 translate-middle text-success shadow-lg anim-pop"
                                        style="z-index: 10;">
                                        <i class="fas fa-check-circle fa-6x"></i>
                                    </div>
                                    <!-- Result Wrapper (Time & Date) -->
                                    <div id="result-wrapper"
                                        class="d-none position-absolute top-50 start-50 translate-middle text-center w-100 px-3"
                                        style="z-index: 11; margin-top: 80px;">
                                        <div class="bg-black bg-opacity-75 rounded-4 p-3 shadow-lg blur-bg mx-auto"
                                            style="max-width: 250px;">
                                            <h2 class="text-white fw-900 mb-0 ls-1" id="success-time">00:00:00</h2>
                                            <p class="text-success small fw-bold mb-0 text-uppercase ls-2"
                                                id="success-date">Wednesday, 10 June 2026</p>
                                        </div>
                                    </div>
                                </div>

                                <div id="scan-instruction"
                                    class="text-white bg-black bg-opacity-50 px-4 py-2 rounded-pill mt-4 blur-bg">
                                    <i class="fas fa-user-circle me-2 animate-pulse"></i> <span
                                        id="instruction-text">Posisikan wajah Anda di dalam lingkaran</span>
                                </div>
                            </div>

                            <!-- Loading Overlay -->
                            <div id="loading-overlay"
                                class="position-absolute top-0 start-0 w-100 h-100 bg-dark d-flex flex-column align-items-center justify-content-center text-white"
                                style="z-index: 1070;">
                                <div class="loader-circle mb-3"></div>
                                <span class="ls-2 small fw-bold">MENYIAPKAN SISTEM...</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 p-4">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <div>
                                <h4 class="fw-900 mb-1 color-primary">Digital Face ID</h4>
                                <p class="text-muted mb-0 small">Sistem verifikasi kehadiran otomatis berbasis AI.</p>
                            </div>
                            <div class="d-flex gap-2">
                                <button id="btn-submit"
                                    class="btn btn-success btn-lg rounded-pill px-5 d-none shadow-lg anim-pop">
                                    <i class="fas fa-paper-plane me-2"></i> Kirim Presensi
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm border-0 rounded-4 h-100 overflow-hidden">
                    <div class="card-header bg-white border-0 py-4 px-4">
                        <h5 class="card-title fw-900 mb-0 ls-1">INFO PRESENSI</h5>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="mb-4">
                            <div
                                class="d-flex align-items-center mb-4 p-3 bg-light rounded-4 border-start border-primary border-4 shadow-sm">
                                <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3 text-primary">
                                    <i class="fas fa-sign-in-alt fa-lg"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block uppercase fw-bold ls-1" style="font-size: 0.65rem;">JAM
                                        MASUK</small>
                                    <span
                                        class="fw-900 h4 mb-0">{{ $attendance && $attendance->clock_in ? \Carbon\Carbon::parse($attendance->clock_in)->format('H:i') : '--:--' }}</span>
                                </div>
                            </div>
                            <div
                                class="d-flex align-items-center p-3 bg-light rounded-4 border-start border-danger border-4 shadow-sm">
                                <div class="bg-danger bg-opacity-10 p-3 rounded-circle me-3 text-danger">
                                    <i class="fas fa-sign-out-alt fa-lg"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block uppercase fw-bold ls-1" style="font-size: 0.65rem;">JAM
                                        PULANG</small>
                                    <span
                                        class="fw-900 h4 mb-0">{{ $attendance && $attendance->clock_out ? \Carbon\Carbon::parse($attendance->clock_out)->format('H:i') : '--:--' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mb-4">
                            <p class="text-muted small mb-3 text-start fw-bold ls-1">VERIFIKASI TERAKHIR</p>
                            <div class="rounded-4 overflow-hidden shadow-lg bg-light border-4 border-white"
                                style="aspect-ratio: 1; position: relative;">
                                @if($attendance && ($attendance->face_verification_in || $attendance->face_verification_out))
                                    <img src="{{ asset('storage/' . ($attendance->face_verification_out ?? $attendance->face_verification_in)) }}"
                                        class="w-100 h-100" style="object-fit: cover;">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                        <div class="text-center op-2">
                                            <i class="fas fa-user-circle fa-4x mb-2"></i>
                                            <p class="small fw-bold ls-1">NO DATA</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div
                            class="bg-gradient-warning p-4 rounded-4 shadow-sm text-white position-relative overflow-hidden">
                            <i class="fas fa-shield-alt position-absolute end-0 bottom-0 fa-4x opacity-10 m-n2"></i>
                            <h6 class="fw-bold mb-2">Peringatan Keamanan</h6>
                            <p class="small mb-0 opacity-75">Sistem akan mencatat lokasi GPS dan alamat IP Anda saat proses
                                verifikasi wajah dilakukan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        :root {
            --primary: #4e73df;
            --success: #28a745;
            --dark: #1a1c23;
        }

        .fw-900 {
            font-weight: 900;
        }

        .ls-1 {
            letter-spacing: 1px;
        }

        .ls-2 {
            letter-spacing: 2px;
        }

        .color-primary {
            color: var(--primary);
        }

        .op-2 {
            opacity: 0.2;
        }

        .blur-bg {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .bg-gradient-warning {
            background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
        }

        .scanner-frame {
            width: 320px;
            height: 320px;
            border: 4px solid rgba(255, 255, 255, 0.4);
            border-radius: 50%;
            position: relative;
            transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: 0 0 0 2000px rgba(0, 0, 0, 0.65);
        }

        .scanner-frame.success {
            border-color: var(--success);
            box-shadow: 0 0 60px rgba(40, 167, 69, 0.4), 0 0 0 2000px rgba(0, 0, 0, 0.8);
            transform: scale(1.05);
        }

        .scanner-frame::before {
            content: '';
            position: absolute;
            inset: -12px;
            border: 3px solid transparent;
            border-top-color: var(--primary);
            border-radius: 50%;
            animation: spin 3s linear infinite;
        }

        .scanner-frame.success::before {
            border-top-color: var(--success);
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .anim-pop {
            animation: pop 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        @keyframes pop {
            0% {
                transform: scale(0.5);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .animate-pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 0.8;
            }

            50% {
                transform: scale(1.1);
                opacity: 1;
            }

            100% {
                transform: scale(1);
                opacity: 0.8;
            }
        }

        .loader-circle {
            width: 50px;
            height: 50px;
            border: 5px solid #333;
            border-top-color: var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/@vladmandic/face-api/dist/face-api.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', async function () {
            const video = document.getElementById('video');
            const canvas = document.getElementById('canvas');
            const loadingOverlay = document.getElementById('loading-overlay');
            const scannerFrame = document.getElementById('scanner-frame');
            const scanInstruction = document.getElementById('scan-instruction');
            const instructionText = document.getElementById('instruction-text');
            const scanProgress = document.getElementById('scan-progress');
            const successMark = document.getElementById('success-mark');
            const resultWrapper = document.getElementById('result-wrapper');
            const successTime = document.getElementById('success-time');
            const successDate = document.getElementById('success-date');
            const btnSubmit = document.getElementById('btn-submit');
            const btnRetry = document.getElementById('btn-retry');

            let isDetecting = true;
            let detectionStartTime = null;
            let finalImageData = null;
            const DETECTION_THRESHOLD_MS = 2500; // 2.5 seconds to verify

            // Load face-api models
            try {
                await Promise.all([
                    faceapi.nets.tinyFaceDetector.loadFromUri('https://cdn.jsdelivr.net/npm/@vladmandic/face-api/model/'),
                ]);
                console.log('Face-api models loaded successfully');
            } catch (e) {
                console.error('Face-api models loading failed', e);
                // We will continue anyway, just might not be as accurate
            }

            // Camera Init
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({ video: { width: 1280, height: 720, facingMode: "user" } })
                    .then(function (stream) {
                        video.srcObject = stream;
                        video.onloadedmetadata = () => {
                            loadingOverlay.classList.add('opacity-0');
                            setTimeout(() => loadingOverlay.classList.add('d-none'), 500);
                            startDetection();
                        };
                    })
                    .catch(function (err) {
                        console.error("Camera access error:", err);
                        Swal.fire('Error Camera', 'Tidak dapat mengakses kamera. Pastikan izin kamera diberikan.', 'error');
                    });
            }

            async function startDetection() {
                if (!isDetecting) return;

                let detected = false;
                try {
                    const detections = await faceapi.detectSingleFace(video, new faceapi.TinyFaceDetectorOptions());
                    if (detections) detected = true;
                } catch (e) {
                    // Fallback if detection fails
                }

                if (detected) {
                    if (!detectionStartTime) {
                        detectionStartTime = Date.now();
                        instructionText.textContent = "MEMPROSES... JANGAN BERGERAK";
                        instructionText.classList.add('text-success');
                        instructionText.classList.remove('text-white');
                    }

                    const elapsed = Date.now() - detectionStartTime;
                    const progress = Math.min((elapsed / DETECTION_THRESHOLD_MS) * 100, 100);
                    scanProgress.style.width = progress + '%';

                    if (elapsed >= DETECTION_THRESHOLD_MS) {
                        onSuccess();
                        return;
                    }
                } else {
                    detectionStartTime = null;
                    scanProgress.style.width = '0%';
                    instructionText.textContent = "Posisikan wajah Anda di dalam lingkaran";
                    instructionText.classList.remove('text-success');
                    instructionText.classList.add('text-white');
                }

                requestAnimationFrame(startDetection);
            }

            function onSuccess() {
                isDetecting = false;

                // Capture final frame
                const context = canvas.getContext('2d');
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                context.drawImage(video, 0, 0, video.videoWidth, video.videoHeight);
                finalImageData = canvas.toDataURL('image/png');

                // Play success sound (native browser beep)
                const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
                const osc = audioCtx.createOscillator();
                osc.type = 'sine';
                osc.frequency.setValueAtTime(800, audioCtx.currentTime);
                osc.connect(audioCtx.destination);
                osc.start();
                osc.stop(audioCtx.currentTime + 0.1);

                // Visual feedback
                scannerFrame.classList.add('success');
                successMark.classList.remove('d-none');
                scanInstruction.classList.add('opacity-0');
                setTimeout(() => scanInstruction.classList.add('d-none'), 300);

                // Results overlay
                resultWrapper.classList.remove('d-none');
                resultWrapper.classList.add('anim-pop');

                const now = new Date();
                successTime.textContent = now.getHours().toString().padStart(2, '0') + ':' +
                    now.getMinutes().toString().padStart(2, '0') + ':' +
                    now.getSeconds().toString().padStart(2, '0');
                successDate.textContent = now.toLocaleDateString('id-ID', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });

                // Toggle Buttons
                btnSubmit.classList.remove('d-none');
                btnRetry.classList.remove('d-none');

                video.pause();
            }

            btnRetry.addEventListener('click', () => {
                location.reload();
            });

            btnSubmit.addEventListener('click', function () {
                this.disabled = true;
                const mode = "{{ !$attendance || !$attendance->clock_in ? 'in' : 'out' }}";
                const url = mode === 'in' ? "{{ route('dashboard.attendance.clock-in') }}" : "{{ route('dashboard.attendance.clock-out') }}";

                this.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> MENGIRIM...';

                fetch(url, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ image: finalImageData })
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'PRENSI BERHASIL!',
                                text: data.message,
                                confirmButtonText: 'SELESAI',
                                buttonsStyling: false,
                                customClass: {
                                    confirmButton: 'btn btn-success rounded-pill px-5 py-2 fw-bold shadow-lg'
                                }
                            }).then(() => location.reload());
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'GAGAL',
                                text: data.message
                            });
                            this.disabled = false;
                            this.innerHTML = '<i class="fas fa-paper-plane me-2"></i> Kirim Presensi';
                        }
                    })
                    .catch(err => {
                        console.error('Submission error:', err);
                        Swal.fire('Error', 'Terjadi kesalahan sistem saat mengirim data.', 'error');
                        this.disabled = false;
                        this.innerHTML = '<i class="fas fa-paper-plane me-2"></i> Kirim Presensi';
                    });
            });
        });
    </script>
@endsection