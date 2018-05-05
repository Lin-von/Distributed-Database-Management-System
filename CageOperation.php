<?php
/**
 * Created by PhpStorm.
 * User: linvon
 * Date: 2018/5/4
 * Time: 20:47
 */

require_once "Db.php";

function InCageRecord($id,$supplier,$province,$operator,$opedate,$cost){
    $db = new Db();

    $sql = "INSERT INTO inCage (id, supplier, province, opedate , operator, cost) 
              VALUES ('$id','$supplier','$province','$opedate','$operator',$cost)";

    if ($db->query($sql) === TRUE)  return true ;
    else return false;

}

function inCageDetail($recordid,$accid,$cnt,$province,$supplier){
    $db = new Db();

    $sql = "INSERT INTO inCage_detail (id, recordid, accid, cnt ,province,supplier) 
              VALUES (NULL ,'$recordid','$accid',$cnt,'$province','$supplier')";

    if ($db->query($sql) === TRUE)  return true ;
    else return false;
}

function InCage($id,$cnt,$province){
    $db = new Db();
    $sql = "SELECT cnt FROM cage WHERE id='$id' and status = '周转备用新件'";
    $result = $db->query($sql);
    if($result->num_rows>0) {
        $row = $result->fetch_assoc();
        $newcnt = $row['cnt'] + $cnt;
        $sql = "UPDATE  cage set cnt = $newcnt WHERE id='$id' and status = '周转备用新件'";
        if ($db->query($sql) === TRUE)  return true ;
        else return false;
    }
    else{
        $sql = "INSERT INTO cage (id, cnt, province, status) 
              VALUES ('$id',$cnt,'$province','周转备用新件')";
        if ($db->query($sql) === TRUE)  return true ;
        else return false;
    }

}
function showInSum($supplier){
    $db = new Db();

    $sql = "select accid,sum(cnt) from inCage_detail where supplier = '$supplier' group by accid";
    $result = $db->query($sql);
    $array = array();
    while($row = $result->fetch_assoc()) $array[$row['accid']] = $row['sum(cnt)'];
    return $array;
}

function showIbSum($supplier){
    $db = new Db();

    $sql = "select accid,sum(cnt) from ibCage_detail where supplier = '$supplier' group by accid";
    $result = $db->query($sql);
    $array = array();
    while($row = $result->fetch_assoc()) array_push($array,$row);
    return $array;
}

function showCageSum(){
    $db = new Db();

    $sql = "select id,cnt from cage where status = '周转备用新件' ";
    $result = $db->query($sql);
    $array = array();
    while($row = $result->fetch_assoc()) $array[$row['id']] = $row['cnt'];
    return $array;

}

function InCageBRecord($id,$supplier,$province,$operator,$opedate,$cost){
    $db = new Db();

    $sql = "INSERT INTO ibCage (id, supplier, province, opedate , operator, cost) 
              VALUES ('$id','$supplier','$province','$opedate','$operator',$cost)";

    if ($db->query($sql) === TRUE)  return true ;
    else return false;

}

function inCageBDetail($recordid,$accid,$cnt,$province,$supplier){
    $db = new Db();

    $sql = "INSERT INTO ibCage_detail (id, recordid, accid, cnt ,province,supplier) 
              VALUES (NULL ,'$recordid','$accid',$cnt,'$province','$supplier')";

    if ($db->query($sql) === TRUE)  return true ;
    else return false;
}

function InCageB($id,$cnt){
    $db = new Db();
    $sql = "SELECT cnt FROM cage WHERE id='$id' and status = '周转备用新件'";
    $result = $db->query($sql);
    if($result->num_rows>0) {
        $row = $result->fetch_assoc();
        $newcnt = $row['cnt'] - $cnt;
        $sql = "UPDATE  cage set cnt = $newcnt WHERE id='$id' and status = '周转备用新件'";
        if ($db->query($sql) === TRUE)  return true ;
        else return false;
    }
    else{
        return false;
    }
}