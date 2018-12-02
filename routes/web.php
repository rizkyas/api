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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', function () {
    return view('home');
});
Route::get('/register', 'AuthController@getRegister');
Route::post('/register', 'AuthController@register')->name('register');
Route::get('/login', 'AuthController@getLogin');
Route::post('/login', 'AuthController@Login')->name('login');
//Route::get('/login/check-pwd', 'AuthController@chkPassword');
Route::get('/login/update-pwd', 'AuthController@updatePassword');
Route::get('/logout', 'AuthController@Logout')->name('logout');
//Route::get('/admin/dashboard', 'AdminController@dashboard')->name('admin');
Route::get('/blog', 'BlogController@Index')->name('blog');
//Route::get('/users','UserController@users');
Route::get('users/profile','UserController@profile')->middleware('auth:api');
Route::post('post', 'PostController@add')->middleware('auth:api');

Route::group(['middleware' => ['auth']], function()
{
    Route::resource('blog','BlogController');
});
Route::group(['middleware' => ['auth']], function()
{
    Route::get('/admin/dashboard', 'AdminController@dashboard')->name('dashboard');
    Route::get('/admin/settings', 'AdminController@settings')->name('settings');
 //   Route::get('/admin/check-pwd', 'AdminController@chkPassword');
 //   Route::match(['get','post'],'/admin/update-pwd','AdminController@updatePassword');
    Route::get('/login/update-pwd', 'AuthController@updatePassword');
    Route::match(['get','post'],'/login/update-pwd','AuthController@updatePassword');

    // Categories Route Admin
    Route::match(['get','post'],'/admin/add-category','CategoryController@addCategory');
    Route::match(['get','post'],'/admin/view-categories','CategoryController@viewCategories');
    Route::match(['get','post'],'/admin/edit-category/{id}','CategoryController@editCategory');
    Route::match(['get','post'],'/admin/delete-category/{id}','CategoryController@deleteCategory');
});


