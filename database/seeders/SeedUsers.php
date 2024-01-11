<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Mgmt\User;

class SeedUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',

            // Auth
            'username' => 'admin',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        // Dummy Customer Users
        // User::factory()->count(2)->create();
    }
}
