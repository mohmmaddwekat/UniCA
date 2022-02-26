<?php

namespace Database\Seeders;

use App\Models\Admin\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $cities = [
            'نابلس',
            'طولكرم',
            'قلقيلية',
            'الخليل',
            'اريحا',
            'رام الله والبيرة',
            'سلفيت',
            'طوباس',
            'بيت لحم',
            'جنين',
            'غزه'
           ];
           foreach($cities as $city){
               City::insert([
                   'name' => $city,
               ]);
           }
    }
}
