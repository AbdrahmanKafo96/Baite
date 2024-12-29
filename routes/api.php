<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MyServiceController;
use App\Http\Controllers\MyServiceLevelOneController;
use App\Http\Controllers\MyServiceLevelTowController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserController;
use App\Models\myServiceLevelOne;
use App\Models\myServiceLevelTow;
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

        Route::resource('employee', EmployeeController::class);
        Route::post('/employee-active', [EmployeeController::class, 'chnageCustomerActiveStatus']);
        // Route::post('/customer-trust', [EmployeeController::class, 'chnageCustomerTrustStatus']);
        // Route::post('/chnage-customers-trust', [EmployeeController::class, 'chnageSomeCustomerStatus']);
        Route::get('/search-employee/{search_value}', [EmployeeController::class, 'search']);


        Route::resource('/service', MyServiceController::class);
        Route::get('/search-service/{search_value}', [MyServiceController::class, 'search']);
        //  Route::post('/service-active', [MyServiceController::class, 'enableService']);

        Route::resource('/service-level-one', MyServiceLevelOneController::class);
        Route::get('/search-service-level-one/{search_value}', [MyServiceLevelOneController::class, 'search']);
        // Route::post('/service-level-one-active', [MyServiceLevelOneController::class, 'enableService']);

        Route::resource('/service-level-tow', MyServiceLevelTowController::class);
        Route::get('/search-service-level-tow/{search_value}', [MyServiceLevelTowController::class, 'search']);
        // Route::post('/service-level-tow-active', [MyServiceLevelTowController::class, 'enableService']);

        Route::resource('/order', OrderController::class);
        Route::get('/order/{search_value}', [OrderController::class, 'search']);
    }
);
