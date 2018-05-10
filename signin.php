<?php
/**
 * Created by PhpStorm.
 * User: linvon
 * Date: 2018/4/15
 * Time: 14:46
 */
session_start();
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
mysqli_set_charset ($conn,'utf8');


$uname = $_POST["username"];
$upwd = $_POST["password"];
$sql = "SELECT * FROM users WHERE username = '$uname' AND password = '$upwd'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if ($result->num_rows > 0) {
    $_SESSION['user'] = "$uname";
    $_SESSION['level'] = $row["level"];
    header( "Location: ../index.php" );
} else {
    header( "Location: ../signin.html?err=1" );
}
$conn->close();
?>