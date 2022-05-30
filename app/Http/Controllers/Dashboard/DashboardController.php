<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Controller;
use App\Models\Admin\Course;
use App\Models\Complaint\ComplaintsForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $statisticOne = 0;
        $statisticTwo = 0;
        $statisticThree = 0;
        $statisticFour = 0;
        if ($user->type == 'student') {
            $statisticOne = $user->coursesStudent()->where('status', '=', 'Fail')->get()->count();
            $statisticTwo = $user->coursesStudent()->where('status', '=', 'Success')->get()->count();
            $statisticThree = $user->coursesStudent()->where('status', '!=', 'Fail')->where('status', '!=', 'Success')->get()->count();
            $statisticFour = $user->complaint->count();
            $complaintsForm = ComplaintsForm::where('user_id', Auth::id())->get();
            $this->dashboardTemplate('index', __('Dashboard'), [
                'user' => $user,
                'statisticOne' => $statisticOne,
                'statisticTwo' => $statisticTwo,
                'statisticThree' => $statisticThree,
                'statisticFour' => $statisticFour,
                'complaintsForms' =>$complaintsForm,
            ]);
        } elseif (Auth::user()->type == 'headDepartment') {
            $statisticOne = $user->complaintHeadDepartment->count();
            $statisticOne = $user->complaintHeadDepartment->count();
            $this->dashboardTemplate('index', __('Dashboard'),[
                'user' => $user,
                'statisticOne' => $statisticOne,
            ]);
        }
        
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
