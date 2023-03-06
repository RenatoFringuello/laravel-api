<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Api\ProjectController as ApiProjectController;
use App\Http\Controllers\Guest\ProjectController as GuestProjectController;

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

Route::name('api.')
->group(function(){
    Route::resource('/api/projects', ApiProjectController::class);
});

Route::get('/', [GuestProjectController::class, 'index']);
Route::name('guest.')
->group(function (){
    Route::resource('/projects', GuestProjectController::class);
});

Route::middleware(['auth', 'verified'])
->name('admin.')
->prefix('admin')
->group(function (){
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::resource('/projects', AdminProjectController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';