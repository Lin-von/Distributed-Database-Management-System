<?php
/**
 * Created by PhpStorm.
 * User: linvon
 * Date: 2018/4/17
 * Time: 01:37
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
mysqli_set_charset ($conn,utf8);

$username = $_SESSION['user'];
$realname = $_POST['realname'];
$tel = $_POST['tel'];
$password = $_POST['password'];

$sql = "UPDATE users SET realname = '$realname', tel = '$tel', password = '$password' WHERE username = '$username'";
echo $sql;
$result = $conn->query($sql);

// print_r($row);
header("location:setting.php");

$conn->close();