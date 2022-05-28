<?php

namespace App\Imports;

use App\Mail\UserMail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
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
        $detailsDeanDepartment = [
            'title' => 'User reminder',
            'name' => 'head of the department',
            'body' => 'this student he need to ..'
        ];
        Mail::to($row['email'])->send(new UserMail($detailsDeanDepartment));
    }
}
