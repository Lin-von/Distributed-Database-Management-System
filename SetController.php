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

    public function addSup($supname,$connector,$tel,$address,$note){
        if(addsup($supname,$connector,$tel,$address,$note))  header( "Location: supinfo.php" );

    }

    public function updateSup($id,$supname,$connector,$tel,$address,$note){
        if(updatesup($id,$supname,$connector,$tel,$address,$note)) header( "Location: supinfo.php" );
    }


    public function delSup($id){
        if(delsup($id))             header( "Location: supinfo.php" );

    }


    public function addCli($cliname,$connector,$tel,$address,$note){
        if(addcli($cliname,$connector,$tel,$address,$note))  header( "Location: cliinfo.php" );

    }

    public function updateCli($id,$cliname,$connector,$tel,$address,$note){
        if(updatecli($id,$cliname,$connector,$tel,$address,$note)) header( "Location: cliinfo.php" );
    }


    public function delCli($id){
        if(delcli($id))             header( "Location: cliinfo.php" );

    }


}