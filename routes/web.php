<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\User;
use App\Http\Controllers\Products;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});



Route::inertia('/view/cart', 'ShoppingCart');
Route::get('/products/{product_id}/detail', [Products::class, 'getProductById']);
Route::get('/add/product/{product_id}/cart', [Products::class, 'addProductToCart']);
Route::get('/remove/product/{product_id}/cart', [Products::class, 'removeProducFromCart']);
Route::get('/view/products', [Products::class, 'getProducts']);
Route::get('/get/cart/items', [Products::class, 'getCartItems']);
Route::get('/checkout', [Products::class, 'checkOut']);