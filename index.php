<?php

$App = require 'private.php';
$dbconn = $App['database'];
global $conn;



function includeController($controller, $conn)
{
    require $controller;
}

$baseDirectory = '/ProfielPlus';

if ($_SERVER['SERVER_NAME'] === 'localhost') {
    $baseDirectory = '';
}
/**hier gebeurd onze routing. we hebben hier een $baseDirectory zodat wanneer het project op een ander domain wordt
 *gezet is het erg simpel
 */
$routes = [
    $baseDirectory . '/' => 'controllers/index.php',
    $baseDirectory . '/account' => 'controllers/account.php',
    $baseDirectory . '/admin' => 'controllers/admin.php',
    $baseDirectory . '/portfolio' => 'controllers/portfolio.php',
    $baseDirectory . '/login' => 'controllers/login.php',
    $baseDirectory . '/signup' => 'controllers/signup.php',
    $baseDirectory . '/updateprofile' => 'controllers/updateProfile.php'
];
//find whatever is after /user/ and put it inside a variable
if (preg_match('#^' . $baseDirectory . '/user/(\d+)$#', $_SERVER['REQUEST_URI'], $matches)) {
    $user_id = $matches[1];
    includeController('controllers/portfolio.php', $conn);
} elseif (array_key_exists($_SERVER['REQUEST_URI'], $routes)) {
    includeController($routes[$_SERVER['REQUEST_URI']], $conn);
} else {
    http_response_code(404);
}
