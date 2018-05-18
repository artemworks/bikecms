<?php

if( isset($name) ) {
	echo "<h1 class=\"display-4\">Event: <i>" . $name . "</i></h1>";
} else {
	echo "<h1 class=\"display-4\">Calendar of Events</h1>";
}

foreach ($events as $event) {
	if ( $event["is_active"] ) {
		$date = DateTime::createFromFormat('Y-m-d H:i:s', $event["event_datetime"])->format('M, d Y');
?>

<p>
	<?= htmlentities($date) ?>
	<a href="<?= DIR_URL . "calendar/" . htmlentities($event["event_title_url"]) ?>">
		<?= htmlentities($event["event_title"]) ?>
	</a>
</p>

<?php
	}
}
?>