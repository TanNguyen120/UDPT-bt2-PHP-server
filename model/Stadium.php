<?php
    class StadiumModel
    {
        public $StadiumID;
        public $SName;
        public $City;

        function __construct() {
            $this->StadiumID = "";
            $this->SName= "";
            $this->City = "";
        }

        // Hàm lấy tất cả các dòng có trong bảng STADIUM
        public static function listAll() {
            $mysqli = connectToDb();
            $mysqli->query("SET NAMES utf8");
            // Câu lệnh truy vấn theo cấu trúc SQL
            $query = "SELECT * FROM Stadium";
            $result = $mysqli->query($query);
            $stadiumList = array();
            if ($result) {
                foreach ($result as $row) {
                    $stadium = new StadiumModel();
                    $stadium->StadiumID = $row["StadiumID"];
                    $stadium->SName = $row["SName"];
                    $stadium->City = $row["City"];
                    $stadiumList[] = $stadium; //add an item into array
                }
            }
            $mysqli->close();
            return $stadiumList;
        }
    }
?>