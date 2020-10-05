<?php

use App\Http\Controllers\{CategoryController, ActivityController, HomeController};
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

Route::get('/', [HomeController::class, 'landing']);
Route::post('/', [HomeController::class, 'submit']);
Route::post('/mentions-legales', [HomeController::class, 'privacy']);

// Routes for the administrator
Route::middleware(['auth:sanctum', 'sanctum.role:administrator'])->prefix('/admin')->group(function () {

    Route::prefix('/accueil')->group(function () {
        Route::get('/editer', [HomeController::class, 'edit']);
        Route::post('', [HomeController::class, 'update']);
    });


    Route::get('/categories', [CategoryController::class, 'all'])->name('category.all');

    Route::prefix('/category')->group(function () {
        Route::post('/add', [CategoryController::class, 'store'])->name('category.store');
        Route::post('/update', [CategoryController::class, 'update'])->name('category.update');
        Route::post('/delete/{category:id}', [CategoryController::class, 'delete'])->name('category.delete');
    });

    Route::get('/dashboard', [ActivityController::class, 'dashboard'])->name('activity.dashboard');

    Route::get('/prestations', [ActivityController::class, 'all'])->name('activity.all');
    Route::prefix('/prestation')->group(function() {
        Route::get('/creer-prestation', [ActivityController::class, 'create']);
        Route::post('/add', [ActivityController::class, 'store'])->name('activity.store');
        Route::get('/editer-prestation/{activity:id}', [ActivityController::class, 'edit']);
        Route::post('/update/{activity:id}', [ActivityController::class, 'update'])->name('activity.update');
        Route::post('/delete/{activity:id}', [ActivityController::class, 'delete'])->name('activity.delete');
    });
});
