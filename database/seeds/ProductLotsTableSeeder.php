<?php

use Illuminate\Database\Seeder;

class ProductLotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\ProductLot::class,110)->create();
    }
}
