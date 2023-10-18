<?php
$baseDirectory = '/ProfielPlus';

if ($_SERVER['SERVER_NAME'] === 'localhost') {
    $baseDirectory = '';
}

$routes = [
    $baseDirectory . '/' => 'controllers/index.php',
    $baseDirectory . '/account' => 'controllers/account.php',
    $baseDirectory . '/admin' => 'controllers/admin.php',
    $baseDirectory . '/portfolio' => 'controllers/portfolio.php'
];

if (array_key_exists($_SERVER['REQUEST_URI'], $routes)) {
    require $routes[$_SERVER['REQUEST_URI']];
} else {
    echo $_SERVER['REQUEST_URI'];
}
