<?php

use App\Exports\MailistsExport;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

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
Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about');
Route::get('/tour', [App\Http\Controllers\TourController::class, 'index'])->name('tour');
Route::get('/news', [App\Http\Controllers\NewsController::class, 'index'])->name('news');
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');
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
        //Master Member
        Route::get('/admin/members', 'MembersController@index')->name('members');
        Route::post('/admin/members/store', 'MembersController@store')->name('members.store');
        Route::get('/admin/members/edit/{id}', 'MembersController@edit')->name('members.edit');
        Route::post('/admin/members/update', 'MembersController@update')->name('members.update');
        Route::delete('/admin/members/delete/{id}', 'MembersController@delete')->name('members.delete');
        //Master Banners
        Route::get('/admin/banners', 'BannersController@index')->name('banners');
        Route::post('/admin/banners/store', 'BannersController@store')->name('banners.store');
        Route::get('/admin/banners/edit/{id}', 'BannersController@edit')->name('banners.edit');
        Route::post('/admin/banners/update', 'BannersController@update')->name('banners.update');
        Route::delete('/admin/banners/delete/{id}', 'BannersController@delete')->name('banners.delete');
        //Master Newsletter
        Route::get('/admin/newsletter', 'MailistsController@index')->name('mailists');
        Route::get('/admin/newsletter/export-csv', function () {
            return Excel::download(new MailistsExport, 'Newsletter-' . now()->format('dmy') . '.csv');
        })->name('mailists.export');
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
