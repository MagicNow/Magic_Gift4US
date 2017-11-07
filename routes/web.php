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

Route::get('cadastro/confirmar-dados', ['as' => 'usuario.confirma', 'uses' => 'RegisterController@confirmar']);
Route::resource('cadastro/dados-bancarios', 'BankController');
Route::resource('cadastro', 'RegisterController');

Route::group(['prefix' => 'usuario'], function() {
    Route::get('nova-senha/recuperar', ['as' => 'usuario.nova-senha.recuperar.show','uses' => 'PasswordRecoveryController@show']);
    Route::post('nova-senha/recuperar', ['as' => 'usuario.nova-senha.recuperar.update','uses' => 'PasswordRecoveryController@update']);
    Route::resource('nova-senha', 'PasswordController');
    Route::get('logout', ['as' => 'usuario.logout','uses' => 'RegisterController@logout']);
    Route::post('login', ['as' => 'usuario.login','uses' => 'RegisterController@login']);

    Route::resource('transferencia', 'TransferController');

    Route::group(['prefix' => 'meus-aniversarios'], function() {
        Route::get('/', ['as' => 'usuario.meus-aniversarios','uses' => 'BirthdayController@index']);
        Route::get('/{festa?}', ['as' => 'usuario.meus-aniversarios.editar','uses' => 'BirthdayController@edit'])->where(['festa' => '[0-9]+']);

        Route::get('novo/{number?}', ['as' => 'usuario.meus-aniversarios.novo','uses' => 'BirthdayController@create'])->where(['number' => '[0-9]+']);
        Route::get('festa/{festa_id?}/passo/{passo?}', ['as' => 'usuario.meus-aniversarios.novo.festa','uses' => 'BirthdayController@create'])->where(['passo' => '[0-9]+', 'festa_id' => '[0-9]+']);
        Route::post('novo/{passo?}', ['as' => 'usuario.meus-aniversarios.store','uses' => 'BirthdayController@store']);
        Route::post('upload', ['as' => 'usuario.meus-aniversarios.upload','uses' => 'BirthdayController@upload']);
        Route::get('excluir/{id}', ['as' => 'usuario.meus-aniversarios.excluir','uses' => 'BirthdayController@aviso'])->where(['id' => '[0-9]+']);
        Route::post('excluir/{id}', ['as' => 'usuario.meus-aniversarios.excluir-post','uses' => 'BirthdayController@destroy'])->where(['id' => '[0-9]+']);
        Route::get('festa/{festa_id}/preview/{layout_id}', ['as' => 'usuario.meus-aniversarios.preview','uses' => 'GiftsController@preview'])->where(['festa_id' => '[0-9]+', 'layout_id' => '[0-9]+']);

        /** ROUPAS **/
        Route::get('festa/{festa_id?}/presentes/roupas', ['as' => 'usuario.meus-aniversarios.presentes.roupas','uses' => 'GiftsController@index'])->where(['festa_id' => '[0-9]+']);

        /** BRINQUEDOS **/
        Route::get('festa/{festa_id?}/presentes/brinquedos', ['as' => 'usuario.meus-aniversarios.presentes.brinquedos','uses' => 'GiftsController@toys'])->where(['festa_id' => '[0-9]+']);
        Route::get('festa/{festa_id?}/presentes/brinquedos/adicionar', ['as' => 'usuario.meus-aniversarios.presentes.brinquedos.adicionar','uses' => 'GiftsController@toysAdd'])->where(['festa_id' => '[0-9]+']);
        Route::get('festa/{festa_id?}/presentes/brinquedos/lista', ['as' => 'usuario.meus-aniversarios.presentes.brinquedos.lista','uses' => 'GiftsController@toysList'])->where(['festa_id' => '[0-9]+']);
        Route::get('festa/{festa_id?}/presentes/brinquedos/{brinquedo_id?}/detalhe', ['as' => 'usuario.meus-aniversarios.presentes.brinquedos.detalhe','uses' => 'GiftsController@toysDetail'])->where(['festa_id' => '[0-9]+', 'brinquedo_id' => '[0-9]+']);
        Route::post('festa/{festa_id?}/presentes/brinquedos/adicionar', ['as' => 'usuario.meus-aniversarios.presentes.brinquedos.submeter','uses' => 'GiftsController@toysStore']);

        /** COTAS **/
        Route::get('festa/{festa_id?}/presentes/cotas', ['as' => 'usuario.meus-aniversarios.presentes.cotas','uses' => 'GiftsController@quotas'])->where(['festa_id' => '[0-9]+']);
        Route::get('festa/{festa_id?}/presentes/cotas/adicionar', ['as'=> 'usuario.meus-aniversarios.presentes.cotas.adicionar', 'uses' => 'GiftsController@quotasAdd']);
        Route::post('festa/{festa_id?}/presentes/cotas/adicionar', ['as' => 'usuario.meus-aniversarios.presentes.cotas.submeter','uses' => 'GiftsController@quotasStore']);
        Route::get('festa/{festa_id?}/presentes/cotas/{cota_id}/detalhe', ['as'=> 'usuario.meus-aniversarios.presentes.cotas.detalhe', 'uses' => 'GiftsController@quotasDetail']);

        // Route::get('festa/{festa_id?}/presentes/cotas/criar-ecommerce', ['as'=> 'convidado.brinquedos.criarEcommerce', 'uses' => 'ToysController@criarEcommerce']);
    });
});

