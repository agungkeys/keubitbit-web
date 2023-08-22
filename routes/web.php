<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
// use Inertia\Inertia;

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

Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('index');
Auth::routes();

Route::group(['namespace' => 'Admin', 'as' => 'admin.'], function () {
    Route::middleware('auth')->group(function () {
        //Dashboard
        Route::get('/dashboard', 'DashboardController@index')->name('index');
        //Master User
        Route::get('/admin/users', 'UsersController@index')->name('users');
        Route::post('/admin/users/store', 'UsersController@store')->name('users.store');
        Route::get('/admin/users/edit/{id}', 'UsersController@edit')->name('users.edit');
        Route::post('/admin/users/update', 'UsersController@update')->name('users.update');
        Route::delete('/admin/users/delete/{id}', 'UsersController@delete')->name('users.delete');

        Route::get('/admin/banners', 'BannersController@index')->name('banners');
        Route::post('/admin/banners/store', 'BannersController@store')->name('banners.store');
        Route::get('/admin/banners/edit/{id}', 'BannersController@edit')->name('banners.edit');
        Route::post('/admin/banners/update', 'BannersController@update')->name('banners.update');
    });
});

// Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('index');


// Route::get('/', function () {
//     return Inertia::render('Homepage', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// require __DIR__.'/auth.php';
