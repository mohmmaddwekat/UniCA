<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      $users = [
         [
            'name' => 'super-admin',
            'email' => 'super-admin@gmail.com',
            'type_username_id' => '123456789',
            'password' => Hash::make('123456789'),
            'addBy_id' => '0',
            'remember_token' => Str::random(10),
         ],

         [
            'name' => 'university',
            'email' => 'university@gmail.com',
            'type_username_id' => '852741963',
            'password' => Hash::make('123456789'),
            'addBy_id' => '1',
            'remember_token' => Str::random(10),
         ],
         [
            'name' => 'headDepartment',
            'email' => 'headDepartment@gmail.com',
            'type_username_id' => '123123123',
            'password' => Hash::make('123456789'),
            'addBy_id' => '2',
            'remember_token' => Str::random(10),
         ],
         [
            'name' => 'headDepartment2',
            'email' => 'headDepartment2@gmail.com',
            'type_username_id' => '456456456',
            'password' => Hash::make('123456789'),
            'addBy_id' => '2',
            'remember_token' => Str::random(10),
         ],
         [
            'name' => "student",
            'email' => 'student@gmail.com',
            'type_username_id' => '741741741',
            'password' => Hash::make('123456789'),
            'addBy_id' => '3',
            'remember_token' => Str::random(10),
         ],
         [
            'name' => "student2",
            'email' => 'student2@gmail.com',
            'type_username_id' => '852852852',
            'password' => Hash::make('123456789'),
            'addBy_id' => '3',
            'remember_token' => Str::random(10),
         ],
         [
            'name' => "student3",
            'email' => 'student3@gmail.com',
            'type_username_id' => '963963963',
            'password' => Hash::make('123456789'),
            'addBy_id' => '3',
            'remember_token' => Str::random(10),
         ],
         [
            'name' => "student4",
            'email' => 'student4@gmail.com',
            'type_username_id' => '741852963',
            'password' => Hash::make('123456789'),
            'addBy_id' => '4',
            'remember_token' => Str::random(10),
         ],
      ];
      foreach ($users as $user) {
         User::create($user);
      }
   }
}
