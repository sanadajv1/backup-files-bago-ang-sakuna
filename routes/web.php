<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



route::get('/',[HomeController::class,'index']);


//USER SIDE
route::get('/Products',[HomeController::class,'Products']);
route::get('/product_details/{id}',[HomeController::class,'product_details']);
route::post('/add_cart/{id}',[HomeController::class,'add_cart']);
route::get('/product_details/{id}',[HomeController::class,'product_details']);
route::get('/About',[HomeController::class,'About']);
route::get('/show_cart',[HomeController::class,'show_cart']);
route::get('/remove_cart/{id}',[HomeController::class,'remove_cart']);
route::post('/cash_order',[HomeController::class,'cash_order']);
//order tracking
route::get('/show_orders',[HomeController::class,'show_orders']);
route::get('/show_pending',[HomeController::class,'show_pending']);
route::get('/show_Dpayment',[HomeController::class,'show_Dpayment']);
route::get('/show_on_process',[HomeController::class,'show_on_process']);
route::get('/show_Fpayment',[HomeController::class,'show_Fpayment']);
route::get('/show_shipping',[HomeController::class,'show_shipping']);
route::get('/show_order_received',[HomeController::class,'show_order_received']);
route::get('/show_order_completed',[HomeController::class,'show_order_completed']);

route::get('/show_order_completed',[HomeController::class,'show_order_completed']);



// track specific order
route::get('/track_Sorder/{id}',[HomeController::class,'track_Sorder']);
route::get('/receive_order/{id}',[HomeController::class,'receive_order']);


route::get('/home',[HomeController::class,'home'])->middleware('auth', 'verified');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


/* Routes */

Route::get('/Signup', function () {
    return view('YearnArt.Signup');
})->name('Signup');

Route::get('/FAQ', function () {
    return view('YearnArt.FAQ');
})->name('FAQ');

// Route::get('/Products', function () {
//     return view('YearnArt.Products');
// })->name('Products');

// Route::get('/About', function () {
//     return view('YearnArt.About');
// })->name('About');

// Route::get('/MyOrders', function () {
//     return view('YearnArt.MyOrders');
// })->name('MyOrders');



//ADMIN SIDE

route::get('/admin_dashboard',[AdminController::class,'admin_dashboard']);
route::get('/view_category',[AdminController::class,'view_category']);
route::post('/add_category',[AdminController::class,'add_category']);
route::get('/delete_category/{id}',[AdminController::class,'delete_category']);
route::get('/view_product',[AdminController::class,'view_product']);
route::post('/add_product',[AdminController::class,'add_product']);
route::get('/show_product',[AdminController::class,'show_product']);
route::get('/delete_product/{id}',[AdminController::class,'delete_product']);
route::get('/update_product/{id}',[AdminController::class,'update_product']);
route::post('/update_product_confirm/{id}',[AdminController::class,'update_product_confirm']);
route::get('/order',[AdminController::class,'order']);
route::get('/pending',[AdminController::class,'pending']);
route::get('/dpayment',[AdminController::class,'dpayment']);
route::get('/onprocess',[AdminController::class,'onprocess']);
route::get('/customer_list',[AdminController::class,'customer_list']);
route::get('/search',[AdminController::class,'search']);
route::get('/searchDpayment',[AdminController::class,'searchDpayment']);

route::get('/fullpayment_receipt/{id}',[HomeController::class,'fullpayment_receipt']);

route::get('/fullpayment_receipt_edit',[HomeController::class,'fullpayment_receipt_edit']);


Route::get('/get_data', [AdminController::class, 'get_data']);
Route::get('/get_data_category', [AdminController::class, 'get_data_category']);






route::get('/to_dpay/{id}',[AdminController::class,'to_dpay']);  // downpayment to
route::get('/to_onprocess/{id}',[AdminController::class,'to_onprocess']); // papuntang on process tapos na mag bayad
route::get('/to_fpay/{id}',[AdminController::class,'to_fpay']);
route::get('/to_ship/{id}',[AdminController::class,'to_ship']);

route::get('/to_order_completed/{id}',[AdminController::class,'to_order_completed']);





