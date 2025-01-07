<?php

use App\Http\Controllers\Auth\UserEmailVerificationController;
use App\Http\Controllers\Auth\ForgetPasswordController;
// use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\ecommerce\admin\AdminOrderController;
use App\Http\Controllers\ecommerce\admin\CustomerController;
use \App\Http\Controllers\ecommerce\admin\AdminController;
use App\Http\Controllers\ecommerce\admin\AdminLoginController;
use App\Http\Controllers\ecommerce\admin\CategoryController;
use App\Http\Controllers\ecommerce\CartController;
use App\Http\Controllers\ecommerce\CheckoutController;
use App\Http\Controllers\ecommerce\HomeController;
use App\Http\Controllers\ecommerce\OrderController;
use App\Http\Controllers\ecommerce\admin\ProductController;
use App\Http\Controllers\ecommerce\UserAccountDeleteController;
use App\Http\Controllers\ecommerce\UserController;
use App\Http\Controllers\ecommerce\UserLoginController;
// use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ecommerce\WishlistController;
use App\Http\Middleware\AuthAdmin;
use App\Http\Middleware\AuthUser;
use Illuminate\Support\Facades\Route;


Route::get('/',[HomeController::class,'index'])->name('home.index');
Route::get('/Category/{category}',[HomeController::class,'show'])->name('category.show');
Route::get('/Category/{par_slug}/products',[HomeController::class,'parentShow'])->name('category.parent.show');
Route::get('/Category/{par_cat}/{sub_cat?}',[HomeController::class,'subShow'])->name('category.sub.show');
Route::get('/recent-products',[HomeController::class,'recentProducts'])->name('recent.show');
Route::get('/most-popular-products',[HomeController::class,'mostPopularProducts'])->name('most.show');
Route::get('/featured-products',[HomeController::class,'featuredProducts'])->name('featured.show');
Route::get('/best-selling-products',[HomeController::class,'featuredProducts'])->name('best.show');

/* Email Verification */
Route::middleware(['web'])->group(function(){
    Route::get('/email-verify/{id}/{hash}',[UserEmailVerificationController::class,'verify'])->name('custom.verification');
});
/* Email Verification */

Route::get('/user-login',[UserLoginController::class,'login'])->name('user.login');
Route::get('/user-register',[UserLoginController::class,'register'])->name('user.register');
Route::post('/user-register',[UserLoginController::class,'authRegister'])->name('user.auth.register');
Route::post('/user-login',[UserLoginController::class,'authLogin'])->name('user.auth.login');

