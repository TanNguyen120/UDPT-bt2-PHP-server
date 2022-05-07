<?php
    class CoachModel
    {
        public $CoachID;
        public $CFullName;
        public $Nationality;

        function __construct() {
            $this->CoachID = "";
            $this->CFullName= "";
            $this->Nationality = "";
        }

        // Hàm lấy tất cả các dòng có trong bảng Coach
        public static function listAll() {
            $mysqli = connectToDb();
            $mysqli->query("SET NAMES utf8");
            // Câu lệnh truy vấn theo cấu trúc SQL
            $query = "SELECT * FROM Coach";
            $result = $mysqli->query($query);
            $coachList = array();
            if ($result) {
                foreach ($result as $row) {
                    $coach = new CoachModel();
                    $coach->CoachID = $row["CoachID"];
                    $coach->CFullName = $row["CFullName"];
                    $coach->Nationality = $row["Nationality"];
                    $coachList[] = $coach; //add an item into array
                }
            }
            $mysqli->close();
            return $coachList;
        }
    }
?>