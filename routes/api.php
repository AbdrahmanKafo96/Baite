<?php

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
        "controller" =>  UserController::class,

    ],
    function () {
        // Route::post('login-admin', [AdminController::class, 'login'])->withoutMiddleware("auth:sanctum");
        // Route::post("/logout-admin", [AdminController::class, 'logout']);

        Route::post("/login", "login")->withoutMiddleware("auth:sanctum");
        Route::post("/logout", "logout");
        Route::post("/showRegistrationForm", "showRegistrationForm");
        Route::get("/getUser", "getUser");
        Route::post("/register", "register")->withoutMiddleware("auth:sanctum");
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
