<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CertificateController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/products', [ProductController::class,'index']);
Route::middleware(\App\Http\Middleware\CheckToken::class)->get('/product', [ProductController::class,'ShowById']);
Route::middleware(\App\Http\Middleware\CheckToken::class)->post('/storage',[ProductController::class,'store']);
Route::middleware(\App\Http\Middleware\CheckToken::class)->get('/products/{nameProducts}', [ProductController::class,'search']);
Route::middleware(\App\Http\Middleware\CheckToken::class)->post('/delete',[ProductController::class,'delete']);
Route::middleware(\App\Http\Middleware\CheckToken::class)->post('/updateProduct/{id}',[ProductController::class,'update']);
Route::middleware(\App\Http\Middleware\CheckToken::class)->post('/admin/login',[ProductController::class,'loginAsAdminstrator']);

Route::get('/certificates', [CertificateController::class,'index']);
Route::middleware(\App\Http\Middleware\CheckToken::class)->post('/certificates/store', [CertificateController::class,'store']);
Route::middleware(\App\Http\Middleware\CheckToken::class)->post('/deletecertificates',[CertificateController::class,'delete']);
