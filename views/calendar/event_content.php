<?php
/*
  Check format characters here: http://php.net/manual/en/datetime.createfromformat.php
*/
  $date = DateTime::createFromFormat('Y-m-d H:i:s', $event_content["event_datetime"])->format('M, d');
  $year = DateTime::createFromFormat('Y-m-d H:i:s', $event_content["event_datetime"])->format('Y');
  $time = DateTime::createFromFormat('Y-m-d H:i:s', $event_content["event_datetime"])->format('g:i a');
  $dow = DateTime::createFromFormat('Y-m-d H:i:s', $event_content["event_datetime"])->format('l');
?>

<h1 class="display-4"><?= $event_content["event_title"] ?></h1>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= DIR_URL ?>">Home</a></li>
    <li class="breadcrumb-item"><a href="<?= DIR_URL . "calendar" ?>">Calendar</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?= $event_content["event_title"] ?></li>
  </ol>
</nav>

<p>
  <b>Date:</b> <?= $date ?> <br />
  <b>Start time:</b> <?= $time ?> <br />
  <b>DOW:</b> <?= $dow ?> <br />
  <b>Year:</b> <?= $year ?> <br />
  <b>Location:</b> <a href="https://www.google.com/maps/search/?api=1&query=<?= urlencode($event_content["event_location"]) ?>" target="_blank"><?= $event_content["event_location"] ?></a>
</p>

<p>
  <b>Description:</b> <br />
	<?= nl2br($event_content["event_description"]) ?>
</p>

<p>
  More information <a href="<?= $event_content["event_link"] ?>" target="_blank">here</a>.
</p>

<p>
  <small>
    <i class="fas fa-eye fa-sm"></i>
    <?= $event_content["pageviews"] ?>
  </small>
</p>