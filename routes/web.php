<?php

use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\UniversityController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Complaint\ComplaintsDetailsController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Roles\RoleController;
use App\Http\Controllers\Complaint\ComplaintsFormController;
use App\Http\Controllers\HeadDepartment\ExcelControler;
use App\Http\Controllers\Student\CourseController;
use App\Http\Controllers\HeadDepartment\SuggestionController;
use App\Http\Controllers\Roles\PermissionController;
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


require __DIR__ . '/auth.php';

Route::group([
    'prefix' => '/dashboard',
    'as' => 'dashboard.',
    'middleware' =>  ['auth'],
], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
});
Route::group([
    'prefix' => '/course',
    'as' => 'course.',
    'middleware' =>  ['auth','permission:show course'],
], function () {
    Route::post('/change/{year}/{semester}/{track}', [DashboardController::class, 'changeCourse'])->name('change')
    ->middleware('permission:show course');
    Route::post('/year/{year}', [DashboardController::class, 'yearCourse'])->name('year');
    Route::post('/store', [CourseController::class, 'store'])->name('add');
});

// Admin Route
Route::group([
    'prefix' => '/admin',
    'as' => 'admin.',
    'middleware' =>  ['auth'],
], function () {

    // Universities Route
    Route::group([

        'prefix' => '/universities',
        'as' => 'universities.',
    ], function () {
        Route::get('/', [UniversityController::class, 'index'])->name('index')
        ->middleware('permission:show universities');
        Route::get('/create', [UniversityController::class, 'create'])->name('create')
        ->middleware('permission:add universities');
        Route::post('/', [UniversityController::class, 'store'])->name('store')
        ->middleware('permission:add universities');
        Route::get('/{university}', [UniversityController::class, 'edit'])->name('edit')
        ->middleware('permission:edit universities');
        Route::put('/{university}', [UniversityController::class, 'update'])->name('update')
        ->middleware('permission:edit universities');
        Route::delete('/{university}', [UniversityController::class, 'destroy'])->name('destroy')
        ->middleware('permission:delete universities');
    });

    //City Controller
    Route::group([

        'prefix' => '/cities',
        'as' => 'cities.',
    ], function () {
        Route::get('/', [CityController::class, 'index'])->name('index')
        ->middleware('permission:show cities'); 
        Route::get('/create', [CityController::class, 'create'])->name('create')
        ->middleware('permission:add cities'); 
        Route::post('/', [CityController::class, 'store'])->name('store')
        ->middleware('permission:add cities'); 
        Route::get('/{city}', [CityController::class, 'edit'])->name('edit')
        ->middleware('permission:edit cities'); 
        Route::put('/{city}', [CityController::class, 'update'])->name('update')
        ->middleware('permission:edit cities'); 
        Route::delete('/{city}', [CityController::class, 'destroy'])->name('destroy')
        ->middleware('permission:delete cities'); 
    });

    //user Controller
    Route::group([

        'prefix' => '/users',
        'as' => 'users.',
    ], function () {
        Route::get('/', [UserController::class, 'index'])->name('index')
        ->middleware('permission:show users'); 
        Route::get('/create', [UserController::class, 'create'])->name('create')
        ->middleware('permission:add users'); 
        Route::post('/', [UserController::class, 'store'])->name('store')
        ->middleware('permission:add users'); 
        Route::get('/{user}', [UserController::class, 'edit'])->name('edit')
        ->middleware('permission:edit users'); 
        Route::put('/{user}', [UserController::class, 'update'])->name('update')
        ->middleware('permission:edit users'); 
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy')
        ->middleware('permission:delete users'); 
    });
});

// Roles Route
Route::group([
    'prefix' => '/roles',
    'as' => 'roles.role.',
    'middleware' =>  ['auth'],
], function () {
    Route::get('/', [RoleController::class, 'index'])->name('index')
    ->middleware('permission:show roles');
    Route::get('/add', [RoleController::class, 'create'])->name('add')
    ->middleware('permission:add roles');
    Route::post('/save', [RoleController::class, 'store'])->name('save')
    ->middleware('permission:add roles');
    Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit')
    ->middleware('permission:edit roles');
    Route::post('/update/{id}', [RoleController::class, 'update'])->name('update')
    ->middleware('permission:edit roles');
});
// Roles Route
Route::group([
    'prefix' => '/permission',
    'as' => 'permission.',
    'middleware' =>  ['auth'],
], function () {
    Route::get('/', [PermissionController::class, 'index'])->name('index')
    ->middleware('permission:show permission');
    Route::get('/add', [PermissionController::class, 'create'])->name('add')
    ->middleware('permission:add permission');
    Route::post('/save', [PermissionController::class, 'store'])->name('save')
    ->middleware('permission:add permission');
    Route::get('/edit/{permission}', [PermissionController::class, 'edit'])->name('edit')
    ->middleware('permission:edit permission');
    Route::post('/update/{permission}', [PermissionController::class, 'update'])->name('update')
    ->middleware('permission:edit permission');
    Route::get('/delete/{permission}', [PermissionController::class, 'destroy'])->name('delete')
    ->middleware('permission:delete permission');
});

