<?php

use Illuminate\Database\Seeder;

class MealTimeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\MealTime::class)->create([
            'name' => 'Desayunos',
            'start_time' => '8:00 am',
            'end_time' => '11:00 am',
        ]);
        factory(App\MealTime::class)->create([
            'name' => 'Almuerzos',
            'start_time' => '11:00 am',
            'end_time' => '3:00 am',
        ]);
        factory(App\MealTime::class)->create([
            'name' => 'Cenas',
            'start_time' => '4:00 pm',
            'end_time' => '9:00 pm',
        ]);
    }
}
