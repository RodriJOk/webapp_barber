<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\SuscriptionController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CollaboratorAvailableController;
use App\Http\Controllers\ProfessionalsController;
use App\Http\Controllers\ProfessionalAvailabilityController;
use App\Http\Controllers\ServicesController;

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth', 'rol:admin,colaborador,client');

Route::controller(LoginController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/login', 'index')->name('login');
    Route::post('/singin', 'singin')->name('singin');
    Route::get('/logout', 'logout')->name('logout');
    Route::get('/register', 'register')->name('register');
    Route::post('/create_user', 'create_user')->name('create_user');
    Route::get('/forget_password', 'forget_password')->name('forget_password');
    Route::post('/reset_password', 'reset_password')->name('reset_password');
    Route::get('/new_password', 'new_password')->name('new_password');
    Route::post('/save_new_password', 'save_new_password')->name('save_new_password');
    Route::post('/close_session', 'close_session')->name('close_session');
    Route::post('/notifications', 'notifications')->name('notifications');
    Route::get('/success', 'success')->name('success');
    Route::get('/failure', 'failure')->name('failure');
    Route::get('/pending', 'pending')->name('pending');
    Route::get('/test_email', 'test_email')->name('test_email');
    Route::get('/template_email', 'template_email')->name('template_email');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/usuarios', 'index')->middleware('auth', 'rol:admin');
    Route::get('/my_profile', 'my_profile')->name('my_profile')->middleware('auth', 'rol:admin,colaborador,client');
});

Route::controller(CalendarController::class)->group(function () {
    Route::get('/my_calendar', 'index')->name('my_calendar')->middleware('auth', 'rol:admin,colaborador,client');
    Route::get('/edit_event', 'edit_event')->name('edit_event')->middleware('auth', 'rol:admin,colaborador,client');
    Route::post('/delete_event', 'delete_event')->name('delete_event')->middleware('auth', 'rol:admin,colaborador,client');
    Route::get('/new_event', 'new_event')->name('new_event')->middleware('auth', 'rol:admin,colaborador,client');
    Route::post('/create_event', 'create_event')->name('create_event')->middleware('auth', 'rol:admin,colaborador,client');
    Route::post('/get_services_by_professional', 'get_services_by_professional')->name('get_services_by_professional')->middleware('auth', 'rol:admin,colaborador,client');
    Route::post('/get_availability_day', 'get_availability_day')->name('get_availability_day')->middleware('auth', 'rol:admin,colaborador,client');
    Route::get('/get_availability_day', 'get_availability_day')->name('get_availability_day')->middleware('auth', 'rol:admin,colaborador,client');
});

Route::controller(SuscriptionController::class)->group(function () {
    Route::get('/suscription', 'index')->name('suscription')->middleware('auth', 'rol:admin');
    Route::post('/create_suscription', 'create_suscription')->name('create_suscription')->middleware('auth', 'rol:admin');
    Route::get('/edit_suscription', 'edit_suscription')->middleware('auth', 'rol:admin');
    Route::get('/delete_suscription', 'delete_suscription')->middleware('auth', 'rol:admin');
    Route::get('/subscription_history', 'subscription_history')->name('subscription_history')->middleware('auth', 'rol:admin');
});

Route::controller(BranchController::class)->group(function () {
    Route::get('/my_branch', 'index')->name('my_branch')->middleware('auth', 'rol:admin');
    Route::get('/new_branch', 'new_branch')->name('new_branch')->middleware('auth', 'rol:admin');
    Route::post('/create_branch', 'create_branch')->name('create_branch')->middleware('auth', 'rol:admin');
    Route::get('/edit_branch', 'edit_branch')->name('edit_branch')->middleware('auth', 'rol:admin');
    Route::post('/update_branch', 'update_branch')->name('update_branch')->middleware('auth', 'rol:admin');
    Route::get('/delete_branch', 'delete_branch/{id}')->name('delete_branch')->middleware('auth', 'rol:admin');
    Route::post('/update_profile', 'update_profile')->name('update_profile')->middleware('auth', 'rol:admin');
});

Route::controller(ClientController::class)->group(function () {
    Route::get('/my_clients', 'index')->name('my_clients')->middleware('auth', 'rol:admin');
    Route::post('/create_client', 'create_client')->name('create_client')->middleware('auth', 'rol:admin');
    Route::get('/search_client', 'search_client')->name('search_client')->middleware('auth', 'rol:admin');
});

Route::controller(ProfessionalsController::class)->group(function () {
    Route::get('/my_professionals', 'index')->name('my_professionals')->middleware('auth', 'rol:admin');
    Route::post('/save_professional', 'save_professional')->name('save_professional')->middleware('auth', 'rol:admin');
    Route::get('/delete_professional/{id}', 'delete_professional')->name('delete_professional')->middleware('auth', 'rol:admin');
    Route::post('/update_schedules_professional', 'update_schedules_professional')->name('update_schedules_professional')->middleware('auth', 'rol:admin');
    Route::get('/get_professional_by_branch/{id}', 'get_professional_by_branch')->name('get_professional_by_branch');
    Route::get('/edit_professional/{id}', 'edit_professional')->name('edit_professional')->middleware('auth', 'rol:admin');
    Route::post('/update_professional/{id}', 'update_professional')->name('update_professional')->middleware('auth', 'rol:admin');
});

Route::controller(ProfessionalAvailabilityController::class)->group(function () {
    Route::get('/my_professionals_availability/{id}', 'my_professionals_availability')->name('my_professionals_availability')->middleware('auth', 'rol:admin');
    Route::post('/store_professional_availability', 'store_professional_availability')->name('store_professional_availability')->middleware('auth', 'rol:admin, colaborador, client');
    Route::get('/delete_professional_availability/{id}', 'delete_professional_availability')->name('delete_professional_availability')->middleware('auth', 'rol:admin');
    Route::post('/update_professional_availability', 'update_professional_availability')->name('update_professional_availability')->middleware('auth', 'rol:admin');
});

Route::controller(ServicesController::class)->group(function () {
    Route::get('/my_services', 'my_services')->name('my_services')->middleware('auth', 'rol:admin');
    Route::post('/save_service', 'save_service')->name('save_service')->middleware('auth', 'rol:admin');
    Route::get('/delete_service/{id}', 'delete_service')->name('delete_service')->middleware('auth', 'rol:admin');
    Route::get('/active_service/{id}', 'active_service')->name('active_service')->middleware('auth', 'rol:admin');
    Route::get('/edit_service/{id}', 'edit_service')->name('edit_service')->middleware('auth', 'rol:admin');
    Route::post('/update_service/{id}', 'update_service')->name('update_service')->middleware('auth', 'rol:admin');
});