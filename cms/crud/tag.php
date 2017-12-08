<?php

if ( isset($_POST['cancel']) ) {
  $_SESSION['success'] = "Cancelled";
  header("Location: " . DIR_URL . "cms");
  return;
}

if ( $activity === "/" || $activity === "") {

  if ( isset($_POST['tag_id']) && isset($_POST['delete'])) {
    header("Location: " . DIR_URL . "cms/tag/delete/" . $_POST['tag_id']);
    return;
  }
        
  require_once DIR . "cms/crud/tag/view.php";

}

if ( $activity === "add" ) {

  if ( isset($_POST["add"]) & 
       isset($_POST["name"]) && isset($_POST["is_active"]) ) {

                  $stmt = $pdo->prepare("INSERT INTO 
                                Tag (name, is_active) 
                                VALUES (:nm, :isa)
                                ");

                  $stmt->execute(array(
                      ':nm' => $_POST["name"],
                      ':isa' => $_POST["is_active"])
                        );

                  $tag_id = $pdo->lastInsertId();

                  if ( !$tag_id || empty($tag_id) ) {
                    $_SESSION["error"] = "Something bad happened";
                    header("Location: " . DIR_URL . "cms/tag");
                    return;
                  } else {
                    $_SESSION["success"] = "Tag Added";
                    header("Location: " . DIR_URL . "cms/tag");
                    return;
                  }
        }

    require_once DIR . "cms/crud/tag/add.php";

}

if ( $activity === "edit" && !empty($activity_id) ) {

          if ( isset($_POST["edit"]) && 
               isset($_POST["name"]) && isset($_POST["is_active"]) ) {

                  $stmt = $pdo->prepare("UPDATE Tag SET 
                         name = :nm, 
                         is_active = :isa 
                         WHERE tag_id = :tid
                         ");

                  $stmt->execute(array(
                      ':nm' => $_POST["name"],
                      ':isa' => $_POST["is_active"],
                      ':tid' => $activity_id)
                        );

                  $_SESSION['success'] = "Tag updated";
                  header("Location: " . DIR_URL . "cms/tag");
          }

      require_once DIR . "cms/crud/tag/edit.php";

}  

if ( $activity === "delete" && !empty($activity_id) ) {

  if ( isset($_POST["delete"]) && 
       isset($_POST["tag_id"]) ) {
                
                $stmt = $pdo->prepare("DELETE FROM Tag WHERE tag_id = :tid");
                $stmt->execute(array( ':tid' => $_POST["tag_id"] ));
                
                $_SESSION['success'] = "Tag deleted";
                header("Location: " . DIR_URL . "cms/tag");
          } 

      require_once DIR . "cms/crud/tag/delete.php";

}

?>