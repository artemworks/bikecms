<?php
require_once "./include/pdo.php";
require_once "./include/essentials.php";
require_once "./include/functions.php";
session_start();
restrictAccessCMS();
flashMessages();
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?= $cms_title ?> Admin Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
  </head>
  <body>

	<nav class="navbar navbar-expand-lg navbar-light bg-light">

	<div class="container">

	  <a class="navbar-brand" href="/<?= $dir_url ?>/cms/">Dashboard</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	  <ul class="navbar-nav mr-auto">
	  </ul>
	    <?= "<span class=\"navbar-text\">" . userMessages() . "</span>" ?>
	  </div>

	</div>  
	</nav>

	<br>
	
  	<div class="container">
  		<div class="row">

  			<div class="col-3">
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

  			<div class="col-3">
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

  			<div class="col-3">
  				<p class="text-center lead"><b>Sections</b></p>
  				<h1 class="display-4 text-center"><?= count(getArticles()) ?></h1>
          <p class="text-center">
            <a class="btn btn-secondary" href="section/add" aria-label="Settings">
              <i class="fa fa-plus" aria-hidden="true"></i>
            </a> 
            <a class="btn btn-secondary" href="section" aria-label="Settings">
              <i class="fa fa-search" aria-hidden="true"></i>
            </a>
          </p>
			</div>

  			<div class="col-3">
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
	</div>
	
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
  </body>
</html>