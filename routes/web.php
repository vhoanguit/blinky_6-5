<?php

use Illuminate\Support\Facades\Route;
// // FE
Route::get('/', 'App\Http\Controllers\HomeController@index2'); // goi ham index trong HomeController, khi go localhost/blinky thi hien ra page luon
Route::get('/trang-chu', 'App\Http\Controllers\HomeController@index2'); // Khi search localhost8080/blinky/trang-chu thì nó se hiện thị trang chủ
Route::get('/tim-kiem','App\Http\Controllers\HomeController@search');

// Send email route
// Route::get('/test-email', 'App\Http\Controllers\SendEmailController@testEmail');
Route::post('/send-email-to-customer', 'App\Http\Controllers\SendEmailController@sendEmailToCustomer')->name('send.email.to.customer');
// Contact reply route
Route::get('/contact_reply', 'App\Http\Controllers\ContactController@contact_reply')->name('contact_reply');
Route::get('/contact_replied', 'App\Http\Controllers\ContactController@contact_replied')->name('contact_replied');
Route::get('/phan-hoi/{id}', 'App\Http\Controllers\ContactController@reply')->name('phan_hoi');
Route::get('/lich-su-phan-hoi/{id}', 'App\Http\Controllers\ContactController@history')->name('lich_su_phan_hoi');
Route::get('/contact', 'App\Http\Controllers\ContactController@input')->name('lien_he');
Route::post('/contact/store', 'App\Http\Controllers\ContactController@store')->name('contact.store');
// //BE 
// //admin
Route::get('/admin','App\Http\Controllers\AdminController@index');
Route::get('/dashboard','App\Http\Controllers\AdminController@show_dashboard');
Route::post('/admin-dashboard','App\Http\Controllers\AdminController@dashboard_login'); // phương thức của form là post
Route::get('/logout','App\Http\Controllers\AdminController@dashboard_logout'); // đăng xuất

//danh muc san pham 
Route::get('/add-category-product','App\Http\Controllers\CategoryProduct@add_category_product');
Route::get('/all-category-product','App\Http\Controllers\CategoryProduct@all_category_product');
Route::post('/save-category-product','App\Http\Controllers\CategoryProduct@save_category_product');

// Route::get('/unactive-category-product/{category_pro_id}','App\Http\Controllers\CategoryProduct@unactive_category_product');
// Route::get('/active-category-product/{category_pro_id}','App\Http\Controllers\CategoryProduct@active_category_product');

Route::get('/edit-category-product/{category_pro_id}','App\Http\Controllers\CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_pro_id}','App\Http\Controllers\CategoryProduct@delete_category_product');
Route::post('/update-category-product/{category_pro_id}','App\Http\Controllers\CategoryProduct@update_category_product');

//san pham
Route::get('/add-product','App\Http\Controllers\ProductController@add_product');
Route::get('/all-product','App\Http\Controllers\ProductController@all_product');
Route::post('/save-product','App\Http\Controllers\ProductController@save_product');

// Route::get('/unactive-product/{product_id}','App\Http\Controllers\ProductController@unactive_product');
// Route::get('/active-product/{product_id}','App\Http\Controllers\ProductController@active_product');

Route::get('/edit-product/{product_id}','App\Http\Controllers\ProductController@edit_product');
Route::get('/delete-product/{product_id}','App\Http\Controllers\ProductController@delete_product');
Route::post('/update-product/{product_id}','App\Http\Controllers\ProductController@update_product');

// Sảm phẩm FE
Route::get('/san-pham', 'App\Http\Controllers\HomeController@sanpham');
Route::get('/danh-muc-san-pham/{category_product_id}','App\Http\Controllers\CategoryProduct@show_category_product_home');
Route::get('/chi-tiet-san-pham/{product_id}','App\Http\Controllers\ProductController@show_inside_product');

Route::post('/filter-products', 'App\Http\Controllers\ProductController@filterProducts');

