<?php
/**
 * Created by PhpStorm.
 * User: linvon
 * Date: 2018/5/6
 * Time: 19:15
 */

require_once "CenterOperation.php";

class CenterController{


    public function transCageDetail($idstr,$cntstr,$cageout,$trid,$cagein){
        $ctime = time();
        $inid = "CI".$ctime;
        $otid = "CO".$ctime;

        $ids = explode(',',$idstr);
        $cnts = explode(',',$cntstr);
        for($i = 0;$i < count($ids);$i++){
            trCageDetail($inid,$ids[$i],$cnts[$i],$cagein,$trid);
            trCageDetail($otid,$ids[$i],$cnts[$i],$cageout,$trid);

            trCage($ids[$i],$cnts[$i],$cageout,$cagein);

        }

    }


}