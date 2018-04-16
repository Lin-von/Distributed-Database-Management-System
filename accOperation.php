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
        $oldstatus = $_GET['oldstatus'];
        $id = $_GET['id'];
        $sql = "UPDATE accessory SET status = '$status' WHERE id = '$id'";
        $result = $conn->query($sql);

        $sql = "SELECT max(id) FROM record";
        $result = $conn->query($sql);
        $row = $result->fetch_row();
        $maxid=$row[0]+1;
        $opedate = date("Y-m-d H:i:s",time());
        $sql = "INSERT INTO record (id, accid, operation, opedate , oldstatus , newstatus) VALUES ($maxid, $id, 2,'$opedate','$oldstatus','$status')";
        $result = $conn->query($sql);

        header( "Location: cage-local.php" );
        break;
    }
    case 2:{
        $id = $_GET['id'];
        $sql = "DELETE FROM accessory WHERE id = '$id' ";
        $result = $conn->query($sql);

        $sql = "SELECT max(id) FROM record";
        $result = $conn->query($sql);
        $row = $result->fetch_row();
        $maxid=$row[0]+1;
        $opedate = date("Y-m-d H:i:s",time());
        $sql = "INSERT INTO record (id, accid, operation, opedate) VALUES ($maxid, $id, 4,'$opedate')";
        $result = $conn->query($sql);

        header( "Location: cage-local.php" );
        break;
    }
    case 3:{


        $name = $_GET['name'];
        $status = $_GET['status'];
        $describe = $_GET['describe'];
        $id = (time()-1522512000)*10+1;
        $sql = "INSERT INTO accessory (id, accname, status, accdescribe , province) VALUES ($id, '$name', '$status','$describe','shanghai')";
        // echo $id."<br>".$name."<br>".$status."<br>".$describe;
        if ($conn->query($sql) === TRUE) {

            $sql = "SELECT max(id) FROM record";
            $result = $conn->query($sql);
            $row = $result->fetch_row();
            $maxid=$row[0]+1;
            $sql = "SELECT max(id) FROM accessory";
            $result = $conn->query($sql);
            $row = $result->fetch_row();
            $id=$row[0];

            $opedate = date("Y-m-d H:i:s",time());
            $sql = "INSERT INTO record (id, accid, operation, opedate , accto) VALUES ($maxid, $id, 1,'$opedate' , 'shanghai')";
            $result = $conn->query($sql);


            header( "Location: new-acc.php?mes=1" );
        } else {
            header( "Location: new-acc.php?mes=2" );
        }
    }
}


$conn->close();
?>