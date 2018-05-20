<?php

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', '1');

$home_url = "http://localhost:8005/git/bikecms/api/v1/";

$page = isset($_GET['page']) ? $_GET['page'] : 1;

// paging
$obj_per_page = 10;
$from_record_num = ($obj_per_page * $page) - $obj_per_page;

?>