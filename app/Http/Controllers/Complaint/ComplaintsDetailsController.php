<?php

namespace App\Http\Controllers\Complaint;

use App\Http\Controllers\Complaint\Controller;

use App\Models\Complaint\ComplaintsDetails;
use App\Http\Requests\StoreComplaintsDetailsRequest;
use App\Http\Requests\UpdateComplaintsDetailsRequest;
use App\Mail\ComplaintMail;
use App\Models\Complaint\ComplaintsForm;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ComplaintsDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function defult()
    {
        $complaintsForm = ComplaintsForm::where([['headDepartment_id', Auth::id()], ['status','=','In progress By the head of the department']])
        ->get();
        $this->complaintTemplate('details.index', __('Complaints'), ['complaintsForms' => $complaintsForm]);
    } 
    /**
     * Display a listing of the group resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function group()
    {
        $complaintsFormWithdraws = ComplaintsForm::where('headDepartment_id', Auth::id())
        ->where('status', '=','In progress By the head of the department')
        ->where('type', 'withdraw')->get();
        $complaintsFormEnrolls = ComplaintsForm::where('headDepartment_id', Auth::id())->where('type', 'enroll')->get();


        $this->complaintTemplate('details.group', __('group'), ['complaintsFormWithdraws' => $complaintsFormWithdraws, 'complaintsFormEnrolls' => $complaintsFormEnrolls]);
  
    }

    /**
     * Display a listing of the complaintForStudent resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function complaintForStudent()
    {
        $complaintsForms = ComplaintsForm::where('headDepartment_id', Auth::id())->get();
        $unique_user_id = [];

        foreach ($complaintsForms as  $complaintsForm) {
            if (array_key_exists($complaintsForm['user_id'], $unique_user_id)) {

                $unique_user_id[$complaintsForm['user_id']][] = $complaintsForm;
            } else {

                $unique_user_id += [$complaintsForm['user_id'] => [$complaintsForm]];
            }
        }


        $this->complaintTemplate('details.complaintForStudent', __('complaintForStudent'), ['complaintsForms' => $complaintsForms, 'unique_users_id' => $unique_user_id]);
    }


    public function complaintDecline($complaintUser,$typeComplaint=null)
    {

        
        if($typeComplaint != null){
            $complaintsForms = ComplaintsForm::where([['headDepartment_id', Auth::id()],['type','withdraw']])->get();

            foreach($complaintsForms as $userComplaintsForm){

                $complaintsForm = ComplaintsForm::findOrFail($userComplaintsForm['id']);

                $details = [
                    'title' => 'complaint',
                    'name' =>$complaintsForm->user->name,
                    'body' => 'complaint-decline'
                ];
            
                $complaintsForm->update([
                    'status' => 'Declined',
                ]);
                Mail::to('hamzaalkharouf5@gmail.com')->send(new ComplaintMail($details));
            }


            return redirect()->back()->with('success',__('Success Declined'));
        }else{

            $complaintsForm = ComplaintsForm::findOrFail($complaintUser);
            $details = [
                'title' => 'complaint',
                'name' =>$complaintsForm->user->name,
                'body' => 'complaint-decline'
            ];
        
            $complaintsForm->update([
                'status' => 'Declined',
            ]);
    
            Mail::to('hamzaalkharouf5@gmail.com')->send(new ComplaintMail($details));
            return redirect()->back()->with('success',__('Success Declined'));
        }

    }

    public function complaintResolved($id)
    {
        $complaintsForm = ComplaintsForm::findOrFail($id);

        $details = [
            'title' => 'complaint',
            'name' =>$complaintsForm->user->name,
            'body' => 'complaint-Resolved'
        ];
    
        $complaintsForm->update([
            'status' => 'Resolved',
        ]);

        Mail::to('hamzaalkharouf5@gmail.com')->send(new ComplaintMail($details));
        return redirect()->back()->with('success',__('Success Resolved'));

    }

    public function complaintDeanDepartment($id)
    {
        $complaintsForm = ComplaintsForm::findOrFail($id);

        

        //send mail to student
        $details = [
            'title' => 'complaint',
            'name' =>$complaintsForm->user->name,
            'body' => 'complaint-complaintDeanDepartment is send to Dean Department'
        ];
        $complaintsForm->update([
            'status' => 'In progress By the Dean of the department',
        ]);
        Mail::to('hamzaalkharouf5@gmail.com')->send(new ComplaintMail($details));


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
       
        return redirect()->back()->with('success',__('Success send to Dean Department'));

    }


    




    
}
