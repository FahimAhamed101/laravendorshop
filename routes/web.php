<?php

use App\Http\Controllers\Admin\ActiveUserController;
use App\Http\Controllers\User\UserController;
Use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ReturnController;
use App\Http\Controllers\Admin\RolePermission;
use App\Http\Controllers\Admin\ShippingAreaController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\VendorManageController;
use App\Http\Controllers\Admin\VendorProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\CompareController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\User\ShopController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\Vendor\VendorController;
use App\Http\Controllers\Vendor\VendorOrderController;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('frontend.index');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// ===================================== Admin Dashboard All Part =====================================

Route::group(['prefix'=>'admin','middleware' =>['admin','auth'],'namespace'=>'Admin'], function(){

    // ------------------------------ Admin Home Page----------------------------------
    Route::get('dashboard',[AdminController::class,'index'])->name('admin.dashboard');
    Route::get('profile',[AdminController::class,'profile'])->name('admin.profile');
    Route::post('profile/store', [AdminController::class, 'Store'])->name('admin.profile.store');
    Route::get('password/change', [AdminController::class, 'ChangePassword'])->name('admin.ChangePassword');
    Route::post('password/change', [AdminController::class, 'ChangeStore'])->name('admin.password.store');

    // ------------------------------ Admin Brand Page----------------------------------
    Route::get('brand', [BrandController::class, 'index'])->name('brand');
    Route::get('brand/add', [BrandController::class, 'add'])->name('brand.add');
    Route::post('brand/store', [BrandController::class, 'Store'])->name('brand.store');
    Route::get('brand/edit/{id}', [BrandController::class, 'Edit'])->name('brand.edit');
    Route::post('brand/update/{id}', [BrandController::class, 'Update'])->name('brand.update');
    Route::get('brand/delete/{id}', [BrandController::class, 'Delete'])->name('brand.delete');

    // ------------------------------ Admin Category Page----------------------------------
    Route::get('category', [CategoryController::class, 'index'])->name('category');
    Route::get('category/add', [CategoryController::class, 'add'])->name('category.add');
    Route::post('category/store', [CategoryController::class, 'Store'])->name('category.store');
    Route::get('category/edit/{id}', [CategoryController::class, 'Edit'])->name('category.edit');
    Route::post('category/update/{id}', [CategoryController::class, 'Update'])->name('category.update');
    Route::get('category/delete/{id}', [CategoryController::class, 'Delete'])->name('category.delete');

    // ------------------------------ Admin Sub-Category Page----------------------------------
    Route::get('subcategory', [SubCategoryController::class, 'index'])->name('subcategory');
    Route::get('subcategory/add', [SubCategoryController::class, 'add'])->name('subcategory.add');
    Route::post('subcategory/store', [SubCategoryController::class, 'Store'])->name('subcategory.store');
    Route::get('subcategory/edit/{id}', [SubCategoryController::class, 'Edit'])->name('subcategory.edit');
    Route::post('subcategory/update/{id}', [SubCategoryController::class, 'Update'])->name('subcategory.update');
    Route::get('subcategory/delete/{id}', [SubCategoryController::class, 'Delete'])->name('subcategory.delete');
    Route::get('/subcategory/ajax/{category_id}', [SubCategoryController::class, 'GetSubCategory']);



    // ------------------------------ Admin Vendor Manage Page----------------------------------
    Route::get('vendorInactive', [VendorManageController::class, 'vendorInactive'])->name('inactive.vendor');
    Route::get('vendorActive', [VendorManageController::class, 'vendorActive'])->name('active.vendor');
    Route::get('inactive/vendor/details/{id}', [VendorManageController::class, 'inActiveDetails'])->name('inactive.vendor.details');
    Route::post('inactive/vendor/active', [VendorManageController::class, 'activeVendorApprove'])->name('active.vendor.approve');
    Route::get('active/vendor/details/{id}', [VendorManageController::class, 'ActiveDetails'])->name('active.vendor.details');
    Route::post('active/vendor/inactive', [VendorManageController::class, 'inActiveVendorApprove'])->name('inactive.vendor.approve');


    // ------------------------------ Admin Product Manage Page----------------------------------
    Route::get('product', [ProductController::class, 'index'])->name('product');
    Route::get('product/add', [ProductController::class, 'add'])->name('product.add');
    Route::post('product/store', [ProductController::class, 'Store'])->name('product.store');
    Route::get('product/edit/{id}', [ProductController::class, 'Edit'])->name('product.edit');
    Route::post('product/update', [ProductController::class, 'Update'])->name('product.update');
    Route::get('product/delete/{id}', [ProductController::class, 'Delete'])->name('product.delete');
        //  Main Image update route --------------------------------------------------------------------
    Route::post('product/image/update', [ProductController::class, 'MainImageUpdate'])->name('product.mainImage.update');
    Route::post('product/multiImage/update', [ProductController::class, 'MultiImageUpdate'])->name('product.multiImage.update');
    Route::get('product/delete/multiImage/{id}', [ProductController::class, 'MultiImageDelete'])->name('product.multiImage.delete');
        //  Product Inactive route --------------------------------------------------------------------
    Route::get('product/inactive/{id}', [ProductController::class, 'ProductInactive'])->name('product.inactive');
    Route::get('product/active/{id}', [ProductController::class, 'ProductActive'])->name('product.active');

    //  Product Store route --------------------------------------------------------------------
    Route::get('product/stock', [ProductController::class, 'ProductStock'])->name('product.stock');





    // ------------------------------ Admin Slider Page ----------------------------------
    Route::get('slider', [SliderController::class, 'index'])->name('slider');
    Route::get('slider/add', [SliderController::class, 'add'])->name('slider.add');
    Route::post('slider/store', [SliderController::class, 'Store'])->name('slider.store');
    Route::get('slider/edit/{id}', [SliderController::class, 'Edit'])->name('slider.edit');
    Route::post('slider/update/{id}', [SliderController::class, 'Update'])->name('slider.update');
    Route::get('slider/delete/{id}', [SliderController::class, 'Delete'])->name('slider.delete');


    // ------------------------------ Admin Banner Page ----------------------------------
    Route::get('banner', [BannerController::class, 'index'])->name('banner');
    Route::get('banner/add', [BannerController::class, 'add'])->name('banner.add');
    Route::post('banner/store', [BannerController::class, 'Store'])->name('banner.store');
    Route::get('banner/edit/{id}', [BannerController::class, 'Edit'])->name('banner.edit');
    Route::post('banner/update/{id}', [BannerController::class, 'Update'])->name('banner.update');
    Route::get('banner/delete/{id}', [BannerController::class, 'Delete'])->name('banner.delete');

    // ------------------------------ Admin Coupon Page ----------------------------------
    Route::get('coupon', [CouponController::class, 'index'])->name('coupon');
    Route::get('coupon/add', [CouponController::class, 'add'])->name('coupon.add');
    Route::post('coupon/store', [CouponController::class, 'Store'])->name('coupon.store');
    Route::get('coupon/edit/{id}', [CouponController::class, 'Edit'])->name('coupon.edit');
    Route::post('coupon/update/{id}', [CouponController::class, 'Update'])->name('coupon.update');
    Route::get('coupon/delete/{id}', [CouponController::class, 'Delete'])->name('coupon.delete');

    // ------------------------------ Admin All Division Page ----------------------------------
    Route::get('division', [ShippingAreaController::class, 'index'])->name('division');
    Route::get('division/add', [ShippingAreaController::class, 'add'])->name('division.add');
    Route::post('division/store', [ShippingAreaController::class, 'Store'])->name('division.store');
    Route::get('division/edit/{id}', [ShippingAreaController::class, 'Edit'])->name('division.edit');
    Route::post('division/update/{id}', [ShippingAreaController::class, 'Update'])->name('division.update');
    Route::get('division/delete/{id}', [ShippingAreaController::class, 'Delete'])->name('division.delete');


    // ------------------------------ Admin All District Page ----------------------------------
    Route::get('district', [ShippingAreaController::class, 'District'])->name('district');
    Route::get('district/add', [ShippingAreaController::class, 'addDistrict'])->name('district.add');
    Route::post('district/store', [ShippingAreaController::class, 'StoreDistrict'])->name('district.store');
    Route::get('district/edit/{id}', [ShippingAreaController::class, 'EditDistrict'])->name('district.edit');
    Route::post('district/update/{id}', [ShippingAreaController::class, 'UpdateDistrict'])->name('district.update');
    Route::get('district/delete/{id}', [ShippingAreaController::class, 'DeleteDistrict'])->name('district.delete');


    // ------------------------------ Admin All State Page ----------------------------------
    Route::get('state', [ShippingAreaController::class, 'State'])->name('state');
    Route::get('state/add', [ShippingAreaController::class, 'addState'])->name('state.add');
    Route::post('state/store', [ShippingAreaController::class, 'StoreState'])->name('state.store');
    Route::get('state/edit/{id}', [ShippingAreaController::class, 'EditState'])->name('state.edit');
    Route::post('state/update/{id}', [ShippingAreaController::class, 'UpdateState'])->name('state.update');
    Route::get('state/delete/{id}', [ShippingAreaController::class, 'DeleteState'])->name('state.delete');
    Route::get('district/ajax/{district_id}', [ShippingAreaController::class, 'GetDistrict']);

    // ------------------------------ Admin Order Manage Page ----------------------------------
    Route::get('All/orders', [OrderController::class, 'AllOrder'])->name('admin.all.order');
    Route::get('pending/order', [OrderController::class, 'PendingOrder'])->name('pending.order');
    Route::get('confirmed/order', [OrderController::class, 'ConfirmedOrder'])->name('admin.confirmed.order');
    Route::get('processing/order', [OrderController::class, 'ProcessingOrder'])->name('admin.processing.order');
    Route::get('delivered/order', [OrderController::class, 'DeliveredOrder'])->name('admin.delivered.order');
    Route::get('order/details/{id}', [OrderController::class, 'AdminOrderDetails'])->name('admin.order.details');
    Route::get('pending/confirm/{order_id}', [OrderController::class, 'PendingToConfirm'])->name('pending-confirm');
    Route::get('confirm/delivered{order_id}', [OrderController::class, 'ConfirmToDelivered'])->name('confirm-delivered');
    Route::get('processing/delivered/{order_id}', [OrderController::class, 'ProcessingToDelivered'])->name('processing-delivered');
    Route::get('invoice/download/{order_id}', [OrderController::class, 'InvoiceDownload'])->name('admin.invoice.download');

    // ------------------------------ Admin User Return Part Page ----------------------------------
    Route::get('return/request', [ReturnController::class, 'ReturnRequest'])->name('return.request');
    Route::get('return/request/approved/{order_id}', [ReturnController::class, 'ReturnRequestApproved'])->name('return.request.approved');
    Route::get('return/request/Complete', [ReturnController::class, 'ReturnRequestComplete'])->name('complete.return.request');

    // ------------------------------ Admin Report Page ----------------------------------
    Route::get('report/view', [ReportController::class, 'Report'])->name('report.view');
    Route::post('report/search/by/date', [ReportController::class, 'SearchByDate'])->name('search-by-date');
    Route::post('report/search/by/month', [ReportController::class, 'SearchByMonth'])->name('search-by-month');
    Route::post('report/search/by/year', [ReportController::class, 'SearchByYear'])->name('search-by-year');
    Route::get('order/by/user', [ReportController::class, 'OrderByUser'])->name('order.by.user');
    Route::post('search/by/user', [ReportController::class, 'SearchByUser'])->name('search-by-user');

    // ------------------------------ Admin Active & Inactive User OR Vendor Page ----------------------------------
    Route::get('all/user', [ActiveUserController::class, 'AllUser'])->name('all-user');
    Route::get('all/vendor', [ActiveUserController::class, 'AllVendor'])->name('all-vendor');

    // ------------------------------ Admin Blog Page ----------------------------------
    Route::get('blog/category', [BlogController::class, 'AllBlogCategory'])->name('admin.blog.category');
    Route::get('add/blog/category', [BlogController::class, 'AddBlogCategory'])->name('add.blog.category');
    Route::post('store/blog/category', [BlogController::class, 'StoreBlogCategory'])->name('store.blog.category');
    Route::get('edit/blog/category/{id}', [BlogController::class, 'EditBlogCategory'])->name('edit.blog.category');
    Route::post('update/blog/category', [BlogController::class, 'UpdateBlogCategory'])->name('update.blog.category');
    Route::get('delete/blog/category/{id}', [BlogController::class, 'DeleteBlogCategory'])->name('delete.blog.category');

    // ------------------------------ Admin Blog Page ----------------------------------
    Route::get('blog/post', [BlogController::class, 'AllBlogPost'])->name('admin.blog.post');
    Route::get('add/blog/post', [BlogController::class, 'AddBlogPost'])->name('add.blog.post');
    Route::post('store/blog/post', [BlogController::class, 'StoreBlogPost'])->name('store.blog.post');
    Route::get('edit/blog/post/{id}', [BlogController::class, 'EditBlogPost'])->name('edit.blog.post');
    Route::post('edit/update/blog/post', [BlogController::class, 'UpdateBlogPost'])->name('update.blog.post');
    Route::get('delete/blog/post/{id}', [BlogController::class, 'DeleteBlogPost'])->name('delete.blog.post');


    // ------------------------------ Admin Review & Comment ----------------------------------
    Route::get('pending/review', [ReviewController::class, 'PendingReview'])->name('pending.review');
    Route::get('edit/review/{id}', [ReviewController::class, 'ReviewApprove'])->name('review.approve');
    Route::get('publish/review', [ReviewController::class, 'PublishReview'])->name('publish.review');
    Route::get('review/delete/{id}', [ReviewController::class, 'ReviewDelete'])->name('review.delete');

    // ------------------------------ Admin Setting All Part ----------------------------------
    Route::get('site/setting', [SiteSettingController::class, 'Setting'])->name('site.setting');
    Route::post('site/setting/update', [SiteSettingController::class, 'SettingUpdate'])->name('site.setting.update');

    // ------------------------------ Admin Seo Setting All Part ----------------------------------
    Route::get('seo/setting', [SiteSettingController::class, 'SeoSetting'])->name('seo.setting');
    Route::post('seo/setting/update', [SiteSettingController::class, 'SeoSettingUpdate'])->name('seo.setting.update');

    // ------------------------------ Admin Roles & Permission Setting All Part ------------------------------
    Route::get('role/permission', [RolePermission::class, 'RolePermissionSetting'])->name('all.permission');
    Route::get('add/permission', [RolePermission::class, 'AddRolePermission'])->name('add.permission');
    Route::post('store/permission', [RolePermission::class, 'StorePermission'])->name('store.permission');
    Route::get('edit/permission/{id}', [RolePermission::class, 'EditPermission'])->name('edit.permission');
    Route::post('edit/permission/{id}', [RolePermission::class, 'UpdatePermission'])->name('update.permission');
    Route::get('delete/permission/{id}', [RolePermission::class, 'DeletePermission'])->name('delete.permission');

    Route::get('role', [RolePermission::class, 'Role'])->name('all.roles');
    Route::get('role/add', [RolePermission::class, 'AddRole'])->name('role.add');
    Route::post('store/role', [RolePermission::class, 'StoreRole'])->name('store.role');
    Route::get('edit/role/{id}', [RolePermission::class, 'EditRoll'])->name('edit.role');
    Route::post('edit/role/{id}', [RolePermission::class, 'UpdateRole'])->name('update.role');
    Route::get('delete/role/{id}', [RolePermission::class, 'DeleteRole'])->name('delete.role');


    Route::get('add/roles/permission', [RolePermission::class, 'AddRolePerm'])->name('add.roles.permission');
    Route::post('roles/permission/store', [RolePermission::class, 'StoreRolePerm'])->name('role.permission.store');
    Route::get('all/roles/permission/store', [RolePermission::class, 'AllRolesPermission'])->name('all.roles.permission');
    Route::get('all/edit/roles/{id}', [RolePermission::class, 'AdminRolesEdit'])->name('admin.edit.roles');
    Route::post('all/roles/update/{id}', [RolePermission::class, 'AdminRolesUpdate'])->name('admin.roles.update');
    Route::get('all/roles/delete/{id}', [RolePermission::class, 'AdminRolesDelete'])->name('admin.delete.roles');


    Route::get('all/admin', [AdminController::class, 'AllAdmin'])->name('all.admin');
    Route::get('add/admin', [AdminController::class, 'AddAdmin'])->name('add.admin');
    Route::post('admin/user/store', [AdminController::class, 'AdminUserStore'])->name('admin.user.store');
    Route::get('edit/admin/role/{id}', [AdminController::class, 'EditAdminRole'])->name('edit.admin.role');
    Route::post('admin/user/update/{id}', [AdminController::class, 'AdminUserUpdate'])->name('admin.user.update');
    Route::get('admin/user/delete/{id}', [AdminController::class, 'DeleteAdminRole'])->name('delete.admin.role');





});// Admin Group Middleware End



