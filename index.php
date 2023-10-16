<?php
$basePath = '/ProfielPlus'; // Set your base path here
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$route = str_replace($basePath, '', $uri);

$routes = [
    $basePath . '/' => 'controllers/index.php',
    $basePath . '/account' => 'controllers/account.php',
    $basePath . '/admin' => 'controllers/admin.php',
    $basePath . '/portfolio' => 'controllers/portfolio.php'
];

if (array_key_exists($route, $routes)) {
    require $routes[$route];
} else {
    header("Location: $basePath/");
}
