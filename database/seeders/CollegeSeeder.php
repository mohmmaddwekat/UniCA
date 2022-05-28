<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\University\College;

class CollegeSeeder extends Seeder
{
   
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colleges = [
            [
                'name' => 'it',
                'college_number' => '11',
                'university_id' => '1',
                'user_id' => '3',
            ],
            [
                'name' => 'art',
                'college_number' => '08',
                'university_id' => '1',
                'user_id' => '4',
            ],
    
        ];

        foreach ($colleges as $college) {
            College::create($college);
        }
    }
}
