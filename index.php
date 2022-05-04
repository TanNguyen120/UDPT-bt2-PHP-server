<?php
require_once("./include/allLibraries.php");

$action = "";
if (isset($_REQUEST["action"]))
{    
    $action = $_REQUEST["action"];
}

if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
    echo 'We don\'t have mysqli!!!';
} else {
    echo 'Phew we have it!';
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