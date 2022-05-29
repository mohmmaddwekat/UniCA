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
    'middleware' =>  ['auth'],
], function () {
    Route::post('/change/{year}/{semester}/{track}', [DashboardController::class, 'changeCourse'])->name('change');
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

// Roles Route
Route::group([
    'prefix' => '/roles',
    'as' => 'roles.role.',
    'middleware' =>  ['auth'],
], function () {
    Route::get('/', [RoleController::class, 'index'])->name('index');
    Route::get('/add', [RoleController::class, 'create'])->name('add');
    Route::post('/save', [RoleController::class, 'store'])->name('save');
    Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [RoleController::class, 'update'])->name('update');
});
// Roles Route
Route::group([
    'prefix' => '/permission',
    'as' => 'permission.',
    'middleware' =>  ['auth'],
], function () {
    Route::get('/', [PermissionController::class, 'index'])->name('index');
    Route::get('/add', [PermissionController::class, 'create'])->name('add');
    Route::post('/save', [PermissionController::class, 'store'])->name('save');
    Route::get('/edit/{permission}', [PermissionController::class, 'edit'])->name('edit');
    Route::post('/update/{permission}', [PermissionController::class, 'update'])->name('update');
    Route::get('/delete/{permission}', [PermissionController::class, 'destroy'])->name('delete');
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
        Route::get('/export/course', [ExcelControler::class, 'exportCoure'])->name('export.course');
        Route::get('/export/student', [ExcelControler::class, 'exportStudent'])->name('export.student');
        Route::get('/import/student', [ExcelControler::class, 'showImportStudent'])->name('import.student.show');
        Route::post('/impor/student', [ExcelControler::class, 'importStudent'])->name('import.student.store');
        Route::get('/import/course', [ExcelControler::class, 'showImportCourse'])->name('import.course.show');
        Route::post('/import/course', [ExcelControler::class, 'importCourse'])->name('import.course.store');
        Route::get('/', [DepartmentController::class, 'index'])->name('index');
        Route::get('/add', [DepartmentController::class, 'create'])->name('add');
        Route::post('/save', [DepartmentController::class, 'store'])->name('save');
        Route::get('/edit/{id}', [DepartmentController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [DepartmentController::class, 'update'])->name('update');
        Route::post('/delete/{id}', [DepartmentController::class, 'destroy'])->name('delete');
    });

    // College Route
    Route::group([
        'prefix' => '/college',
        'as' => 'college.',
        'where' => [
            'id' => '[0-9]+',
        ],
    ], function () {
        Route::get('/', [CollegeController::class, 'index'])->name('index');
        Route::get('/add', [CollegeController::class, 'create'])->name('add');
        Route::post('/save', [CollegeController::class, 'store'])->name('save');
        Route::get('/edit/{id}', [CollegeController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [CollegeController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [CollegeController::class, 'destroy'])->name('delete');

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
        Route::get('/', [ComplaintsFormController::class, 'index'])->name('index');
        Route::get('/create', [ComplaintsFormController::class, 'create'])->name('create');
        Route::post('/store', [ComplaintsFormController::class, 'store'])->name('store');
        //Route::get('/edit/{form}',[ComplaintsFormController::class,'edit'])->name('edit');
        //Route::post('/update/{form}',[ComplaintsFormController::class,'update'])->name('update');
        Route::get('/delete/{form}', [RoleController::class, 'destroy'])->name('delete');
    });

    //Details Route
    Route::group([
        'prefix' => '/details',
        'as' => 'details.',
    ], function () {
        Route::get('/', [ComplaintsDetailsController::class, 'defult'])->name('index');
        Route::get('/group', [ComplaintsDetailsController::class, 'group'])->name('group');
        Route::get('/complaintForStudent', [ComplaintsDetailsController::class, 'complaintForStudent'])->name('complaintForStudent');

        Route::get('/complaint-decline/{complaintUser}/{typeComplaint?}', [ComplaintsDetailsController::class, 'complaintDecline'])->name('complaintDecline');
        Route::get('/complaint-resolved/{complaintUser}/{typeComplaint?}', [ComplaintsDetailsController::class, 'complaintResolved'])->name('complaintResolved');
        Route::get('/complaint-deanDepartment/{complaintUser}/{typeComplaint?}', [ComplaintsDetailsController::class, 'complaintDeanDepartment'])->name('complaintDeanDepartment');
    });
});
