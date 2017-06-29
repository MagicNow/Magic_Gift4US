<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::any('/', ['as' => 'home','uses' => 'HomeController@index']);
Route::group(['prefix' => 'cadastro'], function() {
    Route::get('/', ['as' => 'cadastro.criar','uses' => 'RegisterController@create']);
    Route::post('/', ['as' => 'cadastro.gravar','uses' => 'RegisterController@store']);

    Route::post('login', ['as' => 'cadastro.login','uses' => 'RegisterController@cadastro']);
});

Route::group(['prefix' => 'usuario'], function() {
    Route::any('dados-bancarios', ['as' => 'usuario.dados-bancarios','uses' => 'HomeController@dados_bancarios']);
    Route::any('editar-dados', ['as' => 'usuario.editar-dados','uses' => 'HomeController@editar_dados']);
    Route::any('nova-senha', ['as' => 'usuario.nova-senha','uses' => 'HomeController@nova_senha']);
    Route::any('transferencia', ['as' => 'usuario.transferencia','uses' => 'HomeController@transferencia']);

    Route::group(['prefix' => 'meus-aniversarios'], function() {
        Route::any('/', ['as' => 'usuario.meus-aniversarios','uses' => 'HomeController@meus_aniversarios']);
        Route::any('novo', ['as' => 'usuario.meus-aniversarios.novo','uses' => 'HomeController@meus_aniversarios_novo']);
        Route::any('excluir/{id}', ['as' => 'usuario.meus-aniversarios.excluir','uses' => 'HomeController@meus_aniversarios_excluir']);
    });
});

Route::group(['prefix' => 'admin'], function() {
	Route::get('/', ['as'=> 'admin.index','uses' => 'Admin\AdminController@index']);
    Route::get('login', ['as'=> 'admin.login','uses' => 'Admin\AdminController@index']);
    Route::post('login', ['uses' => 'Admin\AdminController@login']);
    Route::post('password/reset', ['as'=> 'admin.password','uses' => 'Admin\AdminController@changePassword']);
    Route::get('logout', ['as'=> 'admin.logout','uses' => 'Admin\AdminController@logout']);

    //USERS
    Route::get('users', ['as'=> 'admin.users','uses' => 'Admin\UsersController@index']);
    Route::get('users/create', ['as'=> 'admin.users.create','uses' => 'Admin\UsersController@create']);
    Route::get('users/edit/{id}', ['as'=> 'admin.users.edit','uses' => 'Admin\UsersController@edit']);
	Route::get('users/destroy/{id}', ['as'=> 'admin.users.destroy','uses' => 'Admin\UsersController@destroy']);
    Route::post('users/store/{id?}', ['as'=> 'admin.users.store','uses' => 'Admin\UsersController@store']);
	
	//POSTS

    Route::get('produtos', ['as'=> 'admin.produtos','uses' => 'Admin\ProdutosController@index']);
    Route::get('produtos/status/{id}/{status}', ['as'=> 'admin.produtos.status','uses' => 'Admin\ProdutosController@status']);
});

Route::group(['prefix' => 'api'], function() {
    Route::get('/produtos', ['as'   => 'produtos','uses' => 'ApiController@produtos']);
});