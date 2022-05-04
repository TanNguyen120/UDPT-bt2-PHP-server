<?php
function connectToDb()
{
    // các biến để kết nối tới data base được đặt theo đề bài
    $user = "root";
    $pass = "root";
    $db = "footballdb";	
    $mysqli = new mysqli("localhost", $user, $pass, $db );
    if ($mysqli->connect_errno )
    {
        die( "Couldn't connect to MySQL server" );
    }
    return $mysqli;
}
?>