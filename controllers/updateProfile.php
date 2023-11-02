<?php
session_start();
if (!empty($_SESSION["user_id"])) {
    require "views/updateProfile.view.php";
}else{
    header('location: /');
}