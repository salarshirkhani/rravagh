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

Route::get('/', 'FrontController@index')->name('/');
Route::get('products', 'FrontController@products')->name('products');
Route::get('discountable', 'FrontController@discountable')->name('discountable');
Route::get('contact', 'FrontController@contact')->name('contact');
Route::post('message', 'FrontController@Message')->name('message');
Route::get('about', 'FrontController@about')->name('about');
Route::get('promotion', 'FrontController@promotion')->name('promotion');
//Route::get('customer_service', 'FrontController@Customer')->name('customer_service');
Route::get('blog', 'FrontController@blog')->name('blog');
Route::get('search', 'FrontController@search')->name('search');
Route::get('post/{id}', 'FrontController@post')->name('post');
Route::get('product/{id}', 'FrontController@Sproduct')->name('product');
Route::get('brands/{id}', 'FrontController@Brands')->name('brands');
Route::get('category/{slug}', 'FrontController@category')->name('category');
Route::get('single/{id}', 'FrontController@Sproduct')->name('single');
Route::post('single/{id}','FrontController@SendOffer')->name('single'); 
Route::get('search', 'FrontController@search')->name('search');
Route::post('comment', 'FrontController@comment')->name('comment');
Route::post('postcomment', 'FrontController@postcomment')->name('postcomment');
Route::post('productsearch', 'FrontController@productsearch')->name('productsearch');
Route::get('tags', 'FrontController@tags')->name('tags');
Route::get('posttags', 'FrontController@posttags')->name('posttags');
Route::post('promot', 'FrontController@promot')->name('promot');
Route::get('subscription', 'FrontController@subscription')->name('subscription');
Route::get('questions', 'FrontController@questions')->name('questions');
Route::get('rules', 'FrontController@rules')->name('rules');
Route::get('security', 'FrontController@security')->name('security');

//SUBSCRIPTION SYSTEM
Route::post('subs','SubscribeController@create')->name('subs');
Route::get('payment/callbackss', 'SubscribeController@callback')->name('payment.callbackss');

//CART
Route::get('cart', 'CartController@index')->name('cart');
Route::post('cart','CartController@store')->name('cart.store'); 
Route::delete('cart/{id}','CartController@destroy')->name('cart.destroy');
Route::get('discount', 'PaymentController@discount')->name('discount');

Route::post('checkout', 'PaymentController@checkout')->name('checkout');
Route::post('payment/pay','PaymentController@create')->name('payment.pay');
Route::get('payment/callbacks', 'PaymentController@callback')->name('payment.callbacks');
Route::get('payment/callback', 'PaymentController@callbacks')->name('payment.callback');
//LIKE
Route::post('like','LikeController@Like')->name('like'); 

//HELP SYSTEM
Route::post('help','HelpController@create')->name('help');
Route::get('payment/scallbacksh', 'HelpController@callback')->name('payment.scallbacksh');

Route::prefix('media')
->name('media.')
->group(function() {
    Route::get('/', 'Movie\IndexController@index')->name('index');
    Route::post('moviesearch', 'Movie\IndexController@moviesearch')->name('moviesearch');
    Route::get('movie/{id}', 'Movie\IndexController@single')->name('movie');
    Route::post('all', 'Movie\IndexController@movies')->name('all');
    Route::get('tags', 'Movie\IndexController@tags')->name('tags');
    Route::get('category/{slug}', 'Movie\IndexController@category')->name('category');
});

Auth::routes();

