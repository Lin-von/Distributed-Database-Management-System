<?php
/**
 * Created by PhpStorm.
 * User: linvon
 * Date: 2018/4/16
 * Time: 22:11
 */

header("Content-Type: text/html;charset=utf-8");

$servername = "localhost:8066";
$username = "root";
$password = "123";
$dbname = "TESTDB";
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
        $idstr = $_GET['idstr'];
        $ids = explode(',',$idstr);
        $province = $_GET['province'];

        foreach ($ids as $id){
            $sql = "SELECT * FROM accessory WHERE id = '$id' ";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();


            $sql = "DELETE FROM accessory WHERE id = '$id' ";
            $result = $conn->query($sql);

            $name = $row['accname'];
            $status = $row['status'];
            $describe = $row['describe'];
            $accfrom = $row['province'];
            $sql = "INSERT INTO accessory (id, accname, status, accdescribe , province) VALUES ($id, '$name', '$status','$describe','$province')";
            $result = $conn->query($sql);

            $sql = "SELECT max(id) FROM record";
            $result = $conn->query($sql);
            $row = $result->fetch_row();
            $maxid=$row[0]+1;
            $opedate = date("Y-m-d H:i:s",time());

            $sql = "INSERT INTO record (id, accid, operation, opedate , accfrom , accto ,province) VALUES ($maxid, $id, 3,'$opedate','$accfrom','$province','$province')";
            echo $sql;
            $result = $conn->query($sql);
        }


        header( "Location: transfer.php" );
        break;
    }
    case 2:{
        $describe = $_GET['describe'];
        $id = $_GET['id'];
        $sql = "UPDATE accessory SET accdescribe = '$describe' WHERE id = '$id'";
        $result = $conn->query($sql);
        header( "Location: detail.php?id=".$id );
        break;
    }

}


$conn->close();
?>