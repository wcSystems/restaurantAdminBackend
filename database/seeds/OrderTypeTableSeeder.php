<?php

use Illuminate\Database\Seeder;

class OrderTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\OrderType::class)->create(['name' => 'Local']);
        factory(App\OrderType::class)->create(['name' => 'Internet']);
        factory(App\OrderType::class)->create(['name' => 'Para llevar']);
    }
}
