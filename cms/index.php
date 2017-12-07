<?php
require_once "./include/pdo.php";
require_once "./include/essentials.php";
require_once "./include/functions.php";
session_start();
restrictAccessCMS();
flashMessages();

isset($_GET["one"]) ? $page = htmlentities($_GET["one"]) : $page = "default";

switch ($page) {

  case 'article':

    if ( isset($_POST['cancel']) ) {
      $_SESSION['success'] = "Cancelled";
        header("Location: /".$dir_url."/cms/");
        return;
    }
    if ( isset($_POST["posted"]) && isset($_POST["archiving"]) &&
        isset($_POST["title"]) && isset($_POST["title_url"]) &&
        isset($_POST["description"]) && isset($_POST["body"]) &&
        isset($_POST["user_id"]) && isset($_POST["is_active"]) ) {

        addArticle(
          $_POST["posted"], $_POST["archiving"], 
          $_POST["title"], $_POST["title_url"], 
          $_POST["description"], $_POST["body"], 
          $_POST["user_id"], $_POST["is_active"]);
    }
    
    require_once "./header.php";

      $url = htmlentities($_GET["two"]);

      if ( $url === "/add") {

        require_once "./crud/add_article.php";

      } else if ( $url === "/" || $url === "") {
        
        require_once "./crud/view_article.php";

      } else {

        $urlArr = explode("/", ltrim($url, '/'));

        if ( !empty($urlArr[1]) ) {
          require_once "./crud/edit_article.php";
        } else if ( $urlArr[0] === "edit" || $urlArr[1] === "" ) {
          echo "You wanna edit something?";
        } 

      }

    require_once "./footer.php";

    break;

  case 'tag':
    echo "tag";
    break;
  case 'section':
    echo "section";
    break;
  case 'user':
    echo "user";
    break;
  default:
    require_once "./header.php";
?>

      <div class="row">

        <div class="col-md-3">
          <p class="text-center lead"><b>Articles</b></p>
          <h1 class="display-4 text-center"><?= count(getArticles()) ?></h1>
          <p class="text-center">
            <a class="btn btn-secondary" href="article/add" aria-label="Settings">
              <i class="fa fa-plus" aria-hidden="true"></i>
            </a> 
            <a class="btn btn-secondary" href="article" aria-label="Settings">
              <i class="fa fa-search" aria-hidden="true"></i>
            </a>
          </p>
      </div>

        <div class="col-md-3">
          <p class="text-center lead"><b>Tags</b></p>
          <h1 class="display-4 text-center"><?= count(getTags()) ?></h1>
          <p class="text-center">
            <a class="btn btn-secondary" href="tag/add" aria-label="Settings">
              <i class="fa fa-plus" aria-hidden="true"></i>
            </a> 
            <a class="btn btn-secondary" href="tag" aria-label="Settings">
              <i class="fa fa-search" aria-hidden="true"></i>
            </a>
          </p>
      </div>

        <div class="col-md-3">
          <p class="text-center lead"><b>Sections</b></p>
          <h1 class="display-4 text-center"><?= count(getSections()) ?></h1>
          <p class="text-center">
            <a class="btn btn-secondary" href="section/add" aria-label="Settings">
              <i class="fa fa-plus" aria-hidden="true"></i>
            </a> 
            <a class="btn btn-secondary" href="section" aria-label="Settings">
              <i class="fa fa-search" aria-hidden="true"></i>
            </a>
          </p>
      </div>

        <div class="col-md-3">
          <p class="text-center lead"><b>Users</b></p>
          <h1 class="display-4 text-center"><?= count(getUsers()) ?></h1>
          <p class="text-center">
            <a class="btn btn-secondary" href="user/add" aria-label="Settings">
              <i class="fa fa-plus" aria-hidden="true"></i>
            </a> 
            <a class="btn btn-secondary" href="user" aria-label="Settings">
              <i class="fa fa-search" aria-hidden="true"></i>
            </a>
          </p>
      </div>

    </div>


<?php
  require_once "./footer.php";
    break;
}
?>