<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersController extends Controller
{
    public function index(){
        $users = User::all();
        return view('admin.users.index' , compact('users'));
    }

    public function show(User $user){
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.users.show' , compact('user' , 'roles' , 'permissions'));
    }

    public function assignPermission(User $user , Request $request){
        if($user->hasPermissionTo($request->permission)){
            return back();
        }
        $user->givePermissionTo($request->permission);
        return back();
    }

    public function revokePermission(User $user , Permission $permission){
     
        if($user->hasPermissionTo($permission->name)){
            $user->revokePermissionTo($permission);
            return back();
        }
        return back();
    }

    public function assignRole(User $user , Request $request ){
        if($user->hasRole($request->role)){
            return back();
        }
        $user->assignRole($request->role);
        return back();
    }

    public function removeRole( User $user , Role $role ){
     
        if($user->hasRole($role)){
            $user->removeRole($role);
            return back();
        }
        return back();
    }
    public function destroy(User $user){
        $user->delete();
    }
}
