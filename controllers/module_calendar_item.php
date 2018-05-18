<?php

require_once "./models/section.php";
$section = new Section($db);
$sections = $section->readAll();

require_once "./models/module_calendar.php";
$event = new Calendar($db);
$event_content = $event->getEventByUrl(htmlentities(ltrim($action, '/')));

require_once "./include/utilities.php";
$utility = new Utility($db);

if ($event_content)
{

	$viewsCounter = $event_content["pageviews"] + 1;
	$event->count_views($viewsCounter, $event_content["event_id"]);

	require_once "./views/header.php";

	require_once "./views/calendar/event_content.php";

	require_once "./views/footer.php";
}
else
{
	$utility->redirect_to( DIR_URL . "404" );
}
?>