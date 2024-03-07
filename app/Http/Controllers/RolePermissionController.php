<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::with('roles')->get();
        $roles = Role::all();
        $permissions = Permission::all();
        return view('partials.Roles_permissions.index',compact('roles','permissions','users'));
    }

    //assign role to user
    public function assignRoleToUser($user_id)
    {
        $user = User::with('roles')->findOrFail($user_id);
        $roles = Role::all();
        // return $roles;
        return view('partials.Roles_permissions.assign_role_to_user',compact('user','roles'));
    }

    public function assignRolesToUser(Request $request,$user_id)
    {
       $roles = $request->roles;
       $user = User::where('id',$user_id)->first();
       $user->syncRoles($roles);
       return redirect()->route('roles-permissions.index')->with('message','Roles added to the user');

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('partials.Roles_permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' =>'required|string'
        ]);
        Permission::create($data);
        return  redirect()->route('roles-permissions.index')->with('message','Permission create');

    }

    public function assignPermissionToRolePage($role_id)
    {
        $role = Role::with('permissions')->findOrFail($role_id);
        $permissions = Permission::all();
        return view('partials.Roles_permissions.assign_permission_to_role', compact('role','permissions'));
    }

    public function assignPermissionToRole(Request $request,$role_id)
    {
        $role = Role::findOrFail($role_id);
        $role->syncPermissions($request->permissions);
        return redirect()->route('roles-permissions.index')->with('message','Assign permission to role successfully!');
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
    }
}
