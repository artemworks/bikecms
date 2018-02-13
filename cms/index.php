<?php

require_once "../include/settings.php";

require_once "../models/db.php";
$database = new Database();
$db = $database->getConnection();

require_once "../models/user.php";
$user = new User($db);

session_start();

$user->restrictAccessToCMS();
require_once "../controllers/messages.php";
flashMessages();

require_once "./router.php";
    
?>