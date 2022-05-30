<?php

namespace App\Models\University;

use App\Models\Admin\University;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class College extends Model
{
        use HasFactory;
        protected $table = 'colleges';

        /**
         * The primary key associated with the table.
         *
         * @var string
         */
        protected $primaryKey = 'id';

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
                'name',
                'college_number',
                'id'
        ];


        // Inverse of One-to-Many (College belongs to only one University)
        public function university()
        {
                return $this->belongsTo(
                        University::class,    // Related Model 
                        'university_id',      // FK for the related in the current model
                        'id'                // PK in the related model
                );
        }

        public function departments()
        {
                return $this->hasMany(
                        Department::class,    // Related Moadel
                        'college_id',  // FK in the related model
                        'id'            // PK in the current model
                );
        }

        public function user()
        {
                return $this->belongsTo(
                        User::class,    // Related Model 
                        'user_id',      // FK for the related in the current model
                        'id'                // PK in the related model
                );
        }
}
