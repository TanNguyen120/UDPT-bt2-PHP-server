<?php

use LDAP\Result;

class PlayerModel
{
    public $PlayerID;
    public $FullName;
    public $ClubID;
    public $DOB;
    public $Position;
    public $Nationality;
    public $Number;

    function __construct() {
        $this->PlayerID = "";
        $this->FullName = "";
        $this->ClubID = "";
        $this->DOB = "";
        $this->Position = "";
        $this->Nationality = "";
        $this->Number = "";
    }
    
    // Hàm lấy tất cả các dòng có trong bảng player
    public static function listAll($page) {
        $offset = ($page -1) * 10;
        $mysqli = connectToDb();
        $mysqli->query("SET NAMES utf8");
        // Câu lệnh truy vấn theo cấu trúc SQL
        $query = "SELECT * FROM Player AS P JOIN Club as C on P.CLubID = C.CLubID LIMIT ${offset},10";
        $result = $mysqli->query($query);
        $playerList = array();
        if ($result) 
        {            
            foreach ($result as $row) {
                $player = new PlayerModel();
                $player->PlayerID = $row["PlayerID"];
                $player->FullName = $row["FullName"];
                $player->ClubID = $row["ClubName"];
                $player->Nationality = $row["Nationality"];
                $player->Position = $row["Position"];
                $player->Number = $row["Number"];
                $playerList[] = $player; //add an item into array
            }
        }
        $mysqli->close();
        return $playerList;
    }
    // Hàm trả về tổng số trang của bảng player
    public static function countAllPage() {
        $mysqli = connectToDb();
        $mysqli->query("SET NAMES utf8");
        // Câu lệnh truy vấn theo cấu trúc SQL
        $query = "SELECT COUNT(*) FROM Player";

        // sử dụng fetch array để ta có thể lấy kết quả
        $result = $mysqli->query($query)->fetch_array();
        if($result) {
            // để có được số trang để phân trang ta lấy kết quả chia cho số dòng mỗi lần lấy rồi làm tròn lên 
            $page = ceil(($result[0] /10));
        }
        return $page;
    }

    // Hàm lấy tất cả các player trong đội bóng
    public static function listPlayerFromClub($page, $clubName) {
        $mysqli = connectToDb();
        $offset = ($page -1) * 10;
        $mysqli->query("SET NAMES utf8");
        // Câu lệnh truy vấn theo cấu trúc SQL
        $query = "SELECT * FROM Player AS P JOIN Club as C on P.CLubID = C.CLubID WHERE C.ClubName = '$clubName' LIMIT ${offset},10";
        $result = $mysqli->query($query);
        $playerList = array();
        if ($result) 
        {            
            foreach ($result as $row) {
                $player = new PlayerModel();
                $player->PlayerID = $row["PlayerID"];
                $player->FullName = $row["FullName"];
                $player->Nationality = $row["Nationality"];
                $player->ClubID = $row["ClubName"];
                $player->Number = $row["Number"];
                $player->Position = $row["Position"];
                $playerList[]=$player; //add an item into array
            }
        }
        $mysqli->close();
        return $playerList;
    }


    // hàm đếm tất cả các cầu thủ trong câu lạc bộ
    public static function countPlayerFromClub($clubName) {
        $mysqli = connectToDb();
        $mysqli->query("SET NAMES utf8");
        // Câu lệnh truy vấn theo cấu trúc SQL
        $query = "SELECT COUNT(*) FROM Player AS P JOIN Club as C on P.CLubID = C.CLubID WHERE C.ClubName = '$clubName'";
        // sử dụng fetch array để ta biến dòng sql thành mảng
        $result = $mysqli->query($query)->fetch_array();
        $count = 0;
        if ($result) 
        {            
            $page = ceil(($result[0] /10));
        }
        return $page;
    }


    public static function findName($keyword,$page) {
        $mysqli = connectToDb();        
        $mysqli->query("SET NAMES utf8");
        $offset = ($page -1) * 10;
        $query = "SELECT * FROM Player AS P JOIN Club AS C ON P.ClubID = C.ClubID WHERE FullName LIKE '%$keyword%' LIMIT ${offset},10";
        $result = $mysqli->query($query);
        $playerList = array();
        if ($result) 
        {            
            foreach ($result as $row) {
                $player = new PlayerModel();
                $player->PlayerID = $row["PlayerID"];
                $player->FullName = $row["FullName"];
                $player->Nationality = $row["Nationality"];
                $player->ClubID = $row["ClubName"];
                $player->Number = $row["Number"];
                $player->Position = $row["Position"];
                $playerList[]=$player; //add an item into array
            }
        }
        $mysqli->close();
        return $playerList;
    }

    public static function countPlayerNameSearch($keyword) {
        $mysqli = connectToDb();
        $mysqli->query("SET NAMES utf8");
        // Câu lệnh truy vấn theo cấu trúc SQL
        $query = "SELECT COUNT(*) FROM Player WHERE FullName LIKE '%$keyword%'";
        // sử dụng fetch array để ta biến dòng sql thành mảng
        $result = $mysqli->query($query)->fetch_array();
        
        if ($result) 
        {            
            $page = ceil(($result[0] /10));
        }
        $mysqli->close();
        return $page;
    }

