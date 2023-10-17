<?php
$routes = [
    '/ProfielPlus' => 'controllers/index.php',
    '/ProfielPlus/account' => 'controllers/account.php',
    '/ProfielPlus/admin' => 'controllers/admin.php',
    '/ProfielPlus/portfolio' => 'controllers/portfolio.php'
];

if (array_key_exists($_SERVER['REQUEST_URI'], $routes)) {
    require $routes[$_SERVER['REQUEST_URI']];
} else {
    header("Location: /ProfielPlus");
}
