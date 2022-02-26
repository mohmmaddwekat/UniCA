<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

        // One-to-Many (city has many university)
        public function university()
        {
            return $this->hasMany(
                University::class,    // Related Moadel
                'city_id',  // FK in the related model
                'id'            // PK in the current model
            );
        }
}
