<?php
/**
 * Created by PhpStorm.
 * User: linvon
 * Date: 2018/5/1
 * Time: 15:06
 */

require_once "UserOpreation.php";

class UserController{


    public function Login($username,$password){
        if(LoginCheck($username,$password))  {
            header( "Location: index.php" );
        }
        else header( "Location: signin.html?err=1" );
    }


}