<?php

echo "<h1 class=\"display-4\">My Articles</h1>";

$articles = getArticles();

echo "<form method=\"POST\"><table class='table'>
<tr>
<th></th><th>ID</th><th>Title</th><th>Published</th><th>Status</th><th>Author</th>
</tr>
";

  foreach ($articles as $article) {
    
    $datePosted = DateTime::createFromFormat('Y-m-d H:i:s', $article["posted"]);
    $datePosted = $datePosted->format('M, n Y');

    $dateArchiving = DateTime::createFromFormat('Y-m-d H:i:s', $article["archiving"]);
    $dateArchiving = $dateArchiving->format('M, n Y');

    $article["is_active"] ? $status = "Active" : $status = "Not Active";
    
    echo "<tr>" . 
      "<td><input class=\"form-check-input\" name=\"article_id\" type=\"checkbox\" value=\"" . htmlentities($article["article_id"]) . "\"></td>" .
      "<td>" . htmlentities($article["article_id"]) . "</td>" .
      "<td><a href='/" . $dir_url . "/cms/article/edit/" . htmlentities($article["article_id"]) . "'>" . htmlentities($article["title"])  . "</a></td>" .
      "<td>" . htmlentities($datePosted) . "</td>" .
      "<td>" . htmlentities($status)  . "</td>" .
      "<td>" . htmlentities(getUserById($article["user_id"])["real_name"])  . "</td>"
    . "</tr>";
  
  }

echo "</table>";

echo '
      <input type="submit" class="btn btn-outline-danger" name="delete" value="Delete">
      <input type="submit" class="btn btn-outline-secondary" name="cancel" value="Cancel">
      </form><br><br>';
?>