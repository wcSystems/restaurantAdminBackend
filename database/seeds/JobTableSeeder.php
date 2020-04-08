<?php

use Illuminate\Database\Seeder;

class JobTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Job::class)->create(['name' => 'Gerente']);
        factory(App\Job::class)->create(['name' => 'Chef']);
        factory(App\Job::class)->create(['name' => 'Mesonero(a)']);
        factory(App\Job::class)->create(['name' => 'Barman']);
        factory(App\Job::class)->create(['name' => 'Cajero(a)']);
    }
}
