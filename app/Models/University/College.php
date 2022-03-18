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
        ];
        public function departments()
        {
                return $this->hasMany(Department::class);
        }
        public function user()
        {
                return $this->belongsTo(User::class, 'university_id');
        }
}
