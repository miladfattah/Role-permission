<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
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
});

require __DIR__.'/auth.php';
