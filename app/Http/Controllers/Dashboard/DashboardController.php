<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Controller;
use App\Models\Admin\Course;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $this->dashboardTemplate('index', __('Dashboard'));
    }

    public function changeCourse($year, $semester)
    {
        $courses = Course::where('year', '<=', $year)->get(['year', 'semester', 'name', 'id', 'prerequisite'])->toArray();
        $data = [];
        foreach ($courses as $course) {

            if ($course['year'] != $year) {
                array_push($data, $course);
            }
            if ($course['year'] == $year && $course['semester'] == $semester) {
                array_push($data, $course);
            }
        }
        return $data;
    }
}
