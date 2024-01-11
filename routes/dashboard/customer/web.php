<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;

use App\Http\Controllers\Dashboard\CustomerController;
use App\Http\Controllers\Dashboard\Customer\AuthController as CustomerAuth;
use App\Http\Controllers\Dashboard\Customer\Controllers\AccountController;

use App\Http\Controllers\Dashboard\Customer\Controllers\OrderController;
use App\Http\Controllers\Dashboard\Customer\Controllers\QuoteController;

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
// Route::get('/', function () {
//     return "CUstomer Home";
//     // return view('view.home.index');
// })->name('customer.home');

// login
Route::any('/login', [DashboardController::class, 'showLoginCustomer'])->name('customer.login');
Route::any('/logout', [CustomerAuth::class, 'logout'])->name('customer.logout');
Route::post('/login', [CustomerAuth::class, 'login']);

// register
Route::any('/register', [DashboardController::class, 'showRegisterCustomer'])->name('customer.register');
Route::post('/register', [CustomerAuth::class, 'register']);


// Auth Resource
Route::middleware('userAuth:customer')
    ->group( function () {
        // customer - home
        Route::any('/', [CustomerController::class, 'index'])->name('customer.home');


        // Orders
        Route::prefix('/orders')->group( function () {
            Route::any('/', [OrderController::class, 'index'])->name('customer.orders.home');

            Route::any('/{id}/paynow', [OrderController::class, 'orderPaynowView'])->name('customer.orders.paynow');
            Route::post('/{id}/paynow', [OrderController::class, 'orderPaynow']);
            
            Route::any('/{id}/cancle', [OrderController::class, 'orderCancle'])->name('customer.orders.cancle');
            // Route::any('/{id}/edit', [OrderController::class, 'orderEdit'])->name('customer.orders.edit');
            // Route::post('/{id}/edit', [OrderController::class, 'orderUpdate'])->name('customer.orders.update');

            Route::any('/{id}/viewInvoice', [OrderController::class, 'orderViewInvoice'])->name('customer.orders.viewInvoice');
        });

        // Quotations
        Route::prefix('/quotes')->group( function () {
            Route::any('/', [QuoteController::class, 'index'])->name('customer.quotes.home');

            Route::any('/new', [QuoteController::class, 'quoteNew'])->name('customer.quotes.new');
            Route::post('/new', [QuoteController::class, 'submitQuoteNew']);

            Route::any('/{id}/info', [QuoteController::class, 'quoteInfo'])->name('customer.quotes.info');
            Route::any('/{id}/edit', [QuoteController::class, 'quoteEdit'])->name('customer.quotes.edit');
            Route::post('/{id}/edit', [QuoteController::class, 'quoteUpdate'])->name('customer.quotes.update');

            Route::any('/{id}/delete', [QuoteController::class, 'deteteQuote'])->name('customer.quotes.delete');
        });

        // Account
        Route::prefix('/account')->group( function () {
            Route::any('/', [AccountController::class, 'index'])->name('customer.account.home');

        });

        // Redirect /any -> home
        // Route::redirect('{any}', '/management')->where('any', '.*');
    });




// Redirect /any -> home
// Route::redirect('{any}', '/')->where('any', '.*');
