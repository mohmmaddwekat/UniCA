<?php

namespace App\Models\University;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'roles';
      
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
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function users(){
            return $this->hasMany(User::class,'role_id','id');    
    }
    public function abilities(){
            return $this->belongsToMany(Ability::class,'ability_role','role_id');    
    }
}
