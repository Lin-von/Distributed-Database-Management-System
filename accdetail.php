<!DOCTYPE html>
<html lang="en">
<head>
    <title>配件明细</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- bootstrap -->
    <link href="css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="css/bootstrap/bootstrap-responsive.css" rel="stylesheet" />
    <link href="css/bootstrap/bootstrap-overrides.css" type="text/css" rel="stylesheet" />

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="css/layout.css" />
    <link rel="stylesheet" type="text/css" href="css/elements.css" />
    <link rel="stylesheet" type="text/css" href="css/icons.css" />

    <!-- libraries -->
    <link href="css/lib/font-awesome.css" type="text/css" rel="stylesheet" />

    <!-- this page specific styles -->
    <link rel="stylesheet" href="css/compiled/user-list.css" type="text/css" media="screen" />


    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>

    <![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>

<div class="content" style="margin: 0; min-height: 350px;">

    <!-- settings changer -->

<?php $id= $_GET['id'];?>
    <div class="container-fluid">
        <div id="pad-wrapper" class="users-list" style="margin-top: 20px;">
            <div style="margin-bottom: 0px;" class="row-fluid header">
                <h4 style="margin-bottom: 10px;" id="accid">配件编号:<?php echo $id;?></h4>

            </div>
            <h5 style="float: left;margin-left: 20px;margin-bottom: 20px;" id="accname">配件名称:</h5>
            <h5 style="float: left;margin-left: 20px;margin-bottom: 20px;" id="classname">类别:</h5>
            <h5 style="float: left;margin-left: 20px;margin-bottom: 20px;" id="pricein">进价:</h5>
            <h5 style="float: left;margin-left: 20px;margin-bottom: 20px;" id="priceout">售价:</h5>
            <!-- Users table -->
            <div class="ui-dropdown">
                <select style="min-height: 30px;margin-bottom: 10px;" id="cage" onchange="search()">
                    <option disabled="disabled" selected/>按仓库查看
                    <option value=""/>所有仓库
                    <option />成都
                    <option />上海
                    <option />深圳

                </select>
            </div>
            <?php
            header("Content-Type: text/html;charset=utf-8");
            $servername = "localhost:3306";
            $username = "root";
            $password = "123";
            $dbname = "db";
            // 创建连接
            $conn = new mysqli($servername, $username, $password, $dbname);
            // 检测连接
            if ($conn->connect_error) {
                die("连接失败: " . $conn->connect_error);
            }
            mysqli_set_charset ($conn,utf8);


            $sql = "select inCage.`opedate`,inCage_detail.* from inCage,inCage_detail where inCage.`id`=inCage_detail.`recordid` and inCage_detail.`accid` = '$id'
union
select ibCage.`opedate`,ibCage_detail.* from ibCage,ibCage_detail where ibCage.`id`=ibCage_detail.`recordid` and ibCage_detail.`accid` = '$id'
union
select obCage.`opedate`,obCage_detail.* from obCage,obCage_detail where obCage.`id`=obCage_detail.`recordid` and obCage_detail.`accid` = '$id'
union
select outCage.`opedate`,outCage_detail.* from outCage,outCage_detail where outCage.`id`=outCage_detail.`recordid` and outCage_detail.`accid` = '$id'
union
select statusChange.`opedate`,statusChange_detail.* from statusChange,statusChange_detail where statusChange.`id`=statusChange_detail.`recordid` and statusChange_detail.`accid` = '$id'
union
select trCage.`opedate`,trCage.`cageout`,trCage_detail.`recordid`,trCage_detail.`accid`,trCage_detail.`cnt`,trCage_detail.`province`,trCage.`cagein` from trCage,trCage_detail where trCage.`id`=trCage_detail.`trid`  and trCage_detail.`accid` = '$id' order by opedate desc";

            $result = $conn->query($sql);
            //$row = $result->fetch_assoc();
            $conn->close();
            ?>
            <!-- Users table -->
            <div class="row-fluid table">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="span2 sortable">
                            日期
                        </th>

                        <th class="span2 sortable">
                            <span class="line"></span>流水单号
                        </th>

                        <th class="span2 sortable">
                            <span class="line"></span>说明
                        </th>
                        <th class="span2 sortable">
                            <span class="line"></span>来源/去向
                        </th>

                        <th class="span2 sortable">
                            <span class="line"></span>操作量
                        </th>
                        <th class="span2 sortable">
                            <span class="line"></span>总值
                        </th>
                        <th class="span2 sortable">
                            <span class="line"></span>仓库
                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    <!-- row -->
                    <?php
                    if ($result->num_rows > 0) {
                    // 输出每行数据
                    while($row = $result->fetch_assoc()) { ?>
                    <tr  >
                        <td><?php echo $row["opedate"];?></td>
                        <td><?php echo $row["recordid"];?>
                        </td>

                        <td>
                            <?php
                            switch (substr($row['recordid'],0,2)){
                                case "IN": {echo "采购进货"; break;}
                                case "IB": {echo "采购退货"; break;}
                                case "OT": {echo "配件销售"; break;}
                                case "Ob": {echo "客户退货"; break;}
                                case "SO": {echo "配件报旧"; break;}
                                case "SF": {echo "配件报修"; break;}
                                case "SD": {echo "配件报损"; break;}
                                case "SU": {echo "配件报溢"; break;}
                                case "CI": {echo "调拨入库"; break;}
                                case "CO": {echo "调拨出库"; break;}


                            }
                            ?>

                        </td>
                        <td>
                            <?php
                            if(substr($row['recordid'],0,2)=='CI') echo $row['id'];
                            else echo $row["supplier"];?>
                        </td>
                        <td><?php echo $row["cnt"];?></td>

                        <td>

                        </td>
                        <td>
                            <?php echo $row["province"];?>
                        </td>

                    </tr>



            </div>

        <?php     }
        } else { ?>
            <tr  ><td>没有记录</td></tr>
            <?php

        }
        ?>

            <!-- row -->

            </tbody>
            </table>
        </div>

        <!-- end users table -->
    </div>
</div>
</div>
<!-- end main container -->


<!-- scripts -->
<script src="js/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/theme.js"></script>
<script type="text/javascript">

    function filter(fn) {
        var list = document.getElementsByTagName('table')[0].getElementsByTagName('tbody')[0].rows;
        var size = list.length;
        var tr;
        for(var i = 0; i < size; i++) {
            tr = list[i];
            tr.removeAttribute('class', 'hide')
            if(!fn(tr)) {
                tr.setAttribute('class', 'hide');
            }
        }
    }
    function search() {
        var cage = document.getElementById('cage').value;
        filter(function(tr) {

            if(cage && tr.cells[6].innerHTML.indexOf(cage) < 0) {
                return false;
            }


            return true;
        });
    }

    var accname = new Array();
    var accprice = new Array();
    var accclass = new Array();
    var accpriceo = new Array();
    $.ajax({
        type: 'POST',
        url: 'Controller/Controller.php?controller=Set&method=showAccInfo',
        async:false,
        success: function (data) {
            var str = data;
            infoobj = JSON.parse(str);
            for(var i=0;i<infoobj.length;i++){
                accname[infoobj[i].id] = infoobj[i].accname;
                accprice[infoobj[i].id] = infoobj[i].pricein;
                accclass[infoobj[i].id] = infoobj[i].classname;
                accpriceo[infoobj[i].id] = infoobj[i].priceout;
            }
        }
    });

    var id = document.getElementById('accid').innerText.substr(5);
    document.getElementById('accname').innerText = "配件名称:"+accname[id];
    document.getElementById('classname').innerText = "类别:"+accclass[id];
    document.getElementById('pricein').innerText = "进价:"+accprice[id];
    document.getElementById('priceout').innerText = "售价:"+accpriceo[id];

    var list = document.getElementsByTagName('table')[0].getElementsByTagName('tbody')[0].rows;
    var size = list.length;
    var tr;
    for(var i = 0; i < size; i++) {
        tr = list[i];
        tr.cells[5].innerText = parseInt(accpriceo[id])*parseInt(tr.cells[4].innerText);
    }
</script>

</body>
</html>