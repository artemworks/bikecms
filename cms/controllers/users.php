<?php

if ( isset($_POST['cancel']) ) {
  $_SESSION['success'] = "Cancelled";
  header("Location: " . DIR_URL . "cms");
  return;
}

if ( $action === "/" || $action === "") {

  if ( isset($_POST['user_id']) && isset($_POST['delete'])) {
    header("Location: " . DIR_URL . "cms/user/delete/" . $_POST['user_id']);
    return;
  }
        
  require_once DIR . "cms/views/users/view.php";

}

if ( $action === "add" ) {

  if ( isset($_POST["add"]) & 
       isset($_POST["name"]) && isset($_POST["pass"]) && 
       isset($_POST["real_name"]) && isset($_POST["email"]) &&
       isset($_POST["priv"]) && isset($_POST["is_active"]) ) {

                  $hashedPass = password_encrypt($_POST["pass"]);
                  $stmt = $pdo->prepare('INSERT INTO users (name, pass, real_name, email, priv, is_active) 
                                              VALUES (:nm, :pw, :rnm, :eml, :pri, :isa)');
                  $stmt->execute(array(
                    ':nm' => $_POST["name"], 
                    ':pw' => $hashedPass, 
                    ':rnm' => $_POST["real_name"], 
                    ':eml' => $_POST["email"],
                    ':pri' => $_POST["priv"],
                    ':isa' => $_POST["is_active"]
                    ));

                  $user_id = $pdo->lastInsertId();

                  if ( !$user_id || empty($user_id) ) {
                    $_SESSION["error"] = "Something bad happened";
                    header("Location: " . DIR_URL . "cms/user");
                    return;
                  } else {
                    $_SESSION["success"] = "User Added";
                    header("Location: " . DIR_URL . "cms/user");
                    return;
                  }
        }

    require_once DIR . "cms/views/users/add.php";

}

if ( $action === "edit" && !empty($action_id) ) {

          if ( isset($_POST["pass"]) && $_POST["pass"] === "" ) {
            $_SESSION['error'] = "Changes not saved! User password is empty";
            header("Location: " . DIR_URL . "cms/user");
          }
          
          if ( isset($_POST["edit"]) && 
               isset($_POST["name"]) && isset($_POST["pass"]) && !empty($_POST["pass"]) && 
               isset($_POST["real_name"]) && isset($_POST["email"]) &&
               isset($_POST["priv"]) && isset($_POST["is_active"]) ) {

                  $hashedPass = password_encrypt($_POST["pass"]);

                  $stmt = $pdo->prepare("UPDATE users SET 
                         name = :nm, 
                         pass = :pw, 
                         real_name = :rnm, 
                         email = :eml, 
                         priv = :pri,
                         is_active = :isa
                         WHERE user_id = :uid
                         ");

                  $stmt->execute(array(
                      ':nm' => $_POST["name"],
                      ":pw" => $hashedPass,
                      ":rnm" => $_POST["real_name"],
                      ":eml" => $_POST["email"], 
                      ":pri" => $_POST["priv"],
                      ':isa' => $_POST["is_active"],
                      ':uid' => $action_id)
                        );

                  $_SESSION['success'] = "User updated";
                  header("Location: " . DIR_URL . "cms/user");
          }

      require_once DIR . "cms/views/users/edit.php";

}  

if ( $action === "delete" && !empty($action_id) ) {

  if ( isset($_POST["delete"]) && 
       isset($_POST["user_id"]) ) {
                
                $stmt = $pdo->prepare("DELETE FROM users WHERE user_id = :uid");
                $stmt->execute(array( ':uid' => $_POST["user_id"] ));
                
                $_SESSION['success'] = "User deleted";
                header("Location: " . DIR_URL . "cms/user");
          } 

      require_once DIR . "cms/views/users/delete.php";

}

?>