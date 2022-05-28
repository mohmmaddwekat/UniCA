<?php

namespace Database\Seeders;

use App\Models\University\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 
        $departments = [
            [
                'name'=>'cap',
                'college_id'=>'1',
                'user_id'=>'5',
            ],
            [
                'name'=>'paint',
                'college_id'=>'2',
                'user_id'=>'6',
            ],
            [
                'name'=>'cs',
                'college_id'=>'1',
                'user_id'=>'10',
            ],
        ];
        foreach ($departments as $departments) {
            Department::create($departments);
        }
    }
}
