<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\FileController;
// welcome page
Route::get('/', function () {
    return view('welcome');
});

// auth
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);


// dashboard (role-based)
Route::get('/dashboard', function () {

    if (!session()->has('user_id')) {
        return redirect('/login');
    }

    if (session('role') == 'agent') {
        return view('dashboard_agent');
    }

    return view('dashboard_user');
});
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::post('/services/add', [ServiceController::class, 'add'])->name('services.add');
Route::post('/services/delete/{id}', [ServiceController::class, 'delete'])->name('services.delete');
Route::post('/file/add', [FileController::class, 'add'])->name('file.add');
Route::post('/file/join', [FileController::class, 'join'])->name('file.join');
Route::get('/services/{id}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/services/update/{id}', [ServiceController::class, 'updateForm'])->name('services.update.form');
Route::post('/services/update/{id}', [ServiceController::class, 'update'])->name('services.update');
Route::post('/file/delete/{id}', [FileController::class, 'delete'])->name('file.delete');
Route::get('/file/update/{id}', [FileController::class, 'updateForm'])->name('file.update.form');
Route::post('/file/update/{id}', [FileController::class, 'update'])->name('file.update');
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);