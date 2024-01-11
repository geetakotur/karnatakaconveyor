<?php

use App\Http\Controllers\Dashboard\ManagementController;
use App\Http\Controllers\Dashboard\Mgmt\Controllers\AccountController;
use App\Http\Controllers\Dashboard\Mgmt\Controllers\CustomerController;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\Mgmt\Controllers\OrderController;
use App\Http\Controllers\Dashboard\Mgmt\Controllers\QuoteController;

use App\Http\Controllers\DashboardController;
// use App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Mgmt\AuthController as MgmtAuth;
use App\Http\Controllers\Dashboard\Mgmt\Controllers\EmployeeController;

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
//     return "Mgmt Home";
//     // return view('view.home.index');
// })->name('mgmt.home');

// login
Route::any('/login', [DashboardController::class, 'showLoginMgmt'])->name('mgmt.login');
Route::any('/logout', [MgmtAuth::class, 'logout'])->name('mgmt.logout');
Route::post('/login', [MgmtAuth::class, 'login']);

// register
// Route::get('/register', [DashboardController::class, 'showRegisterMgmt'])->name('mgmt.register');
// Route::post('/register', [MgmtAuth::class, 'register']);

// Auth Resource
Route::middleware('userAuth:mgmt')
    ->group( function () {
        // mgmt - home
        Route::get('/', [ManagementController::class, 'index'])->name('mgmt.home');

        // Models
        // Route::prefix('/model')->group( function () {
        //     Route::any('/', [MachineController::class, 'index'])->name('mgmt.model.home');

        //     Route::any('/create', [MachineController::class, 'createView'])->name('mgmt.model.create'); // Create New Model View
        //     Route::post('/create', [MachineController::class, 'create']); // Create New Model by POST

        //     Route::any('/edit/{id}', [MachineController::class, 'updateView'])->name('mgmt.model.update'); // Update Model by Id View
        //     Route::post('/edit/{id}', [MachineController::class, 'update']); // Update Model by Id by POST

        //     Route::any('/delete/{id}', [MachineController::class, 'delete'])->name('mgmt.model.delete'); // Delete Model by Id

        // });

        // Orders
        Route::prefix('/orders')->group( function () {
            Route::any('/', [OrderController::class, 'index'])->name('mgmt.orders.home');

            Route::any('/{id}/view', [OrderController::class, 'orderView'])->name('mgmt.orders.view');

            Route::any('/{id}/edit', [OrderController::class, 'orderEditView'])->name('mgmt.orders.edit');
            Route::post('/{id}/edit', [OrderController::class, 'orderUpdate'])->name('mgmt.orders.update');

            Route::any('/{id}/cancle', [OrderController::class, 'orderCancle'])->name('mgmt.orders.cancle');
            Route::any('/{id}/delete', [OrderController::class, 'orderDelete'])->name('mgmt.orders.delete');

        });

        // Quotes
        Route::prefix('/quotes')->group( function () {
            Route::any('/', [QuoteController::class, 'index'])->name('mgmt.quotes.home');

            Route::any('/{id}/info', [QuoteController::class, 'quoteInfo'])->name('mgmt.quotes.info');
            Route::any('/{id}/edit', [QuoteController::class, 'quoteEdit'])->name('mgmt.quotes.edit');
            Route::post('/{id}/update', [QuoteController::class, 'quoteUpdate'])->name('mgmt.quotes.update');

            Route::any('/{id}/delete', [QuoteController::class, 'deteteQuote'])->name('mgmt.quotes.delete');

        });

        // Customers
        Route::prefix('/customer')->group( function () {
            Route::any('/', [CustomerController::class, 'index'])->name('mgmt.customer.home');

            Route::any('/new', [CustomerController::class, 'customerNewView'])->name('mgmt.customer.new');
            Route::post('/new', [CustomerController::class, 'customerNew']);

            // Route::any('/{id}/info', [CustomerController::class, 'customerInfo'])->name('mgmt.customer.info');
            Route::any('/{id}/edit', [CustomerController::class, 'customerEdit'])->name('mgmt.customer.edit');
            Route::post('/{id}/edit', [CustomerController::class, 'customerUpdate'])->name('mgmt.customer.update');

            Route::any('/{id}/delete', [CustomerController::class, 'customerDelete'])->name('mgmt.customer.delete');

        });

        // Employees
        Route::prefix('/employee')->group( function () {
            Route::any('/', [EmployeeController::class, 'index'])->name('mgmt.employees.home');

            Route::any('/new', [EmployeeController::class, 'employeeNewView'])->name('mgmt.employees.new');
            Route::post('/new', [EmployeeController::class, 'employeeNew']);

            Route::any('/{id}/info', [EmployeeController::class, 'employeeInfo'])->name('mgmt.employees.info');
            Route::any('/{id}/edit', [EmployeeController::class, 'employeeEdit'])->name('mgmt.employees.edit');
            Route::post('/{id}/edit', [EmployeeController::class, 'employeeUpdate'])->name('mgmt.employees.update');

            Route::any('/{id}/delete', [EmployeeController::class, 'employeeDelete'])->name('mgmt.employees.delete');

        });

        // Account
        Route::prefix('/account')->group( function () {
            Route::any('/', [AccountController::class, 'index'])->name('mgmt.account.home');

        });

        // Redirect /any -> home
        // Route::redirect('{any}', route('mgmt.home'))->where('any', '.*');
    });




// Redirect /any -> home
// Route::redirect('{any}', '/')->where('any', '.*');
