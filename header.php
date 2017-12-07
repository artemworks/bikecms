<!DOCTYPE html>
<html>
  <head>
    <title><?= $cms_title ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/<?= $dir_url ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/<?= $dir_url ?>/assets/css/font-awesome.min.css">
  </head>
  <body>

	<nav class="navbar navbar-expand-lg navbar-light bg-light">

	<div class="container">

	  <a class="navbar-brand" href="/<?= $dir_url ?>/"><?= $cms_title ?></a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
			<?php
				$sections = getSections();
				foreach ($sections as $section) {
					if ( $section["is_active"] ) {
						echo "<li class=\"nav-item\"><a class=\"nav-link\" href='/" . $dir_url . "/" . $section["page"] . "'>" . $section["title"] . "</a></li>";
					}
				}
			?>
	    </ul>
	    <?= "<span class=\"navbar-text\">" . userMessages() . "</span>" ?>
	    <form class="form-inline my-2 my-lg-0" action="search" method="GET">
	      <input class="form-control mr-sm-2" name="q" type="search" placeholder="Search" aria-label="Search">
	      <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
	    </form>
	  </div>

	</div>  
	</nav>

	<br>
	
  	<div class="container">
  		<div class="row">
  			<div class="col-12">

