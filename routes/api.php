<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::group(
    [
        "middleware" => [
            "auth:sanctum" //,"throttle:100,20"
        ],
        "prefix" => "auth",
        "controller" =>  CustomerController::class,

    ],
    function () {
        Route::post('login-admin', [SuperAdminController::class, 'login'])->withoutMiddleware("auth:sanctum");
        Route::post("/logout-admin", [SuperAdminController::class, 'logout']);

        Route::post("/login", "login")->withoutMiddleware("auth:sanctum");
        Route::post("/logout", "logout");
        Route::post("/showRegistrationForm", "showRegistrationForm");
        Route::get("/get-client", "getUser");
        Route::post("/register", "register")->withoutMiddleware("auth:sanctum");


        Route::post('/login-employee', [EmployeeController::class, 'login'])->withoutMiddleware("auth:sanctum");
        Route::post("/logout-employee", [EmployeeController::class, 'logout']);
        Route::post('/register-employee', [EmployeeController::class, 'register'])->withoutMiddleware("auth:sanctum");
        Route::post("/get-employee", [EmployeeController::class, 'getUser']);


     //   Route::post("/showRegistrationForm", "showRegistrationForm");

    }
);
// Route::middleware(['auth', 'role:admin'])->group(function () {
//     // Admin routes
// });

// Route::middleware(['auth', 'role:client'])->group(function () {
//     // Client routes
// });

// Route::middleware(['auth', 'role:employee'])->group(function () {
//     // Employee routes
// });
Route::middleware(['auth:sanctum'])->group(
    function () {
            Route::get('search-ad-show/{search_value}', [AdController::class, 'searchAd']);
            Route::resource('ads',  AdController::class);

            Route::resource('customers', CustomerController::class);
            Route::post('/customer-active', [CustomerController::class, 'chnageCustomerActiveStatus']);
            Route::post('/customer-trust', [CustomerController::class, 'chnageCustomerTrustStatus']);
            Route::post('/chnage-customers-trust', [CustomerController::class, 'chnageSomeCustomerStatus']);
            Route::get('/search-customer/{search_value}', [CustomerController::class, 'search']);

    });

