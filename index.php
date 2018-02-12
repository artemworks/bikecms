<?php

require_once "./include/settings.php";

require_once "./models/db.php";
$database = new Database();
$db = $database->getConnection();

session_start();

require_once "./controllers/messages.php";
flashMessages();

require_once "./router.php";

?>