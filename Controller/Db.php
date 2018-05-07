<?php
/**
 * Created by PhpStorm.
 * User: linvon
 * Date: 2018/5/1
 * Time: 15:39
 */

//数据库操作管理类
class Db{
   //数据库联接
   var $conn;
   //初始化
   function __construct(){

       header("Content-Type: text/html;charset=utf-8");

       $servername = "localhost:3306";
       $username = "root";
       $password = "123";
       $dbname = "db";
// 创建连接
       $this->conn = new mysqli($servername, $username, $password, $dbname);
// 检测连接
       if ($this->conn->connect_error) {
           die("连接失败: " . $this->conn->connect_error);
       }
       mysqli_set_charset ($this->conn,utf8);

   }

   function query($sql){
       $result = $this->conn->query($sql);
       return $result;
   }
}
?>
