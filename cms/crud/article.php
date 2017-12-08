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

  if ( isset($_POST["add"]) & 
       isset($_POST["posted"]) && isset($_POST["archiving"]) &&
       isset($_POST["title"]) && isset($_POST["title_url"]) &&
       isset($_POST["description"]) && isset($_POST["body"]) &&
       isset($_POST["user_id"]) && isset($_POST["is_active"]) ) {

                  $stmt = $pdo->prepare("INSERT INTO Article (posted, archiving, title, title_url, description, body, user_id, is_active) 
                                VALUES (:pos, :arc, :tit, :tiu, :des, :bod, :use, :ise)");

                  $stmt->execute(array(
                      ':pos' => $_POST["posted"],
                      ':arc' => $_POST["archiving"],
                      ':tit' => $_POST["title"],
                      ':tiu' => $_POST["title_url"],
                      ':des' => $_POST["description"],
                      ':bod' => $_POST["body"],
                      ':use' => $_POST["user_id"],
                      ':ise' => $_POST["is_active"])
                        );

                  $article_id = $pdo->lastInsertId();

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

                  $stmt = $pdo->prepare("UPDATE Article SET 
                         posted = :pos, 
                         archiving = :arc, 
                         title = :tit, 
                         title_url = :tiu, 
                         description = :des, 
                         body = :bod, 
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
                      ':uid' => $_POST["user_id"],
                      ':isa' => $_POST["is_active"],
                      ':aid' => $activity_id)
                        );

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