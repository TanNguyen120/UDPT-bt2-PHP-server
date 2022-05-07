<?php

class ClubController
{
    public function listAll()
    {
        if(isset($_REQUEST["page"]))
        {
            $pageCount = 0;
            $page = $_REQUEST["page"];
            $data = ClubModel::listAll($page);
            $pageCount = ClubModel::countAllPage();
            $VIEW = "./view/clubList.phtml";
            require("./template/template.phtml");
        }
        else{
            echo "Wrong URL !";
        }
        
    }
    
    public function search()
    {
        $keyword = $_REQUEST["keyword"];
        $data = SinhVienModel::find($keyword);
        $VIEW = "./view/DanhSachSV.phtml";
        require("./template/template.phtml");
    }

    public function addClubPage()
    {
        $stadiums = StadiumModel::listAll();
        $coaches = CoachModel::listAll();
        $VIEW = "./view/addClubPage.phtml";
        $data = "please fill in the form above";
        require("./template/template.phtml");
    }
    
    public function addClubFromForm(){
        $clubName = $_REQUEST["ClubName"];
        $stadiumID = $_REQUEST["StadiumID"];
        $coachID = $_REQUEST["CoachID"];
        $shortName = $_REQUEST["ShortName"];
        $clubID = $_REQUEST["ClubID"];
        $club = new ClubModel();
        $club->ClubName = $clubName;
        $club->StadiumID = $stadiumID;
        $club->Coach = $coachID;
        $club->ShortName = $shortName;
        $club->ClubID = $clubID;
        $result = ClubModel::addToDataBase($club,$stadiumID);
        $data = '';
        if($result){
            $data= "Successfully added!";
        }else
        {
            $data= "Failed to add!";
        }
        $stadiums = StadiumModel::listAll();
        $coaches = CoachModel::listAll();
        $VIEW = "./view/addClubPage.phtml";
        require("./template/template.phtml");
    }
    public function editClubPage(){
        if(isset($_REQUEST["page"]))
        {
            $pageCount = 0;
            $page = $_REQUEST["page"];
            $data = ClubModel::listAll($page);
            $stadiums = StadiumModel::listAll();
            $coaches = CoachModel::listAll();
            $pageCount = ClubModel::countAllPage();
            $VIEW = "./view/clubListEditable.phtml";
            require("./template/template.phtml");
        }
        else{
            echo "Wrong URL !";
        }
    }

    public function ajaxEditClub(){
        $club = new ClubModel;
        $clubID = $_REQUEST["ClubID"];
        $club->ClubID = $clubID;
        $club->ClubName = $_REQUEST["ClubName"];
        $club->Stadium = $_REQUEST["StadiumID"];
        $club->Coach = $_REQUEST["CoachID"];
        $club->ShortName = $_REQUEST["ShortName"];

        $result = ClubModel::updateClub($club);
        if($result){
            echo "success adding";
        }else{
            echo "failed to add";
        }
    }
}
?>