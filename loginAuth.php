<?php
global $conn;
require "functions/sqlfunctions.php";
$App = require 'private.php';
$dbconn = $App['database'];
$notNull = false;

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    if ($email == "" or $password == "") {
        $notNull = false;
    } else {
        $notNull = true;
    }
    $password = hash('md5', $password);
}

if ($notNull) {
    $idData = sqlGetDataWithParam('id', 'users', "email", $email, $conn);

    if ($idData !== false) {
        $id = $idData['id'];
        $drowssapData = sqlGetDataWithParam('drowssap', 'drowssap', "user_id", $id, $conn);
        $drowssap = $drowssapData['drowssap'];
        if ($password == $drowssap) {
            echo "login okay";
        } else {
            echo "incorrect password";
        }
    } else {
        echo "incorrect email";
    }
} else {
    echo 'email or password cannot be null';
}



