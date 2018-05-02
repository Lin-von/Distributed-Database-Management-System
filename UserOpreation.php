<?php
/**
 * Created by PhpStorm.
 * User: linvon
 * Date: 2018/5/1
 * Time: 15:35
 */
session_start();
require_once "Db.php";

function LoginCheck($uname,$upwd){
    $db = new Db();

    $sql = "SELECT * FROM users WHERE username = '$uname' AND password = '$upwd'";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();

    if ($result->num_rows > 0) {
        $_SESSION['user'] = $uname;
        $_SESSION['level'] = $row["level"];
        return true;

    } else {
        return false;
    }
}

