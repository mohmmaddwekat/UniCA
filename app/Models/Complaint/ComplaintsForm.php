<?php

namespace App\Models\Complaint;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintsForm extends Model
{
    use HasFactory;

        // Inverse of One-to-Many (Complaint belongs to only one user)
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
