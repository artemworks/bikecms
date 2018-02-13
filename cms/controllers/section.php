<?php

if ( isset($_POST['cancel']) ) {
  $_SESSION['success'] = "Cancelled";
  header("Location: " . DIR_URL . "cms");
  return;
}

if ( $action === "/" || $action === "") {

  if ( isset($_POST['section_id']) && isset($_POST['delete'])) {
    header("Location: " . DIR_URL . "cms/section/delete/" . $_POST['section_id']);
    return;
  }
        
  require_once DIR . "cms/views/section/view.php";

}

if ( $action === "add" ) {

  if ( isset($_POST["add"]) & 
       isset($_POST["name"]) && isset($_POST["page"]) &&
       isset($_POST["title"]) && isset($_POST["description"]) &&
       isset($_POST["rank"]) && isset($_POST["is_active"]) ) {

                  $stmt = $pdo->prepare("INSERT INTO 
                                Section (name, page, title, description, rank, is_active) 
                                VALUES (:nam, :pag, :tit, :des, :ran, :isa)
                                ");

                  $stmt->execute(array(
                      ':nam' => $_POST["name"],
                      ':pag' => $_POST["page"],
                      ':tit' => $_POST["title"],
                      ':des' => $_POST["description"],
                      ':ran' => $_POST["rank"],
                      ':isa' => $_POST["is_active"])
                        );

                  $section_id = $pdo->lastInsertId();

                  if ( !$section_id || empty($section_id) ) {
                    $_SESSION["error"] = "Something bad happened";
                    header("Location: " . DIR_URL . "cms/section");
                    return;
                  } else {
                    $_SESSION["success"] = "Section Added";
                    header("Location: " . DIR_URL . "cms/section");
                    return;
                  }
        }

    require_once DIR . "cms/views/section/add.php";

}

if ( $action === "edit" && !empty($action_id) ) {

          if ( isset($_POST["edit"]) && 
               isset($_POST["name"]) && isset($_POST["page"]) &&
               isset($_POST["title"]) && isset($_POST["description"]) &&
               isset($_POST["rank"]) && isset($_POST["is_active"]) ) {

                  $stmt = $pdo->prepare("UPDATE Section SET 
                         name = :nam, 
                         page = :pag, 
                         title = :tit, 
                         description = :des, 
                         rank = :ran, 
                         is_active = :isa 
                         WHERE section_id = :sid
                         ");

                  $stmt->execute(array(
                      ':nam' => $_POST["name"],
                      ':pag' => $_POST["page"],
                      ':tit' => $_POST["title"],
                      ':des' => $_POST["description"],
                      ':ran' => $_POST["rank"],
                      ':isa' => $_POST["is_active"],
                      ':sid' => $action_id)
                        );

                  $_SESSION['success'] = "Section updated";
                  header("Location: " . DIR_URL . "cms/section");
          }

      require_once DIR . "cms/views/section/edit.php";

}  

if ( $action === "delete" && !empty($action_id) ) {

  if ( isset($_POST["delete"]) && 
       isset($_POST["section_id"]) ) {
                
                $stmt = $pdo->prepare("DELETE FROM Section WHERE section_id = :sid");
                $stmt->execute(array( ':sid' => $_POST["section_id"] ));
                
                $_SESSION['success'] = "Section deleted";
                header("Location: " . DIR_URL . "cms/section");
          } 

      require_once DIR . "cms/views/section/delete.php";

}

?>