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
                'phone_number' => '0512346888',
             ],
             [
                'user_id' =>'3',
                'city_id' => '6',
                'address' =>'rammallh',
                'phone_number' => '0512346588',
             ],
            ];
            foreach($universities as $university){
                University::create($university);
            }
    

        //
    }
}
