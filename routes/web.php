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
Auth::routes((['register' => false]));

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');



Route::group(['middleware' => 'auth'], function () {

    Route::resource('users', 'UserController');
    Route::resource('projects', 'ProjectsController');
    Route::resource('roles', 'RoleController');
    Route::resource('modules', 'ModulesController');
    Route::resource('parts', 'BodyPartsController');
    Route::resource('details', 'EquipmentsController');
    Route::resource('patients', 'PatientsController');
//    Route::resource('objectives', 'ObjectivesController');
//    Route::resource('equipments', 'EquipmentsController');
    Route::resource('exercises', 'ExerciseController');
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
    Route::get('add_exercise/{id}','PatientsController@add_exercise')->name('add_exercise');
    Route::post('/patients/getPatients/','PatientsController@getPatients')->name('patients.getPatients');

});

