<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CertificateController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/products', [ProductController::class,'index']);
Route::get('/product', [ProductController::class,'ShowById'])->middleware(\App\Http\Middleware\CheckToken::class);
Route::post('/storage',[ProductController::class,'store'])->middleware(\App\Http\Middleware\CheckToken::class);
Route::get('/products/{nameProducts}', [ProductController::class,'search'])->middleware(\App\Http\Middleware\CheckToken::class);
Route::post('/delete',[ProductController::class,'delete'])->middleware(\App\Http\Middleware\CheckToken::class);
Route::post('/updateProduct/{id}',[ProductController::class,'update'])->middleware(\App\Http\Middleware\CheckToken::class);
Route::post('/admin/login',[ProductController::class,'loginAsAdminstrator']);

Route::get('/certificates', [CertificateController::class,'index']);
Route::post('/certificates/store', [CertificateController::class,'store'])->middleware(\App\Http\Middleware\CheckToken::class);
Route::post('/deletecertificates',[CertificateController::class,'delete'])->middleware(\App\Http\Middleware\CheckToken::class);
