<?php

namespace App\Imports;

use App\Models\Admin\Course;
use App\Models\User;
use \Maatwebsite\Excel\Concerns\ToModel;
use \Maatwebsite\Excel\Concerns\WithHeadingRow;

class CourseImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $user = User::where('id', '=', auth()->id())->first();
        // dd($user->department->id);
        return new Course([
            'id' => $row['id'],
            'name' => $row['name'],
            'track' => $row['track'] === "NULL" ? null : $row['track'],
            'year' => $row['year'],
            'semester' => $row['semester'],
            'headDepartment_id' => auth()->id(),
            'department_id' => $user->department->id,
            'prerequisite' => $row['prerequisite'],
        ]);
    }
}
