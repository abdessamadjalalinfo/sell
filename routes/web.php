<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Image;
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
    $products = Product::all();
    return view('index', ['products' => $products]);
})->name('accueil');
Route::get('/home', function () {
    $products = Product::all();
    return view('home', ['products' => $products]);
})->name('home');

Route::get('/products', function () {
    $products = Product::all();
    return view('products', ['products' => $products]);
})->name('services');

Route::get('/about', function () {

    return view('about');
})->name('about');




Route::get('product/{id}', function ($id) {
    $product = Product::find($id);
    $products = Product::all();
    return view('product', ['product' => $product, 'products' => $products]);
})->name('product');
Route::get('contact', function () {

    return view('contact');
})->name('contact');
Route::post('/update', [App\Http\Controllers\ProductController::class, 'update'])->name('update');


Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::post('/add', [App\Http\Controllers\ProductController::class, 'add'])->name('add');
Route::get('/delete/{id}', [App\Http\Controllers\ProductController::class, 'delete'])->name('delete');
