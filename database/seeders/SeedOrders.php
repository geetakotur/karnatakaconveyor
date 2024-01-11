<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Customer\User as CustomerUser;
use App\Models\Customer\Order;
use App\Models\Mgmt\Conveyor;

class SeedOrders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::factory()->count(5)->create()->each(function($order){
            // print_r($order);
            $order->customer_id = CustomerUser::where('username', 'customer')->first()->id;
            $order->model_id = Conveyor::inRandomOrder()->first()->id;
            $order->save();
        });

        Order::factory()->count(10)->create()->each(function($order){
            // print_r($order);
            $order->customer_id = CustomerUser::inRandomOrder()->first()->id;
            $order->model_id = Conveyor::inRandomOrder()->first()->id;
            $order->save();
        });
        
        Order::factory()->count(10)->create()->each(function($order){
            // print_r($order);
            $order->customer_id = CustomerUser::inRandomOrder()->first()->id;
            $order->model_id = Conveyor::inRandomOrder()->first()->id;
            $order->save();
        });
    }
}
