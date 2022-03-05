<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\UniversityController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\University\CollegeController;
use App\Http\Controllers\University\DepartmentController;
use App\Http\Controllers\University\RoleController;

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



//////////////////



Route::group([
    'prefix' => '/admin',
    'as' => 'admin.',
    ], function () {
        Route::group([

            'prefix' => '/universities',
            'as' => 'universities.',
        ], function () {
            Route::get('/', [UniversityController::class, 'index'])->name('index');
            Route::get('/create', [UniversityController::class, 'create'])->name('create');
            Route::post('/', [UniversityController::class, 'store'])->name('store');
            Route::get('/{university}', [UniversityController::class, 'edit'])->name('edit');
            Route::put('/{university}', [UniversityController::class, 'update'])->name('update');
            Route::delete('/{university}', [UniversityController::class, 'destroy'])->name('destroy');

        });
                
        //City Controller
        Route::group([

            'prefix' => '/cities',
            'as' => 'cities.',
        ], function () {
            Route::get('/', [CityController::class, 'index'])->name('index');
            Route::get('/create', [CityController::class, 'create'])->name('create');
            Route::post('/', [CityController::class, 'store'])->name('store');
            Route::get('/{city}', [CityController::class, 'edit'])->name('edit');
            Route::put('/{city}', [CityController::class, 'update'])->name('update');
            Route::delete('/{city}', [CityController::class, 'destroy'])->name('destroy');
        });

        //user Controller
        Route::group([

            'prefix' => '/users',
            'as' => 'users.',
        ], function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/', [UserController::class, 'store'])->name('store');
            Route::get('/{user}', [UserController::class, 'edit'])->name('edit');
            Route::put('/{user}', [UserController::class, 'update'])->name('update');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
        });

});


Route::group([
    'prefix'=>'/university',
    'as'=>'university.',
],function(){
    Route::group([
        'prefix'=>'/role',
        'as'=>'role.',
    ],function(){
        Route::get('/',[RoleController::class,'index'])->name('index');
        Route::get('/add',[RoleController::class,'create'])->name('add');
        Route::post('/save',[RoleController::class,'store'])->name('save');
        Route::get('/edit/{id}',[RoleController::class,'edit'])->name('edit');
        Route::post('/update/{id}',[RoleController::class,'update'])->name('update');
        Route::get('/delete/{id}',[RoleController::class,'destroy'])->name('delete');
    });
    Route::group([
    'prefix'=>'/department',
    'as'=>'department.',
    'where' => [
        'id'=>'[0-9]+',
    ],
    ],function(){
        Route::get('/',[DepartmentController::class,'index'])->name('index');
        Route::get('/add',[DepartmentController::class,'create'])->name('add');
        Route::post('/save',[DepartmentController::class,'store'])->name('save');
        Route::get('/edit/{id}',[DepartmentController::class,'edit'])->name('edit');
        Route::post('/update/{id}',[DepartmentController::class,'update'])->name('update');
        Route::post('/delete/{id}',[DepartmentController::class,'destroy'])->name('delete');
    });
    Route::group([
    'prefix'=>'/college',
    'as'=>'college.',
    'where' => [
        'id'=>'[0-9]+',
    ],
    ],function(){
        Route::get('/',[CollegeController::class,'index'])->name('index');
        Route::get('/add',[CollegeController::class,'create'])->name('add');
        Route::post('/save',[CollegeController::class,'store'])->name('save');
        Route::get('/edit/{id}',[CollegeController::class,'edit'])->name('edit');
        Route::post('/update/{id}',[CollegeController::class,'update'])->name('update');
        Route::post('/delete/{id}',[CollegeController::class,'destroy'])->name('delete');
    });
});
