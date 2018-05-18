<?php
require_once DIR . "models/module_calendar.php";
$event = new Calendar($db);

if ( isset($_POST['cancel']) ) {
  $_SESSION['success'] = "Cancelled";
  header("Location: " . DIR_URL . "cms");
  return;
}

if ( isset($_POST["event_title"]) && isset($_POST["event_title_url"]) &&
    isset($_POST["event_description"]) && isset($_POST["event_link"]) &&
    isset($_POST["event_datetime"]) &&  isset($_POST["cat_id"]) &&
    isset($_POST["pageviews"]) && isset($_POST["is_active"]) &&
    isset($_POST["event_location"]) &&  isset($_POST["add"])
     )
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

      $event_id = $event->addEvent($event_datetime, $event_title, $event_title_url, $event_description, $event_location, $event_link, $cat_id, $is_active, $pageviews);

      if ( !$event_id || empty($event_id) )
      {
        $_SESSION["error"] = "Something bad happened";
        header("Location: " . DIR_URL . "cms/module_calendar");
        return;
      } else
      {
        $_SESSION["success"] = "Event Added";
        header("Location: " . DIR_URL . "cms/module_calendar");
        return;
      }

  }

  require_once DIR . "cms/views/header.php";
  require_once DIR . "cms/views/module_calendar/add.php";
  require_once DIR . "cms/views/footer.php";

?>