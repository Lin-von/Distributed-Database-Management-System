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

    public function outCage($idstr,$cntstr,$client,$operator,$cost){
        $id = "OT".time();
        $province = "成都";
        $opedate = date("Y-m-d H:i:s",time());
        outCageRecord($id,$client,$province,$operator,$opedate,$cost);

        $ids = explode(',',$idstr);
        $cnts = explode(',',$cntstr);
        for($i = 0;$i < count($ids);$i++){
            outCageDetail($id,$ids[$i],$cnts[$i],$province,$client);
            OutCage($ids[$i],$cnts[$i]);
        }
    }

    public function showOutBack($client){
        $insum = showOutSum($client);
        $ibsum = showObSum($client);
        for($i=0;$i<count($ibsum);$i++){
            $insum[$ibsum[$i]['accid']] -= $ibsum[$i]['sum(cnt)'];
            if($insum[$ibsum[$i]['accid']] == 0 ) unset($insum[$ibsum[$i]['accid']]);
        }

        $temp = array();
        $i = 0;
        foreach ($insum as $key=>$value){
            if($insum[$key] == 0) continue;
            $temp[$i]['id']=$key;
            $temp[$i++]['cnt']=$insum[$key];

        }


        $jsonde = json_encode($temp);
        echo $jsonde;

    }

    public function outCageBack($idstr,$cntstr,$client,$operator,$cost){
        $id = "OB".time();
        $province = "成都";
        $opedate = date("Y-m-d H:i:s",time());
        outCageBRecord($id,$client,$province,$operator,$opedate,$cost);

        $ids = explode(',',$idstr);
        $cnts = explode(',',$cntstr);
        for($i = 0;$i < count($ids);$i++){
            outCageBDetail($id,$ids[$i],$cnts[$i],$province,$client);
            OutCageB($ids[$i],$cnts[$i],$province);
        }
    }

    public function statusChange($idstr,$cntstr,$operation,$operator){
        switch ($operation){
            case "配件报旧":{
                $id = "SO".time();
                $status = "周转备用旧件";
            break;
            }
            case "配件报修":{
                $id = "SF".time();
                $status = "返修配件";
                break;
            }
            case "配件报损":{
                $id = "SD".time();
                $status = "报损件";
                break;
            }
            case "配件报溢":{
                $id = "SU".time();
                $status = "周转备用新件";
                break;
            }
        }

        $province = "成都";
        $opedate = date("Y-m-d H:i:s",time());
        statusChaRecord($id,$province,$operator,$opedate);

        $ids = explode(',',$idstr);
        $cnts = explode(',',$cntstr);
        for($i = 0;$i < count($ids);$i++){
            statusChaDetail($id,$ids[$i],$cnts[$i],$province);

            StatusChange($ids[$i],$cnts[$i],$operation,$status,$province);
        }


    }



    public function showAccCnt($id){
        echo showacccnt($id);
    }


}