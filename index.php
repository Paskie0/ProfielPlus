<?php
$routes = [
    '/' => '/ProfielPlus/controllers/index.php',
    '/account' => '/ProfielPlus/controllers/account.php',
    '/admin' => '/ProfielPlus/controllers/admin.php',
    '/portfolio' => '/ProfielPlus/controllers/portfolio.php'
];

if (array_key_exists($_SERVER['REQUEST_URI'], $routes)) {
    require $routes[$_SERVER['REQUEST_URI']];
} else {
    http_response_code(404);
}
