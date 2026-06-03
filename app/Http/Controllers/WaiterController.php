<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WaiterController extends Controller
{
    public function orders()
    {
        // Dummy orders data
        $dummyOrders = [
            [
                'id' => 'ORD-201',
                'table' => 3,
                'customer' => 'Budi Santoso',
                'items' => 'Nasi Goreng Spesial (2), Es Teh Manis (2)',
                'total' => 85000,
                'time' => '12:30',
                'status' => 'pending'
            ],
            [
                'id' => 'ORD-202',
                'table' => 7,
                'customer' => 'Siti Aminah',
                'items' => 'Ayam Bakar Madu (1), Jus Jeruk (1)',
                'total' => 45000,
                'time' => '12:45',
                'status' => 'pending'
            ],
            [
                'id' => 'ORD-203',
                'table' => 1,
                'customer' => 'Agus Pratama',
                'items' => 'Mie Goreng Seafood (1), Es Jeruk (1)',
                'total' => 55000,
                'time' => '13:00',
                'status' => 'serving'
            ],
            [
                'id' => 'ORD-204',
                'table' => 10,
                'customer' => 'Dinda Putri',
                'items' => 'Sate Ayam (1 porsi), Nasi Putih (1)',
                'total' => 40000,
                'time' => '13:15',
                'status' => 'serving'
            ],
            [
                'id' => 'ORD-205',
                'table' => 5,
                'customer' => 'Reza Pahlevi',
                'items' => 'Nasi Campur Bali (2), Kopi Hitam (2)',
                'total' => 110000,
                'time' => '11:30',
                'status' => 'done'
            ],
            [
                'id' => 'ORD-206',
                'table' => 9,
                'customer' => 'Maya Sari',
                'items' => 'Ikan Bakar (1), Sayur Asem (1), Nasi Putih (2)',
                'total' => 75000,
                'time' => '11:45',
                'status' => 'done'
            ],
        ];

        return view('dashboard.waiter.orders', compact('dummyOrders'));
    }
}
