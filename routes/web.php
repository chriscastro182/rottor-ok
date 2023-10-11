<?php

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

Route::get('/', 'HomeController@index');
Route::get('/test', 'HomeController@test');
Route::post('/contact', 'HomeController@contact')->name('home.contact');
/*Route::get('/mailcontact', function(){
	$customerService = new App\Services\CustomerService\CustomerService();
	$messageService = new App\Services\MessageService\MessageService();

	$customer = $customerService->get(1);
	$message = $messageService->getLastMessageByCustomer($customer->id);

	return new App\Mail\CustomerContact($customer, $message);
});*/
Route::get('/home', 'HomeController@home')->name('home');
Route::get('/privacy', 'HomeController@privacy')->name('privacy');

Route::prefix('admin')->group(function(){
    //Route::get('products/{id}/images', 'ProductController@getImages');
	Route::resource('products', 'ProductController');

    Route::get('models/{id}/versions/allForm', 'ModelController@getVersions');
	Route::resource('models', 'ModelController');

    Route::get('brands/allForm', 'BrandController@getAllForSelect');
    Route::get('brands/{id}/models/allForm', 'BrandController@getModelsForBrand');
	Route::resource('brands', 'BrandController');

	Route::resource('kms', 'KmController');

	Route::resource('motors', 'MotorController');

	Route::post('factors/bulkImporter', 'FactorController@bulkImporter')->name('factors.bulkImporter');
	Route::get('factors/bulk', 'FactorController@bulkImport')->name('factors.bulk');
	Route::resource('factors', 'FactorController');

	Route::post('markets/bulkImporter', 'MarketLaunchController@bulkImporter')->name('markets.bulkImporter');
	Route::get('markets/bulk', 'MarketLaunchController@bulkImport')->name('markets.bulk');
	Route::resource('markets', 'MarketLaunchController');


    Route::post('customMarkets/search', 'CustomMarketController@search')->name('customMarkets.search');
    Route::post('customMarkets/report', 'CustomMarketController@report')->name('customMarkets.report');
    Route::resource('customMarkets', 'CustomMarketController');


    Route::resource('versions', 'VersionController');

    Route::post('users/logout', 'UserController@logout')->name('users.logout');
});

Route::group(['namespace' => 'Front'], function(){
    Route::resource('appointments', 'AppointmentController');

    Route::get('products', 'ProductController@index')->name('front.products.index');
    Route::get('products/{id}/form', 'ProductController@registerForm')->name('front.products.form');
	Route::get('products/{id}', 'ProductController@show')->name('front.products.show');
    Route::post('products/filter', 'ProductController@filter')->name('front.products.filter');
    Route::get('sellInfo', 'SellController@info')->name('front.sell.info');
	Route::get('sell', 'SellController@index')->name('front.sell.index');
	Route::get('buy', 'BuyController@index')->name('front.buy.index');
});
