<?php

namespace App\Http\Controllers\HeadDepartment;

use App\Exports\ExportCourse;
use App\Exports\ExportUser;
use App\Imports\CourseImport;
use Illuminate\Http\Request;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ExcelControler extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Collection
     */
    public function showImportStudent(Request $request)
    {
        $this->departmentTemplate('csvStudent','CSV student');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Collection
     */
    public function showImportCourse(Request $request)
    {
        $this->departmentTemplate('csvCourse','CSV Course');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Collection
     */
    public function importCourse(Request $request)
    {
        // dd(request()->file('file'));
        $request->validate([
            'file' => 'required|file|mimes:csv,txt',
        ]);
        Excel::import(new CourseImport, request()->file('file'));
        return redirect()->route('dashboard.index');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Collection
     */
    public function importStudent(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv',
        ]);
        Excel::import(new UsersImport, request()->file('file'));
        return redirect()->route('dashboard.index');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function exportCoure()
    {
        return Excel::download(new ExportCourse, 'courses.csv');
        return back();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function exportStudent()
    {
        return Excel::download(new ExportUser, 'users.csv');
        return back();
    }
}
