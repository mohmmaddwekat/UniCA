<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'year' => ['required', 'between:1,7'],
            'semester' => ['required', 'between:1,2'],
            'head_of_department' => 'min:3', 'max:255',
        ]);
        $courses = $request->course;
        $data = [];
        foreach ($courses as $key => $status) {
            $value =  [
                'course_id' => $key,
                'status' => $status,
                'student_id' => Auth::id(),
            ];
            array_push($data, $value);
        }
        DB::table('course_student')->insert($data);
        return redirect()->route('dashboard.index')->with('success', __('Add success'));
    }

}
