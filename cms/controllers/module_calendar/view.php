<?php

require_once DIR . "models/module_calendar.php";
$event = new Calendar($db);
$events = $event->readAllSortedByDate();

if ( isset($_POST['cancel']) ) {
  $_SESSION['success'] = "Cancelled";
  header("Location: " . DIR_URL . "cms");
  return;
}

if ( isset($_POST['event_id']) && isset($_POST['delete'])) {
    header("Location: " . DIR_URL . "cms/module_calendar/delete/" . $_POST['event_id']);
    return;
}

  require_once DIR . "cms/views/header.php";
  require_once DIR . "cms/views/module_calendar/view.php";
  require_once DIR . "views/footer.php";

?>