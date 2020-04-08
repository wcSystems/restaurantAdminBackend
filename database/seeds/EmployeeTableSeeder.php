<?php

use Illuminate\Database\Seeder;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Employee::class)->create([
            'firstname' => 'Katrina',
            'lastname' => 'Hagenes',
            'email' => 'ardith.frami@example.net',
            'phone' => '888.950.2811',
            'job_id' => 1,
            'employee_id' => NULL,
            'salary' => 500
        ]);

        factory(App\Employee::class)->create([
            'firstname' => 'Kameron',
            'lastname' => 'Crona',
            'email' => 'blanca58@example.net',
            'phone' => '1-844-483-2455',
            'job_id' => 2,
            'employee_id' => 1,
            'salary' => 500
        ]);

        factory(App\Employee::class)->create([
            'firstname' => 'Joyce',
            'lastname' => 'Senger',
            'email' => 'grimes.jeanette@example.net',
            'phone' => '1-888-684-0539',
            'job_id' => 3,
            'employee_id' => 1,
            'salary' => 500
        ]);

        factory(App\Employee::class)->create([
            'firstname' => 'Lera',
            'lastname' => 'Rutherford',
            'email' => 'funk.alana@example.net',
            'phone' => '844-270-3109',
            'job_id' => 4,
            'employee_id' => 1,
            'salary' => 500
        ]);

        factory(App\Employee::class)->create([
            'firstname' => 'Ceasar',
            'lastname' => 'Greenholt',
            'email' => 'tiana59@example.org',
            'phone' => '(866) 280-3379',
            'job_id' => 5,
            'employee_id' => 1,
            'salary' => 500
        ]);
    }
}
