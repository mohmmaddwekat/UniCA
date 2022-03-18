<?php

namespace Database\Seeders;

use App\Models\Admin\University;
use Illuminate\Database\Seeder;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $universities = [
            [
                'user_id' =>'2',
                'city_id' => '1',
                'address' =>'nablus',
                'phone_number' => '0512346578',

             ],

            ];
            foreach($universities as $university){
                University::create($university);
            }
    

        //
    }
}
