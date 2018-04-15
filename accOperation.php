<?php
/**
 * Created by PhpStorm.
 * User: linvon
 * Date: 2018/4/15
 * Time: 23:34
 */


header("Content-Type: text/html;charset=utf-8");

$servername = "localhost:3306";
$username = "root";
$password = "123";
$dbname = "db";
// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
mysqli_set_charset ($conn,utf8);

$method = $_GET['method'];
switch ($method){
    case 1:{
        $status = $_GET['status'];
        $id = $_GET['id'];
        $sql = "UPDATE accessory SET status = '$status' WHERE id = '$id'";
        $result = $conn->query($sql);
        header( "Location: cage-local.php" );
        break;
    }
    case 2:{
        $id = $_GET['id'];
        $sql = "DELETE FROM accessory WHERE id = '$id' ";
        $result = $conn->query($sql);
        header( "Location: cage-local.php" );
        break;
    }
}


$conn->close();
?>