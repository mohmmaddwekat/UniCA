<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;

use App\Models\Admin\University;

use App\Models\Admin\City;
use App\Models\User;
use App\Rules\alpha_spaces;
use App\Rules\alpha_spaces_symbols;
use App\Rules\CheckPhoneRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Spatie\Permission\Models\Role;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->adminTemplate('universities.index', __('Universities'), ['universities' => University::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $this->adminTemplate('universities.create', __('Create university'), ['university' => new University(), 'user' => new User(), 'cities' => City::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUniversityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'key' => ['required', 'max:3', 'min:3', 'unique:users,key'],
            'type_username_id' => ['required', 'digits:8', 'unique:users,type_username_id'],
            'university_name' => ['required', 'max:250', 'min:3', 'unique:users,name', new alpha_spaces],
            'city_id' => ['nullable', 'int', 'exists:cities,id'],
            'address' => ['required', 'max:250', 'min:3', new alpha_spaces_symbols],
            'phone_number' => ['required', 'unique:universities,phone_number', 'numeric', new CheckPhoneRule],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
        ]);
        $validator->validate();
        $user = new User;
        $user->key = $request->post('key');
        $user->type_username_id = $request->post('type_username_id');
        $user->name = $request->post('university_name');
        Role::findOrCreate('university');
        $user->assignRole('university');
        $user->addBy_id = Auth::id();
        $user->department_id = 'null';

        $user->email = $request->post('email');
        $user->type = 'university';
        $userPassword = Str::random(10);
        $user->password = Hash::make($userPassword);
        $user->save();
        $user->assignRole('');

        $universities = new University;
        $universities->user_id = $user->id;
        $universities->city_id = $request->post('city_id');
        $universities->address = $request->post('address');
        $universities->phone_number = $request->post('phone_number');
        $universities->save();

        Password::sendResetLink(
            $request->only('email')
        );

        Password::RESET_LINK_SENT;

        return redirect()->back()->with('success', __('Message for reset password is sended'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\University  $university
     * @return \Illuminate\Http\Response
     */
    public function show(University $university)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\University  $university
     * @return \Illuminate\Http\Response
     */
    public function edit(University $university)
    {
        $roles = Role::all();

        $this->adminTemplate('universities.edit', __('Edit city'), ['university' => $university, 'roles' => $roles, 'cities' => City::all(),]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUniversityRequest  $request
     * @param  \App\Models\Admin\University  $university
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, University $university)
    {

        if (!empty($request->password)) {
            $validator = Validator::make($request->all(), [
                'university_id' => ['required', 'max:250', 'min:3', 'unique:universities,university_id,' . $university['id'], 'numeric'],
                'university_name' => ['required', 'max:250', 'min:3', 'unique:universities,university_name,' . $university['id'], new alpha_spaces],
                'city_id' => ['nullable', 'int', 'exists:cities,id'],
                'address' => ['required', 'max:250', 'min:3', new alpha_spaces_symbols],
                'phone_number' => ['required', 'unique:universities,phone_number,' . $university['id'], 'numeric', new CheckPhoneRule],
                'password' => [
                    'required',
                    Password::min(8)
                        ->mixedCase()
                        ->letters()
                        ->numbers()
                        ->symbols()
                        ->uncompromised()
                ],
            ]);
            $validator->validate();
            $university->update([
                'university_id' => $request->post('university_id'),
                'university_name' => $request->post('university_name'),
                'city_id' => $request->post('city_id'),
                'address' => $request->post('address'),
                'phone_number' => $request->post('phone_number'),
                'password' => Hash::make($request->password),

            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'university_id' => ['required', 'max:250', 'min:3', 'unique:universities,university_id,' . $university['id'], 'numeric'],
                'university_name' => ['required', 'max:250', 'min:3', 'unique:universities,university_name,' . $university['id'], new alpha_spaces],
                'city_id' => ['nullable', 'int', 'exists:cities,id'],
                'address' => ['required', 'max:250', 'min:3', new alpha_spaces_symbols],
                'phone_number' => ['required', 'unique:universities,phone_number,' . $university['id'], 'numeric', new CheckPhoneRule],

            ]);
            $validator->validate();
            $role = Role::where('name', 'university')->first();

            $university->update([
                'university_id' => $request->post('university_id'),
                'university_name' => $request->post('university_name'),
                'city_id' => $request->post('city_id'),
                'address' => $request->post('address'),
                'role_id' => $role['id'],
                'phone_number' => $request->post('phone_number'),

            ]);
        }

        return redirect()->route('admin.universities.index')->with('success', __('Success Edited'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\University  $university
     * @return \Illuminate\Http\Response
     */
    public function destroy(University $university)
    {
        if ($university == null) {
            return redirect()->route('admin.universities.index')->with('error', __('not fond') . ' ' . __('college'));
        }
        if ($university->user()->get()->count() != 0) {
            return  redirect()->route('admin.universities.index')->with('error', __('Can\'t delete'));
        }
        if ($university->college()->get()->count() != 0) {
            return  redirect()->route('admin.universities.index')->with('error', __('Can\'t delete'));
        }
        $university->delete();
        return  redirect()->route('admin.universities.index')->with('success', __('Success Deleted'));
    }
}
