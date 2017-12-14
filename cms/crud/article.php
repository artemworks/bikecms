<?php
if ( isset($_POST['cancel']) ) {
  $_SESSION['success'] = "Cancelled";
  header("Location: " . DIR_URL . "cms");
  return;
}

if ( $activity === "/" || $activity === "") {

  if ( isset($_POST['article_id']) && isset($_POST['delete'])) {
    header("Location: " . DIR_URL . "cms/article/delete/" . $_POST['article_id']);
    return;
  }
        
  require_once DIR . "cms/crud/article/view.php";

}

if ( $activity === "add" ) {

  if ( isset($_POST["add"]) && 
       isset($_FILES["cover_image"]) && !empty($_FILES["cover_image"]["name"]) && 
       isset($_POST["posted"]) && isset($_POST["archiving"]) &&
       isset($_POST["title"]) && isset($_POST["title_url"]) &&
       isset($_POST["description"]) && isset($_POST["body"]) &&
       isset($_POST["user_id"]) && isset($_POST["is_active"]) ) {

                  $stmt = $pdo->prepare("INSERT INTO Article (posted, archiving, title, title_url, description, body, cover, user_id, is_active) 
                                VALUES (:pos, :arc, :tit, :tiu, :des, :bod, :cov, :use, :ise)");

                  $stmt->execute(array(
                      ':pos' => $_POST["posted"],
                      ':arc' => $_POST["archiving"],
                      ':tit' => $_POST["title"],
                      ':tiu' => $_POST["title_url"],
                      ':des' => $_POST["description"],
                      ':bod' => $_POST["body"],
                      ':cov' => $_FILES["cover_image"]["name"],
                      ':use' => $_POST["user_id"],
                      ':ise' => $_POST["is_active"])
                        );

                  $coverPath = DIR_IMG . basename($_FILES["cover_image"]["name"]);
                  move_uploaded_file($_FILES["cover_image"]["tmp_name"], $coverPath);

                  $article_id = $pdo->lastInsertId();

                  insertSections($article_id);
                  insertTags($article_id);

                  if ( !$article_id || empty($article_id) ) {
                    $_SESSION["error"] = "Something bad happened";
                    header("Location: " . DIR_URL . "cms/article");
                    return;
                  } else {
                    $_SESSION["success"] = "Article Added";
                    header("Location: " . DIR_URL . "cms/article");
                    return;
                  }
        }

    require_once DIR . "cms/crud/article/add.php";

}

if ( $activity === "edit" && !empty($activity_id) ) {

          if ( isset($_POST["edit"]) && 
               isset($_POST["posted"]) && isset($_POST["archiving"]) &&
               isset($_POST["title"]) && isset($_POST["title_url"]) &&
               isset($_POST["description"]) && isset($_POST["body"]) &&
               isset($_POST["user_id"]) && isset($_POST["is_active"]) ) {

                  if ( isset($_FILES["cover_image"]) && !empty($_FILES["cover_image"]["name"]) ) {
                    $coverImage = $_FILES["cover_image"]["name"];
                    $coverPath = DIR_IMG . basename($_FILES["cover_image"]["name"]);
                    move_uploaded_file($_FILES["cover_image"]["tmp_name"], $coverPath);
                  } else {
                    $coverImage = $_POST["cover_image"];
                  }

                  $stmt = $pdo->prepare("UPDATE Article SET 
                         posted = :pos, 
                         archiving = :arc, 
                         title = :tit, 
                         title_url = :tiu, 
                         description = :des, 
                         body = :bod, 
                         cover = :cov,
                         user_id = :uid, 
                         is_active = :isa 
                               WHERE article_id = :aid
                               ");

                  $stmt->execute(array(
                      ':pos' => $_POST["posted"],
                      ':arc' => $_POST["archiving"],
                      ':tit' => $_POST["title"],
                      ':tiu' => $_POST["title_url"],
                      ':des' => $_POST["description"],
                      ':bod' => $_POST["body"],
                      ':cov' => $coverImage,
                      ':uid' => $_POST["user_id"],
                      ':isa' => $_POST["is_active"],
                      ':aid' => $activity_id)
                        );

                  // clining old section entries
                  $stmt = $pdo->prepare('DELETE FROM sections WHERE article_id=:aid');
                  $stmt->execute(array( ':aid' => $activity_id ));
                  // insert new
                  insertSections($activity_id);

                  // clining old tag entries
                  $stmt = $pdo->prepare('DELETE FROM tags WHERE article_id=:aid');
                  $stmt->execute(array( ':aid' => $activity_id ));
                  // insert new
                  insertTags($activity_id);

                  $_SESSION['success'] = "Article updated";
                  header("Location: " . DIR_URL . "cms/article");
          }

      require_once DIR . "cms/crud/article/edit.php";

}  

if ( $activity === "delete" && !empty($activity_id) ) {

  if ( isset($_POST["delete"]) && 
       isset($_POST["article_id"]) ) {
                
                $stmt = $pdo->prepare("DELETE FROM Article WHERE article_id = :aid");
                $stmt->execute(array( ':aid' => $activity_id ));
                
                $_SESSION['success'] = "Article deleted";
                header("Location: " . DIR_URL . "cms/article");
          } 

      require_once DIR . "cms/crud/article/delete.php";

}

?>