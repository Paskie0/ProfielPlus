<?php
session_start();
//unset verwijderd de waarde van user_id en destroy eindigt de huidige session
unset($_SESSION["user_id"]);
session_destroy();
header('location: /');
