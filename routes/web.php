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
Route::post('/newsletter/store', [App\Http\Controllers\IndexController::class, 'store'])->name('mailists.store');
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
        //Master Milestone
        Route::get('/admin/milestones', 'MilestonesController@index')->name('milestones');
        Route::post('/admin/milestones/store', 'MilestonesController@store')->name('milestones.store');
        Route::get('/admin/milestones/edit/{id}', 'MilestonesController@edit')->name('milestones.edit');
        Route::post('/admin/milestones/update', 'MilestonesController@update')->name('milestones.update');
        Route::delete('/admin/milestones/delete/{id}', 'MilestonesController@delete')->name('milestones.delete');
        //Master Member
        Route::get('/admin/members', 'MembersController@index')->name('members');
        Route::post('/admin/members/store', 'MembersController@store')->name('members.store');
        Route::get('/admin/members/edit/{id}', 'MembersController@edit')->name('members.edit');
        Route::post('/admin/members/update', 'MembersController@update')->name('members.update');
        Route::delete('/admin/members/delete/{id}', 'MembersController@delete')->name('members.delete');
        //Master Music
        Route::get('/admin/musics', 'MusicsController@index')->name('musics');
        Route::post('/admin/musics/store', 'MusicsController@store')->name('musics.store');
        Route::get('/admin/musics/edit/{id}', 'MusicsController@edit')->name('musics.edit');
        Route::post('/admin/musics/update', 'MusicsController@update')->name('musics.update');
        Route::delete('/admin/musics/delete/{id}', 'MusicsController@delete')->name('musics.delete');
        //Master Tour
        Route::get('/admin/tours', 'ToursController@index')->name('tours');
        Route::post('/admin/tours/store', 'ToursController@store')->name('tours.store');
        Route::get('/admin/tours/edit/{id}', 'ToursController@edit')->name('tours.edit');
        Route::post('/admin/tours/update', 'ToursController@update')->name('tours.update');
        Route::delete('/admin/tours/delete/{id}', 'ToursController@delete')->name('tours.delete');
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
        //Master Article & News
        Route::get('/admin/articles', 'NewsController@index')->name('news');
        Route::post('/admin/articles/store', 'NewsController@store')->name('news.store');
        Route::get('/admin/articles/changeactive', 'NewsController@changeActive')->name('news.isactive');
        Route::get('/admin/articles/edit/{id}', 'NewsController@edit')->name('news.edit');
        Route::post('/admin/articles/update', 'NewsController@update')->name('news.update');
        Route::delete('/admin/articles/delete/{id}', 'NewsController@delete')->name('news.delete');
        //Master Stores
        Route::get('/admin/stores', 'StoresController@index')->name('stores');
        Route::post('/admin/stores/store', 'StoresController@store')->name('stores.store');
        Route::get('/admin/stores/edit/{id}', 'StoresController@edit')->name('stores.edit');
        Route::post('/admin/stores/update', 'StoresController@update')->name('stores.update');
        Route::delete('/admin/stores/delete/{id}', 'StoresController@delete')->name('stores.delete');
        //Master Stores
        Route::get('/admin/videos', 'VideosController@index')->name('videos');
        Route::post('/admin/videos/store', 'VideosController@store')->name('videos.store');
        Route::get('/admin/videos/edit/{id}', 'VideosController@edit')->name('videos.edit');
        Route::post('/admin/videos/update', 'VideosController@update')->name('videos.update');
        Route::delete('/admin/videos/delete/{id}', 'VideosController@delete')->name('videos.delete');
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
