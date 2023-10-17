<?php
$routes = [
    '/ProfielPlus' => '/ProfielPlus/controllers/index.php',
    '/ProfielPlus/account' => '/ProfielPlus/controllers/account.php',
    '/ProfielPlus/admin' => '/ProfielPlus/controllers/admin.php',
    '/ProfielPlus/portfolio' => '/ProfielPlus/controllers/portfolio.php'
];

if (array_key_exists($_SERVER['REQUEST_URI'], $routes)) {
    require $routes[$_SERVER['REQUEST_URI']];
} else {
    header("Location: /ProfielPlus");
}
