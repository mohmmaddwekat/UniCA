<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class StudentController extends Controller
{
    public function register()
    {

        return view('auth.student-register');
    }
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);
        $user = User::where('email', $request->post('email'))->first();

        // check user is Found
        if ($user != null) {

            // check if remember_token of is null ,  null if Student is already registered
            if ($user->remember_token != null) {
                return back()->withErrors('A student with this email is already registered');
            }

            $status = Password::sendResetLink(
                $request->only('email')
            );

            return $status == Password::RESET_LINK_SENT
                ? back()->with('status', __($status))
                : back()->withInput($request->only('email'))->withErrors(['email' => __($status)]);
        }
        return back()->withErrors('User is not Found, Please make sure to enter university email');

    }
}
