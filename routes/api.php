<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\API\MessageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::apiResource('messages', 'API\MessageController');

Route::post('customers/login', 'API\CustomerController@login');
Route::apiResource('customers', 'API\CustomerController');

Route::apiResource('/brand/{year}/', 'API\BrandController');
Route::get('brand', 'API\BrandController@getAllBrands');


Route::apiResource('version', 'API\VersionController');

Route::post('product/filter', 'API\ProductController@filter');
Route::post('product/searchByWord', 'API\ProductController@searchByWord');
Route::apiResource('product', 'API\ProductController');

Route::get('/model/{id}/version/{year}', 'API\ModelController@versions');//esto es para obtener las versiones de un modelo
Route::get('/model/year/{year}/brand/{id}', 'API\ModelController@getByBrand');
Route::get('/model/onSale', 'API\ModelController@getAllOnSale');
Route::apiResource('model', 'API\ModelController');

Route::get('/market/lessBrands', 'API\MarketLaunchController@getLessBrands');
Route::get('/market/mostBrands', 'API\MarketLaunchController@getMostBrands');
Route::post('/market/full', 'API\MarketLaunchController@getCotization');
Route::apiResource('market', 'API\MarketLaunchController');

Route::apiResource('km', 'API\KMController');

Route::post('appointment/product', 'API\AppointmentController@product');
Route::apiResource('appointment', 'API\AppointmentController');

Route::get('customMarket/getMostDate', 'API\CustomMarketController@getMostQuotesDate');
Route::get('customMarket/getLessDate', 'API\CustomMarketController@getLessQuotesDate');
Route::get('customMarket/getMostKM', 'API\CustomMarketController@getMostQuotesKM');
Route::get('customMarket/getLessKM', 'API\CustomMarketController@getLessQuotesKM');
Route::get('customMarket/getMostCC', 'API\CustomMarketController@getMostQuotesCC');
Route::get('customMarket/getLessCC', 'API\CustomMarketController@getLessQuotesCC');
Route::get('customMarket/getMostBikes', 'API\CustomMarketController@getMostQuotesBikes');
Route::get('customMarket/getLessBikes', 'API\CustomMarketController@getLessQuotesBikes');
Route::apiResource('customMarket', 'API\CustomMarketController');

Route::get('product/{id}/images', 'API\ProductController@getImages');
Route::apiResource('product', 'API\ProductController');

Route::get('quotation/lessCC', 'API\QuotationController@getLessCC');
Route::get('quotation/mostCC', 'API\QuotationController@getMostCC');
Route::get('quotation/lessVersions', 'API\QuotationController@getLessVersions');
Route::get('quotation/mostVersions', 'API\QuotationController@getMostVersions');
Route::get('quotation/lessBrands', 'API\QuotationController@getLessBrands');
Route::get('quotation/mostBrands', 'API\QuotationController@getMostBrands');
Route::apiResource('quotation', 'API\QuotationController');
