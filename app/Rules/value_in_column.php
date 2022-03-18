<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class value_in_column implements Rule
{
    private  $table_name;
    private  $col_name;
    private  $value;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($table_name, $col_name, $value)
    {
        //
        $this->table_name = $table_name;
        $this->col_name = $col_name;
        $this->value = $value;
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
        if ($this->value != null) {
            if (Schema::hasTable($this->table_name)) {
                $item = DB::table($this->table_name)->where($this->col_name, '=', $this->value);
                if ($item == null) {
                    return false;
                } else {
                    return true;
                }
            } else {
                return false;
            }
        } else {
            $this->value = $value;
            if (Schema::hasTable($this->table_name)) {
                $item = DB::table($this->table_name)->where($this->col_name, '=', $this->value);
                if ($item == null) {
                    return false;
                } else {
                    return true;
                }
            } else {
                return false;
            }
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
