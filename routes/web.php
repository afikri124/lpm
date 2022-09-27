<?php

use Illuminate\Support\Facades\Route;
use Jenssegers\Date\Date;

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
Route::get('/login/sso_klas2/', [App\Http\Controllers\HomeController::class, 'sso_klas2'])->name('sso_klas2');
Route::get('/login/google', [App\Http\Controllers\GoogleController::class, 'redirectToGoogle']);
Route::get('/login/google/callback', [App\Http\Controllers\GoogleController::class, 'handleCallback']);
//DASHBOARD
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('dashboard'); 
Route::get('/documentation', [App\Http\Controllers\DashboardController::class, 'documentation'])->name('documentation'); 
Route::group(['middleware' => ['auth']], function () {
    Route::get('profile', [App\Http\Controllers\DashboardController::class, 'my_profile'])->name('my_profile');
    Route::post('update-profile', [App\Http\Controllers\DashboardController::class, 'update_profile'])->name('update_profile');
    Route::view('change-password', 'user.change_password')->name('change_password');
    Route::post('update-password', [App\Http\Controllers\DashboardController::class, 'update_password'])->name('update_password');
    Route::any('update-account', [App\Http\Controllers\DashboardController::class, 'update_account'])->name('update_account');
});
//SETTINGS ROLE ADMIN
Route::group(['prefix' => 'settings', 'middleware' => ['auth', 'role:AD']], function() {
    Route::any('general', [App\Http\Controllers\SettingController::class, 'general'])->name('settings.general');
    Route::get('users', [App\Http\Controllers\SettingController::class, 'users'])->name('settings.users');
    Route::get('syncKlas2', [App\Http\Controllers\SettingController::class, 'syncKlas2'])->name('settings.syncKlas2');
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
//SCHEDULES ROLE ADMIN
Route::group(['prefix' => 'schedules', 'middleware' => ['auth', 'role:AD']], function() {
    Route::get('/', [App\Http\Controllers\ScheduleController::class, 'index'])->name('schedules');
    Route::delete('delete', [App\Http\Controllers\ScheduleController::class, 'delete'])->name('schedules.delete');
    Route::any('add', [App\Http\Controllers\ScheduleController::class, 'add'])->name('schedules.add');
    Route::any('/{id}', [App\Http\Controllers\ScheduleController::class, 'edit'])->name('schedules.edit');
    Route::any('/review/{id}', [App\Http\Controllers\ScheduleController::class, 'review_observations'])->name('schedules.review_observations');
    Route::post('/reschedule/{id}', [App\Http\Controllers\FollowUpController::class, 'reschedule'])->name('reschedule_follow_up');
});
//OBSERVATIONS ROLE AUTH
Route::group(['prefix' => 'observations', 'middleware' => ['auth']], function() {
    Route::get('/me', [App\Http\Controllers\ObservationController::class, 'me'])->name('observations.me');
    Route::delete('delete', [App\Http\Controllers\ObservationController::class, 'delete'])->name('observations.delete')->middleware('role:AD');
    Route::any('add', [App\Http\Controllers\ObservationController::class, 'add'])->name('observations.add')->middleware('role:AD');
    Route::any('/results/{id}', [App\Http\Controllers\ObservationController::class, 'results'])->name('observations.results');
});
//OBSERVATIONS ROLE AUDITOR
Route::group(['prefix' => 'observations', 'middleware' => ['auth', 'role:AU']], function() {
    Route::get('/', [App\Http\Controllers\ObservationController::class, 'index'])->name('observations');
    Route::any('/{id}', [App\Http\Controllers\ObservationController::class, 'view'])->name('observations.view');
});
//FOLLOW_UP ROLE DEAN
Route::group(['prefix' => 'follow_up', 'middleware' => ['auth', 'role:DE']], function() {
    Route::get('/', [App\Http\Controllers\FollowUpController::class, 'index'])->name('follow_up');
    Route::any('/{id}', [App\Http\Controllers\FollowUpController::class, 'view'])->name('follow_up.view');
});
//RECAP ROLE ADMIN
Route::group(['prefix' => 'recap', 'middleware' => ['auth', 'role:AD']], function() {
    Route::get('/', [App\Http\Controllers\RecapController::class, 'index'])->name('recap');
});
//PDF
Route::group(['prefix' => 'pdf'], function() {
    Route::get('report/{id}', [App\Http\Controllers\PdfController::class, 'report'])->name('pdf.report');
    Route::get('recap', [App\Http\Controllers\PdfController::class, 'recap'])->name('pdf.recap');
});
//API
Route::group(['prefix' => 'web/api', 'middleware' => ['auth']], function() {
    Route::get('tes', [App\Http\Controllers\ApiController::class, 'tes'])->name('api.tes')->middleware('role:AD');
    Route::get('users', [App\Http\Controllers\ApiController::class, 'users'])->name('api.users')->middleware('role:AD');
    Route::get('notifications', [App\Http\Controllers\ApiController::class, 'notifications'])->name('api.notifications');
    Route::get('categories', [App\Http\Controllers\ApiController::class, 'categories'])->name('api.categories');
    Route::get('criterias', [App\Http\Controllers\ApiController::class, 'criterias'])->name('api.criterias');
    Route::get('schedules', [App\Http\Controllers\ApiController::class, 'schedules'])->name('api.schedules');
    Route::get('schedules_by_lectrurer_id', [App\Http\Controllers\ApiController::class, 'schedules_by_lectrurer_id'])->name('api.schedules_by_lectrurer_id');
    Route::get('observations_by_schedule_id', [App\Http\Controllers\ApiController::class, 'observations_by_schedule_id'])->name('api.observations_by_schedule_id');
    Route::get('observations_by_auditor_id', [App\Http\Controllers\ApiController::class, 'observations_by_auditor_id'])->name('api.observations_by_auditor_id');
    Route::get('follow_up_by_dean_id', [App\Http\Controllers\ApiController::class, 'follow_up_by_dean_id'])->name('api.follow_up_by_dean_id');
    Route::get('recap', [App\Http\Controllers\ApiController::class, 'recap'])->name('api.recap');
});

//tes email
Route::get('/email', function () {
    $data['email'] = "afikri124@gmail.com";
    $data['subject'] = "Peer-Observation Reminder!";
    $data['name'] = "Ali Fikri";
    $data['messages'] = "observasi hari ini";
    $data['username'] = "S000000";
    return new App\Mail\MailReminder($data);
})->middleware(['auth', 'role:AD']);

//update gelar dosen
Route::get('update-dosen', [App\Http\Controllers\ApiController::class, 'update_dosen'])->middleware(['auth', 'role:AD']);
//log-viewers
Route::get('log-viewers', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->middleware(['auth', 'role:AD']);