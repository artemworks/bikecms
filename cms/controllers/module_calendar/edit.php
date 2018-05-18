<?php

require_once DIR . "models/module_calendar.php";
$event = new Calendar($db);
$eventContent = $event->getEventById($action_id);

if ( isset($_POST['cancel']) ) {
  $_SESSION['success'] = "Cancelled";
  header("Location: " . DIR_URL . "cms");
  return;
}

if ( isset($_POST["event_datetime"]) && isset($_POST["event_title"]) &&
    isset($_POST["event_title_url"]) && isset($_POST["event_description"]) &&
    isset($_POST["event_location"]) && isset($_POST["event_link"]) &&
    isset($_POST["cat_id"]) && isset($_POST["is_active"]) &&
    isset($_POST["pageviews"]) )
{

    $event_datetime = $_POST["event_datetime"];
    $event_title = $_POST["event_title"];
    $event_title_url = $_POST["event_title_url"];
    $event_description = $_POST["event_description"];
    $event_location = $_POST["event_location"];
    $event_link = $_POST["event_link"];
    $cat_id = $_POST["cat_id"];
    $is_active = $_POST["is_active"];
    $pageviews = $_POST["pageviews"];


  $result = $event->updateEvent($event_datetime, $event_title, $event_title_url, $event_description, $event_location, $event_link, $cat_id, $is_active, $pageviews, $action_id);

  if ( $result )
  {
    $_SESSION['success'] = "Event updated";
    header("Location: " . DIR_URL . "cms/module_calendar");
  }
  else
  {
    $_SESSION['error'] = "Event not updated";
    header("Location: " . DIR_URL . "cms/module_calendar");
  }

}

require_once DIR . "cms/views/header.php";
require_once DIR . "cms/views/module_calendar/edit.php";
require_once DIR . "cms/views/footer.php";

?>