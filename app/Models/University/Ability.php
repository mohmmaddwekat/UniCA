<?php

namespace App\Models\University;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    use HasFactory;
    
    public $timestamps = false;
  /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'abilities';
      
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
            'code',
            'name',
    ];

    public function roles(){
            return $this->belongsToMany(Role::class,'ability_role');    
    }
}
