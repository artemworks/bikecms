<?php

if( isset($name) ) {
	echo "<h1 class=\"display-4\">Event: <i>" . $name . "</i></h1>";
} else {
	echo "<h1 class=\"display-4\">Calendar of Events</h1>";
}
?>

<div class="container-fluid calendar-table">

<?php
foreach ($events as $event) {
	if ( $event["is_active"] ) {
		$date = DateTime::createFromFormat('Y-m-d H:i:s', $event["event_datetime"])->format('M d');
    $dow = DateTime::createFromFormat('Y-m-d H:i:s', $event["event_datetime"])->format('l');
    $googleCalendarLink = "https://calendar.google.com/calendar/render?action=TEMPLATE&text=" . htmlentities($event["event_title"]) .
    "&location=" . htmlentities($event["event_location"]) .
    "&details=" . htmlentities($event["event_description"]) . "+Added+from+ArtemWorks.com" .
    "&dates=" . htmlentities(strtoupper($event["event_datetime"])) .
    "&sf=true";
?>

<div class="row">
	<div class="col-md-1 col-sm-6 col-xs-6"><b><?= htmlentities(strtoupper($date)) ?></b></div>
  <div class="col-md-1 col-sm-6 col-xs-6"><b><?= htmlentities(strtoupper(substr($dow,0,3))) ?></b></div>
	<div class="col-md-5 col-sm-12 col-xs-12"><b><?= htmlentities($event["event_title"]) ?></b></div>
  <div class="col-md-3 col-sm-12 col-xs-12"><?= htmlentities($event["event_location"]) ?></div>
  <div class="col-md-1 col-sm-2 col-xs-2"><a class="btn btn-info" href="<?= DIR_URL . "calendar/" . htmlentities($event["event_title_url"]) ?>">Info</a></div>
  <div class="col-md-1 col-sm-2 col-xs-2"><a class="btn btn-danger" href="<?= $googleCalendarLink ?>" target="_blank"><i class="fas fa-calendar-alt"></i></a></div>
</div>

<?php
	}
}
?>

</div>