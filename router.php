<?php

// index.php?controller=$1&action=$2 (.htaccess)
isset($_GET["controller"]) ? $controller = htmlentities($_GET["controller"]) : $controller = "homepage";
isset($_GET["action"]) ? $action = htmlentities($_GET["action"]) : $action = "404";

switch ($controller) {

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
		require_once "./controllers/logout.php";
		break;

	case 'articles':
		if ( ! $action || $action == "/" ) {
			require_once "./controllers/articles.php";
		} else if ( $action ) {
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
		require_once "./controllers/default.php";
		break;
}

?>