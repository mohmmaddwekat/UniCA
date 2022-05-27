<?php

namespace App\Imports;

use App\Models\Admin\Course;
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
        return new Course([
            'id' => $row['id'],
            'name' => $row['name'],
            'track' => $row['track'] === "NULL" ? null : $row['track'],
            'year' => $row['year'],
            'semester' => $row['semester'],
            'headDepartment_id' => auth()->id(),
            'prerequisite' => $row['prerequisite'],
        ]);
    }
}
