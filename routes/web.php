<?php

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

Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/', function () {
    return redirect()->route('index');
})->name('/');
Route::get('/',[App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/',[App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('dashboard'); //blank dashboard

Route::group(['middleware' => ['auth']], function () {
    Route::get('profile', [App\Http\Controllers\DashboardController::class, 'my_profile'])->name('my_profile');
    Route::post('update-profile', [App\Http\Controllers\DashboardController::class, 'update_profile'])->name('update_profile');
    Route::view('change-password', 'user.change_password')->name('change_password');
    Route::post('update-password', [App\Http\Controllers\DashboardController::class, 'update_password'])->name('update_password');
});

Route::group(['prefix' => 'settings', 'middleware' => ['auth', 'role:AD']], function() {
    Route::get('users', [App\Http\Controllers\SettingController::class, 'users'])->name('settings.users');
    Route::any('user/add', [App\Http\Controllers\SettingController::class, 'user_add'])->name('settings.user_add');
    Route::any('user/edit/{id}', [App\Http\Controllers\SettingController::class, 'user_edit'])->name('settings.user_edit');
    Route::delete('user/delete', [App\Http\Controllers\SettingController::class, 'user_delete'])->name('settings.user_delete');
    Route::get('categories', [App\Http\Controllers\SettingController::class, 'categories'])->name('settings.categories');
    Route::any('category/add', [App\Http\Controllers\SettingController::class, 'category_add'])->name('settings.category_add');
    Route::any('category/edit/{id}', [App\Http\Controllers\SettingController::class, 'category_edit'])->name('settings.category_edit');
    Route::delete('category/delete', [App\Http\Controllers\SettingController::class, 'category_delete'])->name('settings.category_delete');
    Route::get('criterias', [App\Http\Controllers\SettingController::class, 'criterias'])->name('settings.criterias');
    Route::any('criteria/add', [App\Http\Controllers\SettingController::class, 'criteria_add'])->name('settings.criteria_add');
    Route::any('criteria/edit/{id}', [App\Http\Controllers\SettingController::class, 'criteria_edit'])->name('settings.criteria_edit');
    Route::delete('criteria/delete', [App\Http\Controllers\SettingController::class, 'criteria_delete'])->name('settings.criteria_delete');
});

Route::group(['prefix' => 'api', 'middleware' => ['auth']], function() {
    //API
    Route::get('users', [App\Http\Controllers\ApiController::class, 'users'])->name('api.users');
    Route::get('categories', [App\Http\Controllers\ApiController::class, 'categories'])->name('api.categories');
    Route::get('criterias', [App\Http\Controllers\ApiController::class, 'criterias'])->name('api.criterias');
});