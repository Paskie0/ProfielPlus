<?php
$conn = require 'functions/connection.php';
require 'functions/sqlfunctions.php';
session_start();
// GET & SESSION zijn global variables die een array returnen en overal beschikbaar zijn
$table = $_GET['table'];
$id = $_GET['id'];
$user_id = $_SESSION['user_id'];
// sqlDelete is gedefinieerd in sqlfunctions en verwijdert de meegegeven waardes uit de db
sqlDelete($table, $id, $user_id, $conn);
// stuurt de user terug naar de edit page
header('location: /updateprofile');
