<?php
session_start();
//geeft de user geen toegang tot deze page tenzij de user ingelogd is
if (!empty($_SESSION["user_id"])) {
    require "views/updateProfile.view.php";
} else {
    header('location: /');
}
