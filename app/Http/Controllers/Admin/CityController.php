<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\Controller;

use App\Models\Admin\City;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->adminTemplate('cities.index',__('Cities'),['cities'=>City::all()]);

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $this->adminTemplate('cities.create',__('Create city'),['city'=>new City()]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required','max:250','min:3','unique:cities,name', 'alpha'],
        ]);
        $validator->validate();

        $Cities = new City;
        $Cities->name = $request->post('name');
        $Cities->save();
        return redirect()->route('admin.cities.index')->with('success',__('Success craeted'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {

        $this->adminTemplate('cities.edit',__('Edit city'),['city'=>$city]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
      
        $validator = Validator::make($request->all(), [
            'name' => ['required','max:250','min:3','unique:cities,name', 'alpha'],
        ]);
        $validator->validate();
        $city->name = $request->post('name');
        $city->save();

        return redirect()->route('admin.cities.index')->with('success',__('success Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();

        return  redirect()->route('admin.cities.index')->with('success', __('Success Deleted'));
    }

}