//Chi tiết sản phẩm
Route::get('/show-product-details/{product_id}','App\Http\Controllers\ProductController@show_product_details');
Route::get('/edit-product-details/{product_id}','App\Http\Controllers\ProductController@edit_product_details');
Route::post('/update-product-details/{product_id}','App\Http\Controllers\ProductController@update_product_details');

// Danh muc bai viet 
Route::get('/add-category-post','App\Http\Controllers\CategoryPost@add_category_post');
Route::post('/save-category-post','App\Http\Controllers\CategoryPost@save_category_post');
Route::get('/all-category-post','App\Http\Controllers\CategoryPost@all_category_post');
Route::get('/edit-category-post/{category_post_id}','App\Http\Controllers\CategoryPost@edit_category_post');// khi gõ danh_muc_bai_viet/cate_post_slug thì trả về bài viết đó
Route::post('/update-category-post/{cate_id}','App\Http\Controllers\CategoryPost@update_category_post');
Route::get('/delete-category-post/{cate_id}','App\Http\Controllers\CategoryPost@delete_category_post');

// Route::get('/unactive-cate-post/{cate_post_id}','App\Http\Controllers\CategoryPost@unactive_catepost');
// Route::get('/active-cate-post/{cate_post_id}','App\Http\Controllers\CategoryPost@active_catepost');

// Bai viet
Route::get('/add-post','App\Http\Controllers\PostController@add_post');
Route::post('/save-post','App\Http\Controllers\PostController@save_post');
Route::get('/all-post','App\Http\Controllers\PostController@all_post');
Route::get('/delete-post/{post_id}','App\Http\Controllers\PostController@delete_post'); // xoa theo id
Route::get('/edit-post/{post_id}','App\Http\Controllers\PostController@edit_post'); // xoa theo id
Route::post('/update-post/{post_id}','App\Http\Controllers\PostController@update_post'); // xoa theo id

// Route::get('/unactive-post/{post_id}','App\Http\Controllers\PostController@unactive_post');
// Route::get('/active-post/{post_id}','App\Http\Controllers\PostController@active_post');

//Hien thi danh muc bai viet
Route::get('/tat-ca-bai-viet','App\Http\Controllers\PostController@tatcabaiviet');

Route::get('/bai-viet/{post_slug}','App\Http\Controllers\PostController@bai_viet');
Route::get('/danh-muc-bai-viet/{cate_post_slug}','App\Http\Controllers\PostController@danh_muc_bai_viet');// khi gõ danh_muc_bai_viet/cate_post_slug thì trả về bài viết đó
// import excel 

//Gallery thư viện ảnh
Route::get('/add-gallery/{product_id}','App\Http\Controllers\GalleryController@add_Gallery');
Route::post('/insert-gallery/{product_id}','App\Http\Controllers\GalleryController@insert_Gallery');
Route::get('/delete-gallery/{gallery_id}','App\Http\Controllers\GalleryController@delete_Gallery');

//Giỏ hàng
Route::post('/add-to-cart', 'App\Http\Controllers\ProductController@add_to_cart');
Route::get('/gio-hang','App\Http\Controllers\CartController@shopping_cart');
Route::post('/save-cart','App\Http\Controllers\CartController@save_cart')->name('cart.save');

// Update status
Route::get('/update-post-status', 'App\Http\Controllers\PostController@update_post_status');
Route::get('/update-product-status', 'App\Http\Controllers\ProductController@update_product_status');
Route::get('/update-cate-product-status', 'App\Http\Controllers\CategoryProduct@update_cate_product_status');
Route::get('/update-cate-post-status', 'App\Http\Controllers\CategoryPost@update_cate_post_status');

// login
Route::get('/login', 'App\Http\Controllers\CheckoutController@login');
Route::post('/login-customer', 'App\Http\Controllers\CheckoutController@login_customer');

// Register
Route::get('/register', 'App\Http\Controllers\CheckoutController@register');
Route::post('/add-customer', 'App\Http\Controllers\CheckoutController@add_customer');


// // update-profle
// Route::post('/update-customer/{customer_id}', 'App\Http\Controllers\CheckoutController@update_customer');

