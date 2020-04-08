<?php

use Illuminate\Database\Seeder;

class StatusOrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\StatusOrder::class)->create(['name' => 'Abierta']);
        factory(App\StatusOrder::class)->create(['name' => 'Cerrada']);
        factory(App\StatusOrder::class)->create(['name' => 'Procesada']);
        factory(App\StatusOrder::class)->create(['name' => 'En proceso']);
        factory(App\StatusOrder::class)->create(['name' => 'Depachada']);
    }
}
