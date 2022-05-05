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
    public static function listAll() {
        $mysqli = connectToDb();
        $mysqli->query("SET NAMES utf8");
        // Câu lệnh truy vấn theo cấu trúc SQL
        $query = "SELECT * FROM Player AS Pl JOIN Club as Cl on PL.CLubID = Cl.CLubID LIMIT 10";
        $result = $mysqli->query($query);
        $playerList = array();
        if ($result) 
        {            
            foreach ($result as $row) {
                $player = new PlayerModel();
                $player->PlayerID = $row["PlayerID"];
                $player->FullName = $row["FullName"];
                $player->ClubID = $row["ClubName"];
                $player->DOB = $row["DOB"];
                $player->Position = $row["Position"];
                $player->Number = $row["Number"];
                $playerList[] = $player; //add an item into array
            }
        }
        $mysqli->close();
        return $playerList;
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