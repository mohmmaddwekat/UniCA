<?php

namespace App\Imports;

use App\Models\Admin\Course;
use App\Models\User;
use App\Rules\alpha_spaces;
use \Maatwebsite\Excel\Concerns\ToModel;
use \Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;

class CourseImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        
 
        $course = Course::where('id','=',$row['id'])->where('name','=',$row['name'])->get();
        if (count($course) ==0) {
            return new Course([
                'id' => $row['id'],
                'name' => $row['name'],
                'track' => $row['track'] === "NULL" ? null : $row['track'],
                'year' => $row['year'],
                'semester' => $row['semester'],
                'headDepartment_id' => auth()->id(),
                'department_id' => auth()->user()->department_id,
                'prerequisite' => $row['prerequisite'],
            ]);
        }
        // $validator = Validator::make($row, [


        //     'name' => ['required', 'max:250', 'min:3', 'unique:courses,name'],
        //     ],
        // );
        // $validator->validate();

        
    }
}
