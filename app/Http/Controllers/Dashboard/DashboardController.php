<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Controller;
use App\Models\Admin\Course;
use App\Models\Admin\University;
use App\Models\Complaint\ComplaintsForm;
use App\Models\University\College;
use App\Models\University\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
                'complaintsForms' => $complaintsForm,
            ]);
        } elseif (Auth::user()->type == 'headDepartment') {

            $statisticOne = $user->complaintHeadDepartment->count();
            $statisticOne = $user->complaintHeadDepartment->count();
            $this->dashboardTemplate('index', __('Dashboard'), [
                'user' => $user,
                'statisticOne' => $statisticOne,
            ]);
        } elseif (Auth::user()->type == 'super-admin') {
            $statisticOne = Role::all()->count();
            $statisticTwo = Permission::all()->count();
            $statisticThree = User::where('type', '=', 'university')->get()->count();
            $statisticFour = User::where('type', '!=', 'university')->get()->count();
            $this->dashboardTemplate('index', __('Dashboard'), [
                'user' => $user,
                'universities' => University::all(),
                'statisticOne' => $statisticOne,
                'statisticTwo' => $statisticTwo,
                'statisticThree' => $statisticThree,
                'statisticFour' => $statisticFour,
            ]);
        } elseif (Auth::user()->type == 'university') {
            $statisticOne = auth()->user()->collegesofUniversity->count();
            $count_departments = 0;
            foreach (auth()->user()->collegesofUniversity as $college) {
                $count_departments += $college->departments->count();
            }
            $statisticTwo = $count_departments;
            $statisticThree = User::where('key', '=', auth()->user()->key)->where('type', '=', 'student')->get()->count();
            $statisticOne = User::where('key', '=', auth()->user()->key)->where('type', '=', 'deanDepartment')->get()->count();
            $this->dashboardTemplate('index', __('Dashboard'), [
                'user' => $user,
                'colleges' => College::all(),
                'statisticOne' => $statisticOne,
                'statisticTwo' => $statisticTwo,
                'statisticThree' => $statisticThree,
                'statisticFour' => $statisticFour,
            ]);
        } elseif (Auth::user()->type == 'deanDepartment') {
            // $NumStudent = User::where('department_id', Auth::user()->department())->get();

            $college = College::where('user_id', Auth::id())->first();
            $departments = Department::where('college_id', '=', $college->id)->get();

            //number department of college
            $count_department= $departments->count();

            //Count user of college
            $user_id=array();
            foreach ($departments as $key => $user){
                array_push($user_id, $user['user_id']);
            }
            $users =user::whereIn('addBy_id', $user_id)->get();
            foreach ($users as $key => $user){
                array_push($user_id, $user['id']);
            }
            array_push($user_id, $users);
            $users= user::whereIn('id', $user_id)->get();

 
            $count_all_users_college= $users->count();

            $this->dashboardTemplate('deanDepartment', __('Dashboard'), ['user' => $user, 'count_department'=>$count_department,'count_all_users_college'=>$count_all_users_college]);
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
