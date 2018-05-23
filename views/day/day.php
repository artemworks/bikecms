<p>
  Today is <?= $today ?>
</p>

<?php

if ( empty($articles_td) && empty($events_td) && empty($trans_td) )

{
  echo "<p>Sorry, no data for this day.</p>";
}

if ( !empty($articles_td) ) {

  echo "<h2>Articles:</h2>";

  foreach ($articles_td as $a) {

    if ( $a["is_active"] ) {

      echo "<p><a href=" . DIR_URL . "articles/" .
            htmlentities($a["title_url"]) . ">" .
            htmlentities($a["title"]) . "</a></p>";

    }

  }

}

if ( !empty($events_td) ) {

  echo "<h2>Events:</h2>";

  foreach ($events_td as $e) {

    if ( $e["is_active"] ) {

      echo "<p><a href=" . DIR_URL . "event/" .
            htmlentities($e["event_title_url"]) . ">" .
            htmlentities($e["event_title"]) . "</a></p>";

    }

  }

}

if ( !empty($trans_td) ) {

  echo "<h2>Purchases:</h2>";

  foreach ($trans_td as $t) {

    if ( $t["is_active"] ) {

      echo "<p>" .
            htmlentities($t["store"]) .
            " $" . htmlentities($t["amount"]) .
            "</a></p>";

    }

  }

}

?>