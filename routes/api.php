<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FavoriteController;
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
        Route::post('/customes-active', [CustomerController::class, 'chnageCustomerActiveStatus']);
        Route::post('/customers-trust', [CustomerController::class, 'chnageCustomerTrustStatus']);
        Route::post('/chnage-customers-trust', [CustomerController::class, 'chnageSomeCustomerStatus']);
        Route::get('/search-customers/{search_value}', [CustomerController::class, 'search']);

        Route::resource('employees', EmployeeController::class);
        Route::post('/employees-active', [EmployeeController::class, 'chnageCustomerActiveStatus']);
        // Route::post('/customer-trust', [EmployeeController::class, 'chnageCustomerTrustStatus']);
        // Route::post('/chnage-customers-trust', [EmployeeController::class, 'chnageSomeCustomerStatus']);
        Route::get('/search-employees/{search_value}', [EmployeeController::class, 'search']);


        Route::resource('/services', MyServiceController::class);
        Route::get('/search-services/{search_value}', [MyServiceController::class, 'search']);
        //  Route::post('/service-active', [MyServiceController::class, 'enableService']);

        Route::resource('/services-level-one', MyServiceLevelOneController::class);
        Route::get('/search-services-level-one/{search_value}', [MyServiceLevelOneController::class, 'search']);
        Route::get('/get-all-myservices-level-1/{service_id}', [MyServiceLevelOneController::class, 'getAllServices']);

        Route::resource('/services-level-tow', MyServiceLevelTowController::class);
        Route::get('/search-services-level-tow/{search_value}', [MyServiceLevelTowController::class, 'search']);
        Route::get('/get-all-myservices-level-2/{service_id}', [MyServiceLevelTowController::class, 'getAllServices']);

        Route::resource('/orders', OrderController::class);
        Route::get('/orders/{search_value}', [OrderController::class, 'search']);
        Route::post('/orders-status', [OrderController::class, 'chanageStatus']);
        Route::get('/get-my-order', [OrderController::class, 'getMyOrder']);

        Route::resource('/carts', CartController::class);

        Route::resource('/favorites', FavoriteController::class);
        // Route::get('/favorites', [FavoriteController::class, 'fetchAllFavorite']);
        // Route::post('/addToFavorites', [FavoriteController::class, 'addToFavorites']);
        // Route::delete('/removeFromFavorites', [FavoriteController::class, 'removeFromFavorites']);
    }
);
