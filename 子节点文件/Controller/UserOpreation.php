<?php
/**
 * Created by PhpStorm.
 * User: linvon
 * Date: 2018/5/1
 * Time: 15:35
 */

require_once "Db.php";

function LoginCheck($uname,$upwd){
    $db = new Db();

    $sql = "SELECT * FROM users WHERE username = '$uname' AND password = '$upwd'";
    $result = $db->query($sql);
    return $result;


}

function adduser($realname,$tel,$uposition,$username,$password){
    $db = new Db();

    $sql = "INSERT INTO users (id, username, password,  uposition, realname ,tel ) 
              VALUES (NULL ,'$username','$password','$uposition','$realname','$tel')";

    if ($db->query($sql) === TRUE)  return true ;
    else return false;
}

function updateuser($id,$realname,$tel,$uposition,$password){
    $db = new Db();

    $sql = "UPDATE users SET realname = '$realname', uposition = '$uposition',tel = '$tel',password = '$password'
WHERE id = $id";
    if ($db->query($sql) === TRUE)  return true ;
    else return false;
}

function deluser($id){
    $db = new Db();

    $sql = "DELETE FROM users WHERE id = $id ";
    if ($db->query($sql) === TRUE)  return true ;
    else return false;
}