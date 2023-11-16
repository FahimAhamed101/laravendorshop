<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\IndexController;
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

Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('All/vendor/List', [IndexController::class, 'allVendor'])->name('all.vendor');
Route::post('search',[IndexController::class,'ProductSearch'])->name('product.search');
Route::post('search-product',[IndexController::class,'SearchProduct']);
Route::get('wishlist', [WishlistController::class, 'allWishlist'])->name('wishlist');
Route::get('compare', [CompareController::class, 'allCompare'])->name('compare');
Route::get('myCart',[CartController::class,'MyCart'])->name('myCart');
Route::get('checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');
Route::get('user/login',[UserController::class,'userLogin'])->name('user.login');
Route::get('user/register',[UserController::class,'userRegister'])->name('user.register');
Route::get('product/category/{id}/{slug}', [IndexController::class, 'productCategory']);
Route::get('product/subcategory/{id}/{slug}', [IndexController::class, 'productSubCategory']);
Route::get('shop', [ShopController::class, 'ShopPage'])->name('shop.page');
Route::get('blog',[BlogController::class,'AllBlog'])->name('home.blog');
Route::get('become/vendor',[VendorController::class,'BecomeVendor'])->name('become.vendor');