<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class PermissionController extends Controller
{
    public function index(){
        $permissions = Permission::all();
        return view('admin.permission.index' , compact('permissions'));
    } 

    public function create(){
        return view('admin.permission.create');
    }

    public function store(Request $request){
        $permission = $request->validate([
            'name' => 'required|min:3|unique:permissions'
        ]);

        Permission::create($permission);
        return to_route('admin.permission.index');
    }

    public function edit(Permission $permission){
        $roles = Role::all();
        return view('admin.permission.edit' , compact('permission'  , 'roles'));
    }

    public function update(Request $request , Permission $permission){
        $newPermission = $request->validate([
            'name' => 'required|min:3|unique:permissions'
        ]);

        $permission->update($newPermission);
        return to_route('admin.permission.index');
    }

    public function destroy( Permission $permission){
        $permission->delete();
        return to_route('admin.permission.index');
    }

    public function assignRole(Request $request , Permission $permission  ){
        if($permission->hasRole($request->role)){
            return back();
        }
        $permission->assignRole($request->role);
        return back();
    }

    public function removeRole( Permission $permission , Role $role ){
     
        if($permission->hasRole($role)){
            $permission->removeRole($role);
            return back();
        }
        return back();
    }
}
