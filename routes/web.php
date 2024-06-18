<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/home', function () {
    return view('website/home');
})->name('home');

//Route::get('/dashboard', function () {
//    return view('admin/dashboard');
//})->name('home');


Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

Route::get('/', function () {
    return view('auth.login');
})->name('login');


Route::get('/dashboard', [\App\Http\Controllers\Dashboard::class, 'index'])->middleware(['auth'])->name('dashboard');


Route::group(['middleware' => ['auth'], 'prefix' => 'dashboard'], function () {

    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/');
    });
//    Route::get('/dashboard', [\App\Http\Controllers\Dashboard::class, 'index'])->name('dashboard');
    Route::post('/store', [\App\Http\Controllers\Dashboard::class, 'addRecords'])->name('addRecords');
    Route::get('/updateStatus', [\App\Http\Controllers\Dashboard::class, 'updateStatus'])->name('updateStatus');
});
require __DIR__.'/auth.php';


