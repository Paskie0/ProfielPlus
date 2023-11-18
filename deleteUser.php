<?php
$conn = require 'functions/connection.php';
require 'functions/sqlfunctions.php';

session_start();
// delete user waar de user_id gelijk is aan die van de form in admin.php
$selectedUser =  $_POST['userId'];
$sql = "delete from users where id = $selectedUser";
$stmt = $conn->prepare($sql);
$stmt->execute();

header('location: /admin');
