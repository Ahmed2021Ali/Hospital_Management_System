<?php

use App\Models\Doctor\Doctor;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Dashboard\DashboardController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function()
    {
########################## User Dashboard  ###############################################
        Route::get('/dashboard/user', function () {
            return view('Dashboard.Users.dashboard');
        })->middleware(['auth'])->name('dashboard.user');
########################## End Dashboard  ###############################################

########################## Admin Dashboard  ###############################################
        Route::get('/dashboard/admin', function () {
            return view('Dashboard.Admin.dashboard');
        })->middleware(['auth:admin'])->name('dashboard.admin');
########################## End  Dashboard  ###############################################

Route::middleware(['auth'])->group(function(){

########################## Section Route  ###############################################
    Route::resource('Section',SectionController::class);
########################## End  Section Route  ###########################################

########################## Doctor Route  ###############################################
Route::resource('Doctor',DoctorController::class);
########################## End  Doctor Route  ###########################################


});













        require __DIR__.'/auth.php';

    });




