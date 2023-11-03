<?php

$App = require 'private.php';
$dbconn = $App['database'];
global $conn;

try {
    $conn = new PDO(
        "mysql:host=$dbconn[servername];
        dbname=$dbconn[dbname]",
        $dbconn['username'],
        $dbconn['drowssap']
    );
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
//get data from database

//if (isset($conn)) {
//    $sql = 'select name from users where id = 1';
//    $stmt = $conn->prepare($sql);
//    $stmt->execute();
//    $data =$stmt->fetchAll(PDO::FETCH_ASSOC);
//    $name = $data[0]['name'];
//    echo $name;
//} else {
//    echo "Database connection not available.";
//}

function includeController($controller, $conn)
{
    require $controller;
}

$baseDirectory = '/ProfielPlus';

if ($_SERVER['SERVER_NAME'] === 'localhost') {
    $baseDirectory = '';
}

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
