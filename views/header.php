<!DOCTYPE html>
<html>
  <head>
    <title><?php if ( isset($article_content["title"]) ) { echo $article_content["title"] . " - " . CMS_TITLE; } else { echo ucwords(htmlentities($controller)) . " - " . CMS_TITLE; } ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?= DIR_URL ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= DIR_URL ?>assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?= DIR_URL ?>assets/css/bike.css">
  </head>
  <body>

	<nav class="navbar navbar-expand-lg navbar-light bg-light">

	<div class="container">

	  <a class="navbar-brand" href="<?= DIR_URL ?>"><?= CMS_TITLE ?></a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
			<?php
				foreach ($sections as $section) {
					if ( $section["is_active"] ) {
						echo "<li class=\"nav-item\"><a class=\"nav-link\" href='" . DIR_URL . $section["page"] . "'>" . $section["title"] . "</a></li>";
					}
				}
			?>
	    </ul>
	    <?= "<span class=\"navbar-text\">" . userMessages() . "</span>" ?>
	    <form class="form-inline my-2 my-lg-0" action="<?= DIR_URL ?>search" method="POST">
	      <input class="form-control mr-sm-2" name="q" type="search" placeholder="Search" aria-label="Search">
	      <button class="btn btn-outline-dark my-2 my-sm-0" type="submit" name="search">Search</button>
	    </form>
	  </div>

	</div>  
	</nav>

	<br>
	
  	<div class="container">
  		<div class="row">
  			<div class="col-12">
