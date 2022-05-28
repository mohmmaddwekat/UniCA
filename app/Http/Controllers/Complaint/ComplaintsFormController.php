<?php

namespace App\Http\Controllers\Complaint;
use App\Http\Controllers\Complaint\Controller;

use App\Models\Complaint\ComplaintsForm;
use App\Http\Requests\StoreComplaintsFormRequest;
use App\Http\Requests\UpdateComplaintsFormRequest;
use App\Mail\ComplaintMail;
use App\Models\University\College;
use App\Models\University\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class ComplaintsFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if (Auth::user()->type == 'headDepartment'){
            $complaintsForm = ComplaintsForm::where('headDepartment_id', Auth::id())->get();

        }
        elseif(Auth::user()->type == 'student'){
            $complaintsForm = ComplaintsForm::where('user_id', Auth::id())->get();
        }
        elseif(Auth::user()->type == 'deanDepartment'){
            $college = College::where('user_id', Auth::id()) ->first();
            $departments = Department::where('college_id', '=', $college->id)->get();
            $user_id=array();
            foreach ($departments as $key => $user){
                array_push($user_id, $user['user_id']);
            }

            $complaintsForm = ComplaintsForm::whereIn('headDepartment_id', $user_id)->get();



        }

        $this->complaintTemplate('form.index',__('Complaints'),['complaintsForms' => $complaintsForm]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->complaintTemplate('form.create',__('Create Complaint'),['complaintsForm'=>new ComplaintsForm(),'types' => ['withdraw', 'enroll']]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreComplaintsFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'type' => ['required', 'in:withdraw,enroll'],
            'course_number' => ['required', 'digits:8'],
            'section' => ['required', 'digits:1'],
            'course_name' => ['required', 'string', 'max:255','min:3'],
            'teacher_name' => ['required', 'string', 'max:255','min:3'],
            'days' => ['required', 'string', 'max:255','min:3'],
            'hour' => ['required', 'string', 'regex:/^(?:1[012]|0[0-9]):[0-5][0-9]-(?:1[012]|0[0-9]):[0-5][0-9]$/'],
        ]);
         $validator->validate();
         $complaintsForm = new ComplaintsForm;
         $complaintsForm->user_id = Auth::id();
         $complaintsForm->headDepartment_id = Auth::user()->addBy_id;
         $complaintsForm->type = $request->post('type');
         $complaintsForm->course_number = $request->post('course_number');
         $complaintsForm->section = $request->post('section');
         $complaintsForm->course_name = $request->post('course_name');
         $complaintsForm->teacher_name = $request->post('teacher_name');
         $complaintsForm->days = $request->post('days');
         $complaintsForm->hour = $request->post('hour');

         if(Auth::user()->type == 'headDepartment'){


            $complaintsForm->status = 'In progress By the Dean of the department';
            //send mail to student
            $deanDepartment = User::findOrFail($complaintsForm->user->addBy_id);
            $detailsDeanDepartment = [
                'title' => 'complaint',
                'name' =>' Dean of the department',
                'body' => 'this student he need to ..'
            ];
            $complaintsForm->update([
                'status' => 'In progress By the Dean of the department',
            ]);
            Mail::to('hamzaalkharouf5@gmail.com')->send(new ComplaintMail($detailsDeanDepartment));
            $complaintsForm->save();
            return redirect()->back()->with('success',__('Success send to Dean Department'));

         }else{
            $complaintsForm->status = 'In progress By the head of the department';
            $complaintsForm->save();
            return redirect()->back()->with('success',__('Success Sended'));
         }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student\ComplaintsForm  $complaintsForm
     * @return \Illuminate\Http\Response
     */
    public function show(ComplaintsForm $complaintsForm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student\ComplaintsForm  $complaintsForm
     * @return \Illuminate\Http\Response
     */
    public function edit(ComplaintsForm $complaintsForm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateComplaintsFormRequest  $request
     * @param  \App\Models\Student\ComplaintsForm  $complaintsForm
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateComplaintsFormRequest $request, ComplaintsForm $complaintsForm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student\ComplaintsForm  $complaintsForm
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComplaintsForm $complaintsForm)
    {
        //
    }
}
