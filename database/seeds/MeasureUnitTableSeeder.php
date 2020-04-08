<?php

use Illuminate\Database\Seeder;

class MeasureUnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\MeasureUnit::class)->create(['name' => 'GR']);
        factory(App\MeasureUnit::class)->create(['name' => 'ML']);
        factory(App\MeasureUnit::class)->create(['name' => 'OZ']);
        factory(App\MeasureUnit::class)->create(['name' => 'UND']);
    }
}
