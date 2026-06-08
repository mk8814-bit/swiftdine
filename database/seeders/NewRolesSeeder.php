<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class NewRolesSeeder extends Seeder
{
    public function run(): void
    {
        $password = Hash::make('12345');
        $faker = \Faker\Factory::create('id_ID');

        $roles = [
            'barista' => 'Barista',
            'koki' => 'Koki',
            'staf_gudang' => 'Staf Gudang',
            'owner' => 'Owner'
        ];

        foreach ($roles as $roleKey => $roleName) {
            for ($i = 1; $i <= 2; $i++) {
                $firstName = $faker->firstName;
                $lastName = $faker->lastName;
                $email = strtolower($firstName . $lastName) . '@gmail.com';

                User::firstOrCreate(
                    ['email' => $email],
                    [
                        'name' => $firstName . ' ' . $lastName,
                        'role' => $roleKey,
                        'password' => $password,
                    ]
                );
            }
        }
    }
}
