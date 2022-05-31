<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Models\University\College;
use App\Models\University\Department;
use App\Models\User;
use App\Rules\alpha_spaces;
use App\Rules\in_list;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
  
        if(Auth::user()->type== 'university'){
            $users= user::where('key', Auth::user()->key)->get();
            $this->adminTemplate('users.index', __('users'), ['users' =>  $users]);
        }
        elseif(Auth::user()->type== 'deanDepartment'){

            $college = College::where('user_id', Auth::id()) ->first();
            $departments = Department::where('college_id', '=', $college->id)->get();
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

            $this->adminTemplate('users.index', __('users'), ['users' =>  $users]);
        }
        elseif(Auth::user()->type== 'headDepartment'){
            $users= user::where('addBy_id', Auth::user()->id)->get();
            $this->adminTemplate('users.index', __('users'), ['users' =>  $users]);
        }
        else{
            return  redirect()->route('dashboard.index');
        }
        

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $key = Auth::user()->key;

        $this->adminTemplate('users.create', __('Create user'), ['user' => new User(), 'key' => $key]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $type_username_id = $request->post('type_username_id');
        $key = Auth::user()->key;
        $validator = Validator::make($request->all(), [
            'role' => ['required', 'int', 'exists:roles,id'],
            'type_username_id' => [
                'required',
                'digits:8',
                Rule::unique("users")->where(
                    function ($query) use ($type_username_id, $key) {
                        return $query->where(
                            [
                                ["type_username_id", "=", $type_username_id],
                                ["key", "=", $key]
                            ]
                        );
                    }
                )
            ],
            'name' => ['required', 'max:250', 'min:3', 'unique:users,name', new alpha_spaces],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
        ]);
        $validator->validate();
        $user = new User;
        $user->key = Auth::user()->key;
        $user->type_username_id = $request->post('type_username_id');
        $user->name = $request->post('name');
        Role::findOrCreate('student');
        $user->assignRole('student');
        $user->type = $request->post('type');
        $user->email = $request->post('email');
        $user->addBy_id = Auth::id();
        $user->department_id = auth()->user()->department_id;
        $userPassword = Str::random(10);
        $user->password = Hash::make($userPassword);
        $user->save();

        Password::sendResetLink(
            $request->only('email')
        );
        Password::RESET_LINK_SENT;

        return redirect()->back()->with('success', __('Go to email to change reset password' . $userPassword));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $key = Auth::user()->key;

        $this->adminTemplate('users.edit', __('Edit user'), ['key' => $key,'user' => $user, 'roles' => Role::all(), 'types' => ['headDepartment', 'deanDepartment', 'academicVice']]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $type_username_id = $request->post('type_username_id');
        $key = Auth::user()->key;
        $validator = Validator::make($request->all(), [
            'type_username_id' => [
                'required',
                'digits:8',
                Rule::unique("users")->where(
                    function ($query) use ($type_username_id, $key) {
                        return $query->where(
                            [
                                ["type_username_id", "=", $type_username_id],
                                ["key", "=", $key]
                            ]
                        );
                    }
                )
            ],
            'name' => ['required', 'max:250', 'min:3', 'unique:users,name', new alpha_spaces],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
        ]);
        $validator->validate();
        $user->update([
            'type_username_id' => $request->post('type_username_id'),
            'name' => $request->post('name'),
            'email' => $request->post('email'),

        ]);
        Password::sendResetLink(
            $request->only('email')
        );
        Password::RESET_LINK_SENT;
        return redirect()->route('admin.universities.index')->with('success', __('Success Edited'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        if ($user == null) {
            return redirect()->route('admin.users.index')->with('error', __('not fond') . ' ' . __('college'));
        }
        if ($user->coursesStudent()->get()->count() != 0) {
            return  redirect()->route('admin.users.index')->with('error', __('Can\'t delete'));
        }
        $user->delete();
        return  redirect()->route('admin.users.index')->with('success', __('Success Deleted'));
    }
}
