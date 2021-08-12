<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Problem;
use Illuminate\Database\Seeder;

class ProblemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::all()->each(function($order) {
            $order->problem()->save(Problem::factory()->make());
        });
    }
}
