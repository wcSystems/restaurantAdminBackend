<?php

use Illuminate\Database\Seeder;

class PaymentMethodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\PaymentMethod::class)->create(['name' => 'Tarjeta Débito']);
        factory(App\PaymentMethod::class)->create(['name' => 'Tarjeta Crédito']);
        factory(App\PaymentMethod::class)->create(['name' => 'Transferencia']);
        factory(App\PaymentMethod::class)->create(['name' => 'Pago Móvil']);
        factory(App\PaymentMethod::class)->create(['name' => 'Criptomonedas']);
        factory(App\PaymentMethod::class)->create(['name' => 'PayPall']);
    }
}
