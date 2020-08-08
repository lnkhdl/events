<?php
$routes->saveGetRoutes('/', 'PageController@index');
$routes->saveGetRoutes('/index', 'PageController@index');
$routes->saveGetRoutes('/event/{id}', 'EventController@show');
$routes->saveGetRoutes('/event/{name}/{name}', 'EventController@test');
$routes->saveGetRoutes('/event/{name}/{id}/{name}', 'EventController@test2');

$routes->savePostRoutes('/event/{id}', 'EventController@edit');