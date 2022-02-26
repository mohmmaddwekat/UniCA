<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Schema;
class in_list implements Rule
{
     private  $table_name;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($table_name)
    {
        //
        $this->table_name =$table_name;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        if(Schema::hasTable($this->table_name)){
            $category = DB::table($this->table_name)->find($value);
            if ($category == null) {
            return false;
            } else {
                return true;
            }
        }else {
           return false; 
        }
         
       
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
       return trans('validation.in_list');
    }
}
