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
        // if ($user->type == 'student') {
        //     $this->dashboardTemplate('student', __('Student Dashboard'), ['student' => $user]);
        // } else {
            $this->dashboardTemplate('index', __('Dashboard'), ['user' => $user]);
        // }
    }
    public function yearCourse($year)
    {
        $track = Course::where([['year', '=', $year], ['track', '!=', null]])->get(['track']);
        return $track;
    }

    public function changeCourse($year, $semester, $track)
    {
        if ($year > 1) {
            if ($semester === 1) {
                $semester = 2;
            } elseif ($semester === 2) {
                $semester = 3;
            }
        }
        if ($track != 0) {
            $coursesThisYear = Course::Where([['year', '<', $year], ['track', '=', null]])->get(['year', 'semester', 'name', 'id', 'prerequisite', 'track'])->toArray();
            $coursesAfterYear = Course::where([['year', '=', $year], ['semester', '<=', $semester], ['track', '=', null]])->get(['year', 'semester', 'name', 'id', 'prerequisite', 'track'])->toArray();
            array_push($coursesThisYear, ...$coursesAfterYear);
        } else {
            $coursesThisYear = Course::Where([['year', '<', $year], ['track', '=', null]])->get(['year', 'semester', 'name', 'id', 'prerequisite', 'track'])->toArray();
            $coursesAfterYear = Course::where([['year', '=', $year], ['semester', '<=', $semester], ['track', '=', null]])->get(['year', 'semester', 'name', 'id', 'prerequisite', 'track'])->toArray();
            array_push($coursesThisYear, ...$coursesAfterYear);
        }
        return $coursesThisYear;
    }
}
