<?php

namespace App\Http\Controllers\University;

use App\Models\University\College;
use App\Models\University\Department;
use App\Models\User;
use App\Rules\in_list;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Rules\alpha_spaces;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Spatie\Permission\Models\Role;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $departments = [];
        $colleges = auth()->user()->collegesofUniversity;

        foreach ($colleges as $college) {
            array_push($departments,...$college->departments()->get());
        }
        $this->universityTemplate('department.index', __('Department'), ['departments' => $departments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $this->universityTemplate('department.add', __('Add Department'), [
            'colleges' => College::all(),
            'user' => new User,
            'department' => new Department(),
            'key' => Auth::user()->key,
        ]);
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
        //
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'unique:departments', 'min:3', 'max:255'],
            'college' => ['required', 'int', 'exists:colleges,id'],

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
            'fullname' => ['required', 'max:250', 'min:3', 'unique:users,name', new alpha_spaces],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
        ]);
        $validator->validate();

        $user = new User;
        $user->key = Auth::user()->key;
        $user->type_username_id = $request->post('type_username_id');
        $user->name = $request->post('fullname');
        Role::findOrCreate('headDepartment');
        $user->assignRole('headDepartment');
        $user->type = 'headDepartment';
        $user->email = $request->post('email');
        $user->addBy_id = Auth::id();
        $user->department_id = 'null';
        $userPassword = Str::random(10);
        $user->password = Hash::make($userPassword);
        $user->save();



        $department = new Department;
        $department->name = $request->post('name');
        $department->user_id = $user->id;
        $department->college_id = $request->post('college');
        $department->save();



        $user->department_id = $department->id;
        $user->save();

        Password::sendResetLink(
            $request->only('email')
        );
        Password::RESET_LINK_SENT;


        return redirect()->route('university.department.index')->with('success', __('Go to email to change reset password' . $userPassword));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $key = Auth::user()->key;
        $department = Department::find($id);
        $user = User::find($department->user_id);

        if ($department == null) {
            return redirect()->route('university.department.index')->with('error', __('not fond') . ' ' . __('Department'));
        } else {
            $colleges = College::all();

            $this->universityTemplate('department.edit', __('Edit Department'), [
                'department' => $department,
                'colleges' => $colleges,
                'user' => $user,
                'key' => $key,

            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $type_username_id = $request->post('type_username_id');
        $key = Auth::user()->key;
        $department = Department::find($id);
        $user = User::find($department->user_id);


        $validator = Validator::make($request->all(), [
            'name' => ['required', 'unique:departments,name,' . $id, 'min:3', 'max:255'],
            'college' => ['required', 'int', 'exists:colleges,id'],

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
                    ->ignore($user->id),
            ],
            'fullname' => ['required', 'max:250', 'min:3', 'unique:users,name,' . $user->id, new alpha_spaces],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],


        ]);
        $validator->validate();

        $department->update([
            'name' => $request->post('name'),
            'college_id' => $request->post('college'),
        ]);
        $department->college_id = $request->post('college');
        $department->save();
        $user->update([
            'type_username_id' => $request->post('type_username_id'),
            'name' => $request->post('fullname'),
            'email' => $request->post('email'),
        ]);



        return redirect()->route('university.department.index')->with('success', __('Edit success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $department = Department::find($id);
        $user = User::find($department->user_id);

        if ($department == null) {
            return redirect()->route('university.department.index')->with('error', __('not fond') . ' ' . __('Department'));
        }
        if ($department->courses()->get()->count() != 0) {
            return  redirect()->route('university.department.index')->with('error', __('Can\'t delete'));
        }
        if ($department->courses()->get()->count() != 0) {
            return  redirect()->route('university.department.index')->with('error', __('Can\'t delete'));
        }
        $department->delete();
        $user->delete();

        return redirect()->route('university.department.index')->with('success', __('delete success'));
    }
}