    public static function CountRow() {
        $mysqli = connectToDb();
        $mysqli->query("SET NAMES utf8");
        // Câu lệnh truy vấn theo cấu trúc SQL
        $query = "SELECT COUNT(*) FROM Player";
        // sử dụng fetch array để ta biến dòng sql thành mảng
        $result = $mysqli->query($query);
        $count = $result[0];
        $mysqli->close();
        return $count;
    }

    public static function getAllCountry() {
        $mysqli = connectToDb();
        $mysqli->query("SET NAMES utf8");
        // Câu lệnh truy vấn theo cấu trúc SQL
        $query = "SELECT DISTINCT Nationality FROM Player";
        $result = $mysqli->query($query);
        $countryList = array();
        if($result)
        {
            foreach($result as $row){
                $country = $row["Nationality"];
                $countryList[] = $country;
            }
        }
        $mysqli->close();
        return $countryList; 
    }

        public static function getAllPosition() {
        $mysqli = connectToDb();
        $mysqli->query("SET NAMES utf8");
        // Câu lệnh truy vấn theo cấu trúc SQL
        $query = "SELECT DISTINCT Position FROM Player";
        $result = $mysqli->query($query);
        $mysqli->close();
        $numbers = array();
        if($result)
        {
            foreach($result as $row){
                $number = $row["Position"];
                $numbers[] = $number;
            }
        }
        return $numbers; 
    }


    public static function getAllClub() {
        $mysqli = connectToDb();
        $mysqli->query("SET NAMES utf8");
        // Câu lệnh truy vấn theo cấu trúc SQL
        $query = "SELECT DISTINCT ClubName FROM Club";
        $result = $mysqli->query($query);
        $clubList = array();
        if($result)
        {
            foreach($result as $row){
                $club = $row["ClubName"];
                $clubList[] = $club;
            }
        }
        $mysqli->close();
        return $clubList;
    }
    
    public static function getAllNumber() {
        $mysqli = connectToDb();
        $mysqli->query("SET NAMES utf8");
        // Câu lệnh truy vấn theo cấu trúc SQL
        $query = "SELECT DISTINCT P.Number FROM Player AS P ORDER BY P.Number ASC";
        $result = $mysqli->query($query);
        $mysqli->close();
        return $result;
    }

    public static function getPlayersWithCondition($condition) {
        $mysqli = connectToDb();
        $mysqli->query("SET NAMES utf8");
        // Câu lệnh truy vấn theo cấu trúc SQL
        $query = "SELECT * FROM Player AS P JOIN Club AS C ON P.ClubID = C.ClubID WHERE $condition";
        $result = $mysqli->query($query);
        $playerList = array();
        if ($result) 
        {            
            foreach ($result as $row) {
                $player = new PlayerModel();
                $player->PlayerID = $row["PlayerID"];
                $player->FullName = $row["FullName"];
                $player->Nationality = $row["Nationality"];
                $player->ClubID = $row["ClubName"];
                $player->Number = $row['Number'];
                $player->Position = $row['Position'];
                $playerList[] = $player; //add an item into array
            }
        }
        $mysqli->close();
        return $playerList;
    }
    


    public static function addPlayer($pl)
    {
        $mysqli = connectToDb();        
        $mysqli->query("SET NAMES utf8");

        $FullName = $pl->FullName;
        $ClubID = $pl->ClubID;
        $Number = $pl->Number;
        $Position = $pl->Position;
        $Nationality = $pl->Nationality;
        $PlayerID = $pl->PlayerID;

        $query = "INSERT INTO player (PlayerID, ClubID,FullName,Position,Number,Nationality)".
        "VALUES".
        "('$PlayerID','$ClubID','$FullName','$Position','$Number','$Nationality')";
        
        if (mysqli_query($mysqli, $query))        
            return 1;        
        return 0;
    }

    public static function get($mssv) {
        $mysqli = connectToDb();        
        $mysqli->query("SET NAMES utf8");
        $query = "SELECT * FROM SinhVien WHERE MSSV='$mssv'";
        $result = $mysqli->query($query);
       
        if  ($row = $result->fetch_object() ) {
            $sv = new SinhVienModel();
            $sv->HOTEN = $row->HoTen;
            $sv->MSSV = $row->MSSV;     
            $sv->NGAYSINH = $row->NgaySinh;
            $sv->DIACHI = $row->DiaChi;   
            $sv->DIENTHOAI = $row->DienThoai;   
            $sv->MAKHOA = $row->MaKhoa;   

        }

        $mysqli->close();
        return $sv;
    }

    public static function delete($mssv)
    {
        $mysqli = connectToDb();        
        $mysqli->query("SET NAMES utf8");
        $query = "DELETE FROM SINHVIEN WHERE MSSV=$mssv";
        $r = 0;
        if ($mysqli->query($query))       
            $r = 1;
        $mysqli->close();
        return $r;
        
    }
    public static function findByID($playerID){
        $mysqli = connectToDb();
        $mysqli->query("SET NAMES utf8");
        $query = "SELECT * FROM Player WHERE PlayerID='$playerID'";
        $result = $mysqli->query($query);
        $player = new PlayerModel();
        if ($row = $result->fetch_object() ) {
            $player->PlayerID = $row->PlayerID;
            $player->FullName = $row->FullName;
            $player->Position = $row->Position;
            $player->Number = $row->Number;
            $player->Nationality = $row->Nationality;
            $player->ClubID = $row->ClubID;
        }
        $mysqli->close();
        return $player;
    }
}
?>