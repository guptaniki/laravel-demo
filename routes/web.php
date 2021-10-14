<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\SubjectsController;
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


Route::group(array('before' => 'auth'), function(){
    Route::get('/', function () {
        return view('auth.login');
    });
    
    Route::get('login', [CustomAuthController::class, 'index'])->name('login');
    
    Route::post('post-login', [CustomAuthController::class, 'postLogin'])->name('login.post'); 
    
    Route::get('registration', [CustomAuthController::class, 'registration'])->name('register');
    
    Route::post('post-registration', [CustomAuthController::class, 'postRegistration'])->name('register.post'); 
    
    Route::get('dashboard', [CustomAuthController::class, 'dashboard']); 
    
    Route::get('logout', [CustomAuthController::class, 'logout'])->name('logout');
    
    
    Route::resource('subjects',SubjectsController::class);
    Route::get('/subjects/{id}/view', [SubjectsController::class, 'show'])->name('view');

});