<?php

namespace App\Http\Controllers\Complaint;
use App\Http\Controllers\Complaint\Controller;

use App\Models\Complaint\ComplaintsDetails;
use App\Http\Requests\StoreComplaintsDetailsRequest;
use App\Http\Requests\UpdateComplaintsDetailsRequest;
use App\Models\Complaint\ComplaintsForm;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ComplaintsDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->type=='super-admin'){
            $this->complaintTemplate('details.index',__('Complaints'),['complaintsForms' => ComplaintsForm::all()]);

        }else{
            $complaintsForm = ComplaintsForm::where('headDepartment_id' , Auth::id())->get();
            $this->complaintTemplate('details.index',__('Complaints'),['complaintsForms' => $complaintsForm]);
        }

    }
     /**
     * Display a listing of the group resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function group()
    {
        if(Auth::user()->type=='super-admin'){
            $complaintsFormWithdraws = ComplaintsForm::where('type','withdraw')->get();
            $complaintsFormEnrolls = ComplaintsForm::where('type','enroll')->get();
            $this->complaintTemplate('details.group',__('group'),['complaintsFormWithdraws' => $complaintsFormWithdraws, 'complaintsFormEnrolls' => $complaintsFormEnrolls]);
 
        }else{
            $complaintsFormWithdraws = ComplaintsForm::where('headDepartment_id' , Auth::id())->where('type','withdraw')->get();
            $complaintsFormEnrolls = ComplaintsForm::where('headDepartment_id' , Auth::id())->where('type','enroll')->get();
            $this->complaintTemplate('details.group',__('group'),['complaintsFormWithdraws' => $complaintsFormWithdraws, 'complaintsFormEnrolls' => $complaintsFormEnrolls]);
           }
   }

         /**
     * Display a listing of the complaintForStudent resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function complaintForStudent()
    {
        $complaintsForms = ComplaintsForm::where('headDepartment_id' , Auth::id())->get();
        $unique_user_id =[];
        // foreach ($complaintsForms as  $complaintsForm){

        //     //if not found add it
        //     if(!in_array($complaintsForm['user_id'],$unique_user_id)){
        //         print($complaintsForm['user_id']);
        //         $unique_user_id += [ $complaintsForm['user_id'] => [$complaintsForm] ];
        //     }
        // }
        
    //    foreach ($complaintsForms as  $complaintsForm){
    //         if(array_key_exists($complaintsForm['user_id'], $unique_user_id)){
    //             print($complaintsForm['user_id']);
    //             array_push($unique_user_id[$complaintsForm['user_id']],[$complaintsForm]);

    //         }else{
                
    //             $unique_user_id += [ $complaintsForm['user_id'] => [$complaintsForm] ];

    //         }
    // }
    foreach ($complaintsForms as  $complaintsForm){
        if(array_key_exists($complaintsForm['user_id'], $unique_user_id)){

           $unique_user_id[$complaintsForm['user_id']] []=$complaintsForm;

        }else{
            
            $unique_user_id += [ $complaintsForm['user_id'] => [$complaintsForm] ];

        }
}

        // foreach ($complaintsForms as  $complaintsForm){

        //     //if not found add it
        //     if(!array_key_exists($complaintsForm['user_id'], $unique_user_id)){
        //         $unique_user_id += [ $complaintsForm['id'] => $complaintsForm['user_id'] ];
        //     }
        // }

        // dd($unique_user_id,$complaintsForms);

        $this->complaintTemplate('details.complaintForStudent',__('complaintForStudent'),['complaintsForms' => $complaintsForms,'unique_users_id' => $unique_user_id]);
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
     * @param  \App\Http\Requests\StoreComplaintsDetailsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreComplaintsDetailsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Complaint\ComplaintsDetails  $complaintsDetails
     * @return \Illuminate\Http\Response
     */
    public function show(ComplaintsDetails $complaintsDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Complaint\ComplaintsDetails  $complaintsDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(ComplaintsDetails $complaintsDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateComplaintsDetailsRequest  $request
     * @param  \App\Models\Complaint\ComplaintsDetails  $complaintsDetails
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateComplaintsDetailsRequest $request, ComplaintsDetails $complaintsDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Complaint\ComplaintsDetails  $complaintsDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComplaintsDetails $complaintsDetails)
    {
        //
    }
}
