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
    // hàm này chỉ thực hiện việc tạo view đến trang search player name
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

        // phần tạo điều kiện từ các thông số của request
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
    }

    public function add()
    {
        $data = "";
        if (isset($_REQUEST["MSSV"]))
        {
            $sv = new SinhVienModel();
            $sv->MSSV = $_REQUEST["MSSV"];
            $sv->HOTEN = $_REQUEST["HoTen"];
            $sv->NGAYSINH = $_REQUEST["NgaySinh"];
            $sv->DIACHI = $_REQUEST["DiaChi"];
            $sv->DIENTHOAI = $_REQUEST["DienThoai"];
            $sv->MAKHOA = $_REQUEST["MaKhoa"];
            $result = SinhVienModel::add($sv);
            if ($result == 1)
                $data = "Thêm thành công";
            else
                $data = "Thêm bị lỗi";                
        }
        
        $VIEW = "./view/ThemSinhVien.phtml";
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
}
?>