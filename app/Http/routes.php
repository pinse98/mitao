<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::post('test', 'WelcomeController@test');

// 用户登录
Route::get('login', 'AuthController@login');

Route::post('login', 'AuthController@postLogin');

// 用户注册
Route::get('register', 'AuthController@register');

Route::post('register', 'AuthController@userCreate');

// 商品详情
Route::get('product/details/{id}','ProductController@show');
// 图文详情
Route::get('product/details/image/{id}','ProductController@images');
// 商品SKU列表
Route::get('product/lists/{id}','ProductController@lists');

Route::get('admin/login', 'Admin\AdminAuthController@login');

Route::post('admin/login', 'Admin\AdminAuthController@check');

Route::get('admin/logout', 'Admin\AdminAuthController@logout');
// 订单支付
Route::get('order/payment', 'PaymentController@pay');
// 支付返回页面
Route::get('order/result', 'PaymentController@returnPage');

Route::group(['middleware' => 'AuthLogin'], function()
{
    // 领取红包
    Route::get('coupon/receive', 'CouponController@receive');

    Route::post('coupon/receive', 'CouponController@postReceive');

    Route::get('coupon/success/{price}', 'CouponController@success');

    // 用户中心
    Route::get('my/user/center', 'UserCenterController@index');

    Route::get('my/order/success', 'UserCenterController@orderSuccess');

    Route::get('my/order/waitpay', 'UserCenterController@orderWaitpay');

    Route::get('my/order/viewShipping/{orderId}', 'UserCenterController@viewShipping');

    Route::get('my/coupon', 'UserCenterController@coupon');

    // 用户收获地址
    Route::get('my/shipping/create', 'ShippingController@create');

    Route::post('my/shipping/create', 'ShippingController@store');

    Route::get('my/shipping', 'ShippingController@index');

    Route::get('my/shipping/edit/{id}', 'ShippingController@edit');

    Route::post('my/shipping/edit/{id}', 'ShippingController@update');

    // 订单详情
    Route::get('order/details/{id}', 'OrderController@details');
    // 订单提交
    Route::post('order/details/{id}', 'OrderController@postDetails');
    // 成功提交订单
    Route::get('order/success/{orderId}', 'OrderController@success');
    // 验证优惠劵
    Route::post('order/coupon/used', 'OrderController@couponUsed');

});

