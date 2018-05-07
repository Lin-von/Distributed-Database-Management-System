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
    $ctime = time();
    $sql = "INSERT INTO inCage_detail (id, recordid, accid, cnt ,province,supplier) 
              VALUES ('$ctime' ,'$recordid','$accid',$cnt,'$province','$supplier')";

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
        $ctime = time();
        $sql = "INSERT INTO cage (priid, id, cnt, province, status) 
              VALUES ('$ctime','$id',$cnt,'$province','周转备用新件')";
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
    $ctime = time();

    $sql = "INSERT INTO ibCage_detail (id, recordid, accid, cnt ,province,supplier) 
              VALUES ('$ctime' ,'$recordid','$accid',$cnt,'$province','$supplier')";

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

function outCageRecord($id,$client,$province,$operator,$opedate,$cost){
    $db = new Db();

    $sql = "INSERT INTO outCage (id, client, province, opedate , operator, cost) 
              VALUES ('$id','$client','$province','$opedate','$operator',$cost)";

    if ($db->query($sql) === TRUE)  return true ;
    else return false;

}

function outCageDetail($recordid,$accid,$cnt,$province,$client){
    $db = new Db();
    $ctime = time();

    $sql = "INSERT INTO outCage_detail (id, recordid, accid, cnt ,province,client) 
              VALUES ('$ctime' ,'$recordid','$accid',$cnt,'$province','$client')";

    if ($db->query($sql) === TRUE)  return true ;
    else return false;
}

function OutCage($id,$cnt){
    $db = new Db();
    $sql = "SELECT cnt FROM cage WHERE id='$id' and status = '周转备用新件'";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();
    $newcnt = $row['cnt'] - $cnt;
    $sql = "UPDATE  cage set cnt = $newcnt WHERE id='$id' and status = '周转备用新件'";
    if ($db->query($sql) === TRUE)  return true ;
    else return false;

}

function showOutSum($client){
    $db = new Db();

    $sql = "select accid,sum(cnt) from outCage_detail where client = '$client' group by accid";
    $result = $db->query($sql);
    $array = array();
    while($row = $result->fetch_assoc()) $array[$row['accid']] = $row['sum(cnt)'];
    return $array;
}

function showObSum($client){
    $db = new Db();

    $sql = "select accid,sum(cnt) from obCage_detail where client = '$client' group by accid";
    $result = $db->query($sql);
    $array = array();
    while($row = $result->fetch_assoc()) array_push($array,$row);
    return $array;
}

function outCageBRecord($id,$client,$province,$operator,$opedate,$cost){
    $db = new Db();

    $sql = "INSERT INTO obCage (id, client, province, opedate , operator, cost) 
              VALUES ('$id','$client','$province','$opedate','$operator',$cost)";

    if ($db->query($sql) === TRUE)  return true ;
    else return false;

}

function outCageBDetail($recordid,$accid,$cnt,$province,$client){
    $db = new Db();
    $ctime = time();

    $sql = "INSERT INTO obCage_detail (id, recordid, accid, cnt ,province,client) 
              VALUES ('$ctime' ,'$recordid','$accid',$cnt,'$province','$client')";

    if ($db->query($sql) === TRUE)  return true ;
    else return false;
}

function OutCageB($id,$cnt,$province){


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
        $ctime = time();

        $sql = "INSERT INTO cage (priid, id, cnt, province, status) 
              VALUES ('$ctime','$id',$cnt,'$province','周转备用新件')";
        if ($db->query($sql) === TRUE)  return true ;
        else return false;
    }
}

function statusChaRecord($id,$province,$operator,$opedate){
    $db = new Db();

    $sql = "INSERT INTO statusChange (id, province, opedate , operator) 
              VALUES ('$id','$province','$opedate','$operator')";

    if ($db->query($sql) === TRUE)  return true ;
    else return false;
}

function statusChaDetail($recordid,$accid,$cnt,$province){
    $db = new Db();
    $ctime = time();

    $sql = "INSERT INTO statusChange_detail (id, recordid, accid, cnt ,province, fromto) 
              VALUES ('$ctime' ,'$recordid','$accid',$cnt,'$province','$province')";

    if ($db->query($sql) === TRUE)  return true ;
    else return false;
}

function StatusChange($id,$cnt,$operation,$status,$province)
{
    $db = new Db();
    if ($operation == "配件报溢") {

        $sql = "SELECT cnt FROM cage WHERE id='$id' and status = '周转备用新件'";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        $newcnt = $row['cnt'] + $cnt;
        $sql = "UPDATE  cage set cnt = $newcnt WHERE id='$id' and status = '周转备用新件'";
        if ($db->query($sql) === TRUE) return true;
        else return false;

    } else {
        $sql = "SELECT cnt FROM cage WHERE id='$id' and status = '周转备用新件'";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        $newcnt = $row['cnt'] - $cnt;
        $sql = "UPDATE  cage set cnt = $newcnt WHERE id='$id' and status = '周转备用新件'";
        $db->query($sql);


        $sql = "SELECT cnt FROM cage WHERE id='$id' and status = '$status'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $newcnt = $row['cnt'] + $cnt;
            $sql = "UPDATE  cage set cnt = $newcnt WHERE id='$id' and status = '$status'";
            if ($db->query($sql) === TRUE) return true;
            else return false;
        } else {
            $ctime = time();

            $sql = "INSERT INTO cage (priid, id, cnt, province, status) 
              VALUES ('$ctime','$id',$cnt,'$province','$status')";
            if ($db->query($sql) === TRUE) return true;
            else return false;
        }

    }
}
function trCageRecord($trid,$cageout,$cagein,$cnt,$operator,$opedate){
    $db = new Db();

    $sql = "INSERT INTO trCage (id, opedate , operator,cageout,cagein,cnt) 
              VALUES ('$trid','$opedate','$operator','$cageout','$cagein',$cnt)";


    if ($db->query($sql) === TRUE)  return true ;
    else return false;
}


function showacccnt($id){
    $db = new Db();

    $sql = "SELECT cnt FROM cage WHERE status = '周转备用新件' and id = '$id'";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();
    return $row['cnt'];
}
