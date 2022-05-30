<?php

namespace App\Imports;

use App\Mail\UserMail;
use App\Models\User;
use App\Rules\alpha_spaces;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $type_username_id = $row['type_username_id'];
        $key = auth()->user()->key;


        $validator = Validator::make($row, [

            'type_username_id' => [
                'required',
                'digits:8',
                Rule::exists('users')->where(function ($query) use ($type_username_id,$key) {
                    $query->where([['type_username_id',$type_username_id],['key',$key]]);
                }),

            ],
            'name' => ['required', 'max:250', 'min:3', 'unique:users,name', new alpha_spaces],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            ],
        );
        $validator->validate();
        $user=User::where("type_username_id", $type_username_id)->where("key", $key)->first();
        if ($user == null) {

        return new User([
            'key' => auth()->user()->key,
            'department_id' => auth()->user()->department_id,
            'name' => $row['name'],
            'type_username_id' => $row['type_username_id'],
            'email' => $row['email'],
            'type' => 'student',
            'role_id' => "4",
            'password' => Hash::make(Str::random(8)),
            'addBy_id' => auth()->id(),
        ]);
        // Role::findOrCreate('student');
        // $user->assignRole('student');
        
        $details = [
            'title' => 'User reminder',
            'name' => 'head of the department',
            'body' => 'Your account has been added to our site, log in and change your password from our site.',
            'btn' => "UniCA",
        ];
        Mail::to($row['email'])->send(new UserMail($details));
    }
    }
}
