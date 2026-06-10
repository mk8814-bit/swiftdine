<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Menu;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $password = Hash::make('12345');
        Menu::truncate();
        Setting::truncate();

        // ── Users ────────────────────────────────────────────────────────────
        User::firstOrCreate(['email' => 'budi.santoso@email.com'], ['name' => 'Budi Santoso', 'role' => 'superadmin', 'password' => $password]);
        User::firstOrCreate(['email' => 'siti.aminah@email.com'], ['name' => 'Siti Aminah', 'role' => 'admin', 'password' => $password]);
        User::firstOrCreate(['email' => 'andi.pratama@email.com'], ['name' => 'Andi Pratama', 'role' => 'admin', 'password' => $password]);
        User::firstOrCreate(['email' => 'ratna.sari@email.com'], ['name' => 'Ratna Sari', 'role' => 'waiter', 'password' => $password]);
        User::firstOrCreate(['email' => 'dimas.anggoro@email.com'], ['name' => 'Dimas Anggoro', 'role' => 'waiter', 'password' => $password]);
        User::firstOrCreate(['email' => 'putri.wulandari@email.com'], ['name' => 'Putri Wulandari', 'role' => 'waiter', 'password' => $password]);
        User::firstOrCreate(['email' => 'eko.prasetyo@email.com'], ['name' => 'Eko Prasetyo', 'role' => 'kasir', 'password' => $password]);
        User::firstOrCreate(['email' => 'linda.kusuma@email.com'], ['name' => 'Linda Kusuma', 'role' => 'kasir', 'password' => $password]);
        User::firstOrCreate(['email' => 'rina.bakery@email.com'], ['name' => 'Rina Bakery', 'role' => 'baker', 'password' => $password]);

        // ── Settings ─────────────────────────────────────────────────────────
        Setting::create(['key' => 'site_name', 'value' => 'SwiftDine']);
        Setting::create(['key' => 'location', 'value' => 'Jakarta, Indonesia']);
        Setting::create(['key' => 'tagline', 'value' => 'PESAN, LANGSUNG SIAPP!']);

        // ── Menu Items ───────────────────────────────────────────────────────
        $menus = [
            // Minuman
            ['name' => 'Iced Latte', 'category' => 'minuman', 'description' => 'Kopi espresso dengan susu segar dan es.', 'price' => 25000, 'image' => '🥤'],
            ['name' => 'Caramel Macchiato', 'category' => 'minuman', 'description' => 'Paduan kopi, susu, dan karamel yang manis.', 'price' => 30000, 'image' => '☕'],
            ['name' => 'Matcha Frappe', 'category' => 'minuman', 'description' => 'Teh hijau Jepang diblend dengan es susu.', 'price' => 35000, 'image' => '🍵'],
            ['name' => 'Lemon Tea', 'category' => 'minuman', 'description' => 'Teh manis dingin dengan perasan lemon segar.', 'price' => 18000, 'image' => '🍋'],
            // Camilan
            ['name' => 'French Fries', 'category' => 'camilan', 'description' => 'Kentang goreng krispi dengan bumbu spesial.', 'price' => 20000, 'image' => '🍟'],
            ['name' => 'Nachos', 'category' => 'camilan', 'description' => 'Keripik jagung dengan saus keju dan daging cincang.', 'price' => 25000, 'image' => '🌮'],
            ['name' => 'Chicken Wings', 'category' => 'camilan', 'description' => 'Sayap ayam panggang dengan saus BBQ.', 'price' => 35000, 'image' => '🍗'],
            // Makanan
            ['name' => 'Nasi Goreng Spesial', 'category' => 'makanan', 'description' => 'Nasi goreng dengan telur, ayam, dan kerupuk.', 'price' => 40000, 'image' => '🍛'],
            ['name' => 'Spaghetti Bolognese', 'category' => 'makanan', 'description' => 'Pasta dengan saus daging sapi dan tomat segar.', 'price' => 45000, 'image' => '🍝'],
            ['name' => 'Burger Beef Deluxe', 'category' => 'makanan', 'description' => 'Burger daging sapi tebal dengan keju lumer.', 'price' => 50000, 'image' => '🍔'],
            // Roti
            ['name' => 'Croissant', 'category' => 'roti', 'description' => 'Roti lapis mentega ala Prancis yang renyah.', 'price' => 22000, 'image' => '🥐'],
            ['name' => 'Choco Donut', 'category' => 'roti', 'description' => 'Donut dengan topping cokelat lezat.', 'price' => 15000, 'image' => '🍩'],
            ['name' => 'Cheesecake', 'category' => 'roti', 'description' => 'Kue keju lembut dengan selai stroberi.', 'price' => 35000, 'image' => '🍰'],
            // Sarapan Pagi
            ['name' => 'Omelette', 'category' => 'sarapan-pagi', 'description' => 'Telur dadar ala Prancis dengan sayuran dan sosis.', 'price' => 25000, 'image' => '🍳'],
            ['name' => 'Pancake', 'category' => 'sarapan-pagi', 'description' => 'Pancake hangat dengan sirup maple dan mentega.', 'price' => 30000, 'image' => '🥞'],
            ['name' => 'Sandwich Tuna', 'category' => 'sarapan-pagi', 'description' => 'Roti lapis gandum dengan isian tuna mayo segar.', 'price' => 28000, 'image' => '🥪'],
        ];

        foreach ($menus as $menu) {
            Menu::create(array_merge($menu, ['is_active' => true]));
        }

        $this->call(MejaSeeder::class);
    }
}
