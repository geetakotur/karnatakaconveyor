<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// Dummy Seeders
// use Dummy\SeedConveyors;
// use Dummy\SeedCustomer;
// use Dummy\SeedPurchases;
// use Dummy\SeedPurchaseMaintainance;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $isDev = config('app.env') == 'local';
        // echo(config('app.env'));
        // $isDev = false; //override

        if($isDev){
            // Testing
            echo('**************************'  . PHP_EOL);
            echo('***** App in Testing *****'  . PHP_EOL);
            echo('**************************'  . PHP_EOL);

            $this->call([
                SeedUsers::class,                   // Seed Mgmt Users

                SeedConveyors::class,                // 1 Seed Dummy Machines
                SeedCustomer::class,                // 2 Seed Dummy Customers
                SeedEmployees::class,                // 2 Seed Dummy Customers
                SeedOrders::class,               // 3 Seed Dummy Customer Purchase
             ]);

        }else{
            // Production
            echo('*****************************'  . PHP_EOL);
            echo('***** App in Production *****'  . PHP_EOL);
            echo('*****************************'  . PHP_EOL);

            $this->call([
                SeedUsers::class,                   // Seed Mgmt Users

            ]);
        }
    }
}
