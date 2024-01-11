<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Customer\User as CustomerUser;
use Carbon\Carbon;

class SeedCustomer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Simple Customer
        CustomerUser::create([
            'first_name' => 'Customer',
            'last_name' => 'User',
            'email' => 'customer@example.com',
            'mobile' => '9876543210',
            'address' => '#Address',
            'city' => 'FakeCity',
            'state' => 'FakeState',
            'registerd_on' => Carbon::now(),

            // Auth
            'username' => 'customer',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        CustomerUser::factory()->count(10)->create();
    }
}