// Route::get('/pages.personal_infor', 'App\Http\Controllers\CheckoutController@personal_infor');

// group này xác định các route cần có customer_id thì mới truy cập được
Route::group(['middleware' => 'customer'], function () {
    // update-profle
    Route::post('/update-customer/{customer_id}', 'App\Http\Controllers\CheckoutController@update_customer');
    // Các route yêu cầu đăng nhập
    Route::get('/personal_infor', 'App\Http\Controllers\CheckoutController@personal_infor');

    // logout
    Route::get('/logout', 'App\Http\Controllers\CheckoutController@logout');

    // Đổi mật khẩu
    Route::get('/change_pass', 'App\Http\Controllers\CheckoutController@Change_pass');
    Route::post('/change_pass', 'App\Http\Controllers\CheckoutController@check_change_pass');

    Route::get('/order_management', 'App\Http\Controllers\CheckoutController@Order_management');

    Route::post('/upload-avatar/{customer_id}', 'App\Http\Controllers\CheckoutController@upload_avatar');
});



// Quên mật khẩu
Route::get('/forgot-password', 'App\Http\Controllers\CheckoutController@forgot_password');
Route::post('/forgot-password', 'App\Http\Controllers\CheckoutController@check_forgot_password');

Route::get('/verify_otp', 'App\Http\Controllers\CheckoutController@verify_otp');
Route::post('/verify_otp', 'App\Http\Controllers\CheckoutController@check_verify_otp');

Route::get('/reset-password', 'App\Http\Controllers\CheckoutController@reset_password');
Route::post('/reset-password', 'App\Http\Controllers\CheckoutController@check_reset_password'); 



use App\Http\Controllers\ShippingController;
use App\Http\Controllers\AdditionalController;
use App\Http\Controllers\FileDisplayController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\EmailController;

// Thanh toán
Route::get('/hoa-don', 'App\Http\Controllers\OrderController@hoaDon')->name('hoa_don');
Route::get('/thanh-toan', 'App\Http\Controllers\OrderController@thanhToan')->name('thanh_toan');
Route::post('/thanh-toan', 'App\Http\Controllers\OrderController@submitThanhToan')->name('submit_thanh_toan');
// Route::post('/thanh-toan', 'App\Http\Controllers\OrderController@online_checkout')->name('MoMo');

// Bổ sung thông tin sau vận chuyển
Route::get('/bo-sung', 'App\Http\Controllers\AdditionalController@index')->name('bo-sung.index');
Route::post('/bo-sung', 'App\Http\Controllers\AdditionalController@store')->name('bo-sung.store');
Route::get('/file-display', 'App\Http\Controllers\FileDisplayController@index')->name('fileDisplay');

// Vận chuyển
Route::get('/shipping', 'App\Http\Controllers\ShippingController@index')->name('shipping.index');
Route::post('/shipping/fetch-district', 'App\Http\Controllers\ShippingController@fetchDistrict')->name('shipping.fetch_district');
Route::post('/shipping/store', 'App\Http\Controllers\ShippingController@store')->name('shipping.store');

// Gửi email
Route::get('/test-email', 'App\Http\Controllers\EmailController@testEmail');

/// Hàm lấy quận từ thành phố.
Route::post('/get-districts', 'App\Http\Controllers\CheckoutController@fetchDistrict')->name('fetch_d');
Route::get('/order-not-process-yet', 'App\Http\Controllers\OrderManagerController@order_not_process_yet')->name('order_not_process_yet');
Route::get('/order-not-delivered-yet', 'App\Http\Controllers\OrderManagerController@order_not_delivered_yet')->name('order_not_delivered_yet');
Route::get('/order-delivered', 'App\Http\Controllers\OrderManagerController@order_delivered')->name('order_delivered');

// Các route cho xử lý qua đêm (overnight) với phương thức GET
Route::get('/accept-order/{id}', 'App\Http\Controllers\OrderManagerController@accept_order');
Route::get('/order-delivered/{id}', 'App\Http\Controllers\OrderManagerController@admin_order_delivered');

?>