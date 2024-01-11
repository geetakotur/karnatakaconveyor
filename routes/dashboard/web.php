<?php

use App\Http\Controllers\DashboardController;
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
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.home');


// // Redirect /any -> home
// Route::get('/{any}', function () {
//     return 'dashboard hi';
// })->where('any', '.*');

// Route::redirect('{any}', '/')->where('any', '.*');
