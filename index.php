<?php
$App = require 'private.php';
$dbconn = $App['database'];
global $conn;

try {
    $conn = new PDO(
        "mysql:host=$dbconn[servername];
        dbname=$dbconn[dbname]",
        $dbconn['username'],
        $dbconn['drowssap']);
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

function includeController($controller, $conn) {
    require $controller;
}

$routes = [
    '/' => 'controllers/index.php',
    '/account' => 'controllers/account.php',
    '/admin' => 'controllers/admin.php',
    '/portfolio' => 'controllers/portfolio.php',
    '/login' => 'controllers/login.php'
];

if (array_key_exists($_SERVER['REQUEST_URI'], $routes)) {
    includeController($routes[$_SERVER['REQUEST_URI']], $conn);
} else {
    http_response_code(404);
}