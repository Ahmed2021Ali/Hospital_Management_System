<?php

use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\SectionController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Livewire\Livewire;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {
################################   User Dashboard  #######################################
    Route::get('/dashboard/user', function () {
        return view('Dashboard.Users.dashboard');
    })->middleware(['auth'])->name('dashboard.user');
########################## End Dashboard  ###############################################

########################## Admin Dashboard  ###############################################
    Route::get('/dashboard/admin', function () {
        return view('Dashboard.Admin.dashboard');
    })->middleware(['auth:admin'])->name('dashboard.admin');
########################## End  Dashboard  ###############################################

    Route::middleware(['auth'])->group(function () {

########################## Section Route  ###############################################
        Route::resource('Section', SectionController::class);
########################## End  Section Route  ###########################################

########################## Doctor Route  ###############################################
        Route::resource('Doctor', DoctorController::class);
        Route::prefix('doctors')->controller(DoctorController::class)->as('Doctors.')->group(function () {
            Route::delete('deleteSelected/Doctors')->name('deleteSelected');
            Route::patch('update/password/{Doctor}')->name('update.password');
            Route::patch('update/status/{Doctor}')->name('update.status');
        });
########################## End  Doctor Route  ###########################################

########################## service Route  ###############################################
        Route::resource('service', \App\Http\Controllers\Dashboard\ServiceController::class)->except('create', 'edit');
########################## End  service Route  ###########################################

########################## Group Liveware Route  ###############################################
        Route::view('group/Services', 'livewire.group-services.include-livewire')->name('GruopService');
        Livewire::setUpdateRoute(function ($handle){
            return Route::post('liveewire/update',$handle);
        });
########################## End  Liveware Route  ##########################################
    });


    require __DIR__ . '/auth.php';

});




