<?php
if ( isset($_POST['cancel']) ) {
  $_SESSION['success'] = "Cancelled";
  header("Location: " . DIR_URL . "cms");
  return;
}

if ( $action === "/" || $action === "") {

  if ( isset($_POST['trans_id']) && isset($_POST['delete'])) {
    header("Location: " . DIR_URL . "cms/budget_app/delete/" . $_POST['trans_id']);
    return;
  }

  require_once DIR . "cms/views/budget_app/view.php";

}

if ( $action === "add" ) {

  if ( isset($_POST["add"]) && 
       isset($_POST["trans_date"]) && isset($_POST["store"]) &&
       isset($_POST["amount"]) && isset($_POST["tax"]) &&
       isset($_POST["cat_id"]) && isset($_POST["is_active"]) ) {

                  $stmt = $pdo->prepare("INSERT INTO B_transactions (trans_date, store, amount, tax, cat_id, is_active) 
                                VALUES (:tdt, :str, :amt, :tax, :cid, :isa)");

                  $stmt->execute(array(
                      ':tdt' => $_POST["trans_date"],
                      ':str' => $_POST["store"],
                      ':amt' => $_POST["amount"],
                      ':tax' => $_POST["tax"],
                      ':cid' => $_POST["cat_id"],
                      ':isa' => $_POST["is_active"])
                        );

                  $trans_id = $pdo->lastInsertId();

                  if ( !$trans_id || empty($trans_id) ) {
                    $_SESSION["error"] = "Something bad happened";
                    header("Location: " . DIR_URL . "cms/budget_app");
                    return;
                  } else {
                    $_SESSION["success"] = "Article Added";
                    header("Location: " . DIR_URL . "cms/budget_app");
                    return;
                  }
        }

    require_once DIR . "cms/views/budget_app/add.php";

}

if ( $action === "edit" && !empty($action_id) ) {

          if ( isset($_POST["edit"]) && isset($_POST["trans_date"]) &&
               isset($_POST["store"]) && isset($_POST["amount"]) &&
               isset($_POST["tax"]) && 
               isset($_POST["cat_id"]) && isset($_POST["is_active"]) ) {

                  $stmt = $pdo->prepare("UPDATE B_transactions SET 
                         trans_date = :tdt, 
                         store = :str, 
                         amount = :amt, 
                         tax = :tax, 
                         cat_id = :cid, 
                         is_active = :isa 
                               WHERE trans_id = :tid
                               ");

                  $stmt->execute(array(
                      ':tdt' => $_POST["trans_date"],
                      ':str' => $_POST["store"],
                      ':amt' => $_POST["amount"],
                      ':tax' => $_POST["tax"],
                      ':cid' => $_POST["cat_id"],
                      ':isa' => $_POST["is_active"],
                      ':tid' => $action_id)
                        );

                  $_SESSION['success'] = "Transaction updated";
                  header("Location: " . DIR_URL . "cms/budget_app");
          }

      require_once DIR . "cms/views/budget_app/edit.php";

}  

if ( $action === "delete" && !empty($action_id) ) {

  if ( isset($_POST["delete"]) && 
       isset($_POST["trans_id"]) ) {
                
                $stmt = $pdo->prepare("DELETE FROM B_transactions WHERE trans_id = :tid");
                $stmt->execute(array( ':tid' => $action_id ));
                
                $_SESSION['success'] = "Transaction deleted";
                header("Location: " . DIR_URL . "cms/budget_app");
          } 

      require_once DIR . "cms/views/budget_app/delete.php";

}

?>