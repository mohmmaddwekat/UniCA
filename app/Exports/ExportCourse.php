<?php

namespace App\Exports;

use App\Models\Admin\Course;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportCourse implements FromCollection ,WithHeadings
{
    public function headings(): array {
        return [
            "id","name","track","year","semester","headDepartment_id","prerequisite",
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect();
    }
}
