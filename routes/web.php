<?php

use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\SuppliersController;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/index', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('invoices','InvoicesController');
Route::resource('sections','SectionsController');
Route::get('/section/{id}','ProductsController@getBySection');
Route::resource('units','UnitsController');
Route::resource('products','ProductsController');
Route::resource('clients','ClientsController');
Route::resource('cart','CartController');
Route::get('cart/{id}/delete','CartController@deleteItem');
Route::get('cart/{id}/empty','CartController@empty');
Route::get('cart/multiple/{id}','CartController@showCart');
Route::post('/cart/storeTmp','CartController@storeCustomProduct');

/*** ---------------- This is Orders Route ------------------------ */

Route::resource('order','OrdersController');
Route::post('order/search','OrdersController@search');
Route::get('order/delete/{id}','OrdersController@delete');



Route::resource('suppliers', 'SuppliersController');
Route::resource('suppliercart','SuppliercartController');
Route::resource('supplierInvoice','SupplierInvoiceController');
Route::get('/suppliercart/delete/{id}','SuppliercartController@delete');
Route::get('/supplierInvoice/delete/{id}','SupplierInvoiceController@delete');


Route::resource('orderItems','OrderItemsController');
Route::get('orderItem/delete/{id}','OrderItemsController@delete');

















Route::get('/{page}','AdminController@index');
