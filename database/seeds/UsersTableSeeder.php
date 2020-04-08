<?php

use Illuminate\Database\Seeder;
use App\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create([
            'firstname' => 'Juan Carlos', 
            'lastname' => 'Guadama', 
            'username' => 'jcguadama', 
            'email' => 'juancarlos@novoples.net', 
            'img_profile' => 'uploads/img/users/jcguadama.jpg', 
            'password' => '$2y$10$dJNlL4bv0J5kGxuxMHfE5ezqUqb73yQ7t7fBSZTa2CEifswkmeHy.', 
            'role_id' => '1', 
            'master' => NULL, 
            'status' => '1'
        ]);

        factory(App\User::class)->create([
            'firstname' => 'Kellian', 
            'lastname' => 'Rea', 
            'username' => 'krea', 
            'email' => 'kellian@novoples.net', 
            'img_profile' => 'uploads/img/users/krea.png', 
            'password' => '$2y$10$dJNlL4bv0J5kGxuxMHfE5ezqUqb73yQ7t7fBSZTa2CEifswkmeHy.', 
            'role_id' => '1', 
            'master' => NULL, 
            'status' => '1'
        ]);
        
        factory(App\User::class)->create([
            'firstname' => 'Daniel', 
            'lastname' => 'Rea', 
            'username' => 'drea', 
            'email' => 'daniel@novoples.net', 
            'img_profile' => 'uploads/img/users/drea.jpg', 
            'password' => '$2y$10$dJNlL4bv0J5kGxuxMHfE5ezqUqb73yQ7t7fBSZTa2CEifswkmeHy.', 
            'role_id' => '1', 
            'master' => NULL, 
            'status' => '1'
        ]);
        
        factory(App\User::class)->create([
            'firstname' => 'Anthony', 
            'lastname' => 'Carriedo', 
            'username' => 'acarriedo', 
            'email' => 'anthony@novoples.net', 
            'img_profile' => 'uploads/img/users/acarriedo.png', 
            'password' => '$2y$10$dJNlL4bv0J5kGxuxMHfE5ezqUqb73yQ7t7fBSZTa2CEifswkmeHy.', 
            'role_id' => '1', 
            'master' => NULL, 
            'status' => '1'
        ]);
    }
}