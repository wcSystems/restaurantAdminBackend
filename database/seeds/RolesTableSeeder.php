<?php

use Illuminate\Database\Seeder;
use App\Role;
use Illuminate\Support\Carbon;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Role::class)->create(['name' => 'Sistemas']);
        factory(App\Role::class)->create(['name' => 'Administrador']);
        factory(App\Role::class)->create(['name' => 'Caja']);
        factory(App\Role::class)->create(['name' => 'Chef']);
    }
}
