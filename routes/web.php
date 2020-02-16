<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// API User route group
$router->group(['prefix' => 'api'], function () use ($router) {
    // Matches /api
    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');
    $router->get('profile', 'UserController@profile');
    $router->get('users/{id}', 'UserController@singleUser');
    $router->get('users', 'UserController@allUsers');

    // Mengajukan gadai Perhiasan
    $router->post('pengajuan', 'PengajuanController@pengajuanPerhiasan');
    $router->get('pengajuan_phs_unconfirmed', 'PengajuanController@getPengajuanPerhiasanUnconfirmed');
    $router->get('status_pengajuan', 'PengajuanController@getStatusPengajuan');
});

// API penaksir route group
$router->group(['prefix' => 'api/penaksir'], function () use ($router) {
    // Matches /api/penaksir
    $router->post('register', 'AuthController@registerPenaksir');
    $router->post('login', 'AuthController@loginPenaksir');
    $router->get('profile', 'UserPenaksirController@profile');
    $router->get('users/{id}', 'UserPenaksirController@singleUser');
    $router->get('users', 'UserPenaksirController@allUsers');

    // Konfirmasi gadai perhiasan untuk user penaksir
    $router->post('konfrmasi_pengajuan', 'PengajuanController@konfirmasiPengajuan');
    $router->post('konfrmasi_menuju_lokasi', 'PengajuanController@konfirmasiMenujuLokasi');
    $router->post('konfrmasi_tiba', 'PengajuanController@konfirmasiPenaksirTiba');
});
