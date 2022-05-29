<?php

namespace App\Http\Controllers\Roles;
use App\Http\Controllers\Roles\Controller;


use App\Models\User;
use App\Rules\alpha_num_spaces;
use App\Rules\in_list;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Role::all(); 
        $this->roleTemplate('roles.index',__('Roles'),['roles'=>$roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $permissions = Permission::all();
        $this->roleTemplate('roles.add',__('Add role'),[
            'permissions'=>$permissions,
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
        $request->validate([
        'name' => ['required',new alpha_num_spaces,'min:3','max:255'],
        'permissions' => ['required', new in_list('permissions')],
        ]);
        $role = new Role;
        $role->name = $request->post('name');
        if(!$role->save()){
            return redirect()->route('roles.role.index')->with('error',__('an error occurred'));
        }
        $role->permissions()->attach($request->post('permissions',[]));
        return redirect()->route('roles.role.index')->with('success',__('Add success'));
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
        
        $role = Role::find($id);
        if ( $role == null) {
            return redirect()->route('roles.role.index')->with('error',__('not fond').' '.__('role'));
        } else {
            $role_permissions = $role->permissions()->pluck('id')->toArray();
            $permissions = Permission::all()->sortBy('id');
            $this->roleTemplate('roles.edit',__('Edit role'),[
                'role'=>$role,
                'permissions'=>$permissions,
                'role_permissions'=>$role_permissions,
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
        'name' => ['required',new alpha_num_spaces,'min:3','max:255'],
        'permissions' => ['required', new in_list('permissions')],
        ]);
        $role = Role::find($id);;   
        $role->name = $request->post('name');
        if(!$role->save()){
            return redirect()->route('roles.role.index')->with('error',__('an error occurred'));
        }
        $role->permissions()->sync($request->post('permissions',[]));
        return redirect()->route('roles.role.index')->with('success',__('Edit success'));
    }

}