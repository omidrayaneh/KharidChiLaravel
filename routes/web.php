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

Auth::routes();

Route::prefix('api')->group(function (){
    Route::get('/categories','Backend\CategoryController@apiIndex');
    Route::post('/categories/attribute','Backend\CategoryController@apiIndexAttribute');
    Route::get('/cities/{provinceId}','Auth\RegisterController@getAllCities');
    Route::get('/products/{id}','Frontend\ProductController@apiGetProduct');
    Route::get('/sort-products/{id}/{sort}/{paginate}','Frontend\ProductController@apiGetSortedProduct');
    Route::get('/category-attribute/{id}','Frontend\ProductController@apiGetCategoryAttributes');
    Route::get('/filter-products/{id}/{sort}/{paginate}/{attributs}','Frontend\ProductController@apigetFilterProduct');
});
Route::prefix('administrator')->group(function (){
    Route::get('/','Backend\MainController@mainPage');
    Route::resource('categories','Backend\CategoryController');
    Route::get('/categories/{id}/settings','Backend\CategoryController@indexSetting')->name('categories.indexSetting');
    Route::post('/categories/{id}/settings','Backend\CategoryController@saveSetting');
    Route::resource('attributes-group','Backend\AttributeGroupController');
    Route::resource('attributes-value','Backend\AttributeValueController');
    Route::resource('brands','Backend\BrandController');
    Route::resource('photos','Backend\PhotoController');
    Route::post('photos/upload','Backend\PhotoController@upload')->name('photos.upload');
    Route::resource('products','Backend\ProductController');
    Route::resource('coupons','Backend\CouponController');
});

Route::group(['middleware' =>'auth'],function(){
    Route::get('/profile','Frontend\UserController@profile')->name('user.profile');
    Route::post('/coupon','Frontend\CouponController@addCoupon')->name('coupon.add');
});

Route::resource('/','Frontend\HomeController');
Route::post('/register-user','Frontend\UserController@register')->name('user.register');
Route::get('/add-product-to-cart/{id}','Frontend\CartController@addToCart')->name('cart.add');
Route::post('/remove-cart-item/{id}','Frontend\CartController@removeItem')->name('cart.remove');
Route::get('/cart','Frontend\CartController@getCart')->name('cart.cart');
Route::get('/products/{slug}','Frontend\ProductController@getProduct')->name('product.single');
Route::get('/category/{id}/','Frontend\ProductController@getProductByCategory')->name('category.index');

