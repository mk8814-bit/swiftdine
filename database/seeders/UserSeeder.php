<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $password = Hash::make('12345');

        User::create([
            'name' => 'Superadmin User',
            'email' => 'superadmin@swiftdine.com',
            'role' => 'superadmin',
            'password' => $password,
        ]);

        for ($i = 1; $i <= 2; $i++) {
            User::create([
                'name' => 'Admin ' . $i,
                'email' => 'admin' . $i . '@swiftdine.com',
                'role' => 'admin',
                'password' => $password,
            ]);
        }

        for ($i = 1; $i <= 3; $i++) {
            User::create([
                'name' => 'Waiter ' . $i,
                'email' => 'waiter' . $i . '@swiftdine.com',
                'role' => 'waiter',
                'password' => $password,
            ]);
        }

        for ($i = 1; $i <= 2; $i++) {
            User::create([
                'name' => 'Kasir ' . $i,
                'email' => 'kasir' . $i . '@swiftdine.com',
                'role' => 'kasir',
                'password' => $password,
            ]);
        }
    }
}

