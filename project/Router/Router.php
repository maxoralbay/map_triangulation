<?php
//$router->get('/user', 'user@index');
//$router->get('/user/product', 'user@product');
//$router->post('/product/:client_id', 'user@postProduct');
////delete product
//$router->delete('/product/{client_id}/{product_id}', 'user@deleteProduct');

$router->get('/', 'triangulation@index');
$router->post('/api/calculate', 'triangulation@calculate');
