<?php

require_once "./models/section.php";
$section = new Section($db);
$sections = $section->readAll();

require_once "./models/module_calendar.php";
$event = new Calendar($db);
$events = $event->readAll();

require_once "./views/header.php";
require_once "./views/calendar/events.php";
require_once "./views/footer.php";
?>