<?php
require_once "./include/pdo.php";
require_once "./include/essentials.php";
require_once "./include/functions.php";
session_start();
restrictAccessCMS();
flashMessages();

// URL for CMS is structured as /$section/$activity/$activity_id

isset($_GET["one"]) ? $section = htmlentities($_GET["one"]) : $section = "";
isset($_GET["one"]) ? $activity =  htmlentities($_GET["two"]) : $activity = "";

$arrayOfActivities = explode("/", ltrim($activity, '/'));

isset($arrayOfActivities[0]) && !is_numeric($arrayOfActivities[0]) ? $activity = $arrayOfActivities[0] : false;
isset($arrayOfActivities[1]) && is_numeric($arrayOfActivities[1]) ? $activity_id = $arrayOfActivities[1] : false;

// Routing

switch ($section) {

  case 'article':
    require_once "./crud/article.php";
    break;
  case 'tag':
    require_once "./crud/tag.php";
    break;
  case 'section':
    require_once "./crud/section.php";
    break;
  case 'user':
    echo "user";
    break;
  default:
    require_once DIR . "cms/crud/header.php";
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
    require_once DIR . "cms/crud/footer.php";
    break;
}
?>