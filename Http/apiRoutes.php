<?php

use Illuminate\Routing\Router;

/** @var $router Router */
Route::prefix('/translation')->middleware('api.token')->group(function (Router $router) {
    $router->post('update', [
        'uses' => 'TranslationController@update',
        'as' => 'api.translation.translations.update',
        'middleware' => 'token-can:translation.translations.edit',
    ]);
    $router->post('clearCache', [
        'uses' => 'TranslationController@clearCache',
        'as' => 'api.translation.translations.clearCache',
    ]);
    $router->post('revisions', [
        'uses' => 'TranslationController@revisions',
        'as' => 'api.translation.translations.revisions',
    ]);
//    $router->get('/', [
//        'uses' => 'AllTranslationController',
//        'as' => 'api.translation.translations.all',
//    ]);
    $router->get('list-locales-for-select', [
        'uses' => 'LocaleController@listLocalesForSelect',
        'as' => 'api.translation.translations.list-locales-for-select',
    ]);
});
Route::prefix('/translation/v2/translations')->group(function (Router $router) {
    /* get new routing */
    $router->get('/', [
        'uses' => 'AllTranslationApiController@index',
        'as' => 'api.translation.v2.translations.all',
    ]);
    $router->post('clearCache', [
        'uses' => 'TranslationApiController@clearCache',
        'as' => 'api.translation.v2.translations.clearCache',
        'middleware' => ['auth:api'],
    ]);
    $router->get('/{criteria}', [
        'uses' => 'TranslationApiController@show',
        'as' => 'api.translation.v2.translations.show',
    ]);
    $router->put('/{criteria}', [
        'uses' => 'TranslationApiController@update',
        'as' => 'api.translation.v2.translations.update',
        'middleware' => ['auth:api'],
    ]);
    $router->post('/', [
        'uses' => 'TranslationApiController@create',
        'as' => 'api.translation.v2.translations.create',
        'middleware' => ['auth:api'],
    ]);
    $router->delete('/{criteria}', [
        'uses' => 'TranslationApiController@delete',
        'as' => 'api.translation.v2.translations.delete',
        'middleware' => ['auth:api'],
    ]);
});
