<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/userinfo', function(){
    return view('userinfo');
})->name('userinfo');


Route::resource('/blog', BlogController::class);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/userlist', [App\Http\Controllers\AdminController::class, 'userlist'])->name('userlist');
Route::post('/adminadd/{id}', [App\Http\Controllers\AdminController::class, 'adminadd'])->name('adminadd');
Route::post('/useradd/{id}', [App\Http\Controllers\AdminController::class, 'useradd'])->name('useradd');
Route::post('/activeuser/{id}', [App\Http\Controllers\AdminController::class, 'activeuser'])->name('activeuser');
Route::post('/banuser/{id}', [App\Http\Controllers\AdminController::class, 'banuser'])->name('banuser');
Route::post('/suspenduser/{id}', [App\Http\Controllers\AdminController::class, 'suspenduser'])->name('suspenduser');
Route::post('/deleteuser/{id}', [App\Http\Controllers\AdminController::class, 'deleteuser'])->name('deleteuser');

