<?php
/**
 * Created by PhpStorm.
 * User: linvon
 * Date: 2018/5/4
 * Time: 20:47
 */

require_once "CageOperation.php";

class CageController{

    public function inCage($idstr,$cntstr,$supplier,$operator,$cost){
        $id = "IN".time();
        $province = "成都";
        $opedate = date("Y-m-d H:i:s",time());
        InCageRecord($id,$supplier,$province,$operator,$opedate,$cost);

        $ids = explode(',',$idstr);
        $cnts = explode(',',$cntstr);
        for($i = 0;$i < count($ids);$i++){
            inCageDetail($id,$ids[$i],$cnts[$i],$province,$supplier);
            InCage($ids[$i],$cnts[$i],$province);
        }

    }

    public function showInBack($supplier){
        $insum = showInSum($supplier);
        $ibsum = showIbSum($supplier);
        for($i=0;$i<count($ibsum);$i++){
            $insum[$ibsum[$i]['accid']] -= $ibsum[$i]['sum(cnt)'];
            if($insum[$ibsum[$i]['accid']] == 0 ) unset($insum[$ibsum[$i]['accid']]);
        }
        $cagesum = showCageSum();
        $result=array_intersect_key($insum,$cagesum);
        $temp = array();
        $i = 0;
        foreach ($result as $key=>$value){
            if($cagesum[$key]<$value) $result[$key] = $cagesum[$key];
            if($result[$key] == 0) continue;
            $temp[$i]['id']=$key;
            $temp[$i++]['cnt']=$result[$key];

        }


        $jsonde = json_encode($temp);
        echo $jsonde;

    }

    public function inCageBack($idstr,$cntstr,$supplier,$operator,$cost){
        $id = "IB".time();
        $province = "成都";
        $opedate = date("Y-m-d H:i:s",time());
        InCageBRecord($id,$supplier,$province,$operator,$opedate,$cost);

        $ids = explode(',',$idstr);
        $cnts = explode(',',$cntstr);
        for($i = 0;$i < count($ids);$i++){
            inCageBDetail($id,$ids[$i],$cnts[$i],$province,$supplier);
            InCageB($ids[$i],$cnts[$i]);
        }
    }
}