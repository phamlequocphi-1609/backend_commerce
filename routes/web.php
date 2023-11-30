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

   
    Route::get('/member/logout', [MemberController::class, 'logout']);
    
    
    Route::get('/member/blog', [BlogMemberController::class, 'bloglist']);
    Route::get('/member/blog/detail/{id}', [BlogMemberController::class, 'blogdetail'])->name('blog.detail');
    Route::post('/member/blog/detail/{id}', [BlogMemberController::class, 'blogcomment']);
    
    Route::post('/member/blog/rate', [BlogMemberController::class, 'rate'])->name('rate');
    
    
    Route::get('/member/account/update', [MemberController::class, 'account'])->name('account');
    Route::post('/member/account/update', [MemberController::class, 'memberUpdate']);
    
    Route::get('/member/account/my-product',[ProductMemberControlller::class, 'index'])->name('account');
    Route::get('/member/account/add-product', [ProductMemberControlller::class, 'getdata'])->name('account');
    Route::post('/member/account/add-product', [ProductMemberControlller::class, 'create']);
    Route::get('/member/account/edit-product/{id}', [ProductMemberControlller::class, 'getEdit'])->name('productEdit');
    Route::post('/member/account/edit-product/{id}', [ProductMemberControlller::class, 'update']);
    Route::get('/member/account/delete-product/{id}', [ProductMemberControlller::class, 'delete'])->name('productDelete');
    Route::get('/member/product/detail/{id}', [ProductMemberControlller::class, 'detail'])->name('productDetail');
    Route::get('/product/search', [ProductMemberControlller::class, 'search']);
    Route::get('/product/searchAdvanced', [ProductMemberControlller::class, 'searchAdvanced']);
    
    
    Route::get('/cart', [CartMemberController::class, 'cart'])->name('cart');
    Route::post('/cart/increase', [CartMemberController::class, 'increase']);
    Route::post('/cart/remove', [CartMemberController::class, 'remove']);
    Route::post('/cart/reduce', [CartMemberController::class, 'reduce']);
    
    
    Route::get('/checkout', [CheckOutController::class, 'check'])->name('cart');
    Route::get('/checkInformation', [CheckOutController::class, 'information']);
    
    Route::post('/price/selected', [ProductMemberControlller::class, 'priceSelect']);
    
    
});

Route::group([
    'middleware'=>'memberNotlogin'
], function(){
    Route::get('/member/login', [MemberController::class, 'getDataMember']);
    Route::post('/member/login', [MemberController::class, 'login']);

    Route::get('/member/register', [MemberController::class, 'getDataRegisterMember']);
    Route::post('/member/register', [MemberController::class, 'create']);
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

    Route::get('/user/profile', [UsersController::class,'userProfile']);
    Route::post('/user/profile', [UsersController::class, 'updateUser']);
    Route::get('/user/add', [UsersController::class, 'getData']);
    Route::post('/user/add', [UsersController::class,'create']);
    
    
    Route::get('/country/list',[CountryController::class, 'index']);
    Route::get('/country/add', [CountryController::class, 'getdata']);
    Route::post('/country/add', [CountryController::class, 'create']);
    Route::get('/country/delete/{id}', [CountryController::class, 'delete'])->name('country.delete');
    
    
    Route::get('/blog/list', [BlogController::class, 'index']);
    Route::get('/blog/add', [BlogController::class, 'getdata']);
    Route::post('/blog/add', [BlogController::class, 'create']);
    Route::get('/blog/list', [BlogController::class, 'index']);
    Route::get('/blog/delete/{id}', [BlogController::class, 'delete'])->name('blog.delete');
    Route::get('/blog/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
    Route::post('/blog/edit/{id}', [BlogController::class, 'update']);
    
    Route::get('/category', [CategoryController::class, 'index']);
    Route::get('/category/add', [CategoryController::class, 'getData']);
    Route::post('/category/add', [CategoryController::class, 'create']);
    Route::get('/category/delete/{id}', [CategoryController::class, 'delete'])->name('categoryDelete');
    
    Route::get('/brand', [BrandController::class, 'index']);
    Route::get('/brand/add', [BrandController::class, 'getdata']);
    Route::post('/brand/add', [BrandController::class, 'create']);
    Route::get('/brand/delete/{id}', [CategoryController::class, 'delete'])->name('brandDelete');
});
