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

// ==== Frontend ====
Route::get('/', 'HomeController@index');
Route::get('/homepage', 'HomeController@index');
Route::get('/contact-un', 'HomeController@contact_un');
Route::get('/contact-us/{ct_id}', 'HomeController@contact_us');
Route::get('/about-us', 'HomeController@about_us');
Route::get('/customer-infor/{ct_id}', 'CheckoutController@customer_infor');

// blog
Route::get('/blogpage', 'BlogController@show_blog');
Route::get('/blog-content/{bl_id}', 'BlogController@blog_content');
// search
Route::post('/search', 'HomeController@seaarch');
// category
Route::get('/show-category-product/{cat_id}', 'CategoryProduct@show_category_product');
// brand
Route::get('/show-brands-products/{bra_id}', 'BrandProduct@show_brands_products');
// product
Route::get('/product-detail/{pro_id}', 'ProductController@product_detail');
// cart
Route::post('/save-cart', 'CartController@save_cart');
Route::get('/show-cart', 'CartController@show_cart');
Route::get('/delete-cart/{rowId}', 'CartController@delete_cart');
Route::post('/qty-cart', 'CartController@qty_cart');
Route::get('/our-stock', 'CartController@our_stock');
// checkout
Route::get('/login-checkout', 'CheckoutController@login_checkout');
Route::get('/new-customer', 'CheckoutController@new_customer');
Route::get('/logout-checkout', 'CheckoutController@logout_checkout');
Route::get('/checkout/{ct_id}', 'CheckoutController@checkout');
Route::get('/payment', 'CheckoutController@payment');
Route::post('/save-checkout', 'CheckoutController@save_checkout');
Route::post('/add-customer', 'CheckoutController@add_customer');
Route::post('/login-customer', 'CheckoutController@login_customer');
Route::post('/order-place', 'CheckoutController@order_place');
// order
Route::get('/manage-order', 'CheckoutController@manage_order');
Route::get('/view-order/{order_id}', 'CheckoutController@view_order');
// comment
Route::post('/save-comment', 'ProductController@save_comment');
// messenger 
Route::post('/send-mess', 'HomeController@send_mess');
// counpon
Route::post('/check-coupon', 'CartController@check_coupon');


// ==== Backend ====
Route::get('/admin', 'AdminController@index');
Route::get('/dashboard', 'AdminController@show_dashboard');
Route::post('/admin-dashboad', 'AdminController@dashboard');
Route::get('/logout', 'AdminController@logout');
//staff
Route::get('/add-staff', 'AdminController@add_staff');
Route::get('/list-staff', 'AdminController@list_staff');
Route::post('/save-staff', 'AdminController@save_staff');
Route::get('/delete-staff/{sta_id}', 'AdminController@delete_staff');
Route::get('/edit-staff/{sta_id}', 'AdminController@edit_staff');
Route::get('/pass-staff/{sta_id}', 'AdminController@pass_staff');
Route::post('/update-staff/{sta_id}', 'AdminController@update_staff');
Route::post('/updatepass-staff/{sta_id}', 'AdminController@updatepass_staff');
Route::get('/active-staff/{sta_id}', 'AdminController@active_staff');
Route::get('/unactive-staff/{sta_id}', 'AdminController@unactive_staff');
// category
Route::get('/add-category', 'CategoryProduct@add_category');
Route::get('/list-category', 'CategoryProduct@list_category');
Route::post('/save-category', 'CategoryProduct@save_category');
Route::get('/active-category/{cat_id}', 'CategoryProduct@active_category');
Route::get('/unactive-category/{cat_id}', 'CategoryProduct@unactive_category');
Route::get('/delete-category/{cat_id}', 'CategoryProduct@delete_category');
Route::get('/edit-category/{cat_id}', 'CategoryProduct@edit_category');
Route::post('/update-category/{cat_id}', 'CategoryProduct@update_category');
// brand
Route::get('/add-brand', 'BrandProduct@add_brand');
Route::get('/list-brand', 'BrandProduct@list_brand');
Route::post('/save-brand', 'BrandProduct@save_brand');
Route::get('/active-brand/{bra_id}', 'BrandProduct@active_brand');
Route::get('/unactive-brand/{bra_id}', 'BrandProduct@unactive_brand');
Route::get('/delete-brand/{bra_id}', 'BrandProduct@delete_brand');
Route::get('/edit-brand/{bra_id}', 'BrandProduct@edit_brand');
Route::post('/update-brand/{bra_id}', 'BrandProduct@update_brand');
// blog
Route::get('/add-blog', 'BlogController@add_blog');
Route::get('/list-blog', 'BlogController@list_blog');
Route::post('/save-blog', 'BlogController@save_blog');
Route::get('/active-blog/{bl_id}', 'BlogController@active_blog');
Route::get('/unactive-blog/{bl_id}', 'BlogController@unactive_blog');
Route::get('/delete-blog/{bl_id}', 'BlogController@delete_blog');
Route::get('/edit-blog/{bl_id}', 'BlogController@edit_blog');
Route::post('/update-blog/{bl_id}', 'BlogController@update_blog');
// slide
Route::get('/view-slide', 'SlideController@view_slide');
Route::post('/save-slide', 'SlideController@save_slide');
Route::get('/active-slide/{sl_id}', 'SlideController@active_slide');
Route::get('/unactive-slide/{sl_id}', 'SlideController@unactive_slide');
Route::get('/delete-slide/{sl_id}', 'SlideController@delete_slide');
// product
Route::get('/add-product', 'ProductController@add_product');
Route::get('/list-product', 'ProductController@list_product');
Route::post('/save-product', 'ProductController@save_product');
Route::get('/active-product/{pro_id}', 'ProductController@active_product');
Route::get('/unactive-product/{pro_id}', 'ProductController@unactive_product');
Route::get('/delete-product/{pro_id}', 'ProductController@delete_product');
Route::get('/edit-product/{pro_id}', 'ProductController@edit_product');
Route::post('/update-product/{pro_id}', 'ProductController@update_product');
// mesager
Route::get('/mesage-customer', 'AdminController@mesage_customer');
//order
Route::get('/ship-order/{or_id}', 'CheckoutController@ship_order');
// code
Route::get('/discount-code', 'CouponController@discount_code');
Route::post('/save-code', 'CouponController@save_code');
Route::get('/delete-coupon/{cp_id}', 'CouponController@delete_coupon');
Route::get('/edit-coupon/{cp_id}', 'CouponController@edit_coupon');
Route::post('/update-code/{cp_id}', 'CouponController@update_code');

// php artisan make:controller SlideController
// php artisan make:migration create_tbl_slide --create=tbl_slide
// php artisan migrate