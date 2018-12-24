<?php

$r->addRoute('GET', '/', 'index page');
$r->addRoute('GET', '/articles', 'ArticleController@index');
$r->addRoute('GET', '/articles/{id:\d+}', 'ArticleController@show');
// $r->addRoute('GET', '/users', 'get_all_users_handler');
// // {id} must be a number (\d+)
// $r->addRoute('GET', '/user/{id:\d+}', 'get_user_handler');
// // The /{title} suffix is optional
// $r->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');