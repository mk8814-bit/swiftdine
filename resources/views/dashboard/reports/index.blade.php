@extends('layouts.dashboard')

@section('content')
<div class="dashboard-header" style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: flex-end;">
    <div>
        <h1 style="font-size: 2.2rem; font-weight: 800; color: var(--brand-dark); margin-bottom: 5px;">Laporan Transaksi</h1>
        <p style="color: #666; font-size: 1.05rem;">Data histori transaksi penjualan restoran.</p>
    </div>
    
    <div style="display: flex; gap: 10px;" class="hide-on-print">
        <button onclick="exportToPDF()" style="background: #E53935; color: white; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 8px;">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
            PDF
        </button>
        <button onclick="exportToExcel()" style="background: #2E7D32; color: white; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 8px;">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
            Excel
        </button>
        <button onclick="window.print()" style="background: var(--brand-primary); color: white; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 8px;">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
            Print
        </button>
    </div>
</div>

<div style="background: white; border-radius: 15px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);" id="report-container">
    <div class="print-header" style="display: none; text-align: center; margin-bottom: 20px;">
        <h2 style="margin: 0;">Laporan Transaksi - {{ \App\Models\Setting::where('key', 'site_name')->value('value') ?? 'SwiftDine' }}</h2>
        <p style="margin: 5px 0 0; color: #666;">Dicetak pada: {{ date('d M Y H:i') }}</p>
    </div>

    <table id="transactionTable" style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="border-bottom: 2px solid #f0e6d2;">
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Tanggal</th>
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">ID Transaksi</th>
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Nama Pelanggan</th>
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Pesanan</th>
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Total (Rp)</th>
                <th style="padding: 15px; font-weight: 800; color: var(--brand-dark);">Status</th>
            </tr>
        </thead>
        <tbody>
            @php $totalRevenue = 0; @endphp
            @foreach($dummyTransactions as $trx)
            @php $totalRevenue += $trx->total; @endphp
            <tr style="border-bottom: 1px solid #f9f6f0;">
                <td style="padding: 15px; color: #555;">{{ \Carbon\Carbon::parse($trx->date)->format('d M Y') }}</td>
                <td style="padding: 15px; font-weight: 700; color: var(--brand-primary);">{{ $trx->id }}</td>
                <td style="padding: 15px; font-weight: 600;">{{ $trx->customer_name }}</td>
                <td style="padding: 15px; color: #666; font-size: 0.9rem; max-width: 250px;">{{ $trx->items }}</td>
                <td style="padding: 15px; font-weight: 700;">{{ number_format($trx->total, 0, ',', '.') }}</td>
                <td style="padding: 15px;">
                    <span style="background: {{ $trx->status == 'Selesai' ? '#D4EDDA' : '#FFF3CD' }}; color: {{ $trx->status == 'Selesai' ? '#155724' : '#856404' }}; padding: 5px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 700;">
                        {{ $trx->status }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr style="background-color: #f9f6f0;">
                <td colspan="4" style="padding: 15px; text-align: right; font-weight: 800; color: var(--brand-dark);">TOTAL PENDAPATAN</td>
                <td colspan="2" style="padding: 15px; font-weight: 900; color: var(--brand-primary); font-size: 1.1rem;">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
    
    <div style="margin-top: 15px; font-size: 0.85rem; color: #999; font-style: italic;" class="hide-on-print">
        * Catatan: Data ini adalah data percontohan (dummy) untuk demonstrasi fitur export laporan.
    </div>
</div>

<!-- Library for Export Excel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<!-- Library for Export PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
    function exportToExcel() {
        var elt = document.getElementById('transactionTable');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "Laporan Transaksi" });
        XLSX.writeFile(wb, "Laporan_Transaksi_SwiftDine.xlsx");
    }

    function exportToPDF() {
        var element = document.getElementById('report-container');
        
        // Sembunyikan elemen yang tidak perlu dicetak
        var hideElements = document.querySelectorAll('.hide-on-print');
        hideElements.forEach(el => el.style.display = 'none');
        
        // Tampilkan header khusus print
        var printHeader = document.querySelector('.print-header');
        if (printHeader) printHeader.style.display = 'block';

        var opt = {
            margin:       10,
            filename:     'Laporan_Transaksi_SwiftDine.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2 },
            jsPDF:        { unit: 'mm', format: 'a4', orientation: 'landscape' }
        };

        html2pdf().set(opt).from(element).save().then(() => {
            // Kembalikan tampilan semula
            hideElements.forEach(el => el.style.display = '');
            if (printHeader) printHeader.style.display = 'none';
        });
    }
</script>

<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #report-container, #report-container * {
            visibility: visible;
        }
        #report-container {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            box-shadow: none !important;
            padding: 0 !important;
        }
        .hide-on-print {
            display: none !important;
        }
        .print-header {
            display: block !important;
        }
    }
</style>
@endsection
