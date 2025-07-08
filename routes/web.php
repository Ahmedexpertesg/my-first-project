<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Cartcontroller;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;


//Home

Route::get('/contact', [HomeController::class, 'ContactUs'])->name('contact');
Route::get('/about', [HomeController::class, 'About'])->name('about');
Route::get('/', [HomeController::class, 'MainPage']);
Route::get('product/{catid?}', [HomeController::class, 'GetProduct'])->name('product');
Route::get('category', [HomeController::class , 'GetCategoryProduct']);
Route::post('/searchProducts', [HomeController::class , 'SearchProducts'] );




//Cart
Route::middleware('auth')->group(function () {
    Route::get('/cart', [Cartcontroller::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [Cartcontroller::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [Cartcontroller::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [Cartcontroller::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [Cartcontroller::class, 'clear'])->name('cart.clear');
});


//Order
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'showCheckoutForm'])->name('checkout');
    Route::post('/place-order', [CheckoutController::class, 'placeOrder'])->name('place.order');
    Route::get('/checkout-success', [CheckoutController::class, 'success'])->name('checkout.success');
});


// User side (product details)
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');


                          //admin routes//

//products//
Route::get('dashbord', [AdminHomeController::class, 'Index'])->name('dashbord');
Route::get('addProduct', [ProductController::class , 'AddProduct']);
Route::post('/storeproduct', [ProductController::class , 'StoreProduct'] );
Route::get('allproducts', [ProductController::class , 'AllProducts'])->name('allproducts');
Route::get('editproduct/{productid?}', [ProductController::class , 'EditProduct']);
Route::delete('removeproduct/{productid}', [ProductController::class , 'RemoveProduct']);

//orders
Route::get('/allorders',[ OrderController::class, 'AllOrders'])->name('admin.orders.index');
Route::get('/admin/orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');

//Categories
Route::get('/category/index',[ CategoryController::class, 'GetAllCategories'])->name('admin.category.index');
Route::get('/category/create',[ CategoryController::class, 'CreateCategory'])->name('admin.category.create');
Route::post('/storecategory',[ CategoryController::class, 'StoreCategory'])->name('storecategory');
Route::get('/category/edit/{category}', [CategoryController::class, 'EditCategory'])->name('category.edit');
Route::put('/category/update/{category}', [CategoryController::class, 'UpdateCategory'])->name('category.update');
Route::delete('/category/{category}', [CategoryController::class, 'DestroyCategory'])->name('category.destroy');





Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
