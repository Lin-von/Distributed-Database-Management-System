<?php
/**
 * Created by PhpStorm.
 * User: linvon
 * Date: 2018/5/1
 * Time: 20:41
 */

require_once "SetOperation.php";

class SetController{


    public function showAccInfo(){

       echo showAccinfo();
    }

    public function showClassName(){
        echo showClassname();
    }

    public function addAcc($accname,$classname,$pricein,$priceout,$lowrange,$uprange,$note){
        $id = time();
        if (addacc($id,$accname,$classname,$pricein,$priceout,$lowrange,$uprange,$note))
            header( "Location: accinfo.php" );
    }

    public function updateAcc($id,$accname,$classname,$pricein,$priceout,$lowrange,$uprange,$note){

        if (updateacc($id,$accname,$classname,$pricein,$priceout,$lowrange,$uprange,$note))
            header( "Location: accinfo.php" );

    }

    public function delAcc($id){
        if(delacc($id))             header( "Location: accinfo.php" );

    }

}