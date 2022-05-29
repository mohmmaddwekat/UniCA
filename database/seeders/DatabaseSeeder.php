<?php

namespace Database\Seeders;

use App\Models\Admin\Course;
use App\Models\Complaint\ComplaintsForm;
use App\Models\Roles\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //  \App\Models\User::factory(1)->create();
        //Course::factory(17)->create();

        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,

            CitySeeder::class,
            UniversitySeeder::class,
            DepartmentSeeder::class,
            UserSeeder::class,
            CollegeSeeder::class,
            
            ComplaintsFormSeeder::class,
   
        ]);
    }
}
