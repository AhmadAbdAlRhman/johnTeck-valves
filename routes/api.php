<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CertificateController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/products', [ProductController::class,'index']);
Route::get('/product', [ProductController::class,'ShowById']);
Route::post('/storage',[ProductController::class,'store']);
Route::get('/products/{nameProducts}', [ProductController::class,'search']);
Route::post('/delete',[ProductController::class,'delete']);
Route::post('/updateProduct/{id}',[ProductController::class,'update']);
Route::post('/admin/login',[ProductController::class,'loginAsAdminstrator']);

Route::get('/certificates', [CertificateController::class,'index']);
Route::post('/certificates/store', [CertificateController::class,'store']);
Route::post('/deletecertificates',[CertificateController::class,'delete']);
Route::fallback(function () {
    return response()->json(['message' => 'Route Not Found'], 404);
});
Route::get('/admin', [ProductController::class,'adminDashboard']);
Route::get('/search', [ProductController::class,'search']);
Route::delete('/products/{id}', [ProductController::class,'delete']);
