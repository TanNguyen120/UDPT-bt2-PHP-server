<?php
require_once("./controller/Home.php");
require_once("./controller/SinhVien.php");
require_once("./model/SinhVien.php");
require_once("config/dbconnect.php"); 

$action = "";
if (isset($_REQUEST["action"]))
{    
    $action = $_REQUEST["action"];
}
 
switch ($action)
{
    case "list":      
        $controller = new SinhVienController();
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
