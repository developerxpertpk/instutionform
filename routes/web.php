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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('project_index');
});




Route::post('/user_register','CustomregisterController@insert')->name('user.register');

Route::get('/login_form','CustomregisterController@showloginform')->name('show.login');

Route::get('/login', 'Auth\loginController@showLoginform')->name('login');
Route::post('/submit','Auth\LoginController@login')->name('login.submit');

				// Admin Routes
Route::prefix('/admin')->group(function(){

	Route::get('login', 'Auth\loginController@showLoginform')->name('admin.login');
	Route::post('/submit','Auth\LoginController@login')->name('login.submit');
	Route::get('/dashboard','DashboardController@index')->name('admin.dashboard');
	Route::get('charts','DashboardController@chart')->name('charts');
	Route::resource('user','UserController');
	Route::post('user/update/{id}','UserController@status_update')->name('user.update1');
	Route::get('admin/user/search', 'UserController@search');
	//Route::get('/user/search', 'UserController@search');
});

  Route::get('/search', 'UserController@search');
//Route::resource('itemCRUD','DashboardController');
 
//  /***   Password reset password ****/

// Route::prefix('/password')->group(function(){

// Route::get('/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::post('/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

// Route::post('/reset','Auth\ResetPasswordController@reset')->name('reset');

// });

// Route::get('password/reset/{token?}','Auth\PasswordController@ahowResetForm');
// Route::post('password/email','Auth\PasswordController@sendResetLinkEmail');
// Route::get('auth/logout',['as'=>'logout','uses'=>'Auth\PasswordController@sendResetLinkEmail']);


// Route::get('auth/password/reset','Auth\PasswordController@getResetAuthenticatedView');

// Route::post('auth/password/reset', 'Auth\PasswordController@resetAuthenticated');
Auth::routes();


/*USER ROUTES*/

Route::get('/home', 'HomeController@index')->name('home');

/*USER HOME GROUP*/
Route::group(['middleware' => ['auth']], function () {

    Route::group(['prefix' => 'home'],function(){

		Route::get('my_profile',function(){
			return view('user.my_profile');
		});

		Route::get('profile_edit',function(){
			return view('user.user_edit');
		});

		Route::post('profile_edit','HomeController@profile_edit');

		Route::get('password_user',function(){
			return view('user.change_user_password');
		});

		Route::post('password_user','HomeController@change_user_password');


	});

});
