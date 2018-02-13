<!DOCTYPE html>
<html>
  <head>
    <title><?= CMS_TITLE ?> Admin Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?= DIR_URL ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= DIR_URL ?>assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?= DIR_URL ?>assets/css/bike.css">
    <link href="<?= DIR_URL ?>cms/vendors/summernote/summernote-bs4.css" rel="stylesheet">


  </head>
  <body>

	<nav class="navbar navbar-expand-lg navbar-light bg-light">

	<div class="container">

	  <a class="navbar-brand" href="<?= DIR_URL ?>cms/">Dashboard</a> <i class="fa fa-bicycle fa-lg"></i> 
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