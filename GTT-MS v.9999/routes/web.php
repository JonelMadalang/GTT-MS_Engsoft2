<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserTransactionController;
use App\Http\Controllers\TaxiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProgrammerController;
use App\Http\Controllers\SettingsController;

use Illuminate\Support\Facades\Auth;
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
    return view('auth/login');
});




Route::middleware(['middleware'=>'PreventBackHistory'])->group(function () {
    Auth::routes();
});





Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'admin', 'middleware'=>['isAdmin','auth','PreventBackHistory']], function(){
    Route::get('dashboard',[AdminController::class,'index'])->name('admin.dashboard');
    Route::resource('admin',AdminController::class);
    //Route::get('drivers',[AdminController::class,'drivers'])->name('admin.drivers');
    //Route::get('register',[RegisterController::class]);
    Route::resource('transactions',TransactionController::class);
    Route::get('transactions-chart',[TransactionController::class,'showChart'])->name('transactions.chart');
    Route::resource('drivers',DriverController::class);
    Route::get('uDrivers',[DriverController::class,'uDrivers'])->name('uDrivers');
    Route::post('unassignTaxi',[DriverController::class,'unassignTaxi'])->name('unassignTaxi');
    Route::resource('taxi',TaxiController::class);
    Route::post('del-taxi',[TaxiController::class,'deleteTaxi'])->name('deleteTaxi');

    // change password
    Route::post('change-password',[AdminController::class,'changePassword'])->name('adminChangePassword');
    Route::get('changePass',[AdminController::class,'changePass'])->name('admin.changepass');

    // reports
    Route::get('viewReport',[AdminController::class,'viewReport'])->name('admin.report');
    Route::post('genReport',[AdminController::class,'generateReport'])->name('generateReport');
   
});

Route::group(['prefix'=>'user', 'middleware'=>['isUser','auth','PreventBackHistory']], function(){
    Route::get('profile',[UserController::class,'index'])->name('user.profile');
    Route::get('viewTransactions',[UserController::class,'viewTransactions'])->name('user.transactions');
    Route::resource('userTransactions',UserTransactionController::class);
    Route::get('viewBonds',[UserTransactionController::class,'viewBonds'])->name('viewBonds');
    Route::resource('users',UserController::class);

    // change password
    Route::post('userChange-password',[UserController::class,'changePassword'])->name('userChangePassword');
    Route::get('userChangePass',[UserController::class,'userChangePass'])->name('user.changepass');
    
});

Route::group(['prefix'=>'programmer', 'middleware'=>['isProgrammer','auth','PreventBackHistory']], function(){
    Route::resource('programmer',ProgrammerController::class);

    
});

