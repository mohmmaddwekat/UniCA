<?php

namespace App\Models;

use App\Models\Admin\Course;
use App\Models\Admin\University;
use App\Models\Complaint\ComplaintsForm;
use App\Models\Roles\Role;
use App\Models\University\College;
use App\Models\University\Department;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type_username_id',
        'email',
        'type',
        'password',
        'addBy_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // One-to-Many (user has many university)
    public function university()
    {
        return $this->hasMany(
            University::class,    // Related Moadel
            'user_id',  // FK in the related model
            'id'            // PK in the current model
        );
    }

    // One-to-Many (user has many Complaint)
    public function complaint()
    {
        return $this->hasMany(
            ComplaintsForm::class,    // Related Moadel
            'user_id',  // FK in the related model
            'id'            // PK in the current model
        );
    }
    public function complaintHeadDepartment()
    {
        return $this->hasMany(
            ComplaintsForm::class,    // Related Moadel
            'headDepartment_id',  // FK in the related model
            'id'            // PK in the current model
        );
    }
    public function coursesStudent()
    {
        return $this->belongsToMany(Course::class, 'course_student', 'student_id');
    }
    public function courses()
    {
        return $this->hasMany(Course::class,'headDepartment_id');
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function colleges()
    {
        return $this->hasMany(
            College::class,    // Related Moadel
            'user_id',  // FK in the related model
            'id'            // PK in the current model
        );
    }
    public function collegesofUniversity()
    {
        return $this->hasMany(
            College::class,    // Related Moadel
            'university_id',  // FK in the related model
            'id'            // PK in the current model
        );
    }
}
