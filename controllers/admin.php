<?php
$conn = require 'functions/connection.php';
require 'functions/sqlfunctions.php';

session_start();
// alleen de admin user mag naar deze page
if ($_SESSION['user_id'] != 1) {
    header('location: /portfolio');
}
//haal user data op uit de db
try {
    $sql = "SELECT id, name, firstName FROM users";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $userData = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "PDO Error: " . $e->getMessage();
}

require 'views/admin.view.php';
