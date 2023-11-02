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
        echo "<script>alert('Email is already taken')</script>";
        echo "<script>window.location = '/signup'</script>";
    }

    if ($email == "" or $first_name == "" or $name == "" or $password == "") {
        echo "<script>alert('Fields cannot be empty')</script>";
        echo "<script>window.location = '/signup'</script>";
    }

    $validPass = false;
    if (strlen($password) >= 8) {
        $validPass = true;
    } else {
        echo "<script>alert('Password must be at least 8 characters')</script>";
        echo "<script>window.location = '/signup'</script>";
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
        //account created
        session_start();
        $_SESSION['user_id'] = $id;
        //create Profile

        sqlInsertIntoValues('profile', 'user_id',$id, $conn);

    }
}

