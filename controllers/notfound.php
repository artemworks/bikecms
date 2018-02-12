<?php

require_once "./models/section.php";
$section = new Section($db);
$sections = $section->readAll();

require_once "./views/header.php";
require_once "./views/notfound.php";
require_once "./views/footer.php";

?>