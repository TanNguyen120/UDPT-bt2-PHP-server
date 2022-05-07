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
        $VIEW = "./view/addClubPage.phtml";
        require("./template/template.phtml");
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