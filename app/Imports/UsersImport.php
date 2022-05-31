<?php

namespace App\Imports;

use App\Mail\UserMail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Spatie\Permission\Models\Role;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        $user = User::where('key', '=', auth()->user()->key)->where('type_username_id', '=', $row['type_username_id'])->where('email', '=', $row['email'])->get();
        if (count($user) == 0) {

            $user =  new User([
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
            Role::findOrCreate('student');
            $user->assignRole('student');

            $details = [
                'title' => 'User reminder',
                'name' => 'head of the department',
                'body' => 'Your account has been added to our site, log in and change your password from our site.',
                'btn' => "UniCA",
            ];
            Mail::to($row['email'])->send(new UserMail($details));
            return $user;
        }
    }
}