// University Route

Route::group([
    'prefix' => '/university',
    'as' => 'university.',
    'middleware' =>  ['auth'],
], function () {

    // Department Route
    Route::group([
        'prefix' => '/department',
        'as' => 'department.',
        'where' => [
            'id' => '[0-9]+',
        ],
    ], function () {

        // Roles Route
        Route::get('/export/course', [ExcelControler::class, 'exportCoure'])->name('export.course')
        ->middleware('permission:import course');

        Route::get('/export/student', [ExcelControler::class, 'exportStudent'])->name('export.student')
        ->middleware('permission:import student');

        Route::get('/import/student', [ExcelControler::class, 'showImportStudent'])->name('import.student.show')
        ->middleware('permission:import student');

        Route::post('/import/student', [ExcelControler::class, 'importStudent'])->name('import.student.store')
        ->middleware('permission:import student');

        Route::get('/import/course', [ExcelControler::class, 'showImportCourse'])->name('import.course.show')
        ->middleware('permission:import course');

        Route::post('/import/course', [ExcelControler::class, 'importCourse'])->name('import.course.store')
        ->middleware('permission:import course');

        Route::get('/', [DepartmentController::class, 'index'])->name('index')
        ->middleware('permission:show department');
        
        Route::get('/add', [DepartmentController::class, 'create'])->name('add')
        ->middleware('permission:add department');
        Route::post('/save', [DepartmentController::class, 'store'])->name('save')
        ->middleware('permission:add department');
        Route::get('/edit/{id}', [DepartmentController::class, 'edit'])->name('edit')
        ->middleware('permission:edit department');
        Route::post('/update/{id}', [DepartmentController::class, 'update'])->name('update')
        ->middleware('permission:edit department');
        Route::post('/delete/{id}', [DepartmentController::class, 'destroy'])->name('delete')
        ->middleware('permission:delete department');
    });

    // College Route
    Route::group([
        'prefix' => '/college',
        'as' => 'college.',
        'where' => [
            'id' => '[0-9]+',
        ],
    ], function () {
        Route::get('/', [CollegeController::class, 'index'])->name('index')
        ->middleware('permission:show college');
        Route::get('/add', [CollegeController::class, 'create'])->name('add')
        ->middleware('permission:add college');
        Route::post('/save', [CollegeController::class, 'store'])->name('save')
        ->middleware('permission:add college');
        Route::get('/edit/{id}', [CollegeController::class, 'edit'])->name('edit')
        ->middleware('permission:edit college');
        Route::post('/update/{id}', [CollegeController::class, 'update'])->name('update')
        ->middleware('permission:edit college');
        Route::get('/delete/{id}', [CollegeController::class, 'destroy'])->name('delete')
        ->middleware('permission:delete college');

    });

});

// Complaints Route
Route::group([
    'prefix' => '/complaints',
    'as' => 'complaints.',
    'middleware' =>  ['auth'],
], function () {
    //Form Route
    Route::group([
        'prefix' => '/form',
        'as' => 'form.',
    ], function () {
        Route::get('/', [ComplaintsFormController::class, 'index'])->name('index')
        ->middleware('permission:show form complaints');
        Route::get('/create', [ComplaintsFormController::class, 'create'])->name('create')
        ->middleware('permission:add form complaints');
        Route::post('/store', [ComplaintsFormController::class, 'store'])->name('store')
        ->middleware('permission:add form complaints');
    });

    //Details Route
    Route::group([
        'prefix' => '/details',
        'as' => 'details.',
    ], function () {
        Route::get('/', [ComplaintsDetailsController::class, 'defult'])->name('index')
        ->middleware('permission:show details complaints');
        Route::get('/group', [ComplaintsDetailsController::class, 'group'])->name('group')
        ->middleware('permission:show details complaints');
        Route::get('/complaintForStudent', [ComplaintsDetailsController::class, 'complaintForStudent'])->name('complaintForStudent')
        ->middleware('permission:show details complaints');

        Route::get('/complaint-decline/{complaintUser}/{typeComplaint?}', [ComplaintsDetailsController::class, 'complaintDecline'])->name('complaintDecline')
        ->middleware('permission:show details complaints');
        Route::get('/complaint-resolved/{complaintUser}/{typeComplaint?}', [ComplaintsDetailsController::class, 'complaintResolved'])->name('complaintResolved')
        ->middleware('permission:show details complaints');
        Route::get('/complaint-deanDepartment/{complaintUser}/{typeComplaint?}', [ComplaintsDetailsController::class, 'complaintDeanDepartment'])->name('complaintDeanDepartment')
        ->middleware('permission:show details complaints');
    });
});
