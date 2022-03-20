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


//endregion
