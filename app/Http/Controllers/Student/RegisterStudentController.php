<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Foundation\Auth\User;

class RegisterStudentController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('student.registerform');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */

     public function customReset(){
        return view('student.registerform');
     }
   
  
    public function store(Request $request)
    {
        $request->validate([
            'id' => ['required', 'string', 'max:255'],
        ]);

        $id = Student::create([
            'id' => $request->id,
        ]);

        event(new Registered($id));

        Password::sendResetLink(
            $request->only('email')
        );
        Password::RESET_LINK_SENT;

        return redirect()->back()->with('success',__('Go to email to change reset password'));
    }
}
