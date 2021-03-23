<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//追加admin用
Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm')->name('admin-login');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');

Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin')->name('admin-register');

Route::view('/admin', 'admin')->middleware('auth:admin')->name('admin-home');

//画像アップロード用
Route::post('/admin', 'UploadImageController@upload')->name('admin-upload');

//カートに入れるボタンクリック時
Route::post('/home', 'Item_in_cart_Controller@item_in_cart')->name('item-inCart');

//カートボタンクリック時
Route::get('/purchase', 'Item_in_cart_Controller@cart_click')->name('item-cartClick');

//購入処理&削除ボタンクリック時(カートから削除)
Route::post('/purchase', 'Item_in_cart_Controller@item_purchase')->name('item-purchase');

//admin画面
Route::get('/show_registerItems', 'Show_registerItems_Controller@index')->name('admin-showItems');
Route::get('/admin', 'Show_registerItems_Controller@adminindex')->name('admin-index');
Route::get('/purcahse_notiflcation', 'Show_registerItems_Controller@purchase_notiflcation')->name('admin-notiflcation');

//購入履歴
Route::get('/purchase_history', 'Purchase_history_Controller@index')->name('purchase-history');
