<?php

namespace App\Http\Controllers\Complaint;

use App\Http\Controllers\Complaint\Controller;


use App\Mail\ComplaintMail;
use App\Models\Complaint\ComplaintsForm;
use App\Models\University\College;
use App\Models\University\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class ComplaintsDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function defult()
    {
        if (Auth::user()->type == 'headDepartment') {
            $complaintsForm = ComplaintsForm::where([['headDepartment_id', Auth::id()], ['status', '=', 'In progress By the head of the department']])->get();
        } elseif (Auth::user()->type == 'deanDepartment') {
            $college = College::where('user_id', Auth::id())->first();
            $departments = Department::where('college_id', '=', $college->id)->get();
            $user_id = array();
            foreach ($departments as $key => $user) {
                array_push($user_id, $user['user_id']);
            }

            $complaintsForm = ComplaintsForm::whereIn('headDepartment_id', $user_id)->where([['status', '=', 'In progress By the Dean of the department']])->get();
        }
        $this->complaintTemplate('details.index', __('Complaints'), ['complaintsForms' => $complaintsForm]);
    }
    /**
     * Display a listing of the group resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function group()
    {
        if (Auth::user()->type == 'headDepartment') {

            $complaintsFormWithdraws = ComplaintsForm::where('headDepartment_id', Auth::id())
                ->where('status', '=', 'In progress By the head of the department')
                ->where('type', 'withdraw')->get();
            $complaintsFormEnrolls = ComplaintsForm::where('headDepartment_id', Auth::id())
                ->where('status', '=', 'In progress By the head of the department')
                ->where('type', 'enroll')->get();
        } elseif (Auth::user()->type == 'deanDepartment') {
            $college = College::where('user_id', Auth::id())->first();
            $departments = Department::where('college_id', '=', $college->id)->get();
            $user_id = array();
            foreach ($departments as $key => $user) {
                array_push($user_id, $user['user_id']);
            }

            $complaintsFormWithdraws = ComplaintsForm::whereIn('headDepartment_id', $user_id)
                ->where('status', '=', 'In progress By the Dean of the department')
                ->where('type', 'withdraw')->get();
            $complaintsFormEnrolls = ComplaintsForm::whereIn('headDepartment_id', $user_id)
                ->where('status', '=', 'In progress By the Dean of the department')
                ->where('type', 'enroll')->get();
        }
        $this->complaintTemplate('details.group', __('group'), ['complaintsFormWithdraws' => $complaintsFormWithdraws, 'complaintsFormEnrolls' => $complaintsFormEnrolls]);
    }

    /**
     * Display a listing of the complaintForStudent resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function complaintForStudent()
    {

        if (Auth::user()->type == 'headDepartment') {
            $complaintsForms = ComplaintsForm::where('headDepartment_id', Auth::id())
                ->where('status', '=', 'In progress By the head of the department')
                ->get();
            $unique_user_id = [];

            foreach ($complaintsForms as  $complaintsForm) {
                if (array_key_exists($complaintsForm['user_id'], $unique_user_id)) {

                    $unique_user_id[$complaintsForm['user_id']][] = $complaintsForm;
                } else {

                    $unique_user_id += [$complaintsForm['user_id'] => [$complaintsForm]];
                }
            }
        } elseif (Auth::user()->type == 'deanDepartment') {
            $college = College::where('user_id', Auth::id())->first();
            $departments = Department::where('college_id', '=', $college->id)->get();
            $user_id = array();
            foreach ($departments as $key => $user) {
                array_push($user_id, $user['user_id']);
            }
            $complaintsForms = ComplaintsForm::whereIn('headDepartment_id', $user_id)
                ->where('status', '=', 'In progress By the Dean of the department')
                ->get();
            $unique_user_id = [];

            foreach ($complaintsForms as  $complaintsForm) {
                if (array_key_exists($complaintsForm['user_id'], $unique_user_id)) {

                    $unique_user_id[$complaintsForm['user_id']][] = $complaintsForm;
                } else {

                    $unique_user_id += [$complaintsForm['user_id'] => [$complaintsForm]];
                }
            }
        }



        $this->complaintTemplate('details.complaintForStudent', __('complaintForStudent'), ['complaintsForms' => $complaintsForms, 'unique_users_id' => $unique_user_id]);
    }

    //-------------------------------------Complaint Defult

    public function complaintResolvedDefult($complaintID)
    {

        $complaintsForm = ComplaintsForm::findOrFail($complaintID);
        if (Auth::user()->type == 'headDepartment') {

            $details = [
                'title' => 'complaint',
                'name' => $complaintsForm->user->name,
                'body' => 'complaint-Resolved'
            ];
            $complaintsForm->update([
                'status' => 'Resolved',
            ]);
            Mail::to($complaintsForm->user->email)->send(new ComplaintMail($details));
            return redirect()->back()->with('success', __('Success Resolved'));
        } elseif (Auth::user()->type == 'deanDepartment') {
            $complaintsForm = ComplaintsForm::findOrFail($complaintID);
            $details = [
                'title' => 'complaint',
                'name' => $complaintsForm->user->name,
                'body' => 'complaint-Resolved by deanDepartment'
            ];
            $complaintsForm->update([
                'status' => 'Resolved',
            ]);
            Mail::to($complaintsForm->user->email)->send(new ComplaintMail($details));
            return redirect()->back()->with('success', __('Success Resolved'));
        }

        return redirect()->back();
    }

    public function complaintDeclineDefult(Request $request, $complaintID)
    {



        $complaintsForm = ComplaintsForm::findOrFail($complaintID);

        if (Auth::user()->type == 'headDepartment') {

            $details = [
                'title' => 'complaint',
                'name' => $complaintsForm->user->name,
                'body' => 'Declined  by headDepartment' . $request->post('notes')
            ];
            $complaintsForm->update([
                'status' => 'Declined',
            ]);
            Mail::to($complaintsForm->user->email)->send(new ComplaintMail($details));
            return redirect()->back()->with('success', __('Success Resolved'));
        } elseif (Auth::user()->type == 'deanDepartment') {
            $complaintsForm = ComplaintsForm::findOrFail($complaintID);
            $details = [
                'title' => 'complaint',
                'name' => $complaintsForm->user->name,
                'body' => 'Declined  by deanDepartment' . $request->post('notes')
            ];
            $complaintsForm->update([
                'status' => 'Declined',
            ]);
            Mail::to($complaintsForm->user->email)->send(new ComplaintMail($details));
            return redirect()->back()->with('success', __('Success Resolved'));
        }

        return redirect()->back();
    }



    public function complaintDeanDepartmentDefult($complaintID)
    {

        $complaintsForm = ComplaintsForm::findOrFail($complaintID);
        if (Auth::user()->type == 'headDepartment') {

            $details = [
                'title' => 'complaint',
                'name' => $complaintsForm->user->name,
                'body' => 'by headDepartment send to In progress By the Dean of the department'
            ];
            $complaintsForm->update([
                'status' => 'In progress By the Dean of the department',
            ]);
            Mail::to($complaintsForm->user->email)->send(new ComplaintMail($details));
            return redirect()->back()->with('success', __('Success Resolved'));
        }

        return redirect()->back();
    }




    //-------------------------------------Complaint group
    public function complaintResolvedGroup($typeComplaint)
    {
        if (Auth::user()->type == 'headDepartment') {
            if ($typeComplaint == 'withdraw') {
                $complaintsForms = ComplaintsForm::where('headDepartment_id', Auth::id())
                    ->where('status', '=', 'In progress By the head of the department')
                    ->where('type', 'withdraw')->get();
            } elseif ($typeComplaint == 'enroll') {
                $complaintsForms = ComplaintsForm::where('headDepartment_id', Auth::id())
                    ->where('status', '=', 'In progress By the head of the department')
                    ->where('type', 'enroll')->get();
            } else {
                return redirect()->back();
            }

            foreach ($complaintsForms as $complaintsForm) {

                $details = [
                    'title' => 'complaint',
                    'name' => $complaintsForm->user->name,
                    'body' => 'complaint-Resolved by headDepartment'
                ];
                $complaintsForm->update([
                    'status' => 'Resolved',
                ]);
                Mail::to($complaintsForm->user->email)->send(new ComplaintMail($details));
            }
            return redirect()->back()->with('success', __('Success Resolved'));
        } elseif (Auth::user()->type == 'deanDepartment') {
            $college = College::where('user_id', Auth::id())->first();
            $departments = Department::where('college_id', '=', $college->id)->get();
            $user_id = array();
            foreach ($departments as $key => $user) {
                array_push($user_id, $user['user_id']);
            }
            if ($typeComplaint == 'withdraw') {
                $complaintsForms = ComplaintsForm::whereIn('headDepartment_id', $user_id)
                    ->where('status', '=', 'In progress By the Dean of the department')
                    ->where('type', 'withdraw')->get();
            } elseif ($typeComplaint == 'enroll') {
                $complaintsForms = ComplaintsForm::whereIn('headDepartment_id', $user_id)
                    ->where('status', '=', 'In progress By the Dean of the department')
                    ->where('type', 'enroll')->get();
            } else {
                return redirect()->back();
            }
            foreach ($complaintsForms as $complaintsForm) {

                $details = [
                    'title' => 'complaint',
                    'name' => $complaintsForm->user->name,
                    'body' => 'complaint-Resolved by deanDepartment'
                ];
                $complaintsForm->update([
                    'status' => 'Resolved',
                ]);
                Mail::to($complaintsForm->user->email)->send(new ComplaintMail($details));
            }
            return redirect()->back()->with('success', __('Success Resolved'));
        }
        return redirect()->back();
    }
    public function complaintDeanDepartmentGroup($typeComplaint)
    {
        if (Auth::user()->type == 'headDepartment') {

            if ($typeComplaint == 'withdraw') {
                $complaintsForms = ComplaintsForm::where('headDepartment_id', Auth::id())
                    ->where('status', '=', 'In progress By the head of the department')
                    ->where('type', 'withdraw')->get();
            } elseif ($typeComplaint == 'enroll') {
                $complaintsForms = ComplaintsForm::where('headDepartment_id', Auth::id())
                    ->where('status', '=', 'In progress By the head of the department')
                    ->where('type', 'enroll')->get();
            } else {
                return redirect()->back();
            }

            foreach ($complaintsForms as $complaintsForm) {

                $details = [
                    'title' => 'complaint',
                    'name' => $complaintsForm->user->name,
                    'body' => 'by headDepartment send to In progress By the Dean of the department'
                ];
                $complaintsForm->update([
                    'status' => 'In progress By the Dean of the department',
                ]);
                Mail::to($complaintsForm->user->email)->send(new ComplaintMail($details));
            }
            return redirect()->back()->with('success', __('Send Group ' . $typeComplaint . 'to Dean department'));
        }
        return redirect()->back();
    }
    public function complaintDeclineGroup(Request $request, $typeComplaint)
    {






        if (Auth::user()->type == 'headDepartment') {
            if ($typeComplaint == 'withdraw') {
                $complaintsForms = ComplaintsForm::where('headDepartment_id', Auth::id())
                    ->where('status', '=', 'In progress By the head of the department')
                    ->where('type', 'withdraw')->get();
            } elseif ($typeComplaint == 'enroll') {
                $complaintsForms = ComplaintsForm::where('headDepartment_id', Auth::id())
                    ->where('status', '=', 'In progress By the head of the department')
                    ->where('type', 'enroll')->get();
            } else {
                return redirect()->back();
            }

            foreach ($complaintsForms as $complaintsForm) {

                $details = [
                    'title' => 'complaint',
                    'name' => $complaintsForm->user->name,
                    'body' => 'Declined  by headDepartment' . $request->post('notes')
                ];
                $complaintsForm->update([
                    'status' => 'Declined',
                ]);
                Mail::to($complaintsForm->user->email)->send(new ComplaintMail($details));
            }
            return redirect()->back()->with('success', __('Success Resolved'));
        } elseif (Auth::user()->type == 'deanDepartment') {

            $college = College::where('user_id', Auth::id())->first();
            $departments = Department::where('college_id', '=', $college->id)->get();
            $user_id = array();
            foreach ($departments as $key => $user) {
                array_push($user_id, $user['user_id']);
            }
            if ($typeComplaint == 'withdraw') {
                $complaintsForms = ComplaintsForm::whereIn('headDepartment_id', $user_id)
                    ->where('status', '=', 'In progress By the Dean of the department')
                    ->where('type', 'withdraw')->get();
            } elseif ($typeComplaint == 'enroll') {
                $complaintsForms = ComplaintsForm::whereIn('headDepartment_id', $user_id)
                    ->where('status', '=', 'In progress By the Dean of the department')
                    ->where('type', 'enroll')->get();
            } else {
                return redirect()->back();
            }
            foreach ($complaintsForms as $complaintsForm) {

                $details = [
                    'title' => 'complaint',
                    'name' => $complaintsForm->user->name,
                    'body' => 'Declined by  deanDepartment' . $request->post('notes')
                ];
                $complaintsForm->update([
                    'status' => 'Declined',
                ]);
                Mail::to($complaintsForm->user->email)->send(new ComplaintMail($details));
            }
            return redirect()->back()->with('success', __('Success Resolved'));
        }

        return redirect()->back();
    }

    //-------------------------------------Complaint For Student

    public function complaintResolvedForStudent($userId)
    {
        if (Auth::user()->type == 'headDepartment') {
            $complaintsForms = ComplaintsForm::where([['user_id', $userId], ['status', 'In progress By the head of the department']])->get();

            foreach ($complaintsForms as $complaintsForm) {

                $details = [
                    'title' => 'complaint',
                    'name' => $complaintsForm->user->name,
                    'body' => 'Resolved  by headDepartment'
                ];
                $complaintsForm->update([
                    'status' => 'Resolved',
                ]);
                Mail::to($complaintsForm->user->email)->send(new ComplaintMail($details));
            }
            return redirect()->back()->with('success', __('Success Resolved'));
        } elseif (Auth::user()->type == 'deanDepartment') {
            $complaintsForms = ComplaintsForm::where([['user_id', $userId], ['status', 'In progress By the Dean of the department']])->get();

            foreach ($complaintsForms as $complaintsForm) {

                $details = [
                    'title' => 'complaint',
                    'name' => $complaintsForm->user->name,
                    'body' => 'Resolved by  deanDepartment'
                ];
                $complaintsForm->update([
                    'status' => 'Resolved',
                ]);
                Mail::to($complaintsForm->user->email)->send(new ComplaintMail($details));
            }
            return redirect()->back()->with('success', __('Success Resolved'));
        }
        return redirect()->back();
    }




    public function complaintDeanForStudent($userId)
    {
        if (Auth::user()->type == 'headDepartment') {
            $complaintsForms = ComplaintsForm::where([['user_id', $userId], ['status', 'In progress By the head of the department']])->get();
            foreach ($complaintsForms as $complaintsForm) {

                $details = [
                    'title' => 'complaint',
                    'name' => $complaintsForm->user->name,
                    'body' => 'by headDepartment send to In progress By the Dean of the department'
                ];
                $complaintsForm->update([
                    'status' => 'In progress By the Dean of the department',
                ]);
                Mail::to($complaintsForm->user->email)->send(new ComplaintMail($details));
            }
            return redirect()->back()->with('success', __('Send to Dean department'));
        }
        return redirect()->back();
    }


    public function complaintDeclineForStudent(Request $request, $userId)
    {


        if (Auth::user()->type == 'headDepartment') {
            $complaintsForms = ComplaintsForm::where([['user_id', $userId], ['status', 'In progress By the head of the department']])->get();

            foreach ($complaintsForms as $complaintsForm) {

                $details = [
                    'title' => 'complaint',
                    'name' => $complaintsForm->user->name,
                    'body' => 'Declined  by headDepartment' . $request->post('notes')
                ];
                $complaintsForm->update([
                    'status' => 'Declined',
                ]);
                Mail::to($complaintsForm->user->email)->send(new ComplaintMail($details));
            }
            return redirect()->back()->with('success', __('Success Declined'));
        } elseif (Auth::user()->type == 'deanDepartment') {
            $complaintsForms = ComplaintsForm::where([['user_id', $userId], ['status', 'In progress By the Dean of the department']])->get();

            foreach ($complaintsForms as $complaintsForm) {

                $details = [
                    'title' => 'complaint',
                    'name' => $complaintsForm->user->name,
                    'body' => 'Declined by  deanDepartment' . $request->post('notes')
                ];
                $complaintsForm->update([
                    'status' => 'Declined',
                ]);
                Mail::to($complaintsForm->user->email)->send(new ComplaintMail($details));
            }
            return redirect()->back()->with('success', __('Success Declined'));
        }
        return redirect()->back();
    }
}
