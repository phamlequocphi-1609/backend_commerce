<?php

use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'namespace'=>'Api'
], function(){
    
    // Member
    Route::post('/login', [MemberController::class, 'login']);
    Route::post('/register', [MemberController::class, 'register']);
   
    
    // Product 
    Route::get('/product', [ProductController::class, 'productHome']);
    Route::get('/product/list', [ProductController::class, 'productList']);
    Route::get('/product/detail/{id}', [ProductController::class, 'productDetail']);
    Route::post('/product/cart', [ProductController::class, 'productCart']);
    Route::get('/product/wishlist', [ProductController::class, 'productWishlist']);
    Route::get('/product/searchAdvanced', [ProductController::class, 'searchAdvanced']);
    // Blog
    Route::get('/blog/list', [BlogController::class, 'list']);
    Route::get('/blog/detail/{id}', [BlogController::class, 'show']);
    Route::get('/blog/detail-pagination/{id}', [BlogController::class, 'paginationBlogDetail']);
    Route::get('/blog/rate/{id}', [BlogController::class, 'getrate']);
     
    Route::middleware(['auth:sanctum'])->group(function(){
        Route::post('/user/update/{id}', [MemberController::class, 'update']);
        Route::get('/myProduct', [ProductController::class, 'myproduct']);
        Route::post('/user/product/add', [ProductController::class, 'store']);
        Route::get('/user/product/{id}', [ProductController::class, 'show']);
        Route::post('/user/product/update/{id}', [ProductController::class, 'update']);
        Route::get('/user/product/delete/{id}', [ProductController::class, 'deleteProduct']);
        Route::post('/blog/comment/{id}',[BlogController::class, 'comment']);
        Route::post('/blog/rate/{id}', [BlogController::class, 'rateBlog']);
    });

    // Country-brand
    Route::get('/category-brand', [ProductController::class, 'listCategoryBrand']);



});