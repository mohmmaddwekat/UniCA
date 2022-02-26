<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_name',
        'address',
        'phone_number',
        'password',
        'city_id',
        'university_id',
    ];


        // Inverse of One-to-Many (University belongs to only one city)
        public function city()
        {
            return $this->belongsTo(
                City::class,    // Related Model 
                'city_id',      // FK for the related in the current model
                'id'                // PK in the related model
            )->withDefault([
                'name' => 'NULL'
            ]);
        }
}
