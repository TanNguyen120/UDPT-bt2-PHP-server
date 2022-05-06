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
    case "add":
        $controller = new SinhVienController();
        $controller->add();
        break;
    case "show":
        $controller = new SinhVienController();
        $controller->show();
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