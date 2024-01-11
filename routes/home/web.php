<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
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

// home
Route::any('/', [HomeController::class, 'index'])->name('home');

Route::any('/about', [HomeController::class, 'about'])->name('home.about');

Route::any('/contact', [HomeController::class, 'contact'])->name('home.contact');


Route::any('/products', [HomeController::class, 'products'])->name('home.products');
Route::any('/product/{id}', [HomeController::class, 'productById'])->name('home.product.id');

// model by id
// Route::any('/model/{id}', [HomeController::class, 'modelById'])->name('home.model.id');

// test
// Route::get('/test', function () {
//     return 'works';
// })->name('home.test');

// Redirect /any -> home
// Route::redirect('{any}', '/')->where('any', '.*');
