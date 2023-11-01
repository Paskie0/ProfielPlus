<?php
$conn = require 'functions/connection.php';
require 'functions/sqlfunctions.php';
session_start();
$table = $_GET['table'];
$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

sqlDelete($table,$id,$user_id,$conn);
header('location: /updateprofile');