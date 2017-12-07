<?php

$article = getArticleById($article_id);

if (!empty($article)) {

      echo "<h1 class=\"display-4\">Edit Article <b>" . $article["title"] . "</b></h1>";

      echo '
        <form method="POST">
        <div class="form-row">
          <div class="form-group col-md-10">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="' . $article["title"] . '">

            <label for="title">Title URL</label>
            <input type="text" name="title_url" class="form-control" value="' . $article["title_url"] . '">

            <label for="title">Description</label>
            <input type="text" name="description" class="form-control" value="' . $article["description"] . '">

            <label for="body">Body</label>
            <textarea class="form-control" type="text" name="body" rows="7">' . $article["body"] . '</textarea>
          </div>

          <div class="form-group col-md-2">

            <label for="datePosted">Date posted</label>
            <input type="text" class="form-control" name="posted" value="' . $article["posted"] . '">

            <label for="dateArchived">Archiving Date</label>
            <input type="text" class="form-control" name="archiving" value="' . $article["archiving"] . '">

            <br>
            <label for="is_active">Is active?</label>
            <div class="form-group">
              <div class="form-check form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="is_active" id="inlineRadio1" value="1"';
					    if ( $article["is_active"] ) { echo " checked"; }
					    echo '> Yes 
                </label>
              </div>
              <div class="form-check form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="is_active" id="inlineRadio2" value="0"';
					    if ( !$article["is_active"] ) { echo " checked"; }
					    echo '> No 
                </label>
              </div>
            </div>

          </div>
          <input type="hidden" name="user_id" value="' . $_SESSION['user_id'] . '">
          <input type="submit" class="btn btn-outline-primary" name="submit" value="Submit"> &nbsp;&nbsp;
          <input type="submit" class="btn btn-outline-secondary" name="cancel" value="Cancel">
        </div>
        </form>
      ';

} else {
	echo "Wrong article_id";
}
?>