<?php
require_once "./include/pdo.php";
require_once "./include/essentials.php";
require_once "./include/functions.php";
session_start();
restrictAccessCMS();

flashMessages();
require_once "../header.php";
echo "Hello";
require_once "../footer.php";

?>