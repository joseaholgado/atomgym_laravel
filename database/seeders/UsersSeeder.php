<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12341234'),
            'foto' => null,
            'roles' => 'admin',
        ]);

        // Create some other users
        foreach (range(1, 10) as $index) {
            User::create([
                'name' => 'User' . $index,
                'last_name' => 'LastName' . $index,
                'email' => 'user' . $index . '@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('12341234'),
                'foto' => null,
                'roles' => 'user',
            ]);
        }
    }
}
