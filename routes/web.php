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
    return view('forum&finder_welcome');
});






Route::post('/user_register','CustomregisterController@insert')->name('user.register');

Route::get('/login_form','CustomregisterController@showloginform')->name('show.login');

Route::get('/login', 'Auth\loginController@showLoginform')->name('login');

Route::post('/submit','Auth\LoginController@login')->name('login.submit');

	

	/*   Admin Routes */
Route::group(['middleware' => ['auth']], function () {

		Route::prefix('/admin')->group(function(){

			Route::get('/dashboard','DashboardController@index')->name('admin.dashboard');

			Route::get('profile',function(){
					return view('admin.dashboard.profile');
			})->name('admin.profile');

			Route::get('changepwd',function(){
				return view('admin.dashboard.changepwd');
			})->name('admin.changepwd');

			Route::post('postpwd','DashboardController@pwdchange')->name('admin.postpwd');

			Route::get('charts','DashboardController@chart')->name('charts');


			Route::resource('user','UserController');

			Route::post('user/update/{id}','UserController@status_update')->name('user.update1');
			Route::get('admin/user/search', 'UserController@search');

			/*  route for school-institue */
			
			Route::resource('school','SchoolController');
			Route::get('school/search','SchoolController@search')->name('school.search');

			//Route::get('school','SchoolController@list

			// Routes for cms
			Route::get('content',function(){
				  return view('admin.dashboard.cms.content');			
			})->name('content');
			
			Route::get('pages',function(){
				  return view('admin.dashboard.cms.add_page');			
			})->name('addpages');
			
    	});
				
});

Route::get('/search', 'UserController@search');
Auth::routes();
// admin routes ended

/*USER ROUTES*/

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/search_location','UnregisteredController@search_location_school');

Route::get('show_school/{id}','UnregisteredController@show_school');

Route::get('schools_list','UnregisteredController@schools_list');

Route::get('details',function(){
	return view('user.guests.view_school');
});


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

Route::get('map_data','UnregisteredController@retrive_nearby_locations');

//forum&finder_welcome