Route::prefix('dashboard')
    ->name('dashboard.')
    ->middleware('auth')
    ->namespace('Dashboard')
    ->group(function() {
        Route::get('', 'IndexController@get')->name('index');
        Route::prefix('admin')
            ->name('admin.')
            ->middleware('user_type:admin')
            ->namespace('Admin')
            ->group(function() {
                Route::get('', 'IndexController@get')->name('index');

                Route::resource('slider-items', 'SliderItemController')->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
                Route::post('news/create', ['uses' => 'PostController@CreatePost','as' => 'news.create' ]);
                Route::get('news/create', ['uses' => 'PostController@GetCreatePost','as' => 'news.create']); 
                Route::get('news/manage', 'PostController@GetManagePost')->name('news.manage');
                Route::get('deletepost/{id}','PostController@DeletePost')->name('news.deletepost');  
                Route::get('updatepost/{id}','PostController@GetEditPost')->name('news.updatepost');
                Route::post('updatepost/{id}','PostController@UpdatePost')->name('news.updatepost');\
                Route::get('ndeletetags/{ids}','PostController@DeleteTag')->name('news.ndeletetags');

                //NOTIFICATION CONTROLLER
                Route::post('notification/create', ['uses' => 'NotificationController@CreatePost','as' => 'notification.create' ]);
                Route::get('notification/create', ['uses' => 'NotificationController@GetCreatePost','as' => 'notification.create']); 
                Route::get('notification/manage', 'NotificationController@GetManagePost')->name('notification.manage');
                Route::get('deletenotification/{id}','NotificationController@DeletePost')->name('notification.deletenotification');  
                Route::get('updatenotification/{id}','NotificationController@GetEditPost')->name('notification.updatenotification');
                Route::post('updatenotification/{id}','NotificationController@UpdatePost')->name('notification.updatenotification');

                //SUBSCRIPTION CONTROLLER
                Route::post('subscription/create', ['uses' => 'SubscriptionController@CreatePost','as' => 'subscription.create' ]);
                Route::get('subscription/create', ['uses' => 'SubscriptionController@GetCreatePost','as' => 'subscription.create']); 
                Route::get('subscription/manage', 'SubscriptionController@GetManagePost')->name('subscription.manage');
                Route::get('subscription/delete/{id}','SubscriptionController@DeletePost')->name('subscription.delete');  
                Route::get('subscription/update/{id}','SubscriptionController@GetEditPost')->name('subscription.update');
                Route::post('subscription/update/{id}','SubscriptionController@UpdatePost')->name('subscription.update');
              
              
                //PROMOTION CONTROLLER
                Route::get('promotion/manage', 'PromotionController@GetManagePost')->name('promotion.manage');
                Route::get('promotion/deletepro/{id}','PromotionController@DeletePost')->name('promotion.deletepro'); 

                //BRAND CONTROLLER
                Route::post('brands/create', ['uses' => 'BrandController@CreatePost','as' => 'brands.create' ]);
                Route::get('brands/create', ['uses' => 'BrandController@GetCreatePost','as' => 'brands.create']); 
                Route::get('brands/manage', 'BrandController@GetManagePost')->name('brands.manage');
                Route::get('delete/{id}','BrandController@DeletePost')->name('brands.delete');  
                Route::get('update/{id}','BrandController@GetEditPost')->name('brands.update');
                Route::post('update/{id}','BrandController@UpdatePost')->name('brands.update');

                //COLOR CONTROLLER
                Route::post('colors/create', ['uses' => 'ColorController@CreatePost','as' => 'colors.create' ]);
                Route::get('colors/create', ['uses' => 'ColorController@GetCreatePost','as' => 'colors.create']); 
                Route::get('colors/manage', 'ColorController@GetManagePost')->name('colors.manage');
                Route::get('colors/delete/{id}','ColorController@DeletePost')->name('colors.delete');  
                Route::get('colors/update/{id}','ColorController@GetEditPost')->name('colors.update');
                Route::post('colors/update/{id}','ColorController@UpdatePost')->name('colors.update');

                //DISCOUNT CONTROLLER
                Route::post('discount/create', ['uses' => 'DiscountController@CreatePost','as' => 'discount.create' ]);
                Route::get('discount/create', ['uses' => 'DiscountController@GetCreatePost','as' => 'discount.create']); 
                Route::get('discount/manage', 'DiscountController@GetManagePost')->name('discount.manage');
                Route::get('deletediscount/{id}','DiscountController@DeletePost')->name('discount.deletediscount');  
                Route::get('updatediscount/{id}','DiscountController@GetEditPost')->name('discount.update');
                Route::post('updatediscount/{id}','DiscountController@UpdatePost')->name('discount.update');

                //PRODUCT CONTROLLER
                Route::post('product/create', ['uses' => 'ProductController@CreatePost','as' => 'product.create' ]);
                Route::get('product/create', ['uses' => 'ProductController@GetCreatePost','as' => 'product.create']); 
                Route::get('product/manage', 'ProductController@GetManagePost')->name('product.manage');
                Route::get('product/manage', 'ProductController@GetManagePost')->name('product.manage');
                Route::get('deleteproduct/{id}','ProductController@DeletePost')->name('product.deleteproduct');  
                Route::get('updateproduct/{id}','ProductController@GetEditPost')->name('product.updateproduct');
                Route::post('updateproduct/{id}','ProductController@UpdatePost')->name('product.updateproduct');      
                
                //COMMENT CONTROLLER
                Route::get('comment/manage', 'CommentController@GetManagePost')->name('comment.manage');
                Route::get('deletecomment/{id}','CommentController@DeletePost')->name('comment.deletecomment');  
                Route::get('updatecomment/{id}','CommentController@GetEditPost')->name('comment.updatecomment');
                Route::post('updatecomment/{id}','CommentController@UpdatePost')->name('comment.updatecomment');

                //CONTACT CONTROLLER
                Route::get('contact/manage', 'ContactController@GetManagePost')->name('contact.manage');
                Route::get('deletecontact/{id}','ContactController@DeletePost')->name('contact.deletecontact');  
                
                //USER CONTROLLER
                Route::get('users', 'UserController@getprofile')->name('users.index');
                Route::post('users/create', ['uses' => 'UserController@CreatePost','as' => 'users.create' ]);
                Route::get('users/create', ['uses' => 'UserController@GetCreatePost','as' => 'users.create']); 
                Route::get('users/edit/{id}', 'UserController@getEditprofile')->name('users.edit');
                Route::post('users/ediit', 'UserController@Editprofile')->name('users.ediit');
                Route::get('users/show/{id}', 'UserController@getuser')->name('users.show');
                Route::get('deleteuser/{id}','UserController@DeletePost')->name('users.deleteuser');
                Route::post('users/changerole', 'UserController@Role')->name('users.changerole');
                Route::get('deleteorder/{id}','UserController@DeleteOrder')->name('users.deleteorder');
                Route::post('users/addorder', 'UserController@AddOrder')->name('users.addorder');

                //TEACHER CONTROLLER
                Route::get('teachers', 'TeacherController@getprofile')->name('teachers.index');
                Route::get('teachers/edit/{id}', 'TeacherController@getEditprofile')->name('teachers.edit');
                Route::post('teachers/ediit', 'TeacherController@Editprofile')->name('teachers.ediit');
                Route::get('teachers/show/{id}', 'TeacherController@getuser')->name('teachers.show');
                Route::post('teachers/changerole', 'TeacherController@Role')->name('teachers.changerole');
                Route::post('teachers/brand', 'TeacherController@brand')->name('teachers.brand');
                Route::get('deletebrand/{id}','TeacherController@deletebrand')->name('teachers.deletebrand');  

                //BUYER CONTROLLER
                Route::get('buyer', 'BuyerController@getprofile')->name('buyer.index');
                Route::get('buyer/edit/{id}', 'BuyerController@getEditprofile')->name('buyer.edit');
                Route::post('buyer/ediit', 'BuyerController@Editprofile')->name('buyer.ediit');
                Route::get('buyer/show/{id}', 'BuyerController@getuser')->name('buyer.show');
                Route::post('buyer/changerole', 'BuyerController@Role')->name('buyer.changerole');
                
                //UPLOAD CENTER
                Route::post('uploader/create', ['uses' => 'UploadController@CreatePost','as' => 'uploader.create' ]);
                Route::get('uploader/create', ['uses' => 'UploadController@GetCreatePost','as' => 'uploader.create']); 
                Route::get('uploader/manage', 'UploadController@GetManagePost')->name('uploader.manage');
                Route::get('deleteupload/{id}','UploadController@DeletePost')->name('uploader.deleteupload'); 

                //Transaction And Orders CONTROLLER
                Route::get('transaction/manage', 'TransactionController@GetManagePost')->name('transaction.manage');
                Route::get('deletetransaction/{id}','TransactionController@DeletePost')->name('transaction.deleteproduct');  
                Route::get('orders/manage', 'TransactionController@GetOrders')->name('orders.manage');

                //Category Controller 
                Route::resource("categories", "CategoryController");
                Route::get('deletecat/{id}','CategoryController@delete')->name('categories.deletecat'); 

                 // Clear application cache
                Route::get('/clear-cache', function () {
                    Artisan::call('cache:clear');
                    Artisan::call('route:clear');
                    Artisan::call('config:cache');
                    Artisan::call('view:clear');
                    Artisan::call('optimize:clear');
                    return "Cache cleared successfully";
                })->name('clear-cache');


 //------MOVIE ADMIN CONTROLLER----- 

                 //MOVIES CONTROLLER
                Route::post('movies/create', ['uses' => 'MoviesController@CreatePost','as' => 'movies.create' ]);
                Route::get('movies/create', ['uses' => 'MoviesController@GetCreatePost','as' => 'movies.create']); 
                Route::get('movies/manage', 'MoviesController@GetManagePost')->name('movies.manage');
                Route::get('movies/delete/{id}','MoviesController@DeletePost')->name('movies.delete');  
                Route::get('movies/update/{id}','MoviesController@GetEditPost')->name('movies.update');
                Route::post('movies/update/{id}','MoviesController@UpdatePost')->name('movies.update');
            });



        Route::prefix('customer')
            ->name('customer.')
            ->middleware('user_type:buyer')
            ->namespace('Customer')
            ->group(function() {
                Route::get('', 'IndexController@get')->name('index');
                Route::get('cart', 'IndexController@cart')->name('cart');
                Route::get('likes', 'IndexController@likes')->name('likes');
                Route::get('notification/{id}', 'IndexController@notification')->name('notification');
				Route::get('profile', 'IndexController@profile')->name('profile');
                Route::post('profile/edit', 'IndexController@Editprofile')->name('profile.edit');
        });


        Route::prefix('buyer')
            ->name('buyer.')
            ->middleware('user_type:seller')
            ->namespace('Buyer')
            ->group(function() {
                Route::get('', 'IndexController@get')->name('index');
                Route::get('cart', 'IndexController@cart')->name('cart');
                Route::get('likes', 'IndexController@likes')->name('likes');
                Route::get('profile', 'IndexController@profile')->name('profile');
                Route::get('notification/{id}', 'IndexController@notification')->name('notification');

            });

    });
