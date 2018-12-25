<?php

$r->addRoute('GET', '/', 'index page');
$r->addRoute('POST', '/register', 'RegisterController@create');
$r->addRoute('POST', '/login', 'LoginController@auth');
$r->addRoute('GET', '/articles', 'ArticleController@index');
$r->addRoute('GET', '/articles/{id:\d+}', 'ArticleController@show');
$r->addRoute('POST', '/articles/create', 'ArticleController@create');
$r->addRoute('PUT', '/articles/update/{id:\d+}', 'ArticleController@update');
$r->addRoute('PUT', '/articles/delete/{id:\d+}', 'ArticleController@delete');