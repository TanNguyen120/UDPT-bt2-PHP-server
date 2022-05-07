<?php
require_once("./include/allLibraries.php");

$action = "";
if (isset($_REQUEST["action"]))
{    
    $action = $_REQUEST["action"];
}

 
switch ($action)
{
    case "list_player":      
        $controller = new PlayerController();
        $controller->listAll();
        break;
    case "list_club":
        $controller = new ClubController();
        $controller->listAll();
        break;
    case "list_player_from_club":
        $controller = new PlayerController();
        $controller->listPlayerFromClub();
        break;
    case "searchPlayerName":
        $controller = new PlayerController();
        $controller->findByNameSearchBar();
        break;
    case "findPlayerName":
        $controller = new PlayerController();
        $controller->findByName();
        break;
    case "ajaxSearchName":
        $controller = new PlayerController();
        $controller->ajaxSearchName();
        break;

    case "ajaxSearchFilter":
        $controller = new PlayerController();
        $controller->ajaxSearchFilter();
        break;
    case "addPlayer":
        $controller = new PlayerController();
        $controller->add();
        break;
    case "addPlayerPage":
        $controller = new PlayerController();
        $controller->addPlayerPage();
        break;
    case "formSubmitNewPlayer":
        $controller = new PlayerController();
        $controller->add();
        break;

    case "addClubPage":
        $controller = new ClubController();
        $controller->addClubPage();
        break;
    case "delete":
        $controller = new SinhVienController();
        $controller->delete();
        break;
    default:
        $controller = new HomeController();
        $controller->index();
        break;
}

?>