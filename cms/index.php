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
    
      $url = htmlentities($_GET["two"]);
      $urlArr = explode("/", ltrim($url, '/'));
      isset($urlArr[1]) && is_numeric($urlArr[1]) ? $article_id = $urlArr[1] : false;

      if ( $url === "/" || $url === "") {

        if ( isset($_POST['article_id']) && isset($_POST['delete'])) {
          header("Location: /".$dir_url."/cms/article/delete/".$_POST['article_id']);
          return;
        }
        require_once __DIR__ . "/header.php";
        require_once "./crud/view_article.php";

      }

      if ( $url === "/add") {

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

        require_once __DIR__ . "/header.php";
        require_once "./crud/add_article.php";

      } 

      if ( $urlArr[0] === "edit" && !empty($article_id) ) {

          if ( isset($_POST["posted"]) && isset($_POST["archiving"]) &&
              isset($_POST["title"]) && isset($_POST["title_url"]) &&
              isset($_POST["description"]) && isset($_POST["body"]) &&
              isset($_POST["user_id"]) && isset($_POST["is_active"]) ) {

              updateArticle(
                $article_id, $_POST["posted"], $_POST["archiving"], 
                $_POST["title"], $_POST["title_url"], 
                $_POST["description"], $_POST["body"], 
                $_POST["user_id"], $_POST["is_active"]);
          }

      require_once __DIR__ . "/header.php";
      require_once "./crud/edit_article.php";

      }  

      if ( $urlArr[0] === "delete" && !empty($article_id) ) {

          if ( isset($_POST["article_id"]) && isset($_POST["submit"]) ) {
              deleteArticle($_POST["article_id"]);
          } 

      require_once __DIR__ . "/header.php";
      require_once "./crud/delete_article.php";

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