<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // Dummy data for transactions since there's no actual transaction table yet.
        $dummyTransactions = [
            (object)[
                'id' => 'TRX-1001',
                'date' => date('Y-m-d', strtotime('-1 days')),
                'customer_name' => 'Budi Santoso',
                'items' => 'Nasi Goreng Spesial (2), Es Teh Manis (2)',
                'total' => 85000,
                'status' => 'Selesai'
            ],
            (object)[
                'id' => 'TRX-1002',
                'date' => date('Y-m-d', strtotime('-1 days')),
                'customer_name' => 'Siti Aminah',
                'items' => 'Ayam Bakar Madu (1), Jus Jeruk (1)',
                'total' => 45000,
                'status' => 'Selesai'
            ],
            (object)[
                'id' => 'TRX-1003',
                'date' => date('Y-m-d'),
                'customer_name' => 'Agus Pratama',
                'items' => 'Mie Goreng Seafood (1), Es Jeruk (1)',
                'total' => 55000,
                'status' => 'Selesai'
            ],
            (object)[
                'id' => 'TRX-1004',
                'date' => date('Y-m-d'),
                'customer_name' => 'Dinda Putri',
                'items' => 'Sate Ayam (1 porsi), Nasi Putih (1), Air Mineral (1)',
                'total' => 40000,
                'status' => 'Diproses'
            ],
            (object)[
                'id' => 'TRX-1005',
                'date' => date('Y-m-d'),
                'customer_name' => 'Reza Pahlevi',
                'items' => 'Nasi Campur Bali (2), Kopi Hitam (2)',
                'total' => 110000,
                'status' => 'Selesai'
            ],
        ];

        return view('dashboard.reports.index', compact('dummyTransactions'));
    }
}
