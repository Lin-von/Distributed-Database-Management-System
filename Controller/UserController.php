<?php
/**
 * Created by PhpStorm.
 * User: linvon
 * Date: 2018/5/1
 * Time: 15:06
 */
session_start();
require_once "UserOpreation.php";

class UserController{


    public function Login($username,$password){
        $result = LoginCheck($username,$password);
        $row = $result->fetch_assoc();

        if ($result->num_rows > 0) {
            $_SESSION['user'] = $row['realname'];
            $_SESSION['level'] = $row["uposition"];
            header( "Location: ../index.php" );

        } else {
            header( "Location: ../signin.html?err=1" );
        }

    }


    public function addUser($realname,$tel,$uposition,$username,$password){

        if(adduser($realname,$tel,$uposition,$username,$password))  header( "Location: ../userinfo.php" );

    }

    public function updateUser($id,$realname,$tel,$uposition,$password){
        if(updateuser($id,$realname,$tel,$uposition,$password))  header( "Location: ../userinfo.php" );
    }

    public function delUser($id){
        if(deluser($id))             header( "Location: ../userinfo.php" );

    }
}