/* forget password */
Route::get('forget-password', [ForgetPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgetPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::middleware(['web'])->group(function(){
    Route::get('/reset-user-password/{token}', [ForgetPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
});
Route::post('reset-user-password', [ForgetPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
/* forget password */

Route::middleware([AuthUser::class])->prefix('/user')->group(function(){
    Route::get('',[UserController::class,'index'])->name('user.index');
    Route::get('/profile',[UserController::class,'profile'])->name('user.profile');
    Route::get('/profile/delete',[UserController::class,'showDelete'])->name('user.delete');
    Route::patch('/profile/update',[UserController::class,'profileUpdate'])->name('user.profile.update');
    //address
    Route::get('/profile/address',[UserController::class,'manageAddress'])->name('user.address');
    Route::get('/address',[UserController::class,'addAddress'])->name('user.add.address');
    Route::post('/address/store',[UserController::class,'storeAddress'])->name('user.store.address');
    Route::get('/address/{address_id}/edit',[UserController::class,'editAddress'])->name('user.edit.address');
    Route::put('/address/as-primary/{address_id}',[UserController::class,'makeAsPrimary'])->name('user.address.primary');
    Route::patch('/address/{address_id}/update',[UserController::class,'updateAddress'])->name('user.update.address');
    Route::delete('/address/{address_id}/delete',[UserController::class,'deleteAddress'])->name('user.delete.address');
    //delete user own account
    Route::delete('/account/{id}/delete',[UserAccountDeleteController::class,'destroy'])->name('user.account.destroy');
    //change password
    Route::get('/change-password',[UserController::class,'showChangePasswordForm'])->name('user.password.get');
    Route::post('/change-password',[UserController::class,'submitChangePasswordForm'])->name('user.password.post');
    //cart
    Route::post('/add/cart',[CartController::class,'addToCart'])->name('ajax.cart.add');
    Route::get('/add/cart-quantity/{id}',[CartController::class,'addQuantity'])->name('ajax.cart.add.quantity');
    Route::get('/remove/cart-quantity/{id}',[CartController::class,'removeAddToCart'])->name('ajax.cart.remove.quantity');
    Route::get('/remove/cart-product/{id}',[CartController::class,'removeCartProduct'])->name('ajax.cart.remove.product');

    /* wishlist */
    Route::post('/add/wishlist',[WishlistController::class,'addToWishlist'])->name('wishlist.add');
    Route::get('remove/wishlist-product/{id}',[WishlistController::class,'removeWishlistProduct'])->name('ajax.wishlist.remove');
    /* wishlist */

    /* checkout */
    Route::get('checkout',[CheckoutController::class,'index'])->name('checkout');
    Route::post('place-order',[CheckoutController::class,'placeOrder'])->name('order.place');
    /* checkout */
    /* Orders */

    Route::get('orders',[OrderController::class,'listOrdersByUser'])->name('list.order');
    Route::get('view-orders/{Order_Id}',[OrderController::class,'viewOrder'])->name('view.order');
    Route::get('reorder/{product_id}',[OrderController::class,'reorderProduct'])->name('reorder');
    Route::post('cancel-order',[OrderController::class,'cancelOrder'])->name('cancel.order');
    /* Orders */

    /* Notification */
    Route::get('mark-as-read',[HomeController::class,'markAsReadNotification']);
});


Route::get('/admin/login',[AdminLoginController::class,'login'])->name('admin.login');
Route::post('/admin',[AdminLoginController::class,'auth'])->name('admin.auth');
// Route::get('/admin/logout',[AdminLoginController::class,'logout'])->name('admin.logout');

Route::middleware(['auth',AuthAdmin::class])->prefix('/admin')->group(function(){
    Route::get('/dashboard',[AdminController::class,'index'])->name('admin.index');
    Route::get('/categories',[CategoryController::class,'index'])->name('admin.category.index');
    Route::get('/categories/create',[CategoryController::class,'create'])->name('admin.category.create');
    Route::post('/check-slug-availability',[CategoryController::class,'checkSlugAvailability']);
    Route::post('/categories/store',[CategoryController::class,'store'])->name('admin.category.store');
    Route::get('/categories/{id}/edit',[CategoryController::class,'edit'])->name('admin.category.edit');
    Route::patch('/categories/{id}/update',[CategoryController::class,'update'])->name('admin.category.update');
    Route::delete('/category/{id}/delete',[CategoryController::class,'destroy'])->name('admin.category.destroy');

    Route::get('/products',[ProductController::class,'index'])->name('admin.products.index');
    Route::get('/products/create',[ProductController::class,'create'])->name('admin.products.create');
    Route::post('/products/store',[ProductController::class,'store'])->name('admin.products.store');
    Route::get('/products/{id}/edit',[ProductController::class,'edit'])->name('admin.products.edit');
    Route::patch('/products/{id}/update',[ProductController::class,'update'])->name('admin.products.update');
    Route::delete('/products/{id}/delete',[ProductController::class,'destroy'])->name('admin.products.destroy');

    Route::get('/customers',[CustomerController::class,'index'])->name('admin.customer.index');
    Route::get('/customers/create',[CustomerController::class,'createCustomer'])->name('admin.customer.create');
    Route::post('/check-email-availability',[CustomerController::class,'checkEmailAvailability']);
    Route::post('/check-PhoneNumber',[CustomerController::class,'checkPhoneNumber']);
    Route::get('/customers/{customer_id}/view',[CustomerController::class,'viewCustomer'])->name('admin.customer.view');
    Route::post('/customers/store',[CustomerController::class,'storeCustomer'])->name('admin.customer.store');
    Route::delete('/customers/{customer_id}/delete',[CustomerController::class,'destroy'])->name('admin.customer.delete');

    Route::get('/orders',[AdminOrderController::class,'listAllOrders'])->name('admin.orders.index');
    Route::get('/view-orders/{order_Id}',[AdminOrderController::class,'viewOrder'])->name('admin.orders.view');
    Route::post('/orders/{order_id}/change-status/',[AdminOrderController::class,'changeOrderStatus'])->name('admin.orders.change-status');
    Route::post('/orders/cancel-order/',[AdminOrderController::class,'cancelOrder'])->name('admin.orders.cancel.order');
});

require __DIR__.'/auth.php';
