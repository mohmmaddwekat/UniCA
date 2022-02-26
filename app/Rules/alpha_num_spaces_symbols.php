<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class alpha_num_spaces_symbols implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
         if (preg_match("/^[أ-يa-zA-Z0-9 -_@'.:?“”]*$/", $value)) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.alpha_num_spaces_symbols');
    }
}
