<?php
require "functions/sqlfunctions.php";
$conn = require "functions/connection.php";

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
            session_start();
            $_SESSION['user_id'] = $id;
            $_SESSION['loggedIn'] = true;
//            echo "login okay. id is: " . $_SESSION["user_id"];
            header('location: /updateprofile');
        } else {
            echo "incorrect password";
        }
    } else {
        echo "incorrect email";
    }
} else {
    echo 'email or password cannot be null';
}



