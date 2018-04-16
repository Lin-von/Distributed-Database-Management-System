<?php
/**
 * Created by PhpStorm.
 * User: linvon
 * Date: 2018/4/17
 * Time: 01:51
 */


session_start();
unset($_SESSION['user']);
unset($_SESSION['level']);
header( "Location: index.php" );