Route::group(['prefix' => 'api'], function(){

    // 支付宝异步通知方法
    Route::post('notify', 'PaymentController@notify');

});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'AdminAuthLogin'], function(){

    // sku网络管理
    Route::get('sku/network/show', 'AdminNetworkController@index');

    Route::get('sku/network/create', 'AdminNetworkController@create');

    Route::post('sku/network/create', 'AdminNetworkController@store');

    Route::get('sku/network/edit/{id}', 'AdminNetworkController@edit');

    Route::post('sku/network/edit/{id}', 'AdminNetworkController@update');

    Route::get('sku/network/delete/{id}', 'AdminNetworkController@destroy');

    // sku储存管理
    Route::get('sku/storage/show', 'AdminStorageController@index');

    Route::get('sku/storage/create', 'AdminStorageController@create');

    Route::post('sku/storage/create', 'AdminStorageController@store');

    Route::get('sku/storage/edit/{id}', 'AdminStorageController@edit');

    Route::post('sku/storage/edit/{id}', 'AdminStorageController@update');

    Route::get('sku/storage/delete/{id}', 'AdminStorageController@destroy');

    // sku内存管理
    Route::get('sku/memory/show', 'AdminMemoryController@index');

    Route::get('sku/memory/create', 'AdminMemoryController@create');

    Route::post('sku/memory/create', 'AdminMemoryController@store');

    Route::get('sku/memory/edit/{id}', 'AdminMemoryController@edit');

    Route::post('sku/memory/edit/{id}', 'AdminMemoryController@update');

    Route::get('sku/memory/delete/{id}', 'AdminMemoryController@destroy');

    // sku颜色管理
    Route::get('sku/color/show', 'AdminColorController@index');

    Route::get('sku/color/create', 'AdminColorController@create');

    Route::post('sku/color/create', 'AdminColorController@store');

    Route::get('sku/color/edit/{id}', 'AdminColorController@edit');

    Route::post('sku/color/edit/{id}', 'AdminColorController@update');

    Route::get('sku/color/delete/{id}', 'AdminColorController@destroy');

    // 小图管理
    Route::get('sku/image/show', 'AdminImageController@index');

    Route::get('sku/image/create', 'AdminImageController@create');

    Route::post('sku/image/create', 'AdminImageController@store');

    Route::get('sku/image/edit/{id}', 'AdminImageController@edit');

    Route::post('sku/image/edit/{id}', 'AdminImageController@update');

    Route::get('sku/image/delete/{id}', 'AdminImageController@destroy');

    // 商品管理
    Route::get('product/show', 'AdminProductController@index');

    Route::get('product/create', 'AdminProductController@create');

    Route::post('product/create', 'AdminProductController@store');

    Route::get('product/edit/{id}', 'AdminProductController@edit');

    Route::post('product/edit/{id}', 'AdminProductController@update');

    Route::get('product/delete/{id}', 'AdminProductController@destroy');

    // 商品SKU管理
    Route::get('product/sku/show/{id}', 'AdminProductSukController@index');

    Route::get('product/sku/create/{id}', 'AdminProductSukController@create');

    Route::post('product/sku/create/{id}', 'AdminProductSukController@store');

    Route::get('product/sku/edit/{pid}/{id}', 'AdminProductSukController@edit');

    Route::post('product/sku/edit/{pid}/{id}', 'AdminProductSukController@update');

    Route::get('product/sku/delete/{pid}/{id}', 'AdminProductSukController@destroy');

    // 用户管理
    Route::get('users/show', 'AdminUserController@index');

    Route::get('users/create', 'AdminUserController@create');

    Route::post('users/create', 'AdminUserController@store');

    Route::get('users/edit/{id}', 'AdminUserController@edit');

    Route::post('users/edit/{id}', 'AdminUserController@update');

    Route::get('users/enable/{id}', 'AdminUserController@destroy');

    Route::get('users/pay/commission/{uid}', 'AdminUserController@payCommission');

    Route::get('users/members/show', 'AdminUserController@memberShow');

    // 优惠管理
    Route::get('coupon/show', 'AdminCouponController@index');

    Route::get('coupon/create', 'AdminCouponController@create');

    Route::post('coupon/create', 'AdminCouponController@store');

    Route::get('coupon/edit/{id}', 'AdminCouponController@edit');

    Route::post('coupon/edit/{id}', 'AdminCouponController@update');

    Route::get('coupon/delete/{id}', 'AdminCouponController@destroy');

    // 订单管理
    Route::get('orders/show', 'AdminOrderController@index');

    Route::get('orders/pay/{orderId}', 'AdminOrderController@pay');

    Route::get('orders/view/shipping/{orderId}', 'AdminOrderController@viewShipping');

    Route::get('orders/send/shipping/{orderId}', 'AdminOrderController@sendShipping');

    Route::post('orders/send/shipping/{orderId}', 'AdminOrderController@sendOrderShipping');

    Route::get('orders/edit/{id}', 'AdminOrderController@edit');

    Route::post('orders/edit/{id}', 'AdminOrderController@update');

    Route::get('orders/delete/{id}', 'AdminOrderController@destroy');

    // 首页排版管理
    Route::get('show/show', 'AdminShowController@index');

    Route::get('show/create', 'AdminShowController@create');

    Route::post('show/create', 'AdminShowController@store');

    Route::get('show/edit/{id}', 'AdminShowController@edit');

    Route::post('show/edit/{id}', 'AdminShowController@update');

    Route::get('show/delete/{id}', 'AdminShowController@destroy');

    // 首页广告管理
    Route::get('advert/show', 'AdminShowController@advertShow');

    Route::get('advert/create', 'AdminShowController@advertCreate');

    Route::post('advert/create', 'AdminShowController@advertStore');

    Route::get('advert/edit/{id}', 'AdminShowController@advertEdit');

    Route::post('advert/edit/{id}', 'AdminShowController@advertUpdate');

    Route::get('advert/delete/{id}', 'AdminShowController@advertDestroy');

});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'PromoteAuthLogin'], function(){

    Route::get('promote/user/center', 'AdminUserController@promote');

});