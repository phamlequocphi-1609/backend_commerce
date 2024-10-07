<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Frontend\AccountController;
use App\Http\Controllers\frontend\BlogMemberController;
use App\Http\Controllers\Frontend\CartMemberController;
use App\Http\Controllers\Frontend\CheckOutController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\MemberController;
use App\Http\Controllers\Frontend\MenuLeftController;
use App\Http\Controllers\Frontend\ProductMemberControlller;
use App\Http\Controllers\Frontend\ShowMenuLeftController;
use Illuminate\Support\Facades\Auth;
use Whoops\Run;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




// Frontend
Route::get('/index', [HomeController::class, 'index']); 
Route::post('/index', [HomeController::class, 'addCart']);

Route::group([
    'middleware' => 'member',
], function(){
    
    Route::prefix('/member')->group(function(){
        Route::get('/logout', [MemberController::class, 'logout']);
        Route::get('/blog', [BlogMemberController::class, 'bloglist']);
        Route::get('/blog/detail/{id}', [BlogMemberController::class, 'blogdetail'])->name('blog.detail');
        Route::post('/blog/detail/{id}', [BlogMemberController::class, 'blogcomment']);
        Route::post('/blog/rate', [BlogMemberController::class, 'rate'])->name('rate'); 
        Route::get('/account/update', [MemberController::class, 'account'])->name('account');
        Route::post('/account/update', [MemberController::class, 'memberUpdate']);
        Route::get('/account/my-product',[ProductMemberControlller::class, 'index'])->name('account');
        Route::get('/account/add-product', [ProductMemberControlller::class, 'getdata'])->name('account');
        Route::post('/account/add-product', [ProductMemberControlller::class, 'create']);
        Route::get('/account/edit-product/{id}', [ProductMemberControlller::class, 'getEdit'])->name('productEdit');
        Route::post('/account/edit-product/{id}', [ProductMemberControlller::class, 'update']);
        Route::get('/account/delete-product/{id}', [ProductMemberControlller::class, 'delete'])->name('productDelete');
        Route::get('/product/detail/{id}', [ProductMemberControlller::class, 'detail'])->name('productDetail');
    });
   
    Route::prefix('/product')->group(function(){
        Route::get('/search', [ProductMemberControlller::class, 'search']);
        Route::get('/searchAdvanced', [ProductMemberControlller::class, 'searchAdvanced']);
    });
    
    Route::prefix('/cart')->group(function(){
        Route::get('/', [CartMemberController::class, 'cart'])->name('cart');
        Route::post('/increase', [CartMemberController::class, 'increase']);
        Route::post('/remove', [CartMemberController::class, 'remove']);
        Route::post('/reduce', [CartMemberController::class, 'reduce']);
    });
    
    Route::get('/checkout', [CheckOutController::class, 'check'])->name('cart');
    Route::get('/checkInformation', [CheckOutController::class, 'information']);
    
    Route::post('/price/selected', [ProductMemberControlller::class, 'priceSelect']);
    
});



Route::group([
    'middleware'=>'memberNotlogin'

], function(){
    Route::prefix('/member')->group(function(){
        Route::get('/login', [MemberController::class, 'getDataMember']);
        Route::post('/login', [MemberController::class, 'login']);
        Route::get('/register', [MemberController::class, 'getDataRegisterMember']);
        Route::post('/register', [MemberController::class, 'create']);
    });
});

// Admin
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', function () {
    return view('welcome');
});

Route::group([
    // 'prefix'=>'admin',
    'middleware'=> ['admin']
], function(){
    Route::get('/dashboard', [DashboardController::class, 'index']);
    
    Route::prefix('/user')->group(function () {
        Route::get('/profile', [UsersController::class, 'userProfile']);
        Route::post('/profile', [UsersController::class, 'updateUser']);
        Route::get('/add', [UsersController::class, 'getData']);
        Route::post('/add', [UsersController::class,'create']);
    });

    Route::prefix('/country')->group(function(){
        Route::get('/list', [CountryController::class, 'index']);
        Route::get('/add', [CountryController::class, 'getdata']);
        Route::post('/add', [CountryController::class, 'create']);
        Route::get('/delete/{id}', [CountryController::class, 'delete'])->name('country.delete');
    });
 
    Route::prefix('/blog')->group(function(){
        Route::get('/list', [BlogController::class, 'index']);
        Route::get('/add', [BlogController::class, 'getdata']);
        Route::post('/add', [BlogController::class, 'create']);
        Route::get('/delete/{id}', [BlogController::class, 'delete'])->name('blog.delete');
        Route::get('/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
        Route::post('/edit/{id}', [BlogController::class, 'update']);
    });
    
    Route::prefix('/category')->group(function(){
        Route::get('/', [CategoryController::class, 'index']);
        Route::get('/add', [CategoryController::class, 'getData']);
        Route::post('/add', [CategoryController::class, 'create']);
        Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('categoryDelete');
    });
    
    Route::prefix('/brand')->group(function(){
        Route::get('/add', [BrandController::class, 'index']);
        Route::post('/add', [BrandController::class, 'getdata']);
        Route::get('/add', [BrandController::class, 'create']);
        Route::get('/delete/{id}', [BrandController::class, 'delete'])->name('brandDelete');
    });
});