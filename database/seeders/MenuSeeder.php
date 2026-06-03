<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            ['name' => 'Iced Latte', 'category' => 'minuman', 'price' => 'Rp 25.000', 'image' => '??', 'description' => 'Kopi espresso dengan susu segar dan es.'],
            ['name' => 'Caramel Macchiato', 'category' => 'minuman', 'price' => 'Rp 30.000', 'image' => '?', 'description' => 'Paduan kopi, susu, dan karamel yang manis.'],
            ['name' => 'Matcha Frappe', 'category' => 'minuman', 'price' => 'Rp 35.000', 'image' => '??', 'description' => 'Teh hijau Jepang yang diblend dengan es susu.'],
            ['name' => 'French Fries', 'category' => 'camilan', 'price' => 'Rp 20.000', 'image' => '??', 'description' => 'Kentang goreng krispi dengan bumbu spesial.'],
            ['name' => 'Nachos', 'category' => 'camilan', 'price' => 'Rp 25.000', 'image' => '??', 'description' => 'Keripik jagung dengan saus keju dan daging cincang.'],
            ['name' => 'Chicken Wings', 'category' => 'camilan', 'price' => 'Rp 35.000', 'image' => '??', 'description' => 'Sayap ayam panggang dengan saus BBQ.'],
            ['name' => 'Nasi Goreng Spesial', 'category' => 'makanan', 'price' => 'Rp 40.000', 'image' => '??', 'description' => 'Nasi goreng dengan telur, ayam, dan kerupuk.'],
            ['name' => 'Spaghetti Bolognese', 'category' => 'makanan', 'price' => 'Rp 45.000', 'image' => '??', 'description' => 'Pasta dengan saus daging sapi dan tomat segar.'],
            ['name' => 'Burger Beef Deluxe', 'category' => 'makanan', 'price' => 'Rp 50.000', 'image' => '??', 'description' => 'Burger daging sapi tebal dengan keju lumer dan sayuran segar.'],
            ['name' => 'Croissant', 'category' => 'roti', 'price' => 'Rp 22.000', 'image' => '??', 'description' => 'Roti lapis mentega ala Prancis yang renyah di luar, lembut di dalam.'],
            ['name' => 'Choco Donut', 'category' => 'roti', 'price' => 'Rp 15.000', 'image' => '??', 'description' => 'Donut dengan topping cokelat lezat.'],
            ['name' => 'Cheesecake', 'category' => 'roti', 'price' => 'Rp 35.000', 'image' => '??', 'description' => 'Kue keju lembut dengan selai stroberi.'],
            ['name' => 'Omelette', 'category' => 'sarapan-pagi', 'price' => 'Rp 25.000', 'image' => '??', 'description' => 'Telur dadar ala Prancis dengan sayuran dan sosis.'],
            ['name' => 'Pancake', 'category' => 'sarapan-pagi', 'price' => 'Rp 30.000', 'image' => '??', 'description' => 'Pancake hangat dengan sirup maple dan mentega.'],
            ['name' => 'Sandwich Tuna', 'category' => 'sarapan-pagi', 'price' => 'Rp 28.000', 'image' => '??', 'description' => 'Roti lapis gandum dengan isian tuna mayo yang segar.'],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}

