<?php

class SinhVienModel
{
    public $MSSV;
    public $HOTEN;
    
    function __construct() {
        $this->MSSV = "";
        $this->HOTEN = "";
        $this->NGAYSINH = "";
        $this->DIACHI = "";
        $this->DIENTHOAI = "";
        $this->MAKHOA = "";
    }
    
    public static function listAll() {
        $mysqli = connect();
        $mysqli->query("SET NAMES utf8");
        $query = "SELECT * FROM SinhVien";
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
    public static function find($keyword) {
        $mysqli = connect();
        
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
        $mysqli = connect();
        
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
        $mysqli = connect();
        
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
        $mysqli = connect();
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
