<?php

namespace App\Http\Requests;

use App\Rules\alpha_spaces;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', new alpha_spaces, 'min:3', 'max:255','unique:permissions,name,'.$this->permission->id],
        ];
    }
}
