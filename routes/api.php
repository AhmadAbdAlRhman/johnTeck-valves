<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/products', [ProductController::class,'index']);
