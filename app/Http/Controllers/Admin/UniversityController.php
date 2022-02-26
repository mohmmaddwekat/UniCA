<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\Controller;

use App\Models\Admin\University;
use App\Http\Requests\StoreUniversityRequest;
use App\Http\Requests\UpdateUniversityRequest;
use App\Models\Admin\City;
use App\Rules\alpha_spaces;
use App\Rules\alpha_spaces_symbols;
use App\Rules\CheckPhoneRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->adminTemplate('universities.index',__('Universities'),['universities'=>University::all()]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $this->adminTemplate('universities.create',__('Create university'),['university'=>new University(),'cities' => City::all()]);

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
            'university_id' => ['required','max:250','min:3','unique:universities,university_id','numeric'],
            'university_name' => ['required','max:250','min:3','unique:universities,university_name',new alpha_spaces],
            'city_id' => ['nullable','int','exists:cities,id'],
            'address' => ['required','max:250','min:3', new alpha_spaces_symbols],
            'phone_number' => ['required','unique:universities,phone_number', 'numeric', new CheckPhoneRule],
            'password' => [
                'required',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ],        ]);
        $validator->validate();

        $universities = new University;
        $universities->university_id = $request->post('university_id');
        $universities->university_name = $request->post('university_name');
        $universities->city_id = $request->post('city_id');
        $universities->address = $request->post('address');
        $universities->phone_number = $request->post('phone_number');
        $universities->password = Hash::make($request->password);
        $universities->save();

        return redirect()->route('admin.universities.index')->with('success',__('Success craeted'));

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
      
        $this->adminTemplate('universities.edit',__('Edit city'),['university'=> $university,'cities' =>City::all(),]);

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

        if(!empty($request->password)){
            $validator = Validator::make($request->all(), [
                'university_id' => ['required','max:250','min:3','unique:universities,university_id,'.$university['id'],'numeric'],
                'university_name' => ['required','max:250','min:3','unique:universities,university_name,'.$university['id'],new alpha_spaces],
                'city_id' => ['nullable','int','exists:cities,id'],
                'address' => ['required','max:250','min:3', new alpha_spaces_symbols],
                'phone_number' => ['required','unique:universities,phone_number,'.$university['id'], 'numeric', new CheckPhoneRule],
                'password' => [
                    'required',
                    Password::min(8)
                        ->mixedCase()
                        ->letters()
                        ->numbers()
                        ->symbols()
                        ->uncompromised()
                ],        ]);
            $validator->validate();
            $university->update([
                'university_id' =>$request->post('university_id'),
                'university_name' =>$request->post('university_name'),
                'city_id' =>$request->post('city_id'),
                'address' =>$request->post('address'),
                'phone_number' =>$request->post('phone_number'),
                'password' => Hash::make($request->password),
    
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'university_id' => ['required','max:250','min:3','unique:universities,university_id,'.$university['id'],'numeric'],
                'university_name' => ['required','max:250','min:3','unique:universities,university_name,'.$university['id'],new alpha_spaces],
                'city_id' => ['nullable','int','exists:cities,id'],
                'address' => ['required','max:250','min:3', new alpha_spaces_symbols],
                'phone_number' => ['required','unique:universities,phone_number,'.$university['id'], 'numeric', new CheckPhoneRule],
  
            ]);
            $validator->validate();
            $university->update([
                'university_id' =>$request->post('university_id'),
                'university_name' =>$request->post('university_name'),
                'city_id' =>$request->post('city_id'),
                'address' =>$request->post('address'),
                'phone_number' =>$request->post('phone_number'),
    
            ]);
        }


        return redirect()->route('admin.universities.index')->with('success',__('Success Edited'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\University  $university
     * @return \Illuminate\Http\Response
     */
    public function destroy(University $university)
    {
        $university->delete();
        return  redirect()->route('admin.universities.index')->with('success', __('Success Deleted'));

    }


}
