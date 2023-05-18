<?php

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
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('edit/{user}', [UserController::class, 'index'])->name('users.edit');
        Route::get('show/{user}', [UserController::class, 'index'])->name('users.show');
        Route::get('update/password/{user}', [UserController::class, 'index'])->name('users.update.password');
        //users.update.password

        //show
    });


    Route::prefix('visits')->group(function () {
        Route::get('/', [VisitController::class, 'index'])->name('visits.index');
        Route::get('view/{visit}', [VisitController::class, 'show'])->name('visits.show');
        Route::get('edit/{visit}', [VisitController::class, 'edit'])->name('visits.edit');
        Route::put('update/{visit}', [VisitController::class, 'update'])->name('visits.update');
        Route::get('create', [VisitController::class, 'create'])->name('visits.create');
        Route::post('create', [VisitController::class, 'store'])->name('visits.store');
    });

    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('settings.index');
        Route::get('/treatment/config', [TreatmentConfigController::class, 'index'])->name('settings.treatment.config');
        Route::get('/treatment/config/add', [TreatmentConfigController::class, 'create'])->name('settings.treatment.add');
        Route::post('/treatment/config/add', [TreatmentConfigController::class, 'store'])->name('settings.treatment.store');
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
        Route::get('/', [ClinicController::class, 'index'])->name('partners.index');
    });





    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard',[
            'chart_data' => YearlyVisitsChartData::data()
        ]);
    })->name('dashboard');
});
