<?php

use Illuminate\Database\Seeder;

class PriceRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $priceRequests = factory('App\PriceRequest', 25)->create();
    }
}
