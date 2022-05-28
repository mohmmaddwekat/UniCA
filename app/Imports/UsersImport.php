<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
            'name' => $row['name'],
            'type_username_id' => $row['type_username_id'],
            'email' => $row['email'],
            'type' => 'student',
            'password' => Hash::make(Str::random(8)),
            'addBy_id' => auth()->id(),
        ]);
    }
}
