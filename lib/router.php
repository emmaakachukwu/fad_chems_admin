<?php

$is_local = getenv('HTTP_HOST') == '127.0.0.1' || getenv('HTTP_HOST') == 'localhost';
$request = trim($_SERVER['REQUEST_URI'], '/');
$request = $is_local ? implode('/', array_slice(explode('/', $request), 1)) : $request;
$route = explode('/', $request)[0];
$param = count(explode('/', $request)) > 1 ? explode('/', $request)[1] : '';

switch ($route) {
    case 'edit_product' :
        define('ID', $param);
        require __DIR__ . '/../edit_product.php';
        break;
    default:
        http_response_code(404);
        echo '404';
        break;
}