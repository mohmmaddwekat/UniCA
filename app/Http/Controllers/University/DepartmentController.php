<?php

namespace App\Http\Controllers\University;

use App\Models\University\College;
use App\Models\University\Department;
use App\Models\User;
use App\Rules\in_list;
use Illuminate\Http\Request;

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
        $departments = Department::all();
        $this->universityTemplate('department.index', __('Department'), ['departments' => $departments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $colleges = College::all();
        $users = User::whereHas(
            'role',
            function ($q) {
                $q->where('name', 'Head of Department');
            }
        )->get();
        $this->universityTemplate('department.add', __('Add Department'), [
            'colleges' => $colleges,
            'users' => $users,
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
            'name' => ['required', 'unique:departments', 'min:3', 'max:255'],
            'user' => ['required', new in_list('users')],
            'college' => ['required', new in_list('colleges')],
        ]);
        $department = new Department;
        $department->name = $request->post('name');
        $department->user_id = $request->post('user');
        $department->college_id = $request->post('college');
        if (!$department->save()) {
            return redirect()->route('university.department.index')->with('error', __('an error occurred'));
        }
        return redirect()->route('university.department.index')->with('success', __('Add success'));
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
        $department = Department::find($id);
        if ($department == null) {
            return redirect()->route('university.department.index')->with('error', __('not fond') . ' ' . __('Department'));
        } else {
            $colleges = College::all();
            $users = User::whereHas(
                'role',
                function ($q) {
                    $q->where('name', 'Head of Department');
                }
            )->get();
            $this->universityTemplate('department.edit', __('Edit Department'), [
                'department' => $department,
                'colleges' => $colleges,
                'users' => $users,
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
        $validated = $request->validate([
            'name' => ['required', 'unique:departments', 'min:3', 'max:255'],
            'user' => ['required', new in_list('users')],
            'college' => ['required', new in_list('colleges')],
        ]);
        $department = Department::find($id);
        $department->name = $request->post('name');
        $department->user_id = $request->post('user');
        $department->college_id = $request->post('college');
        if (!$department->save()) {
            return redirect()->route('university.department.index')->with('error', __('an error occurred'));
        }
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
        $Department = Department::find($id);
        if ($Department == null) {
            return redirect()->route('university.department.index')->with('error', __('not fond') . ' ' . __('Department'));
        }
        $Department->delete();
        return redirect()->route('university.department.index')->with('success', __('delete success'));
    }
}
