<?php

namespace App\Models\University;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
        use HasFactory;
        protected $table = 'departments';

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
                'college',
                'head_of_department',
        ];
        public function college()
        {
                return $this->belongsTo(College::class);
        }
        public function user()
        {
                return $this->belongsTo(User::class);
        }
}
