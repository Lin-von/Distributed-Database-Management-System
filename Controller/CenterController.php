<?php
require_once "CenterOperation.php";
class CenterController{


    public function transCage($cageout,$operator,$cagein,$cnt){
        $ctime = time();
        $trid = "TR".$ctime;
        $opedate = date("Y-m-d H:i:s",time());
        trCageRecord($trid,$cageout,$cagein,$cnt,$operator,$opedate);
        echo $trid;
    }

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