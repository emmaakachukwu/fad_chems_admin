<?php

$is_local = getenv('HTTP_HOST') == '127.0.0.1' || getenv('HTTP_HOST') == 'localhost';
$request = trim($_SERVER['REQUEST_URI'], '/');
$request = $is_local ? implode('/', array_slice(explode('/', $request), 1)) : $request;

switch ($request) {
    case '' :
        require __DIR__ . '/../index.php';
        break;
    case 'dashboard' :
        require __DIR__ . '/../dashboard.php';
        break;
    case 'products' :
        require __DIR__ . '/../products.php';
        break;
    default:
        // http_response_code(404);
        echo '404';
        break;
}