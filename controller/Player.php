<?php

class PlayerController
{
    public function listAll()
    {
        if(isset($_REQUEST["page"]))
        {
            $pageCount = 0;
            $page = $_REQUEST["page"];
            $data = PlayerModel::listAll($page);
            $pageCount = PlayerModel::countAllPage();
            $VIEW = "./view/playerList.phtml";
            $webTile = "List of all players";
            require("./template/template.phtml");
        }
        else{
            echo "Wrong URL !";
        }
        
    }

    public function listPlayerFromClub()
    {
        if(isset($_REQUEST["page"]) && isset($_REQUEST["club"]))
        {
            $pageCount = 0;
            $page = $_REQUEST["page"];
            $club = $_REQUEST["club"];
            $data = PlayerModel::listPlayerFromClub($page, $club);
            $pageCount = PlayerModel::countPlayerFromClub($club);
            $VIEW = "./view/playerClubList.phtml";
            require("./template/template.phtml");
        }
        else{
            echo "Wrong URL !";
        }
    }

    public function deleteSinglePlayer()
    {
        if(isset($_REQUEST["playerID"]))
        {
            $playerID = $_REQUEST["playerID"];
            $result = PlayerModel::deleteSingle($playerID);
            if($result)
            {
                echo "Successfully deleted!";
            }else{
                echo "Failed to delete!";
            }
        }
            
    }
    public function findByNameSearchBar()
    {
        if(isset($_REQUEST["page"]) && isset($_REQUEST["playerName"]))
        {
            $pageCount = 0;
            $page = $_REQUEST["page"];
            $playerName = $_REQUEST["playerName"];
            $data = PlayerModel::findName($playerName, $page);
            $webTile = "List of players have ".$playerName." in their name";
            $pageCount = PlayerModel::countPlayerNameSearch($playerName);
            $VIEW = "./view/resultSearchPlayerName.phtml";
            require("./template/template.phtml");
        }
        else{
            echo "Wrong URL !";
        }
    }
    // h??m n??y ch??? th???c hi???n vi???c t???o view ?????n trang search player name
    public function findByName()
    {
        $allNationality = PlayerModel::getAllCountry();
        $allClub = PlayerModel::getAllClub();
        $allPosition = PlayerModel::getAllPosition();
        $allNumber = PlayerModel::getAllNumber();
        $webTile = "Search and Filter players";
        $VIEW = "./view/findPlayerName.phtml";
        require("./template/template.phtml");
    }

    public function ajaxSearchName()
    {
        if(isset($_REQUEST["playerName"]))
        {
            $playerName = $_REQUEST["playerName"];
            $data = PlayerModel::findName($playerName,1);
            echo json_encode($data);
        }
    }

    public function ajaxSearchFilter()
    {
        $FullName = $_REQUEST["FullName"];
        $ClubName = $_REQUEST["ClubName"];
        $Position = $_REQUEST["Position"];
        $Nationality = $_REQUEST["Nationality"];
        $Number = $_REQUEST["Number"];
        $searchCon = "";

        // ph???n t???o ??i???u ki???n t??? c??c th??ng s??? c???a request
        if($FullName !== "none")
        {
            $searchCon .= "FullName LIKE '%".$FullName."%'";
        }
        if($ClubName !== "none")
        {
            if($searchCon !== "")
            {
                $searchCon .= " AND ClubName = '".$ClubName."'";
            }
            else
            {
                $searchCon .= "ClubName = '".$ClubName."'";
            }
        }
        if($Position !== "none")
        {
            if($searchCon !== "")
            {
                $searchCon .= " AND Position = '".$Position."'";
            }
            else
            {
                $searchCon .= "Position = '".$Position."'";
            }
        }
        if($Number !== "none")
        {
            if($searchCon !== "")
            {
                $searchCon .= " AND Number = '".$Number."'";
            }
            else
            {
                $searchCon .= "Number = '".$Number."'";
            }
        }
        if($Nationality !== "none")
        {
            if($searchCon !== "")
            {
                $searchCon .= " AND Nationality = '".$Nationality."'";
            }
            else
            {
                $searchCon .= "Nationality = '".$Nationality."'";
            }
        }
        if($searchCon ==="")
        {
            $data = PlayerModel::listAll(2);
            echo json_encode($data);

        }else{
            $data = PlayerModel::getPlayersWithCondition($searchCon);
            echo json_encode($data);
        }
    }

    public function addPlayerPage(){
        $allClub = ClubModel::getAllClub();
        $data ='please fill all the information on the form above';
        $VIEW = "./view/newPlayerForm.phtml";
        require("./template/template.phtml");
    }



    public function add()
    {
        $data = "";
        $allClub = ClubModel::getAllClub();
        if (isset($_REQUEST["PlayerID"]))
        {
            $pl= new PlayerModel();
            $pl->PlayerID = $_REQUEST["PlayerID"];
            $pl->FullName = $_REQUEST["FullName"];
            $pl->ClubID = $_REQUEST["ClubID"];
            $pl->Position = $_REQUEST["Position"];
            $pl->Nationality = $_REQUEST["Nationality"];
            $pl->Number = $_REQUEST["Number"];
            $result = PlayerModel::addPlayer($pl);
            if ($result == 1)
                $data = "ADD PLAYER SUCCESSFULLY";
            else
                $data = "ADD PLAYER FAILS";                
        }
        
        $VIEW = "./view/newPlayerForm.phtml";
        require("./template/template.phtml");
    }


    public function editPlayerPage(){
        $allClub = ClubModel::getAllClub();
        $player = PlayerModel::findByID($_REQUEST["PlayerID"]);
        $data ='please fill all the information on the form above';
        $VIEW = "./view/editPlayerInfo.phtml";
        require("./template/template.phtml");

    }
    public function editPlayerFromForm(){
        $player = new PlayerModel();
        $player->PlayerID = $_REQUEST["PlayerID"];
        $player->FullName = $_REQUEST["FullName"];
        $player->ClubID = $_REQUEST["ClubID"];
        $player->Position = $_REQUEST["Position"];
        $player->Number = $_REQUEST["Number"];  
        $player->Nationality = $_REQUEST["Nationality"];
        $result = PlayerModel::updatePlayer($player);
        $data = '';
        if($result){
            $data = 'updated';
        }else{
            $data = 'update failed';
        }
        $player = PlayerModel::findByID($_REQUEST["PlayerID"]);
        $allCLUB = ClubModel::getAllClub();
        $VIEW = "./view/editPlayerInfo.phtml";
        require("./template/template.phtml");

    }
    public function show()
    {
        $MSSV = $_REQUEST["MSSV"];
        $data = SinhVienModel::get($MSSV);
        $VIEW = "./view/ThongTinSV.phtml";
        require("./template/template.phtml");
    }

    public function delete()
    {
        $MSSV = $_REQUEST["MSSV"];
        $result = SinhVienModel::delete($MSSV);        
        $data = SinhVienModel::listAll();        
        $VIEW = "./view/DanhSachSV.phtml";
        require("./template/template.phtml");
    }
    public function deleteMultiplePlayer(){
        $listPlayer = array();
        $number = $_REQUEST["numberToDelete"];
        for($i = 1; $i <= $number; $i++){
            $listPlayer[] = $_REQUEST["PlayerID".$i];
        }
        $result = PlayerModel::deleteMultiplePlayer($listPlayer);
        if($result){
            echo "success";
        }else{
            echo "failed";
        }
    }
}
?>