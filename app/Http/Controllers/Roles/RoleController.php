<?php

namespace App\Http\Controllers\Roles;
use App\Http\Controllers\Roles\Controller;


use App\Models\Roles\Role;
use App\Models\Roles\Permission;

use App\Models\User;
use App\Rules\alpha_num_spaces;
use App\Rules\in_list;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $this->roleTemplate('index',__('Roles'),['roles'=>$roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = User::all();
        $permissions = Permission::all()->sortBy('id');
        $codes =[];
        foreach ($permissions as $permission) {
            $code = str_replace("university.","",$permission->code);
            $name = $permission->name;
            if ($permission->name =='List') {
                $name = 'index';
            }else if ($permission->name =='Create'){
                $name = 'add';
            }
            $code = str_replace('.'.strtolower($name),"",$code);
            $code = str_replace('.'," ",$code);
            array_push($codes,$code);
        }
        $countValue = array_count_values($codes);
        $data = [];
        foreach($countValue as $key=>$value){
            array_push($data,[$key,DB::table('permissions')->where('code','LIKE','%'.'university.'.str_replace(' ',".",$key).'%')->get()->toArray()]);
        }
        $this->roleTemplate('add',__('Add role'),[
            'users'=>$users,
            'permissions'=>$data,
            'countValue'=>$countValue,
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
            $codes =[];
            foreach ($permissions as $permission) {
                $code = str_replace("university.","",$permission->code);
                $name = $permission->name;
                if ($permission->name =='List') {
                    $name = 'index';
                }else if ($permission->name =='Create'){
                    $name = 'add';
                }
                $code = str_replace('.'.strtolower($name),"",$code);
                $code = str_replace('.'," ",$code);
                array_push($codes,$code);
            }
            $countValue = array_count_values($codes);
            $data = [];
            foreach($countValue as $key=>$value){
                array_push($data,[$key,DB::table('permissions')->where('code','LIKE','%'.'university.'.str_replace(' ',".",$key).'%')->get()->toArray()]);
            }
            $this->roleTemplate('edit',__('Edit role'),[
                'role'=>$role,
                'permissions'=>$data,
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $role = Role::find($id);
        if ($role ==null) {
            return redirect()->route('roles.role.index')->with('error',__('not fond').' '.__('role'));
        }
        if ($role->users()->pluck('id')->toArray()) {
            return redirect()->route('roles.role.index')->with('error',__('This Roles cannot be deleted'));
        } 
        $role->delete();
        $role->permissions()->detach();
        return redirect()->route('roles.role.index')->with('success',__('delete success'));
    }
}