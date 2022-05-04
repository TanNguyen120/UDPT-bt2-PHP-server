<?php

class HomeController
{
    public function index()
    {
        $data = "Hello world !!!!";        
        $VIEW = "./view/TrangChu.phtml";
        require("./template/template.phtml");
    }
}
