<?php

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

Route::get('/student', function () {
    return view('student.registerform');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('/ResetPassword', 'App\Http\Controllers\Student\RegisterStudentController@customReset');
//Route::get('/ResetPassword/{id}', 'App\Http\Controllers\Student\RegisterStudentController@passwordReset');
//Route::get('/ResetPassword/{id}', 'App\Http\Controllers\Auth\PasswordResetLinkController@store');

//Route::post('/ResetPassword', 'App\Http\Controllers\Student\RegisterStudentController@Store');
Route::post('/ResetPassword', 'App\Http\Controllers\Auth\PasswordResetLinkController@store');
require __DIR__.'/auth.php';
