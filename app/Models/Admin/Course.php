<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    public function users()
    {
        return $this->belongsToMany(User::class, 'course_student', 'student_id');
    }
    public function suggestions()
    {
        return $this->belongsTo(Suggestion::class);
    }
}
