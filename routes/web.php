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

Route::get('/','PageController@home');
/*  Route for pages */




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
            /*  route for school-institue */
            Route::post('school/status/{id}','SchoolController@status_update')->name('school.status');

			//Route::get('school','SchoolController@list

			// Routes for cms
			Route::get('content','PageController@index')->name('content');

			Route::get('pages',function(){
				  return view('admin.dashboard.cms.add_page');
			})->name('addpages');

			Route::post('page/submit','PageController@store')->name('page.submit');

			Route::get('freq_ask_ques','PageController@show_faq')->name('freq_ask_ques');

            Route::get('add_question',function(){
                return view('admin.dashboard.cms.add_question');
            })->name('add_question');

            Route::post('question/submit','PageController@question_submit')->name('question_submit');

    	});
});

Route::get('/search', 'UserController@search');
Route::get('/school_search','SchoolController@search')->name('school_search');
Auth::routes();
// admin routes ended

/*USER ROUTES*/

Route::get('home', 'HomeController@index')->name('home');

Route::get('search_location','UnregisteredController@search_location_school');

Route::get('show_school/{id}','UnregisteredController@show_school');

Route::get('schools_list','UnregisteredController@schools_list');

Route::get('details',function(){
	return view('user.guests.view_school');
});


/*USER HOME GROUP*/
Route::group(['middleware' => ['auth','check.status']], function () {

    Route::group(['prefix' => 'home'],function(){

		Route::get('my_profile',function(){
			return view('user.my_profile');
		});

		Route::post('profile_edit','HomeController@profile_edit');

		Route::post('password_user','HomeController@change_user_password');

		Route::post('change_dp_user','HomeController@change_dp_user');


	});

});

/*Ajax calls*/
Route::get('map_data','AjaxCallsController@retrive_nearby_locations');

Route::get('check_status','AjaxCallsController@check_status');

Route::get('rate_school','AjaxCallsController@rate_school');
/*Ajax calls close*/
//forum&finder_welcome



Route::get('/{slug}','PageController@page_show');