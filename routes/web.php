<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DetailOrderController;
use App\Http\Controllers\SaleOrderController;
use App\Http\Controllers\PurchaseOrderController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

// Ruta para mostrar el formulario de registro
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Ruta para procesar el registro de usuarios
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post("access", [LoginController::class, "login"])->name("access.web");
Route::post("logout", [LoginController::class, "logout"])->name("logout");


Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::prefix('employees')->group(function () {
        Route::get('/employees', [EmployeeController::class, 'index'])->name('employees');
        Route::get('/{employee}', [EmployeeController::class, 'show'])->name('employees.show');
        Route::post('/store', [EmployeeController::class, 'store'])->name('employees.store');
        Route::delete('/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
        Route::put('/{id}', [EmployeeController::class, 'update'])->name('employees.update');
    });
    Route::prefix('customers')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('customers');
        Route::get('/{customer}', [CustomerController::class, 'show'])->name('customers.show');
        Route::post('/store', [CustomerController::class, 'store'])->name('customers.store');
        Route::delete('/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
        Route::put('/{id}', [CustomerController::class, 'update'])->name('customers.update');


    });

    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products');
        Route::get('/{product}', [ProductController::class, 'show'])->name('products.show');
        Route::post('/store', [ProductController::class, 'store'])->name('products.store');
        Route::delete('/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
        Route::put('/{id}', [ProductController::class, 'update'])->name('Product.update');

    });


    Route::prefix('suppliers')->group(function () {
        Route::get('/', [SupplierController::class, 'index'])->name('suppliers');
        Route::get('/{supplier}', [SupplierController::class, 'show'])->name('suppliers.show');
        Route::post('/store', [SupplierController::class, 'store'])->name('suppliers.store');
        Route::delete('/{id}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');
        Route::put('/{id}', [SupplierController::class, 'update'])->name('suppliers.update');


    });


});

   
   


    

    
    
