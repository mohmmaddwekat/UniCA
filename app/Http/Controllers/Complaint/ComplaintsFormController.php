<?php

namespace App\Http\Controllers\Complaint;
use App\Http\Controllers\Complaint\Controller;

use App\Models\Complaint\ComplaintsForm;
use App\Http\Requests\StoreComplaintsFormRequest;
use App\Http\Requests\UpdateComplaintsFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ComplaintsFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->complaintTemplate('form.index',__('Complaints'),['complaintsForms' => ComplaintsForm::all()]);
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
         $complaintsForm->status = 'False';
         $complaintsForm->save();
         return redirect()->back()->with('success',__('Success Sended'));
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
