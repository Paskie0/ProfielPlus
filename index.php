<?php
$routes = [
    '/' => 'controllers/index.php',
    '/account' => '/controllers/account.php',
    '/admin' => '/controllers/admin.php',
    '/portfolio' => '/controllers/portfolio.php'
];

if (array_key_exists($_SERVER['REQUEST_URI'], $routes)) {
    require $routes[$_SERVER['REQUEST_URI']];
} else {
    http_response_code(404);
}
