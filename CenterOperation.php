<?php
/**
 * Created by PhpStorm.
 * User: linvon
 * Date: 2018/5/6
 * Time: 19:17
 */

require_once "CDb.php";

function trCageDetail($recordid,$accid,$cnt,$province,$trid){
    $db = new CDb();
    $ctime = time().$province;
    $sql = "INSERT INTO trCage_detail (id, recordid, accid, cnt ,province,trid) 
              VALUES ('$ctime' ,'$recordid','$accid',$cnt,'$province','$trid')";

    if ($db->query($sql) === TRUE)  return true ;
    else return false;
}

function trCage($id,$cnt,$cageout,$cagein){
    $db = new CDb();


    $sql = "SELECT cnt FROM cage WHERE id='$id' and status = '周转备用新件' and province = '$cageout'";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();
    $newcnt = $row['cnt'] - $cnt;
    $sql = "UPDATE  cage set cnt = $newcnt WHERE id='$id' and status = '周转备用新件' and province = '$cageout'";
    $db->query($sql);




    $sql = "SELECT cnt FROM cage WHERE id='$id' and status = '周转备用新件' and province = '$cagein'";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $newcnt = $row['cnt'] + $cnt;
        $sql = "UPDATE  cage set cnt = $newcnt WHERE id='$id' and status = '周转备用新件' and province = '$cagein'";
        if ($db->query($sql) === TRUE) return true;
        else return false;
    } else {
        $ctime = time();
        $sql = "INSERT INTO cage (priid, id, cnt, province, status) 
              VALUES ('$ctime','$id',$cnt,'$cagein','周转备用新件')";
        if ($db->query($sql) === TRUE) return true;
        else return false;
    }



}