<?php

namespace Database\Seeders;

use App\Models\Bid;
use App\Models\Problem;
use Illuminate\Database\Seeder;

class BidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Problem::all()->each(function($problem) {
            $problem->bids()->saveMany(Bid::factory(5)->make());
        });
    }
}
