<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Servicios aplicacion angular*/
Route::get('/inventario', function () {
	$list = array(
		array(
		"id" => 1,
		"producto" => "Teclado",
		"existencia" => 5,
		"precio" => 12,
		"proveedor" => "Genius"
		),
		array(
		"id" => 2,
		"producto" => "Parlantes",
		"existencia" => 4,
		"precio" => 25,
		"proveedor" => "Logitech"
		)
		);
    return json_encode($list, JSON_PRETTY_PRINT);
});

Route::get('/inventario/get-token', function () {
	$token = csrf_token();
	$obj = array("token" => $token);
	return json_encode($obj, JSON_PRETTY_PRINT);
});
Route::post('/inventario', function () {
	return "Funciona el post";
});


/*Rutas acceso archivo Legion*/
Route::group(['prefix' => 'opensource-legion-del-afecto', 'middleware' => []], function(){
	Route::get('/', 'LegionController@index');
	Route::get('search/{keyWord}', 'LegionController@searchDoc');
	Route::get('doc/{string}', 'LegionController@getDoc');
});

/*VERSION 4.0 ELATLAS
30-08-2017
BY ERICK SAENZ
*/
//Archivo principal ELAtlas
Route::get('/', 'v4Controller@index');


/*VERSIONES ANTERIORES DE EL ATLAS
PROXIMAMENTE QUEDARAN OBSOLETAS
*/

//Route::get('/', 'v2Controller@about');//v2 ruta anterior
Route::get('/inicio', 'v2Controller@about');//v2
Route::get('/home', 'v2Controller@about');//v2
Route::get('alexissaenz', 'BasicController@indexAlexis');//No v2
Route::get('retorno', 'BasicController@retorno');//No v2
Route::get('new/index', 'BasicController@newInterfaz');//No v2
//Route::get('new-index', 'BasicController@newIndex');



//Route::get('groups-register', 'BasicController@groupsRegister');
//Route::get('activities', 'BasicController@activities');
//Route::get('map-activities', 'BasicController@mapActivities');
Route::get('terms-conditions', 'BasicController@termsConditions');
//Route::get('categories', 'BasicController@categories');//Ajax
Route::get('categories', ['middleware' => 'cors','uses' => 'BasicController@categories']);
Route::get('searchAjax/{cadena}', 'BasicController@searchAjax');//Ajax
Route::get('allGroupsAjax', 'BasicController@allGroupsAjax');//Ajax
Route::get('da', 'BasicController@daPage');//No v2
Route::get('searchCategories/{cadena}', 'BasicController@searchCategories');//ajax
Route::get('groupsxcat', 'BasicController@groupsxcat');//No v2
Route::get('unirme', 'GruposController@create');

/*Versio 2.0 el Atlas*/
Route::get('v2', 'v2Controller@about');//v2
Route::get('v2/mapa-grupos', 'v2Controller@mapGroups');//v2
Route::get('v2/mapa-acciones', 'v2Controller@mapAct');//v2
Route::get('v2/preguntas-frecuentes', 'v2Controller@questions');//v2
Route::get('v2/mapa-recorridos', 'v2Controller@mapRecorridos');//v2
Route::get('v2/resend-code-activation/{id}', 'v2Controller@resendCodeActivation');//v2


//voy a reescalar las imagenes de perfil y actividades
Route::get('v2/reescalar-perfil', 'v2Controller@reescalarPerfil');//v2
Route::get('v2/reescalar-acti', 'v2Controller@reescalarActi');//v2

/*Routes ajax*/
//Route::get('v2/categories', 'v2Controller@categories');//v2 ajax
Route::get('v2/categories', ['middleware' => 'cors','uses' => 'v2Controller@categories']);
//Route::get('v2/groups-register', 'v2Controller@groupsRegister');//v2 ajax
Route::get('v2/groups-register', ['middleware' => 'cors','uses' => 'v2Controller@groupsRegister']);
//Route::get('v2/groups-register-categories/{activeCategories}', 'v2Controller@groupsRegisterCategories');//v2 ajax
Route::get('v2/groups-register-categories/{activeCategories}', ['middleware' => 'cors','uses' => 'v2Controller@groupsRegisterCategories']);

Route::get('v2/activities-register', 'v2Controller@activitiesRegister');//v2 ajax
Route::get('v2/activities-group-register/{id}', 'v2Controller@activitiesGroupRegister');//v2 ajax
Route::get('v2/tours-group-register/{id}', 'v2Controller@toursGroupRegister');//v2
Route::get('v2/tours-register', 'v2Controller@toursRegister');//v2 ajax

//Route::get('v2', 'v2Controller@template');


Route::get('email_conf', 'email_confController@index');//v2

//Route::get('register', 'HomeController@index');
//
//Route::get('profile', 'ProfileController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::resource('grupos', 'GruposController');//v2

Route::get('active/{cod}', 'ActiveCountController@index');

Route::group(['prefix' => 'user', 'middleware' => ['auth', 'email_confirmed']], function(){
	Route::get('publications', 'UserController@publications');//v2
	Route::get('v2/mapa-grupos', 'v2Controller@mapGroups');//v2
	Route::get('upload-activity', 'UserController@uploadActivity');//v2
	Route::post('upload-activity', 'UserController@uploadActivityPost');//v2
	Route::post('search-post', 'UserController@searchPost');//No v2
	Route::get('upload-photos/{id}', 'UserController@uploadPhotos');//v2
	Route::post('upload-photos', 'FilesController@uploadPhotosPost');//v2
	Route::get('my-publications', 'UserController@myPublications');//v2
	Route::get('reports/edit/{id}', 'UserController@editReport');//v2
	Route::post('reports/update', 'UserController@updateReport');//v2
	Route::get('reports/delete/{id}', 'UserController@deleteReport');//v2
	Route::get('edit-photo-profile', 'UserController@editPhotoProfile');//v2
	Route::post('update-photo-profile', 'FilesController@updatePhotoProfile');//v2
	Route::get('get-photo-profile', 'UserController@getPhotoProfile');//v2
	Route::get('success-act-reg-sin-fotos', 'UserController@activityWithoutPhotos');//v2
	Route::get('report/upload-coordinates/{id}', 'UserController@uploadCoordinates');//v2
	Route::get('report/upload-coordinates-post/{data}', 'UserController@uploadCoordinatesPost');//v2

});

	Route::get('publications', 'UserController@publications');//v2
	Route::get('publications/{id}', 'UserController@showPost');//v2
	Route::get('autor/{id}', 'UserController@showAutor');//v2
	Route::post('search', 'UserController@search');




Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'email_confirmed', 'is_admin']], function(){
	Route::get('reports', 'AdminController@reports');//v2
	Route::get('show-report/{id}', 'AdminController@showReport');//v2
	Route::get('reports/approve/{id}', 'AdminController@approveReport');//v2
	Route::get('reports/desapprove/{id}', 'AdminController@desapproveReport');//v2
	Route::get('reports/edit/{id}', 'AdminController@editReport');//v2
	Route::post('reports/update', 'AdminController@updateReport');//v2
	Route::get('reports/delete/{id}', 'AdminController@deleteReport');//v2
});

Route::group(['prefix' => 'recorridos'], function(){
	Route::get('/', 'RecorridosController@index');
	Route::get('derecho-a-la-ciudad/page{id}', 'RecorridosController@recorridoDerechoAlaCiudad');
});



Route::get('register', ['middleware' => 'auth',function(){
	return redirect()->action('ProfileController@index');
}]);
