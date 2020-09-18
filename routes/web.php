<?php

use App\Http\Controllers\{CategoryController};
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

// Routes for the administrator
Route::middleware(['auth:sanctum', 'sanctum.role:administrator'])->prefix('/admin')->group(function () {
    Route::get('/categories', [CategoryController::class, 'all'])->name('category.all');

    Route::prefix('/category')->group(function () {
        Route::post('/add', [CategoryController::class, 'store'])->name('category.store');
        Route::post('/update', [CategoryController::class, 'update'])->name('category.update');
        Route::post('/delete/{category:id}', [CategoryController::class, 'delete'])->name('category.delete');
    });
});
