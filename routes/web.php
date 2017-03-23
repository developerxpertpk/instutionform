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






Route::post('/user_register','CustomregisterController@insert')->name('user.register');

Route::get('/login_form','CustomregisterController@showloginform')->name('show.login');

Route::get('/login', 'Auth\loginController@showLoginform')->name('login');
Route::post('/submit','Auth\LoginController@login')->name('login.submit');

	

	/*   Admin Routes */
Route::group(['middleware' => ['auth']], function () {

		Route::prefix('/admin')->group(function(){

			Route::get('/dashboard','DashboardController@index')->name('admin.dashboard');

			Route::get('charts','DashboardController@chart')->name('charts');

			Route::resource('user','UserController');

			Route::post('user/update/{id}','UserController@status_update')->name('user.update1');
			Route::get('admin/user/search', 'UserController@search');

			/*  route for school-institue */
			//Route::get('school','SchoolController@index');
			Route::resource('school','SchoolController');
			//Route::get('school','SchoolController@list');

			//Route::get('/user/search', 'UserController@search');
			});
});

Route::get('/search', 'UserController@search');
Auth::routes();


/*USER ROUTES*/

Route::get('/home', 'HomeController@index')->name('home');

/*USER HOME GROUP*/
Route::group(['middleware' => ['auth']], function () {

    Route::group(['prefix' => 'home'],function(){

		Route::get('my_profile',function(){
			return view('user.my_profile');
		});

		Route::post('profile_edit','HomeController@profile_edit');

		Route::post('password_user','HomeController@change_user_password');

		Route::post('change_dp_user','HomeController@change_dp_user');


	});

});
