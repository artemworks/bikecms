<?php

require_once DIR . "models/module_calendar.php";
$event = new Calendar($db);
$event_content = $event->getEventById($action_id);

if ( isset($_POST['cancel']) ) {
  $_SESSION['success'] = "Cancelled";
  header("Location: " . DIR_URL . "cms");
  return;
}

if ( isset($_POST["delete"]) &&
     isset($_POST["event_id"]) )
{

  $event_id = htmlentities($_POST["event_id"]);
  $result = $event->delEvent($event_id);

  if ( $result )
  {
    $_SESSION['success'] = "Event deleted";
    header("Location: " . DIR_URL . "cms/module_calendar");
  }
  else
  {
    $_SESSION['error'] = "Event not deleted";
    header("Location: " . DIR_URL . "cms/module_calendar");
  }

}

require_once DIR . "cms/views/header.php";
require_once DIR . "cms/views/module_calendar/delete.php";
require_once DIR . "cms/views/footer.php";

?>