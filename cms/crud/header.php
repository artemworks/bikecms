<!DOCTYPE html>
<html>
  <head>
    <title><?= $cms_title ?> Admin Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?= $dir_url ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $dir_url ?>assets/css/font-awesome.min.css">
  </head>
  <body>

	<nav class="navbar navbar-expand-lg navbar-light bg-light">

	<div class="container">

	  <a class="navbar-brand" href="<?= $dir_url ?>cms/">Dashboard</a>
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
  			<div class="col-12">