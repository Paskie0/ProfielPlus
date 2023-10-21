<?php

require "functions/sqlfunctions.php";
$conn = require "functions/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $first_name = $_POST["first_name"];
    $name = $_POST["name"];
    $password = $_POST["password"];
    $con_password = $_POST["con_password"];

    $emaildata = sqlGetDataWithParam('id', 'users', 'email', $email,$conn);
    if (empty($emaildata)) {
        echo "no dupe";
    } else {
        header('location: /signup');
    }

    if ($email == "" or $first_name == "" or $name == "" or $password == "") {
        header('location: /signup?');
    }

    $validPass = false;
    if (strlen($password) >= 8) {
        $validPass = true;
    } else {
        header('location: /signup');
    }
    if ($password == $con_password) {
        $sql = "insert into users(name, firstName, email)values (:name, :first_name,:email)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':email', $email);

        $stmt->execute();
        $data = sqlGetDataWithParam("id", "users", "email", $email, $conn);
        $id = $data['id'];

        $hashPass = hash('md5', $password);

        $sql = "insert into drowssap(user_id,drowssap)values (:user_id,:drowssap)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $id);
        $stmt->bindParam(':drowssap', $hashPass);
        $stmt->execute();
        echo "account created";
    }
}

