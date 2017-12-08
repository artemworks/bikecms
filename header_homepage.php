<!DOCTYPE html>
<html>
  <head>
    <title><?= $cms_title ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?= DIR_URL ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= DIR_URL ?>assets/css/fontawesome-all.min.css">
  </head>
  <body>

	<nav class="navbar navbar-expand-lg navbar-light bg-light">

	<div class="container">

	  <a class="navbar-brand" href="<?= DIR_URL ?>"><?= $cms_title ?></a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
			<?php
				$sections = getSections();
				foreach ($sections as $section) {
					if ( $section["is_active"] ) {
						echo "<li class=\"nav-item\"><a class=\"nav-link\" href='" . DIR_URL . $section["page"] . "'>" . $section["title"] . "</a></li>";
					}
				}

				$threeArticles = getLastThreeArticles();
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

	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
	  <ol class="carousel-indicators">
	    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
	    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
	    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
	  </ol>
	  <div class="carousel-inner" style="height: 92vh;">

		<?php
		$i = 0;
		foreach ($threeArticles as $art) {
		$i++;
			echo '<div class="carousel-item ';
			if ( $i==1 ) { echo "active"; }
				echo '">
					<img class="d-block w-100" src="assets/img/0' . $i . '.jpg" alt="..." style="-webkit-filter: grayscale(80%); filter: grayscale(80%);">
						<div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.6);">
						    <h1 class="display-4" style="text-shadow: 1px 1px #000000;">' . "<a href='articles/" . $art["title_url"] . "' style='text-decoration:none;color:#ffffff'>" . $art["title"] . '</a></h1>
						    <p style="text-shadow: 1px 1px #000000;">' . $art["description"] . '</p>
						</div>
					</div>
				';
		}
		?>

	</div>
	  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
	    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	    <span class="sr-only">Previous</span>
	  </a>
	  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
	    <span class="carousel-control-next-icon" aria-hidden="true"></span>
	    <span class="sr-only">Next</span>
	  </a>
	</div>

  	<div class="container">
  		<div class="row">
  			<div class="col-12">