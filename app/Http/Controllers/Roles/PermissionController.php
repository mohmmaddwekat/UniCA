<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Roles\Controller;

use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Rules\alpha_spaces;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $permissions = Permission::all();
        $this->roleTemplate('permission.index', 'Permissions', ['permissions' => $permissions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->roleTemplate('permission.add', 'Add Permission');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePermissionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermissionRequest $request)
    {
        //
        Permission::create(['name' => $request->name]);
        return redirect()->route('permission.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Roles\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Roles\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        //

        $this->roleTemplate('permission.edit', 'Edit Permission', ['permission' => $permission]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissionRequest  $request
     * @param  \App\Models\Roles\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        //
        Permission::where('id','=',$permission->id)->first()->update([
            'name' =>$request->name,
        ]);
        return redirect()->route('permission.index');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Roles\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        //
        if ($permission == null) {
            return redirect()->route('permission.index')->with('error', __('not fond') . ' ' . __('college'));
        }
        if ($permission->roles()->get()->count() != 0) {
            return  redirect()->route('permission.index')->with('error', __('Can\'t delete'));
        }
        Permission::destroy($permission->id);
        return redirect()->route('permission.index');
    }
}
