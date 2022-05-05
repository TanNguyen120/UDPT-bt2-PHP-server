<?php
require_once("./include/allLibraries.php");

$action = "";
if (isset($_REQUEST["action"]))
{    
    $action = $_REQUEST["action"];
}

 
switch ($action)
{
    case "list":      
        $controller = new PlayerController();
        $controller->listAll();
        break;
    case "search":
        $controller = new SinhVienController();
        $keyword = $_REQUEST["keyword"];
        $controller->search($keyword);
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