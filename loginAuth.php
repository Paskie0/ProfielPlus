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

            header('location: /portfolio');
        } else {
            echo "<script>alert('Incorrect password')</script>";
            echo "<script>window.location = '/login'</script>";
        }
    } else {
        echo "<script>alert('Incorrect email')</script>";
        echo "<script>window.location = '/login'</script>";
    }
} else {
    echo "<script>alert('Email or password cannot be empty')</script>";
    echo "<script>window.location = '/login'</script>";
}



