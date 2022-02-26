<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\UniversityController;
use App\Http\Controllers\University\AcademicViceController;
use App\Http\Controllers\University\CollegeController;
use App\Http\Controllers\University\DepartmentController;
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

Route::group([
    'prefix' => '/admin',
    'as' => 'admin.',
    ], function () {
        
        //university Controller
        Route::get('/universities/trash', [UniversityController::class, 'trash'])->name('universities.trash');
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
        Route::get('/cities/trash', [CityController::class, 'trash'])->name('cities.trash');
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

});


Route::group([
    'prefix'=>'/university',
    'as'=>'university.',
],function(){
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
    });
});

