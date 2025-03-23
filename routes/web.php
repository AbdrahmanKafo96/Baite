<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name("/");

Route::get('/contact', function () {
    return view('contact');
})->name('contact');
