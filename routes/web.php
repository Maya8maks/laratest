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

Route::get('/', function () {
    return view('welcome');
});
Route::match(['get','post'],'/', ['uses' => 'IndexController@main', 'as' => 'main']);
Route::get('/{id}/dashboard', ['middleware'=>'checkUser','uses' => 'UserController@dashboard', 'as' => 'dashboard']);
Route::match(['get','post'],'/question/{question}/{discription}/{email}', ['uses' => 'IndexController@prepareTopay', 'as' => 'prepareToPay']);
Route::match(['get','post'],'/paypal',['uses' => 'PaypalController@paypal', 'as' => 'paypal']);
Route::match(['get','post'], 'editQuestion/{question}/{email}', ['uses' => 'IndexController@editQuestion', 'as' => 'editQuestion']);
Route::post('/answer/doctor{doctor_id}/question{question_id}', ['middleware'=>['answer','checkUser'],'uses' => 'UserController@answer', 'as' => 'answer']);
Route::match(['get','post'],'/{id}/orders', ['middleware'=>['answer','checkUser'],'uses' => 'UserController@orders', 'as' => 'orders']);
Route::match(['get','post'],'/{id}/account', ['middleware'=>['checkUser', 'account'],'uses' => 'UserController@account', 'as' => 'account']);
Route::match(['get','post'],'/loginUser', ['uses' => 'UserController@login', 'as' => 'loginUser']);
Route::get('/logoutUser', ['middleware'=>'checkUser','uses' => 'UserController@loguot', 'as' => 'logoutUser']);
Route::match(['get','post'],'/{id}/orders', ['middleware'=>['answer','checkUser'],'uses' => 'UserController@orders', 'as' => 'orders']);
Route::get('/admin', ['middleware'=>'checkAdmin','uses' => 'AdminController@dashboard', 'as' => 'adminDashboard']);
Route::get('/admin/order', ['middleware'=>'checkAdmin','uses' => 'AdminController@orders', 'as' => 'adminOrders']);
Route::match(['get','post'],'/admin/createAccount', ['middleware'=>'checkAdmin','uses' => 'AdminController@createAccount', 'as' => 'adminCreateAccount']);
Route::get('/admin/dashboard/{orderBy}', ['uses'=>'AdminController@dashboardOrderBy', 'as'=>'adminDashboardOrderBy']);
Route::get('/admin/order/{orderBy}', ['uses'=>'AdminController@orderOrderBy', 'as'=>'adminOrderOrderBy']);
Route::post('admin/register', ['middleware'=>'register','uses' => 'AdminController@createAccount', 'as' => 'register']);

Route::get('auth/facebook', ['uses' => 'AuthController@redirectToFacebookProvider','as'=>'facebook']);
Route::match(['get','post'],'auth/facebook/callback', ['uses' => 'AuthController@handleProviderCallbackFromFacebook', 'as'=>'callbackFacebook']);
Route::get('auth/github', ['uses' => 'AuthController@redirectToGithubProvider','as'=>'github']);
Route::match(['get','post'],'auth/github/callback', ['uses' => 'AuthController@handleProviderCallbackFromGithub', 'as'=>'callbackGithub']);
Route::get('auth/google', ['uses' => 'AuthController@redirectToGoogleProvider','as'=>'google']);
Route::match(['get','post'],'auth/google/callback', ['uses' => 'AuthController@handleProviderCallbackFromGoogle', 'as'=>'callbackGoogle']);
Route::get('auth/twitter', ['uses' => 'AuthController@redirectToTwitterProvider','as'=>'twitter']);
Route::match(['get','post'],'auth/twitter/callback', ['uses' => 'AuthController@handleProviderCallbackFromTwitter', 'as'=>'callbackTwitter']);
Route::get('auth/linkedin', ['uses' => 'AuthController@redirectToLinkedinProvider','as'=>'linkedin']);
Route::match(['get','post'],'auth/linkedin/callback', ['uses' => 'AuthController@handleProviderCallbackFromLinkedin', 'as'=>'callbackLinkedin']);
Route::match(['get','post'], 'paypal/pay',['uses' => 'PaypalController@paypal', 'as'=>'paypal']);

Route::get('/privacyCookies', function() {
    return view('privacyCookies');
})->name('privacyCookies');
Route::get('/legal', function() {
    return view('legal');
})->name('legal');
Route::get('/advertise', function() {
    return view('advertise');
})->name('advertise');
Route::get('/help', function() {
    return view('help');
})->name('help');

Route::get('/registration', ['uses' =>'AuthController@registerForm']);
Route::post('/registration', ['uses' => 'AuthController@register', 'as'=>'registration']);
