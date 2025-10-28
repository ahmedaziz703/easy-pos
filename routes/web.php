<?php

use App\Http\Controllers\UtilityController;
use App\Http\Controllers\InstallController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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

Route::get('/', function () {
    app(InstallController::class)->install();
    return redirect( url('admin/') );
});


Route::get('/install',  [InstallController::class, 'install']);
Route::get('/print/{id}',  [UtilityController::class, 'print']);
Route::get('/login',  function(){
    return redirect( url('/admin') );
})->name('login');

Route::get('/clear',  function(){
    Artisan::call('optimize:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
});
