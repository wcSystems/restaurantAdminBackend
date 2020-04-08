<?php

use Illuminate\Database\Seeder;

class CategoryProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\CategoryProduct::class)->create(['name' => 'Viveres']);
        factory(App\CategoryProduct::class)->create(['name' => 'Granos']);
        factory(App\CategoryProduct::class)->create(['name' => 'Desechables']);
        factory(App\CategoryProduct::class)->create(['name' => 'Licor']);
        factory(App\CategoryProduct::class)->create(['name' => 'Bebidas']);
        factory(App\CategoryProduct::class)->create(['name' => 'Panaderia']);
        factory(App\CategoryProduct::class)->create(['name' => 'Vegetales']);
        factory(App\CategoryProduct::class)->create(['name' => 'Frutas']);
        factory(App\CategoryProduct::class)->create(['name' => 'Lacteos']);
        factory(App\CategoryProduct::class)->create(['name' => 'Subrecetas']);
        factory(App\CategoryProduct::class)->create(['name' => 'Pastas']);
        factory(App\CategoryProduct::class)->create(['name' => 'Proteina']);
        factory(App\CategoryProduct::class)->create(['name' => 'Dulces']);
        factory(App\CategoryProduct::class)->create(['name' => 'Aderesos']);
    }
}
