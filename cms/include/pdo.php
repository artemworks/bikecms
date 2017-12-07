<?php

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=bikecms;charset=utf8', 'bikecms', 'bikecms');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>