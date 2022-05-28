<?php

namespace App\Http\Controllers\University;

use App\Models\Admin\University;
use App\Models\University\College;
use App\Models\User;
use App\Rules\in_list;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Rules\alpha_spaces;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Str;

class CollegeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $colleges = College::all();
        $this->universityTemplate('college.index', __('College'), [
            'colleges' => $colleges,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $key = Auth::user()->key;

        //
        $universities = User::where('type', 'university')
            ->get();
        $deans = User::where('type', 'deanDepartment')
            ->get();
        $this->universityTemplate('college.add', __('Add College'), [
            'universities' => $universities,
            'deans' => $deans,
            'key' => $key,
            'user' => new User(),
            'college' => new College(),
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

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'unique:colleges,name', 'min:1', 'max:255'],
            'college_number' =>  ['required', 'min:1', 'max:8', 'unique:colleges,college_number'],

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
        $user->role_id = '5';
        $user->type = 'deanDepartment';
        $user->email = $request->post('email');
        $user->addBy_id = Auth::id();
        $user->department_id = 'null';
        $userPassword = Str::random(10);
        $user->password = Hash::make($userPassword);
        $user->save();

        $college = new College;
        $college->name = $request->post('name');
        $college->college_number = $request->post('college_number');
        $college->university_id = Auth::user()->addBy_id;
        $college->user_id = $user->id;
        $college->save();


        Password::sendResetLink(
            $request->only('email')
        );
        Password::RESET_LINK_SENT;


        return redirect()->route('university.college.index')->with('success', __('Go to email to change reset password' . $userPassword));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $college = College::find($id);
        $user = User::find($college->user_id);


        if ($college == null) {
            return redirect()->route('admin.college.index')->with('error', __('not fond') . ' ' . __('College'));
        } else {

            $deans = User::where('type', 'deanDepartment')
                ->get();
            $this->universityTemplate('college.edit', __('Edit College'), [
                'college' => $college,
                'deans' => $deans,
                'key' => $key,
                'user' => $user
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
        //
        $type_username_id = $request->post('type_username_id');
        $key = Auth::user()->key;
        $college = College::find($id);
        $user = User::find($college->user_id);

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'unique:colleges,name,' . $college->id, 'min:1', 'max:255'],
            'college_number' => ['min:1', 'max:255', 'unique:colleges,college_number,' . $college->id,],

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




        $college->update([
            'name' => $request->post('name'),
            'college_number' => $request->post('college_number'),
        ]);


        $user->update([
            'type_username_id' => $request->post('type_username_id'),
            'name' => $request->post('name'),
            'email' => $request->post('email'),
        ]);


        return redirect()->route('university.college.index')->with('success', __('Update Successed'));
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


        $college = College::find($id);
        $user = User::find($college->user_id);

        if ($college == null) {
            return redirect()->route('admin.college.index')->with('error', __('not fond') . ' ' . __('college'));
        }

        $college->delete();
        $user->delete();

        return redirect()->route('admin.college.index')->with('success', __('delete success'));
    }
}
