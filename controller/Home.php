<?php

class HomeController
{
    public function index()
    {
        $data = " !!! EveryThing about Foot Ball !!!!";        
        $VIEW = "./view/mainPage.phtml";
        require("./template/template.phtml");
    }
}