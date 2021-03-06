<?php

use App\Http\Controllers\{CategoryController, ActivityController, HomeController};
use Illuminate\Support\Facades\Redirect;
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

Route::get('/dashboard', function () {
    $path = auth()->user()->role === 'administrator' ? 'activity.dashboard' : 'client.profile';
    return Redirect::route($path);
});

Route::get('/', [HomeController::class, 'landing']);
Route::post('/contact', [HomeController::class, 'submit']);
Route::get('/mentions-legales', [HomeController::class, 'legalNotice']);
Route::post('/newsletter', [HomeController::class, 'subscribe']);

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

    Route::get('/editer-accueil', [HomeController::class, 'edit'])->name('landing.edit');
    Route::post('/editer-accueil', [HomeController::class, 'update'])->name('landing.update');
});
