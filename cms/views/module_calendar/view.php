<h1 class="display-4">Calendar of Events</h1>

<form method="POST">

  <table class='table'>

  <tr>

    <th><input class="form-check-input" name="event_id" type="checkbox" value="all"></th>
    <th>ID</th>
    <th>Title</th>
    <th>Place</th>
    <th>Day</th>
    <th>Status</th>

  </tr>


  <?php

    foreach ($events as $event) {

      $date = DateTime::createFromFormat('Y-m-d H:i:s', $event["event_datetime"])->format('M, d Y');

      $event["is_active"] ? $status = "Active" : $status = "Not Active";

  ?>

  <tr>

    <td><input class="form-check-input" name="event_id" type="checkbox" value="<?= htmlentities($event["event_id"]) ?>"></td>
    <td><?= htmlentities($event["event_id"]) ?></td>
    <td><a href="<?= DIR_URL . "cms/module_calendar/edit/" . htmlentities($event["event_id"]) ?>"><?= htmlentities($event["event_title"]) ?></a></td>
    <td><?= htmlentities($event["event_location"]) ?></td>
    <td><?= htmlentities($date) ?></td>
    <td><?= htmlentities($status) ?></td>

  </tr>

  <?php } ?>

  </table>

  <button type="submit" class="btn btn-outline-danger" name="delete">Delete</button>&nbsp;
  <button type="submit" class="btn btn-outline-secondary" name="cancel">Cancel</button>

</form>