<?php

namespace App\Models\Admin;

use App\Models\University\College;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address',
        'phone_number',
        'password',
        'city_id',
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

    // Inverse of One-to-Many (University belongs to only one user)
    public function user()
    {
        return $this->belongsTo(
            User::class,    // Related Model 
            'user_id',      // FK for the related in the current model
            'id'                // PK in the related model
        )->withDefault([
            'name' => 'NULL'
        ]);
    }
    
}
