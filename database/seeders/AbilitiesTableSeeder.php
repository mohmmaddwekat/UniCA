<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AbilitiesTableSeeder extends Seeder
{
     protected $abilities = [
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
        foreach($this->abilities as $code=>$name){
            DB::table('abilities')->insert([
            'code'=> $code,
            'name'=> $name,
        ]);
        }
    }
}
