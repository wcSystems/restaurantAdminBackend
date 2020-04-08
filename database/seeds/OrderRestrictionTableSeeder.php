<?php

use Illuminate\Database\Seeder;

class OrderRestrictionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\OrderRestriction::class)->create(['name' => 'Ninguna']);
        factory(App\OrderRestriction::class)->create(['name' => 'Sólo online']);
        factory(App\OrderRestriction::class)->create(['name' => 'Sólo resturant']);
    }
}