Route::group(['prefix' => 'notificacoes'], function() {
    Route::get('aniversario', ['as'=> 'notificacoes.aniversario', 'uses' => 'NotificationsController@aniversario']);
    Route::get('convite-digital', ['as'=> 'notificacoes.convitedigital', 'uses' => 'NotificationsController@conviteDigital']);
    Route::get('enviar-email', ['as'=> 'notificacoes.enviaremail', 'uses' => 'NotificationsController@enviarEmail']);
    Route::get('enviar-convite', ['as'=> 'notificacoes.enviarconvite', 'uses' => 'NotificationsController@enviarConvite']);

    Route::group(['prefix' => 'imprimir'], function() {
        Route::get('convite', ['as'=> 'notificacoes.impimir.convite', 'uses' => 'NotificationsController@imprimirConvite']);
        Route::get('lista-presentes', ['as'=> 'notificacoes.impimir.listaPresentes', 'uses' => 'NotificationsController@imprimirListaPresentes']);
        Route::get('presencas-confirmadas', ['as'=> 'notificacoes.impimir.presencas', 'uses' => 'NotificationsController@imprimirPresencas']);
    });
});

Route::group(['prefix' => 'convidado', 'namespace' => 'Guest'], function() {
    Route::post('login', ['as'=> 'convidado.login', 'uses' => 'HomeController@login']);
    Route::post('{festa_id}/confirmar-presenca', ['as'=> 'convidado.confirmar-presenca', 'uses' => 'HomeController@confirmarPresenca'])->where(['festa_id' => '[0-9]+']);
    Route::get('{festa_id}', ['as'=> 'convidado.index', 'uses' => 'HomeController@index'])->where(['festa_id' => '[
        0-9]+']);

    /** BRINQUEDOS */
    Route::group(['prefix' => '{festa_id}/brinquedos'], function () {
        Route::get('/', ['as'=> 'convidado.brinquedos.index', 'uses' => 'ToysController@index']);
        Route::get('compra-online/{product_id}', ['as'=> 'convidado.brinquedos.compraOnline', 'uses' => 'ToysController@compraOnline']);
        Route::get('detalhe/{produto_id}', ['as'=> 'convidado.brinquedos.detalhe', 'uses' => 'ToysController@detalhe']);
        Route::get('reserva/{produto_id}', ['as'=> 'convidado.brinquedos.reserva', 'uses' => 'ToysController@reserva']);
    });

    Route::group(['prefix' => '{festa_id}/cotas'], function () {
        Route::get('/', ['as'=> 'convidado.cotas.index', 'uses' => 'QuotasController@index']);
        Route::get('detalhe', ['as'=> 'convidado.cotas.detalhe', 'uses' => 'QuotasController@detalhe']);
        Route::get('mensagem', ['as'=> 'convidado.cotas.mensagem', 'uses' => 'QuotasController@mensagem']);
    });

    Route::group(['prefix' => '{festa_id}/roupas'], function () {
        Route::get('/', ['as'=> 'convidado.roupas.index', 'uses' => 'ClothesController@index']);
        Route::get('mensagem/{produto_id}', ['as'=> 'convidado.roupas.mensagem', 'uses' => 'ClothesController@mensagem']);
        Route::get('detalhe/{produto_id}', ['as'=> 'convidado.roupas.detalhe', 'uses' => 'ClothesController@detalhe']);
        Route::get('compra-online/{product_id}', ['as'=> 'convidado.roupas.compraOnline', 'uses' => 'ClothesController@compraOnline']);
    });
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
	Route::get('/', ['as'=> 'admin.index','uses' => 'AdminController@index']);
    Route::get('login', ['as'=> 'admin.login','uses' => 'AdminController@index']);
    Route::post('login', ['uses' => 'AdminController@login']);
    Route::post('password/reset', ['as'=> 'admin.password','uses' => 'AdminController@changePassword']);
    Route::get('logout', ['as'=> 'admin.logout','uses' => 'AdminController@logout']);

    //USERS
    Route::get('users', ['as'=> 'admin.users','uses' => 'UsersController@index']);
    Route::get('users/create', ['as'=> 'admin.users.create','uses' => 'UsersController@create']);
    Route::get('users/edit/{id}', ['as'=> 'admin.users.edit','uses' => 'UsersController@edit']);
	Route::get('users/destroy/{id}', ['as'=> 'admin.users.destroy','uses' => 'UsersController@destroy']);
    Route::post('users/store/{id?}', ['as'=> 'admin.users.store','uses' => 'UsersController@store']);
	
	//POSTS

    Route::get('produtos/status/{id}/{status}', ['as'=> 'admin.products.status', 'uses' => 'ProductsController@status']);

    Route::resource('produtos', 'ProductsController', [
        'names' => [
            'index'   => 'admin.products.index',
            'create'  => 'admin.products.create',
            'store'   => 'admin.products.store',
            'show'    => 'admin.products.show',
            'edit'    => 'admin.products.edit',
            'update'  => 'admin.products.update',
            'destroy' => 'admin.products.destroy'
        ]
    ]);
});