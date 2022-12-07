<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\JoinController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    Route::get('players/trash', [PlayerController::class, 'deletelist']);
    Route::get('players/trash/{player}/restore', [PlayerController::class, 'restore']);
    Route::get('players/trash/{player}/forcedelete', [PlayerController::class, 'deleteforce']);
    Route::resource('players', PlayerController::class);

    Route::get('clubs/trash', [ClubController::class, 'deletelist']);
    Route::get('clubs/trash/{club}/restore', [ClubController::class, 'restore']);
    Route::get('clubs/trash/{club}/forcedelete', [ClubController::class, 'deleteforce']);
    Route::resource('clubs', ClubController::class);

    Route::get('countries/trash', [CountryController::class, 'deletelist']);
    Route::get('countries/trash/{Country}/restore', [CountryController::class, 'restore']);
    Route::get('countries/trash/{Country}/forcedelete', [CountryController::class, 'deleteforce']);
    Route::resource('countries', CountryController::class);

    Route::get('/totals', [JoinController::class, 'index']);
    
});