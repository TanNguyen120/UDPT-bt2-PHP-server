<?php
    class ClubModel
    {
        public $ClubID;
        public $ClubName;
        public $Stadium;
        public $ShortName;
        public $Coach;

        function __construct() {
            $this->ClubID = "";
            $this->ClubName = "";
            $this->Stadium = "";
            $this->ShortName = "";
            $this->Coach = "";
        }

        // Hàm lấy tất cả các dòng có trong bảng club
        public static function listAll($page) {
            $offset = ($page -1) * 10;
            $mysqli = connectToDb();
            $mysqli->query("SET NAMES utf8");
            // Câu lệnh truy vấn theo cấu trúc SQL
            $query = "SELECT * FROM (Club AS C JOIN Stadium AS S ON S.StadiumID = C.StadiumID) JOIN Coach AS CO ON CO.CoachID = C.CoachID LIMIT ${offset},10";
            $result = $mysqli->query($query);
            $clubList = array();
            if ($result) {
                foreach ($result as $row) {
                    $club = new ClubModel();
                    $club->ClubID = $row["ClubID"];
                    $club->ClubName = $row["ClubName"];
                    $club->Stadium = $row["SName"];
                    $club->ShortName = $row["Shortname"];
                    $club->Coach = $row["CFullName"];
                    $clubList[] = $club; //add an item into array
                }
            }
            $mysqli->close();
            return $clubList;
        }
        public static function getAllClub() {
            $mysqli = connectToDb();
            $mysqli->query("SET NAMES utf8");
            // Câu lệnh truy vấn theo cấu trúc SQL
            $query = "SELECT * FROM (Club AS C JOIN Stadium AS S ON S.StadiumID = C.StadiumID) JOIN Coach AS CO ON CO.CoachID = C.CoachID";
            $result = $mysqli->query($query);
            $clubList = array();
            if ($result) {
                foreach ($result as $row) {
                    $club = new ClubModel();
                    $club->ClubID = $row["ClubID"];
                    $club->ClubName = $row["ClubName"];
                    $club->Stadium = $row["SName"];
                    $club->ShortName = $row["Shortname"];
                    $club->Coach = $row["CFullName"];
                    $clubList[] = $club; //add an item into array
                }
            }
            $mysqli->close();
            return $clubList;
        }
        // Hàm trả về tổng số trang của bảng club
        public static function countAllPage() {
            $mysqli = connectToDb();
            $mysqli->query("SET NAMES utf8");
            // Câu lệnh truy vấn theo cấu trúc SQL
            $query = "SELECT COUNT(*) FROM Club";

            // sử dụng fetch array để ta có thể lấy kết quả
            $result = $mysqli->query($query)->fetch_array();
            if($result) {
                // để có được số trang để phân trang ta lấy kết quả chia cho số dòng mỗi lần lấy và làm tròn lên
                $pageCount = ceil($result[0] / 10);
            }
            $mysqli->close();
            return $pageCount;
        }

        public static function addToDataBase($club,$stadiumID) {
            $mysqli = connectToDb();
            $mysqli->query("SET NAMES utf8");
            $charSplit = str_split($club->Stadium);
            $query = "INSERT INTO Club VALUES ('$club->ClubID','$club->ClubName','$club->ShortName','$stadiumID','$club->Coach')";
            $result = $mysqli->query($query);
            $mysqli->close();
            return $result;
        }
    }
?>