<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

//region Login

$router->post('/login', 'UserController@login');

//endregion
//region Siswa

$router->get('/siswa-all', 'SiswaController@getSiswaAll');
$router->get('/siswa-by-user-id/{id}', 'SiswaController@getSiswaAll');

//endregion
//region Guru

$router->get('/guru-all', 'GuruController@getGuruAll');

//endregion
//region Pertanyaan

$router->get('/pertanyaan-all', 'PertanyaanController@getPertanyaanAll');

//endregion
//region Hasil

$router->get('/hasil-all', 'HasilController@getHasilAll');
$router->post('/hasil-jawaban-insert', 'HasilController@insertHasilJawaban');
$router->get('/hasil-by-siswa-id/{siswa_id}', 'HasilController@getHasilDetailSiswa');


//endregion

//region user
$router->put('/change-password/{id_user}', 'UserController@changePassword');

$router->get('/user-detail/{id_user}', 'UserController@getUserDetailById');
//endregion

//region Register

$router->post('/register', 'UserController@register');

//endregion

//region Update Foto

$router->post('/update-foto/{id_user}', 'UserController@uploadFoto');

//endregion

$router->put('/update-guru/{id_user}', 'GuruController@updateGuru');

$router->put('/update-siswa/{id_user}', 'SiswaController@updateSiswa');
