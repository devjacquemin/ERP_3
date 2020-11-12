<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SkeletonController;

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

/* Route pour l'index du dashboard */
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

/* Route pour l'index de la page test */
Route::middleware(['auth:sanctum', 'verified'])
    ->get('/myself', [SkeletonController::class, 'myself'])
    ->name('skeleton.myself');

/* Route pour l'index des sociétés */
Route::middleware(['auth:sanctum', 'verified'])
    ->get('/company', [CompanyController::class, 'index'])
    ->name('company.index');

Route::get('/company/type', 'App\Http\Controllers\CompanyTypeController@index')->name('company.type');


// /* Route pour l'index des produits */
// Route::middleware(['auth:sanctum', 'verified'])
//     ->get('/product', [ProductController::class, 'index'])
//     ->name('product.index');

// /* Route pour le show des sociétés */
// Route::middleware(['auth:sanctum', 'verified'])
//     ->get('/company', [CompanyController::class, 'show'])
//     ->name('company.show');

// /* Route pour le show des produits */
// Route::middleware(['auth:sanctum', 'verified'])
//     ->get('/product', [ProductController::class, 'show'])
//     ->name('products.show');
