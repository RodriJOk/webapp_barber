<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\SuscriptionController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CollaboratorsController;
use App\Http\Controllers\CollaboratorAvailableController;

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth', 'rol:admin,colaborador,cliente');

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
});

Route::controller(UserController::class)->group(function () {
    Route::get('/usuarios', 'index')->middleware('auth', 'rol:admin');
    Route::get('/my_profile', 'my_profile')->name('my_profile')->middleware('auth', 'rol:admin,colaborador,cliente');
});

Route::controller(CalendarController::class)->group(function () {
    Route::get('/my_calendar', 'index')->name('my_calendar')->middleware('auth', 'rol:admin,colaborador,cliente');
    Route::get('/edit_event', 'edit_event')->name('edit_event')->middleware('auth', 'rol:admin,colaborador,cliente');
    Route::post('/delete_event', 'delete_event')->name('delete_event')->middleware('auth', 'rol:admin,colaborador,cliente');
    Route::post('/create_event', 'create_event')->name('create_event')->middleware('auth', 'rol:admin,colaborador,cliente');
});

Route::controller(SuscriptionController::class)->group(function () {
    Route::get('/suscription', 'index')->name('suscription')->middleware('auth', 'rol:admin');
    Route::post('/create_suscription', 'create_suscription')->name('create_suscription')->middleware('auth', 'rol:admin');
    Route::get('/edit_suscription', 'edit_suscription')->middleware('auth', 'rol:admin');
    Route::get('/delete_suscription', 'delete_suscription')->middleware('auth', 'rol:admin');
});

Route::controller(BranchController::class)->group(function () {
    Route::post('/update_profile', 'update_profile')->name('update_profile')->middleware('auth', 'rol:admin');
});

Route::controller(ClientController::class)->group(function () {
    Route::get('/my_clients', 'index')->name('my_clients')->middleware('auth', 'rol:admin');
    Route::post('/create_client', 'create_client')->name('create_client')->middleware('auth', 'rol:admin');
    Route::get('/search_client', 'search_client')->name('search_client')->middleware('auth', 'rol:admin');
});

Route::controller(CollaboratorsController::class)->group(function () {
    Route::get('/my_collaborators', 'index')->name('my_collaborators')->middleware('auth', 'rol:admin');
    Route::post('/save_collaborator', 'save_collaborator')->name('save_collaborator')->middleware('auth', 'rol:admin');
    Route::get('/delete_collaborator/{id}', 'delete_collaborator')->name('delete_collaborator')->middleware('auth', 'rol:admin');
    Route::post('/update_collaborator', 'update_collaborator')->name('update_collaborator')->middleware('auth', 'rol:admin');
    Route::post('/update_schedules_collaborator', 'update_schedules_collaborator')->name('update_schedules_collaborator')->middleware('auth', 'rol:admin');
});

Route::controller(CollaboratorAvailableController::class)->group(function () {
    Route::get('/my_collaborators_availability/{id}', 'my_collaborators_availability')->name('my_collaborators_availability')->middleware('auth', 'rol:admin');
    Route::post('/save_collaborator_availability', 'save_collaborator_availability')->name('save_collaborator_availability')->middleware('auth', 'rol:admin');
    Route::get('/delete_collaborator_availability/{id}', 'delete_collaborator_availability')->name('delete_collaborator_availability')->middleware('auth', 'rol:admin');
    Route::post('/update_collaborator_availability', 'update_collaborator_availability')->name('update_collaborator_availability')->middleware('auth', 'rol:admin');
});