// ===================================== Vendor Dashboard All Part =====================================

Route::group(['prefix'=>'vendor','middleware' =>['vendor','auth'],'namespace'=>'Vendor'], function(){

    // ------------------------------ Vendor Home Page----------------------------------
    Route::get('dashboard',[VendorController::class,'index'])->name('vendor.dashboard');
    Route::get('profile',[VendorController::class,'profile'])->name('vendor.profile');
    Route::post('profile/store', [VendorController::class, 'Store'])->name('vendor.profile.store');
    Route::get('password/change', [VendorController::class, 'ChangePassword'])->name('vendor.ChangePassword');
    Route::post('password/change', [VendorController::class, 'ChangeStore'])->name('vendor.password.store');

    // ------------------------------ Vendor Product Manage Page----------------------------------
    Route::get('product', [VendorProductController::class, 'index'])->name('vendor.product');
    Route::get('product/add', [VendorProductController::class, 'add'])->name('vendor.product.add');
    Route::post('product/store', [VendorProductController::class, 'Store'])->name('vendor.product.store');
    Route::get('product/edit/{id}', [VendorProductController::class, 'Edit'])->name('vendor.product.edit');
    Route::post('product/update', [VendorProductController::class, 'Update'])->name('vendor.product.update');
    Route::get('product/delete/{id}', [VendorProductController::class, 'Delete'])->name('vendor.product.delete');
    //     //  Main Image update route --------------------------------------------------------------------
    Route::post('product/image/update', [VendorProductController::class, 'MainImageUpdate'])->name('vendor.product.mainImage.update');
    Route::post('product/multiImage/update', [VendorProductController::class, 'MultiImageUpdate'])->name('vendor.product.multiImage.update');
    Route::get('product/delete/multiImage/{id}', [VendorProductController::class, 'MultiImageDelete'])->name('vendor.product.multiImage.delete');
    //     //  Product Inactive route --------------------------------------------------------------------
    Route::get('product/inactive/{id}', [VendorProductController::class, 'ProductInactive'])->name('vendor.product.inactive');
    Route::get('product/active/{id}', [VendorProductController::class, 'ProductActive'])->name('vendor.product.active');
    Route::get('/subcategory/ajax/{category_id}', [VendorProductController::class, 'VendorGetSubCategory']);

    // ------------------------------ Vendor Order Manage Page ----------------------------------
    Route::get('pending/order', [VendorOrderController::class, 'PendingOrder'])->name('vendor.all.order');
    Route::get('return/order', [VendorOrderController::class, 'ReturnOrder'])->name('vendor.return.order');
    Route::get('return/order/complete', [VendorOrderController::class, 'CompleteReturnOrder'])->name('vendor.complete.return.order');
    Route::get('order/details/{order_id}', [VendorOrderController::class, 'OrderDetails'])->name('vendor.order_details');

    // ------------------------------ Vendor Review Manage Page ----------------------------------
    Route::get('pending/review', [ReviewController::class, 'VendorPendingOrder'])->name('vendor.all.review');







});// Vendor Group Middleware End





