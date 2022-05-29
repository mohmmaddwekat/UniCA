<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    protected $permissions = [
        "show course",
        "add course",
        "edit course",
        "delete course",
        "show universities",
        "add universities",
        "edit universities",
        "delete universities",
        "show cities",
        "add cities",
        "edit cities",
        "delete cities",
        "show users",
        "add users",
        "edit users",
        "delete users",
        "show roles",
        "add roles",
        "edit roles",
        "show permission",
        "add permission",
        "edit permission",
        "delete permission",
        "import course",
        "import student",
        "show department",
        "add department",
        "edit department",
        "delete department",
        "show college",
        "add college",
        "edit college",
        "delete college",
        "show form complaints",
        "add form complaints",
        "show details complaints",
        "add details complaints",
        "edit details complaints",
        "delete details complaints",
    ];
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
       //
       foreach($this->permissions as $name){
        Permission::create(['name' => $name]);
       }
   }
}
