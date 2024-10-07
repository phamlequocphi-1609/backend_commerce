<?php
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    Route::prefix('/product')->group(function(){
        Route::get('/', [ProductController::class, 'productHome']);
        Route::get('/list', [ProductController::class, 'productList']);
        Route::get('/detail/{id}', [ProductController::class, 'productDetail']);
        Route::post('/cart', [ProductController::class, 'productCart']);
        Route::get('/wishlist', [ProductController::class, 'productWishlist']);
        Route::get('/searchAdvanced', [ProductController::class, 'searchAdvanced']);
    });
    
    // Blog
    Route::prefix('/blog')->group(function(){
        Route::get('/list', [BlogController::class, 'list']);
        Route::get('/detail/{id}', [BlogController::class, 'show']);
        Route::get('/detail-pagination/{id}', [BlogController::class, 'paginationBlogDetail']);
        Route::get('/rate/{id}', [BlogController::class, 'getrate']);
    });

    
    // Country-brand
    Route::get('/category-brand', [ProductController::class, 'listCategoryBrand']);
   
     
    Route::middleware(['auth:sanctum'])->group(function(){    
        Route::get('/myProduct', [ProductController::class, 'myproduct']);

        Route::prefix('/user')->group(function(){
            Route::post('/update/{id}', [MemberController::class, 'update']);
            Route::post('/product/add', [ProductController::class, 'store']);
            Route::get('/product/{id}', [ProductController::class, 'show']);
            Route::post('/product/update/{id}', [ProductController::class, 'update']);
            Route::get('/product/delete/{id}', [ProductController::class, 'deleteProduct']);
        });

        Route::prefix('/blog')->group(function(){
            Route::post('/comment/{id}',[BlogController::class, 'comment']);
            Route::post('/rate/{id}', [BlogController::class, 'rateBlog']);
        });
    });

});