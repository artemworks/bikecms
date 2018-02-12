<?php

// index.php?one=$1&two=$2 (.htaccess)
isset($_GET["one"]) ? $page = htmlentities($_GET["one"]) : $page = "homepage";
isset($_GET["two"]) ? $nested = htmlentities($_GET["two"]) : $nested = "404";

switch ($page) {

	case 'homepage':
		require_once "./controllers/homepage.php";
		break;

	case 'register':
		require_once "./controllers/registration.php";
		break;

	case 'login':
		require_once "./controllers/login.php";
		break;

	case 'logout':
		logOut();
		break;

	case 'articles':
		if ( ! $nested || $nested == "/" ) {
			require_once "./controllers/articles.php";
		} else if ( $nested ) {
			require_once "./controllers/article.php";
		}
		break;

	case 'tags':
		require_once "./controllers/tags.php";
		break;

	case 'search':
		require_once "./controllers/search.php";
		break;

	case 'budget':	
		require_once "./controllers/budget.php";
		break;

	case '404':	
		require_once "./controllers/notfound.php";
		break;

	default:
		redirect_to( DIR_URL . "404" );
		break;
}

?>