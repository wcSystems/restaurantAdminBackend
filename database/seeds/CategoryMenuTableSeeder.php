<?php

use Illuminate\Database\Seeder;

class CategoryMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\CategoryMenu::class)->create([
            'name' => 'Entradas',
            'image' => 'uploads/img/categories_menu/1_entrada.jpg',
            'description' => 'Entradas',
            'category_menu_id' => NULL,
        ]);
        factory(App\CategoryMenu::class)->create([
            'name' => 'Ensaladas',
            'image' => 'uploads/img/categories_menu/2_ensalada.jpg',
            'description' => 'Ensaladas',
            'category_menu_id' => NULL,
        ]);
        factory(App\CategoryMenu::class)->create([
            'name' => 'Sandwiches',
            'image' => 'uploads/img/categories_menu/3_sandwich.jpg',
            'description' => 'Sandwiches',
            'category_menu_id' => NULL,
        ]);
        factory(App\CategoryMenu::class)->create([
            'name' => 'Hamburguesas',
            'image' => 'uploads/img/categories_menu/4_hamburguesas.jpg',
            'description' => 'Hamburguesas',
            'category_menu_id' => NULL,
        ]);
        factory(App\CategoryMenu::class)->create([
            'name' => 'Postres',
            'image' => 'uploads/img/categories_menu/5_desserts.jpg',
            'description' => 'Postres',
            'category_menu_id' => NULL,
        ]);
        factory(App\CategoryMenu::class)->create([
            'name' => 'Bebidas',
            'image' => 'uploads/img/categories_menu/6_drinks.jpg',
            'description' => 'Bebidas',
            'category_menu_id' => NULL,
        ]);
        factory(App\CategoryMenu::class)->create([
            'name' => 'Pies',
            'image' => 'uploads/img/categories_menu/1_desserts.jpg',
            'description' => 'Pies',
            'category_menu_id' => 5,
        ]);
        factory(App\CategoryMenu::class)->create([
            'name' => 'Brownies',
            'image' => 'uploads/img/categories_menu/2_desserts.jpg',
            'description' => 'Brownies',
            'category_menu_id' => 5,
        ]);
        factory(App\CategoryMenu::class)->create([
            'name' => 'Tortas',
            'image' => 'uploads/img/categories_menu/3_desserts.jpg',
            'description' => 'Tortas',
            'category_menu_id' => 5,
        ]);
        factory(App\CategoryMenu::class)->create([
            'name' => 'Cheese cake',
            'image' => 'uploads/img/categories_menu/4_desserts.jpg',
            'description' => 'Cheese cake',
            'category_menu_id' => 5,
        ]);
        factory(App\CategoryMenu::class)->create([
            'name' => 'Varios',
            'image' => 'uploads/img/categories_menu/6_desserts.jpg',
            'description' => 'Varios',
            'category_menu_id' => 5,
        ]);
        factory(App\CategoryMenu::class)->create([
            'name' => 'Toppings',
            'image' => 'uploads/img/categories_menu/7_desserts.jpg',
            'description' => 'Toppings',
            'category_menu_id' => 5,
        ]);
        factory(App\CategoryMenu::class)->create([
            'name' => 'Jugos naturales',
            'image' => 'uploads/img/categories_menu/3_drinks.jpg',
            'description' => 'Jugos naturales',
            'category_menu_id' => 6,
        ]);
        factory(App\CategoryMenu::class)->create([
            'name' => 'Smoothie',
            'image' => 'uploads/img/categories_menu/1_drinks.jpg',
            'description' => 'Smoothie',
            'category_menu_id' => 6,
        ]);
        factory(App\CategoryMenu::class)->create([
            'name' => 'Refrescos',
            'image' => 'uploads/img/categories_menu/6_drinks.jpg',
            'description' => 'Refrescos',
            'category_menu_id' => 6,
        ]);
        factory(App\CategoryMenu::class)->create([
            'name' => 'Café',
            'image' => 'uploads/img/categories_menu/2_drinks.jpg',
            'description' => 'Café',
            'category_menu_id' => 6,
        ]);
    }
}
