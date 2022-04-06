<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

//region Login

$router->post('/login', 'UserController@login');

//endregion
//region register


//endregion
//region MasterJabatanFungsional

$router->get('/get-master-jabatan-fungsional-all', 'MasterJabatanFungsionalController@getAll');
$router->get('/get-master-jabatan-fungsional-by', 'MasterJabatanFungsionalController@getBy');

//endregion
//region MasterJabatanStruktural

$router->get('/get-master-jabatan-struktural-all', 'MasterJabatanStrukturalController@getAll');
$router->get('/get-master-jabatan-struktural-by', 'MasterJabatanStrukturalController@getBy');

//endregion
//region MasterJenisTenaga

$router->get('/get-master-jenis-tenaga-all', 'MasterJenisTenagaController@getAll');
$router->get('/get-master-jenis-tenaga-by', 'MasterJenisTenagaController@getBy');

//endregion
//region MasterPangkatGolongan

$router->get('/get-master-pangkat-golongan-all', 'MasterPangkatGolonganController@getAll');
$router->get('/get-master-pangkat-golongan-by', 'MasterPangkatGolonganController@getBy');


//endregion
//region MasterPnsNonPns

//endregion
//region MasterStatusAbsensi

//endregion
//region MasterUnitKerja


//endregion
//region Pegawai

//endregion
//region Absensi

//endregion
