<?php

// URL for CMS is structured as /$controller/$action/$action_id
isset($_GET["controller"]) ? $controller = htmlentities($_GET["controller"]) : $controller = "homepage";
isset($_GET["controller"]) ? $action =  htmlentities($_GET["action"]) : $action = "";

$arrayOfActions = explode("/", ltrim($action, '/'));

isset($arrayOfActions[0]) && !is_numeric($arrayOfActions[0]) ? $action = $arrayOfActions[0] : false;
isset($arrayOfActions[1]) && is_numeric($arrayOfActions[1]) ? $action_id = $arrayOfActions[1] : false;

// Routing

switch ($controller) {

  case 'homepage':
		
    require_once "./controllers/homepage.php";
    break;

	case 'article':

    if ( $action === "/" || $action === "") 
    {
      require_once "./controllers/article/view.php";
    }
    if ( $action === "add" ) 
    {
      require_once "./controllers/article/add.php";
    }
    if ( $action === "edit" && !empty($action_id) ) 
    {
      require_once "./controllers/article/edit.php";
    }
    if ( $action === "delete" && !empty($action_id) ) 
    {
      require_once "./controllers/article/delete.php";
    }

    break;

  case 'tag':

    if ( $action === "/" || $action === "") 
    {
      require_once "./controllers/tag/view.php";
    }
    if ( $action === "add" ) 
    {
      require_once "./controllers/tag/add.php";
    }
    if ( $action === "edit" && !empty($action_id) ) 
    {
      require_once "./controllers/tag/edit.php";
    }
    if ( $action === "delete" && !empty($action_id) ) 
    {
      require_once "./controllers/tag/delete.php";
    }
    break;

  case 'section':

    if ( $action === "/" || $action === "") 
    {
      require_once "./controllers/section/view.php";
    }
    if ( $action === "add" ) 
    {
      require_once "./controllers/section/add.php";
    }
    if ( $action === "edit" && !empty($action_id) ) 
    {
      require_once "./controllers/section/edit.php";
    }
    if ( $action === "delete" && !empty($action_id) ) 
    {
      require_once "./controllers/section/delete.php";
    }
    break;

  case 'user':
    if ( $action === "/" || $action === "") 
    {
      require_once "./controllers/user/view.php";
    }
    if ( $action === "add" ) 
    {
      require_once "./controllers/user/add.php";
    }
    if ( $action === "edit" && !empty($action_id) ) 
    {
      require_once "./controllers/user/edit.php";
    }
    if ( $action === "delete" && !empty($action_id) ) 
    {
      require_once "./controllers/user/delete.php";
    }
    break;

  case 'budget_app':
    if ( $action === "/" || $action === "") 
    {
      require_once "./controllers/budget_app/view.php";
    }
    if ( $action === "add" ) 
    {
      require_once "./controllers/budget_app/add.php";
    }
    if ( $action === "edit" && !empty($action_id) ) 
    {
      require_once "./controllers/budget_app/edit.php";
    }
    if ( $action === "delete" && !empty($action_id) ) 
    {
      require_once "./controllers/budget_app/delete.php";
    }
    break;

	case '404':	
    require_once "./controllers/notfound.php";
    break;

  default:
    require_once "./controllers/default.php";
    break;

}

?>