// ===================================== User Dashboard All Part =====================================

Route::group(['middleware' =>['user','auth'],'namespace'=>'User'], function(){

        // ------------------------------ User Profile Page----------------------------------
    Route::get('dashboard',[UserController::class,'Dashboard'])->name('user.dashboard');
    Route::post('user/profile/store', [UserController::class, 'Store'])->name('user.profile.store');
    Route::post('password/change', [UserController::class, 'ChangeStore'])->name('user.password.store');

    // ------------------------------ Wishlist Page----------------------------------
    Route::get('wishlist', [WishlistController::class, 'allWishlist'])->name('wishlist');
    Route::get('get-wishlist-product', [WishlistController::class, 'getWishlistProduct']);
    Route::get('wishlistRemove/{id}', [WishlistController::class, 'WishlistRemove']);

    // ------------------------------ Compare Page----------------------------------
    Route::get('compare', [CompareController::class, 'allCompare'])->name('compare');
    Route::get('get-compare-product', [CompareController::class, 'getCompareProduct']);
    Route::get('compareRemove/{id}', [CompareController::class, 'compareRemove']);


    // ------------------------------ Cart Page View ----------------------------------
    Route::get('myCart',[CartController::class,'MyCart'])->name('myCart');
    Route::get('get-cart-product',[CartController::class,'getCartProduct']);
    Route::get('cartRemove/{rowId}', [CartController::class, 'cartRemove']);
    Route::get('cart-decrement/{rowId}', [CartController::class, 'cartDecrement']);
    Route::get('cart-increment/{rowId}', [CartController::class, 'cartIncrement']);

    // ------------------------------ Strip Payment Page View ----------------------------------
    Route::post('stripe/order',[StripeController::class,'StripOrder'])->name('stripe.order');
    Route::post('cash/order',[StripeController::class,'CashOrder'])->name('cash.order');


    // ------------------------------ User Dashboard ----------------------------------
    Route::get('account/page', [AllUserController::class, 'UserAccount'])->name('user.account.page');
    Route::get('change/password', [AllUserController::class, 'ChangePassword'])->name('user.change.password');
    Route::get('order/page', [AllUserController::class, 'UserOrder'])->name('user.order.page');
    Route::get('order/details/{order_id}', [AllUserController::class, 'OrderDetails']);
    Route::get('order/invoice/{order_id}', [AllUserController::class, 'OrderInvoice']);
    Route::post('return/order/{order_id}', [AllUserController::class, 'ReturnOrder'])->name('return.order');
    Route::get('return/order/page', [AllUserController::class, 'ReturnOrderPage'])->name('return.order.page');
    Route::get('track/page', [AllUserController::class, 'UserTrackOrderPage'])->name('user.track.order');
    Route::post('order/tracking', [AllUserController::class, 'OrderTracking'])->name('order.tracking');

    // ------------------------------ User Review & Comment ----------------------------------
    Route::get('store/review', [ReviewController::class, 'StoreReview'])->name('store.review');





});  // User Group Middleware End
  // ------------------------------ Checkout Page View ----------------------------------
