<?php
    class UserModel
    {
        public $userid;
        public $name;
        public $password;
        public $status;

        function __construct() {
            $this->userid = "";
            $this->name = "";
            $this->password = "";
            $this->status = "";
        }


        public static function insert(UserModel $user) {
            $mysqli = connectToDb();
            $mysqli->query("SET NAMES utf8");
            $query = "INSERT INTO User VALUES (NULL, '$user->name', '$user->password', '$user->status')";
            $result = $mysqli->query($query);
            $mysqli->close();
            return $result;
        }

        public static function findByName(String $user) {
            $mysqli = connectToDb();
            $mysqli->query("SET NAMES utf8");
            $query = "SELECT * FROM User WHERE name = '$user'";
            $result = $mysqli->query($query)->fetch_object();
            $mysqli->close();
            $user = new UserModel();
            $user->userid = $result->userid;
            $user->name = $result->name;
            $user->password = $result->password;
            $user->status = $result->status;
            return $user;
        }
    }
?>