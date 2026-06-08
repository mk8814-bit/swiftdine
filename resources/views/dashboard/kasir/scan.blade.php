@extends('layouts.dashboard')

@section('content')
    <div class="dashboard-header" style="margin-bottom: 30px;">
        <h1 style="font-size: 2rem; font-weight: 800; color: var(--brand-dark);">Generator Barcode</h1>
        <p style="color: #666; margin-top: 5px;">Masukkan nama produk dan kode untuk menghasilkan barcode bergaris yang
            dapat di-scan dengan alat</p>
    </div>

    <div
        style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); max-width: 800px; margin: 0 auto; display: flex; flex-direction: column; align-items: center;">

        <div style="width: 100%; display: flex; flex-direction: column; gap: 15px; margin-bottom: 30px;">
            <div style="position: relative;">
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#999" stroke-width="2"
                    style="position: absolute; left: 15px; top: 13px;">
                    <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                    <line x1="7" y1="7" x2="7.01" y2="7"></line>
                </svg>
                <input type="text" id="productName" placeholder="Masukkan Nama Produk..." autofocus
                    style="width: 100%; padding: 15px 15px 15px 50px; border: 2px solid #f0e6d2; border-radius: 12px; font-size: 1.1rem; outline: none; transition: all 0.3s;"
                    onfocus="this.style.borderColor='var(--brand-primary)'" onblur="this.style.borderColor='#f0e6d2'">
            </div>

            <div style="position: relative;">
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#999" stroke-width="2"
                    style="position: absolute; left: 15px; top: 13px;">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="9" y1="3" x2="9" y2="21"></line>
                </svg>
                <input type="text" id="barcodeInput" placeholder="Masukkan Kode Barcode/SKU..."
                    style="width: 100%; padding: 15px 15px 15px 50px; border: 2px solid #f0e6d2; border-radius: 12px; font-size: 1.1rem; outline: none; transition: all 0.3s;"
                    onfocus="this.style.borderColor='var(--brand-primary)'" onblur="this.style.borderColor='#f0e6d2'">
            </div>

            <button class="btn-primary" onclick="generateBarcode()"
                style="padding: 15px 25px; border-radius: 12px; font-size: 1.05rem; margin-top: 10px;">
                🖨️ Generate Barcode
            </button>
        </div>

        <!-- Barcode result area -->
        <div id="scanResult"
            style="width: 100%; display: none; padding: 30px; background: #fff; border-radius: 12px; text-align: center; border: 2px dashed #e2e8f0;">
            <h3 id="resProductName"
                style="font-weight: 800; color: var(--brand-dark); margin: 0 0 15px 0; font-size: 1.5rem;">Nama Produk</h3>

            <div
                style="background: white; padding: 20px; display: inline-block; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 20px;">
                <svg id="barcodeImage"></svg>
            </div>

            <p style="color: #666; margin: 0; font-size: 0.95rem;">Scan barcode menggunakan alat scanner fisik</p>
        </div>
    </div>

    <!-- Include JsBarcode library -->
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
    <script>
        document.getElementById('barcodeInput').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                generateBarcode();
            }
        });

        document.getElementById('productName').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                document.getElementById('barcodeInput').focus();
            }
        });

        function generateBarcode() {
            var nameInput = document.getElementById('productName').value;
            var codeInput = document.getElementById('barcodeInput').value;

            if (nameInput.trim() === '' || codeInput.trim() === '') {
                alert('Silakan masukkan Nama Produk dan Kode Barcode/SKU.');
                return;
            }

            // Show result area
            document.getElementById('scanResult').style.display = 'block';
            document.getElementById('resProductName').innerText = nameInput;

            // Generate barcode
            try {
                JsBarcode("#barcodeImage", codeInput, {
                    format: "CODE128",
                    lineColor: "#000",
                    width: 2,
                    height: 100,
                    displayValue: true,
                    fontSize: 18,
                    margin: 10
                });
            } catch (e) {
                alert('Gagal menghasilkan barcode. Pastikan kode valid (hindari karakter khusus yang tidak didukung).');
            }
        }
    </script>
@endsection