<?php

echo "<h1 class=\"display-4\">My Articles</h1>";

$articles = getArticles();

echo "<table class='table'>
<tr>
<th></th><th>ID</th><th>Title</th><th>Published</th><th>Status</th><th>Author</th>
</tr>
";

  foreach ($articles as $article) {
    
    $datePosted = DateTime::createFromFormat('Y-m-d H:i:s', $article["posted"]);
    $datePosted = $datePosted->format('M, n Y');

    $dateArchiving = DateTime::createFromFormat('Y-m-d H:i:s', $article["archiving"]);
    $dateArchiving = $dateArchiving->format('M, n Y');

    $article["is_active"] ? $status = "Active" : "Not Active";
    
    echo "<tr>" . 
      "<td><input class=\"form-check-input\" type=\"checkbox\" value=\"" . htmlentities($article["article_id"]) . "\"></td>" .
      "<td>" . htmlentities($article["article_id"]) . "</td>" .
      "<td>" . htmlentities($article["title"])  . "</td>" .
      "<td>" . htmlentities($datePosted) . "</td>" .
      "<td>" . htmlentities($status)  . "</td>" .
      "<td>" . htmlentities(getUserById($article["user_id"])["real_name"])  . "</td>"
    . "</tr>";
  
  }

echo "</table>";

echo '<form method="POST">
      <input type="submit" class="btn btn-outline-secondary" name="cancel" value="Cancel">
      </form>';
?>