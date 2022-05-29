<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

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
                'key' => '000',
                'type_username_id' => '12345678',
                'name' => 'super-admin',
                'email' => 'super-admin@gmail.com',
                'type' => 'super-admin',
                'password' => Hash::make('123456789'),
                'addBy_id' => 'null',
                'department_id' => 'null',
                'remember_token' => Str::random(10),
            ],
            [
                'key' => '001',
                'type_username_id' => '12345688',
                'name' => 'najah',
                'email' => 'najah@gmail.com',
                'type' => 'university',
                'password' => Hash::make('123456789'),
                'addBy_id' => '1',
                'department_id' => 'null',
                'remember_token' => Str::random(10),
            ],

            [
                'key' => '001',
                'type_username_id' => '11112222',
                'name' => 'ali',
                'email' => 'ali_it_deanDepartment@gmail.com',
                'type' => 'deanDepartment',
                'password' => Hash::make('123456789'),
                'addBy_id' => '2',
                'department_id' => 'null',
                'remember_token' => Str::random(10),
            ],
            [
                'key' => '001',
                'type_username_id' => '11112223',
                'name' => 'sami',
                'email' => 'sami_art_deanDepartment@gmail.com',
                'type' => 'deanDepartment',
                'password' => Hash::make('123456789'),
                'addBy_id' => '2',
                'department_id' => 'null',
                'remember_token' => Str::random(10),
            ],
            [
                'key' => '001',
                'type_username_id' => '11112224',
                'name' => 'hamed',
                'email' => 'cap@gmail.com',
                'type' => 'headDepartment',
                'password' => Hash::make('123456789'),
                'addBy_id' => '2',
                'department_id' => '1',
                'remember_token' => Str::random(10),
            ],

            [
                'key' => '001',
                'type_username_id' => '11112225',
                'name' => 'sese',
                'email' => 'paint@gmail.com',
                'type' => 'headDepartment',
                'password' => Hash::make('123456789'),
                'addBy_id' => '2',
                'department_id' => '2',
                'remember_token' => Str::random(10),
            ],
            [
                'key' => '001',
                'type_username_id' => '11112226',
                'name' => "ben",
                'email' => 'ben@gmail.com',
                'type' => 'student',
                'password' => Hash::make('123456789'),
                'addBy_id' => '5',
                'department_id' => '1',
                'remember_token' => Str::random(10),
            ],
            [
                'key' => '001',
                'type_username_id' => '11112227',
                'name' => "abdelrahman",
                'email' => 'abdelrahman@gmail.com',
                'type' => 'student',
                'password' => Hash::make('123456789'),
                'addBy_id' => '5',
                'department_id' => '1',
                'remember_token' => Str::random(10),
            ],
            [
                'key' => '001',
                'type_username_id' => '11112228',
                'name' => "abood",
                'email' => 'abood@gmail.com',
                'type' => 'student',
                'password' => Hash::make('123456789'),
                'addBy_id' => '6',
                'department_id' => '2',
                'remember_token' => Str::random(10),
            ],
            [
                'key' => '001',
                'type_username_id' => '11112229',
                'name' => 'ahmad',
                'email' => 'cs@gmail.com',
                'type' => 'headDepartment',
                'password' => Hash::make('123456789'),
                'addBy_id' => '2',
                'department_id' => '1',
                'remember_token' => Str::random(10),
            ],
            [
                'key' => '001',
                'type_username_id' => '11112129',
                'name' => "rami",
                'email' => 'rami@gmail.com',
                'type' => 'student',
                'password' => Hash::make('123456789'),
                'addBy_id' => '10',
                'department_id' => '3',
                'remember_token' => Str::random(10),
            ],

            [
                'key' => '002',
                'type_username_id' => '12345888',
                'name' => 'berzent',
                'email' => 'berzent@gmail.com',
                'type' => 'university',
                'password' => Hash::make('123456789'),
                'addBy_id' => '1',
                'department_id' => 'null',
                'remember_token' => Str::random(10),
            ],


        ];
        foreach ($users as $user) {
            $newuser = User::create($user);
            switch ($newuser->type) {
                case "university":
                    $newuser->assignRole('university');
                    break;
                case "student":
                    $newuser->assignRole('student');
                    break;
                case "headDepartment":
                    $newuser->assignRole('headDepartment');
                    break;
                case "deanDepartment":
                    $newuser->assignRole('deanDepartment');
                    break;
                case "super-admin":
                    $newuser->assignRole('admin');
                    break;
            }
        }
    }
}
