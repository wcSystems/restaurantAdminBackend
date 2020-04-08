<?php

use Illuminate\Database\Seeder;

class FixedCostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\FixedCost::class)->create([
            'name' => 'Alquiler',
            'cost_value' => 500
        ]);
        factory(App\FixedCost::class)->create([
            'name' => 'Energético',
            'cost_value' => 180
        ]);
        factory(App\FixedCost::class)->create([
            'name' => 'Gas',
            'cost_value' => 50
        ]);
        factory(App\FixedCost::class)->create([
            'name' => 'Agua',
            'cost_value' => 30
        ]);
        factory(App\FixedCost::class)->create([
            'name' => 'Otros',
            'cost_value' => 200
        ]);
        factory(App\FixedCost::class)->create([
            'name' => 'Dias Laborables',
            'cost_value' => 24
        ]);
    }
}
