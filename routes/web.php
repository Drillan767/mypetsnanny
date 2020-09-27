<?php

use App\Http\Controllers\{CategoryController, ActivityController, ClientController};
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Http\Controllers\Inertia\UserProfileController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $path = auth()->user()->role === 'administrator' ? 'activity.dashboard' : 'client.profile';
    return Redirect::route($path);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/profil/configuration', [UserProfileController::class, 'show'])->name('profile.show');
});

// Routes for the administrator
Route::middleware(['auth:sanctum', 'sanctum.role:administrator'])->prefix('/admin')->group(function () {
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

Route::middleware(['auth:sanctum', 'sanctum.role:client'])->prefix('/profil')->group(function () {
    Route::get('', [ClientController::class, '__invoke'])->name('client.profile');
});
