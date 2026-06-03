<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    // Metadata untuk setiap kategori (judul & deskripsi)
    private array $categoryMeta = [
        'minuman'      => ['title' => 'Minuman',       'description' => 'Segarkan harimu dengan berbagai pilihan minuman kami.'],
        'camilan'      => ['title' => 'Camilan',        'description' => 'Teman santai yang pas untuk menemani waktu luangmu.'],
        'makanan'      => ['title' => 'Makanan',        'description' => 'Nikmati hidangan utama yang lezat dan mengenyangkan.'],
        'roti'         => ['title' => 'Roti & Pastry',  'description' => 'Beragam pilihan roti dan kue manis yang menggugah selera.'],
        'sarapan-pagi' => ['title' => 'Sarapan Pagi',   'description' => 'Mulai pagi Anda dengan sarapan bergizi yang penuh energi.'],
    ];

    public function show($category)
    {
        if (!array_key_exists($category, $this->categoryMeta)) {
            abort(404);
        }

        // Ambil menu dari database berdasarkan kategori, hanya yang aktif
        $items = Menu::where('category', $category)
                     ->where('is_active', true)
                     ->orderBy('name')
                     ->get();

        $menuData = array_merge($this->categoryMeta[$category], [
            'items' => $items,
        ]);

        return view('menu.show', compact('menuData'));
    }
}
