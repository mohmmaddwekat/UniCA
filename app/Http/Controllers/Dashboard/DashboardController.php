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
            $complaintsForms = ComplaintsForm::where([['headDepartment_id', Auth::id()], ['status', '=', 'In progress By the head of the department']])->get();
            $complaintsForms_enroll = ComplaintsForm::where([['headDepartment_id', Auth::id()], ['status', '=', 'In progress By the head of the department'],['type','enroll']])->get();
            $complaintsForms_withdraw = ComplaintsForm::where([['headDepartment_id', Auth::id()], ['status', '=', 'In progress By the head of the department'],['type','withdraw']])->get();

            $departments = Department::where('user_id', '=', Auth::id())->first();
            $users_of_department = User::Where('department_id',$departments->id)->get()->count();
            


             $count_order =$complaintsForms->count();
             $complaintsForms_enroll=$complaintsForms_withdraw->count();
             $complaintsForms_withdraw=$complaintsForms_withdraw->count();

            $this->dashboardTemplate('headDepartment', __('Dashboard'), [
                'user' => $user,
                'complaintsForms' => $complaintsForms,
                'users_of_department'=>$users_of_department,
                'count_order'=>$count_order,
                'complaintsForms_enroll'=>$complaintsForms_enroll,
                'complaintsForms_withdraw'=>$complaintsForms_withdraw,
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

                $college = College::where('user_id', Auth::id())->first();
                $departments = Department::where('college_id', '=', $college->id)->get();
                $user_id = array();
                foreach ($departments as $key => $user) {
                    array_push($user_id, $user['user_id']);
                }
    
                $complaintsForms  = ComplaintsForm::whereIn('headDepartment_id', $user_id)->where([['status', '=', 'In progress By the Dean of the department']])->get();
            
            
            $this->dashboardTemplate('deanDepartment', __('Dashboard'), [
                'complaintsForms'=>$complaintsForms ,
                'user' => $user, 
                'count_department'=>$count_department,
                'count_all_users_college'=>$count_all_users_college,
                
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
