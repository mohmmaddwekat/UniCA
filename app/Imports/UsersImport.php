<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new User([
            'name' => $row['name'],
            'type_username_id' => $row['type_username_id'],
            'email' => $row['email'],
            'type' => 'student',
            'password' => Hash::make('123456789'),
            'addBy_id' => auth()->id(),
        ]);
    }
}
