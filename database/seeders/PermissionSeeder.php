<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    protected $permissions = [
        'university.role.index'=>'List',
        'university.role.add'=>'Create',
        'university.role.edit'=>'Edit',
        'university.role.delete'=>'Delete',
        'university.department.index'=>'List',
        'university.department.add'=>'Create',
        'university.department.edit'=>'Edit',
        'university.department.delete'=>'Delete',
        'university.college.index'=>'List',
        'university.college.add'=>'Create',
        'university.college.edit'=>'Edit',
        'university.college.delete'=>'Delete',
    ];
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
       //
       foreach($this->permissions as $code=>$name){
           DB::table('permissions')->insert([
           'code'=> $code,
           'name'=> $name,
       ]);
       }
   }
}
