<?php
class CDb{
    //数据库联接
    public $conn;
    //初始化
    function __construct(){

        header("Content-Type: text/html;charset=utf-8");

        $servername = "localhost:8066";
        $username = "root";
        $password = "123";
        $dbname = "TESTDB";
// 创建连接
        $this->conn = new mysqli($servername, $username, $password, $dbname);
// 检测连接
        if ($this->conn->connect_error) {
            die("连接失败: " . $this->conn->connect_error);
        }
        mysqli_set_charset ($this->conn,'utf8');

    }

    function query($sql){
        $result = $this->conn->query($sql);
        return $result;
    }
}
?>
