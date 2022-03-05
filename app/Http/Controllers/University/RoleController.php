<?php

namespace App\Http\Controllers\University;

use App\Models\University\Ability;
use App\Models\University\Role;
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
        $this->universityTemplate('role.index',__('Roles'),['roles'=>$roles]);
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
        $abilities = Ability::all()->sortBy('id');
        $codes =[];
        foreach ($abilities as $ability) {
            $code = str_replace("university.","",$ability->code);
            $name = $ability->name;
            if ($ability->name =='List') {
                $name = 'index';
            }else if ($ability->name =='Create'){
                $name = 'add';
            }
            $code = str_replace('.'.strtolower($name),"",$code);
            $code = str_replace('.'," ",$code);
            array_push($codes,$code);
        }
        $countValue = array_count_values($codes);
        $data = [];
        foreach($countValue as $key=>$value){
            array_push($data,[$key,DB::table('abilities')->where('code','LIKE','%'.'university.'.str_replace(' ',".",$key).'%')->get()->toArray()]);
        }
        $this->universityTemplate('role.add',__('Add role'),[
            'users'=>$users,
            'abilities'=>$data,
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
        'abilities' => ['required', new in_list('abilities')],
        ]);
        $role = new Role;
        $role->name = $request->post('name');
        if(!$role->save()){
            return redirect()->route('university.role.index')->with('error',__('an error occurred'));
        }
        $role->abilities()->attach($request->post('abilities',[]));
        return redirect()->route('university.role.index')->with('success',__('Add success'));
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
            return redirect()->route('university.role.index')->with('error',__('not fond').' '.__('role'));
        } else {
            $role_abilities = $role->abilities()->pluck('id')->toArray();
            $abilities = Ability::all()->sortBy('id');
            $codes =[];
            foreach ($abilities as $ability) {
                $code = str_replace("university.","",$ability->code);
                $name = $ability->name;
                if ($ability->name =='List') {
                    $name = 'index';
                }else if ($ability->name =='Create'){
                    $name = 'add';
                }
                $code = str_replace('.'.strtolower($name),"",$code);
                $code = str_replace('.'," ",$code);
                array_push($codes,$code);
            }
            $countValue = array_count_values($codes);
            $data = [];
            foreach($countValue as $key=>$value){
                array_push($data,[$key,DB::table('abilities')->where('code','LIKE','%'.'university.'.str_replace(' ',".",$key).'%')->get()->toArray()]);
            }
            $this->universityTemplate('role.edit',__('Edit role'),[
                'role'=>$role,
                'abilities'=>$data,
                'role_abilities'=>$role_abilities,
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
        'abilities' => ['required', new in_list('abilities')],
        ]);
        $role = Role::find($id);;   
        $role->name = $request->post('name');
        if(!$role->save()){
            return redirect()->route('university.role.index')->with('error',__('an error occurred'));
        }
        $role->abilities()->sync($request->post('abilities',[]));
        return redirect()->route('university.role.index')->with('success',__('Edit success'));
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
            return redirect()->route('university.role.index')->with('error',__('not fond').' '.__('role'));
        }
        if ($role->users()->pluck('id')->toArray()) {
            return redirect()->route('university.role.index')->with('error',__('This Roles cannot be deleted'));
        } 
        $role->delete();
        $role->abilities()->detach();
        return redirect()->route('university.role.index')->with('success',__('delete success'));
    }
}
