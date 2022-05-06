<?php

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


    public static function find($keyword) {
        $mysqli = connectToDb();        
        $mysqli->query("SET NAMES utf8");
        $query = "SELECT * FROM SinhVien WHERE HoTen LIKE '%$keyword%'";
        $result = $mysqli->query($query);
        $dssv = array();
        if ($result) 
        {            
            foreach ($result as $row) {
                $sv = new SinhVienModel();
                $sv->HOTEN = $row["HoTen"];
                $sv->MSSV = $row["MSSV"];     
                $dssv[] = $sv; //add an item into array
            }
        }
        $mysqli->close();
        return $dssv;
    }

    public static function add($sv)
    {
        $mysqli = connectToDb();        
        $mysqli->query("SET NAMES utf8");

        $mssv = $sv->MSSV;
        $hoten = $sv->HOTEN;
        $ngaysinh = $sv->NGAYSINH;
        $diachi = $sv->DIACHI;
        $dienthoai = $sv->DIENTHOAI;
        $makhoa = $sv->MAKHOA;

        $query = "INSERT INTO SINHVIEN values ($mssv, '$hoten', '$ngaysinh', '$diachi', '$dienthoai', '$makhoa')";
        
        if ($mysqli->query($query))        
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
}
?>