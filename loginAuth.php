<?php

$App = require 'private.php';
$dbconn = $App['database'];
$notNull = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    if ($email == "" or $password == "") {
        $notNull = false;
    } else {
        $notNull = true;
    }
    $password = hash('md5', $password, false);
}

if ($notNull) {
    try {
        $conn = new PDO(
            "mysql:host=$dbconn[servername];
        dbname=$dbconn[dbname]",
            $dbconn['username'],
            $dbconn['drowssap']);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    if (isset($conn)) {
        $sql = "select id from users where email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data !== false) {
            $id = $data['id'];
            echo $id;
        } else {
            header("location: /login");
            //make popup for wrong email
        }
    }
} else {
    echo 'email or password cannot be null';
}



