<?php

use App\ChartData\YearlyVisitsByClinicChartData;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TreatmentConfigController;
use App\Http\Controllers\TreatmentTypeReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\ChartData\YearlyVisitsChartData;
use App\Http\Controllers\AssignedUserRoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserUpdatePasswordController;
use Illuminate\Http\Request;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'appName' => config('app.name')
    ]);
});




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {


    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index')->middleware('can:viewAny,view');
        Route::get('edit/{user}', [UserController::class, 'edit'])->name('users.edit')->can('edit users');
        Route::put('edit/{user}', [UserController::class, 'update'])->name('users.update')->can('edit users');
        Route::get('show/{user}', [UserController::class, 'show'])->name('users.show')->can('view users');

        //assigned.user_role
        Route::post('assigned/user/roles/{user}', [AssignedUserRoleController::class, 'index'])->name('users.assigned.role')->can('edit users');

        Route::get('update/password/{user}', [UserUpdatePasswordController::class, 'index'])->name('users.update.password')->can('edit users');
        Route::put('update/password/{user}', [UserUpdatePasswordController::class, 'update'])->name('users.update.password')->can('edit users');
        //users.update.password
        //show
    });


    Route::prefix('visits')->group(function () {
        Route::get('/', [VisitController::class, 'index'])->name('visits.index')->can('view visits');
        Route::get('view/{visit}', [VisitController::class, 'show'])->name('visits.show')->can('view visits');
        Route::get('edit/{visit}', [VisitController::class, 'edit'])->name('visits.edit')->can('edit visits');
        Route::put('update/{visit}', [VisitController::class, 'update'])->name('visits.update')->can('edit visits');
        Route::get('create', [VisitController::class, 'create'])->name('visits.create')->can('create visits');
        Route::post('create', [VisitController::class, 'store'])->name('visits.store')->can('create visits');
    });

    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('settings.index')->can('view settings');
        Route::get('/treatment/config', [TreatmentConfigController::class, 'index'])->name('settings.treatment.config');
        Route::get('/treatment/config/add', [TreatmentConfigController::class, 'create'])->name('settings.treatment.add');
        Route::post('/treatment/config/add', [TreatmentConfigController::class, 'store'])->name('settings.treatment.store');
        Route::get('/roles_and_permissions',[RolePermissionController::class,'index'])->name('settings.role_and_permissions');
        Route::get('/roles_and_permissions/show/{role}',[RolePermissionController::class,'show'])->name('settings.role_and_permissions.show');
        Route::get('/roles_and_permissions/edit/{role}',[RolePermissionController::class,'edit'])->name('settings.role_and_permissions.edit');
        Route::get('/roles_and_permissions/create/new',[RolePermissionController::class,'create'])->name('settings.role_and_permissions.add');
        Route::post('/roles_and_permissions/create/new',[RolePermissionController::class,'store'])->name('settings.role_and_permissions.store');
    });



    Route::prefix('employees')->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('employees.index');
    });



    Route::prefix('reports')->group(function () {
        Route::get('/', [ReportsController::class, 'index'])->name('reports.index');
        Route::get('/monthly', [ReportsController::class, 'monthly'])->name('reports.monthly');
        Route::get('/family', [ReportsController::class, 'familyReport'])->name('reports.family');
        Route::get('/custom-date', [ReportsController::class, 'customDate'])->name('reports.custom_date');
        Route::get('/treatment_type', [ReportsController::class, 'treatmentType'])->name('reports.treatment_type');
        Route::get('/treatment_type/{id}', [TreatmentTypeReportController::class, 'showTreatmentTypeDetailsByID'])->name('reports.showTreatmentTypeDetailsByID');


    });

    Route::prefix('partners')->group(function () {
        Route::get('/', [ClinicController::class, 'index'])->name('partners.index')->can('view partners');
    });





    Route::get('/dashboard', function (Request $request) {

        $data = ($request->reportType == 2) ? YearlyVisitsByClinicChartData::data() : YearlyVisitsChartData::data() ;

        // dd($clinics);
        return Inertia::render('Dashboard',[
            'chart_data' =>     $data ,
            'filters' =>  $request->only(['reportType'])
        ]);
    })->name('dashboard');
});
