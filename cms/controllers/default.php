<?php

require_once DIR . "include/utilities.php";
$utility = new Utility($db);
$utility->redirect_to( DIR_URL . "404" );

?>