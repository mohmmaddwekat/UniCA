<?php

namespace App\Http\Controllers\University;

use App\Models\Admin\University;
use App\Models\University\College;
use App\Models\User;
use App\Rules\in_list;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        //
        $universities = User::whereHas(
            'role',
            function ($q) {
                $q->where('name', 'university');
            }
        )->get();
        $this->universityTemplate('college.add', __('Add College'), [
            'universities' => $universities,
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
        //
        $validated = $request->validate([
            'name' => ['required', 'unique:colleges', 'min:1', 'max:255'],
            'university' => ['required', new in_list('users')],
            'college_number' => 'min:1', 'max:255',
        ]);
        $college = new College;
        $college->name = $request->post('name');
        $college->college_number = $request->post('college_number');
        $college->university_id = $request->post('university');
        if (!$college->save()) {
            return redirect()->route('university.college.index')->with('error', __('an error occurred'));
        }
        return redirect()->route('university.college.index')->with('success', __('Add success'));
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
        //
        $college = College::find($id);
        $universities = University::all();
        if ($college == null) {
            return redirect()->route('admin.college.index')->with('error', __('not fond') . ' ' . __('College'));
        } else {
            $this->universityTemplate('college.edit', __('Edit College'), [
                'college' => $college,
                'universities' => $universities,
            ]);
        }
        $this->universityTemplate('college.edit', __('Edit College'), []);
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
        $validated = $request->validate([
            'name' => ['required', 'unique:colleges', 'min:1', 'max:255'],
            'university' => ['required', new in_list('users')],
            'college_number' => 'min:1', 'max:255',
        ]);
        $college = College::find($id);
        $college->name = $request->post('name');
        $college->college_number = $request->post('college_number');
        $college->university_id = $request->post('university');
        if (!$college->save()) {
            return redirect()->route('university.college.index')->with('error', __('an error occurred'));
        }
        return redirect()->route('university.college.index')->with('success', __('Edit success'));
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
        if ($college == null) {
            return redirect()->route('admin.college.index')->with('error', __('not fond') . ' ' . __('college'));
        }
        $college->delete();
        return redirect()->route('admin.college.index')->with('success', __('delete success'));
    }
}
