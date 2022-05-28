<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        "id",
        "name",
        "track",
        "year",
        "semester",
        "headDepartment_id",
        "prerequisite",
        "department_id",
    ];

    public function student()
    {
        return $this->belongsToMany(User::class, 'course_student', 'student_id','student_id');
    }
    public function headDepartment()
    {
        return $this->belongsTo(User::class, 'headDepartment_id');
    }
    public function suggestions()
    {
        return $this->belongsTo(Suggestion::class);
    }
    public function departments()
    {
        return $this->hasMany(Course::class, 'department_id');
    }
}
