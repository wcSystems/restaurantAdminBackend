<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call('FixedCostTableSeeder');
        $this->call('JobTableSeeder');
        $this->call('EmployeeTableSeeder');
        $this->call('RolesTableSeeder');
        $this->call('UsersTableSeeder');
        $this->call('MeasureUnitTableSeeder');
        $this->call('PaymentMethodTableSeeder');
        $this->call('CategoryProductTableSeeder');
        $this->call('OrderTypeTableSeeder');
        $this->call('CategoryMenuTableSeeder');
        $this->call('OrderRestrictionTableSeeder');
        $this->call('MealTimeTableSeeder');
        $this->call('StatusOrderTableSeeder');
        $this->call('ProductTableSeeder');

        factory(App\User::class, 10)->create();

        factory(App\Provider::class)->create([
            'name' => 'default'
        ]);
        factory(App\Provider::class, 20)->create();

        factory(App\PurchaseOrder::class, 50)->create()
            ->each(function ($purchase_order) {
                $number_detail = rand(1, 10);

                for ($i = 0; $i < $number_detail; $i++) {
                    factory(App\PurchaseOrderDetail::class)->create([
                        'product_id' => rand(1, 86),
                        'quantity' => rand(1, 20),
                        'price' => rand(2, 100),
                        'purchase_order_id' => $purchase_order->id
                    ]);
                }
            });

        factory(App\Customer::class, 50)->create();

        $no_tables = 10;
        for ($i = 1; $i <= $no_tables; $i++) {
            $table = factory(App\Table::class)->create([
                'name' => $i
            ]);
            $no_seats = rand(1, 8);
            for ($j = 1; $j <= $no_seats; $j++) {
                factory(App\Seat::class)->create([
                    'name' => $j,
                    'table_id' => $table->id
                ]);
            }
        }

        factory(App\Employee::class, 20)->create()
            ->each(function ($employee) {
                if ($employee->job_id == 3) {
                    $employee->tables()->attach($this->array(rand(1, 10), rand(1, 10)));
                }
            });

        $this->call('RestMenuTableSeeder');

        factory(App\SaleOrder::class, 100)->create()
            ->each(function ($sale_order) {
                $sale_order->tables()->attach(rand(1, 10));

                factory(App\Payment::class)->create();

                $number_detail = rand(1, 6);

                for ($i = 0; $i < $number_detail; $i++) {
                    factory(App\SaleOrderDetail::class)->create([
                        'rest_menu_id' => rand(1, 69),
                        'quantity' => rand(1, 2),
                        'price' => rand(2, 10),
                        'discount' => rand(0, 2),
                        'sale_order_id' => $sale_order->id
                    ]);
                }
            });
    }

    public function array($n1, $n2)
    {
        $values = [];

        if ($n1 < $n2) {
            $min = $n1;
            $max = $n2;
        } else {
            $min = $n2;
            $max = $n1;
        }

        for ($i = $min; $i <= $max; $i++) {
            $values[] = $i;
        }

        return $values;
    }
}
