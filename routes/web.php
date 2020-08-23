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

Route::get('/', function () {
    return view('welcome');
});
//backend
//Login
Route::get('reg-auth','LoginAdmincontroller@regauth');
Route::post('registerauth','LoginAdmincontroller@registerauth');
Route::get('authlogin','LoginAdmincontroller@authlogin');
Route::post('login-auth','LoginAdmincontroller@login_auth');
Route::get('log-out-auth','LoginAdmincontroller@logout_auth');

Route::group(['middleware' => 'login'],function(){
	Route::get('dashboard','Admincontroller@dashboard');
	//Danh mục sản phẩm
	Route::get('category','Admincontroller@category');
	Route::get('add-category','Admincontroller@add_category');
	Route::get('all-category','Admincontroller@all_category');
	Route::get('active/{id}','Admincontroller@active');
	Route::get('un-active/{id}','Admincontroller@unactive');
	Route::get('delete/{id}','Admincontroller@delete');
	Route::get('edit-category/{id}','Admincontroller@editcategory');
	Route::get('update-category/{id}','Admincontroller@updatecategory');
	//Sản phẩm
	Route::get('product','Admincontroller@product');
	Route::post('add-product','Admincontroller@add_product');
	Route::get('all-product','Admincontroller@all_product');
	Route::get('activeproduct/{id}','Admincontroller@activeproduct');
	Route::get('un-activeproduct/{id}','Admincontroller@unactiveproduct');
	Route::get('deleteproduct/{id}','Admincontroller@deleteproduct');
	Route::get('edit-product/{id}','Admincontroller@editproduct');
	Route::post('update-product/{id}','Admincontroller@updateproduct');
	//Coupon
	Route::get('coupon','CouponController@coupon');
	Route::post('add-coupon','CouponController@add_coupon');
	Route::get('all-coupon','CouponController@all_coupon');
	Route::get('delete-coupon/{id}','CouponController@delete_coupon');

	//Order

	Route::get('all-order','OrderController@all_order');
	Route::get('view-order/{order_code}','OrderController@view_order');
	Route::post('status-order/{id}','OrderController@status_order');
	Route::get('delete-order/{order_code}','OrderController@delete_order');

	//Slider
	Route::get('slider','SliderController@slider');
	Route::post('add-slider','SliderController@add_slider');
	Route::get('all-slider','SliderController@all_slider');
	Route::get('un-slider/{id}','SliderController@un_slider');
	Route::get('active-slider/{id}','SliderController@active_slider');
	Route::get('delete-slider/{id}','SliderController@delete_slider');

	//Poster
	Route::get('Poster','PosterController@Poster');
	Route::get('all-Poster','PosterController@all_poster');
	Route::post('add-poster','PosterController@add_poster');
	Route::get('un-poster/{id}','PosterController@un_poster');
	Route::get('active-poster/{id}','PosterController@active_poster');
	Route::get('delete-poster/{id}','PosterController@delete_poster');
});

Route::group(['middleware' => 'adminlogin'],function(){
	//User_admin
	Route::get('User-admin','UserAdminController@user_admin');
	Route::post('save-user','UserAdminController@save_user');
	Route::get('all-user','UserAdminController@all_user');
	Route::post('assign-roles','UserAdminController@assign_roles');
	Route::get('delete-user/{id}','UserAdminController@delete_user');
});






// Home
Route::get('/','Homecontroller@index');
Route::get('category/{id}','Homecontroller@show_category');
Route::get('details/{id}','Homecontroller@details');
Route::get('user','Homecontroller@user');
Route::post('edit-user/{id}','Homecontroller@edit_user');
Route::get('code-order','Homecontroller@code_order');
Route::get('puchase-menu/{code_order}','Homecontroller@puchase_menu');
Route::post('custody/{id}','Homecontroller@custody');
Route::post('check-images/{id}','Homecontroller@check_images');



//Cart
Route::post('add-cart','Cartcontroller@add_cart');
Route::get('show-cart','Cartcontroller@show_cart');
Route::post('update-cart','Cartcontroller@update_cart');
Route::get('delete-cart/{id}','Cartcontroller@delete_cart');
Route::get('order','Cartcontroller@order');
Route::post('check-coupon','Cartcontroller@check_coupon');
Route::get('unset-coupon','Cartcontroller@unset_coupon');
Route::post('payment','Cartcontroller@payment');
Route::POST('/add-cart-ajax','Cartcontroller@add_cart_ajax');
Route::get('show-cart-ajax','Cartcontroller@show_cart_ajax');

//Login
Route::get('reg','Logincontroller@reg');
Route::post('register','Logincontroller@register');
Route::get('log-out','Logincontroller@logout');
Route::get('log-in','Logincontroller@log_in');
Route::post('login','Logincontroller@login');
