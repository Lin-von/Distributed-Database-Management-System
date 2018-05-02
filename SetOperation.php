<?php
/**
 * Created by PhpStorm.
 * User: linvon
 * Date: 2018/5/1
 * Time: 20:41
 */
require_once "Db.php";
function showAccinfo(){
    $db = new Db();

    $sql = "SELECT * FROM accInfo";
    $result = $db->query($sql);
    $array = array();
    while($row = $result->fetch_assoc()) array_push($array,$row);
    $jsonde = json_encode($array);

    return $jsonde;
}


function showClassname(){
    $db = new Db();

    $sql = "SELECT * FROM accClass";
    $result = $db->query($sql);
    $array = array();
    while($row = $result->fetch_assoc()) array_push($array,$row);
    $jsonde = json_encode($array);
    echo $jsonde;
   // return $jsonde;
}

function addacc($id,$accname,$classname,$pricein,$priceout,$lowrange,$uprange,$note){
    $db = new Db();

    $sql = "INSERT INTO accInfo (id, accname, classname, pricein , priceout, lowrange, uprange, note ) 
              VALUES ('$id','$accname','$classname',$pricein,$priceout,$lowrange,$uprange,'$note')";

    if ($db->query($sql) === TRUE)  return true ;
    else return false;

}

function updateacc($id,$accname,$classname,$pricein,$priceout,$lowrange,$uprange,$note){
    $db = new Db();

    $sql = "UPDATE accInfo SET accname = '$accname', classname = '$classname', pricein = $pricein, priceout = $priceout, lowrange = $lowrange, uprange = $uprange , note = '$note'
WHERE id = '$id'";
    if ($db->query($sql) === TRUE)  return true ;
    else return false;

}

function delacc($id){
    $db = new Db();

    $sql = "DELETE FROM accInfo WHERE id = '$id' ";
    if ($db->query($sql) === TRUE)  return true ;
    else return false;
}

