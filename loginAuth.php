<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    echo $email;
    $password = hash('md5', $password, false);
    echo    $password;
}

