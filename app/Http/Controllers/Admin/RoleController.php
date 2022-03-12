<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleController extends Controller
{
    public function index(){
        $roles = Role::whereNotIn('name' , ['admin'])->get();
        return view('admin.role.index' , compact('roles'));
    } 

    public function create(){
        return view('admin.role.create');
    }

    public function store(Request $request){
        $role = $request->validate([
            'name' => 'required|min:3|unique:roles'
        ]);

        Role::create($role);
        return to_route('admin.roles.index');
    }

    public function edit(Role $role){
        $permissions = Permission::all();
        return view('admin.role.edit' , compact('role' , 'permissions'));
    }

    public function update(Request $request , Role $role){
        $newRole = $request->validate([
            'name' => 'required|min:3|unique:roles'
        ]);

        $role->update($newRole);
        return to_route('admin.roles.index');
    }

    public function destroy(Role $role){
        $role->delete();
        return to_route('admin.roles.index');
    }

    public function givePermission(Request $request , Role $role  ){
        if($role->hasPermissionTo($request->permission)){
            return back();
        }
        $role->givePermissionTo($request->permission);
        return back();
    }

    public function revokePermission(Role $role , Permission $permission){
     
        if($role->hasPermissionTo($permission->name)){
            $role->revokePermissionTo($permission);
            return back();
        }
        return back();
    }
}
