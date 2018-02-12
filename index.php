<?php
require_once "./models/db.php";
$database = new Database();
$db = $database->getConnection();

require_once "./cms/include/pdo.php";
require_once "./cms/include/essentials.php";
require_once "./cms/include/functions.php";
session_start();
flashMessages();

require_once "./router.php";

?>