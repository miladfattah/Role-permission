<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\UsersController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware(['auth' , 'role:admin'])->name('admin.')->prefix('admin')->group(function(){
    Route::get('/' , [IndexController::class , 'index'])->name('index');
    Route::resource('/roles' , RoleController::class);
    Route::post('/roles/{role}/permission' , [RoleController::class , 'givePermission'])->name('roles.give-permission');
    Route::delete('/roles/{role}/permission/{permission}' , [RoleController::class , 'revokePermission'])->name('roles.revoke');
    Route::resource('/permission' , PermissionController::class);
    Route::post('/permission/{permission}/permission' , [PermissionController::class , 'assignRole'])->name('role.assign');
    Route::delete('/permission/{permission}/role/{role}' , [PermissionController::class , 'removeRole'])->name('role.remove');
    Route::get('/users' , [UsersController::class , 'index'])->name('users.index');
    Route::delete('/users' , [UsersController::class , 'destroy'])->name('users.destroy');
    Route::get('/users/{user}' , [UsersController::class , 'show'])->name('user.show');
    Route::post('/users/{user}/role' , [UsersController::class , 'assignRole'])->name('user.assign.role');
    Route::post('/users/{user}/permission' , [UsersController::class , 'assignPermission'])->name('user.assign.permission');
    Route::delete('/users/{user}/permission/{permission}' , [UsersController::class , 'revokePermission'])->name('user.revoke.permission');
    Route::delete('/users/{user}/roles/{role}' , [UsersController::class , 'removeRole'])->name('user.remove.role');
    
});

require __DIR__.'/auth.php';