Route::controller(CheckoutController::class)->group(function(){
    Route::get('/district-get/ajax/{division_id}' , 'DistrictGetAjax');
    Route::get('/state-get/ajax/{district_id}' , 'StateGetAjax');
    Route::post('/checkout/store' , 'CheckoutStore')->name('checkout.store');


});




// ================================= General User All Route This ===========================================

            //    ------------------ User Login Or Register  --------------------------------------
    Route::get('user/login',[UserController::class,'userLogin'])->name('user.login');
    Route::get('user/register',[UserController::class,'userRegister'])->name('user.register');


            //    ------------------ Vendor Login Or Register  --------------------------------------
    Route::get('become/vendor',[VendorController::class,'BecomeVendor'])->name('become.vendor');
    Route::get('vendor/login',[VendorController::class,'BecomeVendorLogin'])->middleware(RedirectIfAuthenticated::class)->name('become.vendor.login');
    Route::post('vendor/register',[VendorController::class,'vendorCreate'])->name('vendor.register');

    // ------------------------------ User Product Details Page----------------------------------
    Route::get('/', [IndexController::class, 'index'])->name('home');
    Route::get('product/details/{id}/{slug}', [IndexController::class, 'productDetails']);
    Route::get('product/category/{id}/{slug}', [IndexController::class, 'productCategory']);
    Route::get('product/subcategory/{id}/{slug}', [IndexController::class, 'productSubCategory']);

    // --------------------------- Product View model with Ajax -------------------------------
    Route::get('product/view/model/{id}', [IndexController::class, 'productView']);

    // --------------------------- Add to cart Product with package -------------------------------
    Route::post('cart/data/store/{id}', [CartController::class, 'AddToCart']);
    Route::get('product/mini/cart', [CartController::class, 'addMiniCart']);
    Route::get('miniCart/product/remove/{rowId}', [CartController::class, 'miniCartRemove']);
    Route::post('coupon-apply', [CartController::class, 'couponApply']);
    Route::get('coupon-calculation', [CartController::class, 'couponCalculation']);
    Route::get('couponRemove', [CartController::class, 'CouponRemove']);

    // ------------------------------ Cart Page View ----------------------------------
    Route::get('myCart',[CartController::class,'MyCart'])->name('myCart');
    Route::get('get-cart-product',[CartController::class,'getCartProduct']);
    Route::get('cartRemove/{rowId}', [CartController::class, 'cartRemove']);
    Route::get('cart-decrement/{rowId}', [CartController::class, 'cartDecrement']);
    Route::get('cart-increment/{rowId}', [CartController::class, 'cartIncrement']);

    // ------------------------------ Shop Page----------------------------------
    Route::get('shop', [ShopController::class, 'ShopPage'])->name('shop.page');
    Route::post('shop/filter', [ShopController::class, 'ShopFilter'])->name('shop.filter');


    // ------------------------------ Blog Page View ----------------------------------
    Route::get('blog',[BlogController::class,'AllBlog'])->name('home.blog');
    Route::get('post/details/{id}/{slug}',[BlogController::class,'BlogDetails']);
    Route::get('post/category/{id}/{slug}',[BlogController::class,'BlogPostCategory']);

    // ------------------------------ Product Search Page View ----------------------------------
    Route::post('search',[IndexController::class,'ProductSearch'])->name('product.search');
    Route::post('search-product',[IndexController::class,'SearchProduct']);



    // --------------------------- Cart Page Check Out -------------------------------
    Route::get('checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');

    // ---------------- Add to Details Page cart Product with package -------------------------------
    Route::post('cartDetails/data/store/{id}', [CartController::class, 'AddToCartDetails']);


    // ---------------- Add to Wishlist  -------------------------------
    Route::post('add-to-wishlist/{product_id}', [WishlistController::class, 'AddToWishlist']);

    // ---------------- Add to Compare  -------------------------------
    Route::post('add-to-compare/{product_id}', [CompareController::class, 'AddToCompare']);


        //    ------------------ Vendor Details Page  --------------------------------------
    Route::get('vendor/details/{id}', [IndexController::class, 'vendorDetails'])->name('vendor.details');
    Route::get('All/vendor/List', [IndexController::class, 'allVendor'])->name('all.vendor');