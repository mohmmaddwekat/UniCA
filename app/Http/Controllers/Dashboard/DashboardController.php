<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Controller;
use App\Models\Admin\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // dd($user->courses != null);
        if ($user->type == 'student') {
            $this->dashboardTemplate('student', __('Student Dashboard'), ['student' => $user]);
        }
        $this->dashboardTemplate('index', __('Dashboard'), ['user' => $user]);
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
