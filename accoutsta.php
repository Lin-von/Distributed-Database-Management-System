<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<title>售后配件库管理系统</title>
    
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

    <![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>

<!-- navbar -->
<?php require_once "navbar.html";?>

<!-- end navbar -->

<!-- sidebar -->
<?php require_once "sidebar.html";?>
<script type="text/javascript">
    document.getElementById('forsta').className = "active";

</script>


<!-- main container -->
    <div class="content">
        
        <!-- settings changer -->

        
        <div class="container-fluid">
            <div id="pad-wrapper" class="users-list">
                <div style="margin-bottom: 30px;" class="row-fluid header">
                    <h3 style="margin-bottom: 20px;">配件销售统计</h3>
                    <div class="span10 pull-right">
                        <input id="accname" style="margin-bottom: 0; max-width: 30%;" type="text" class="span5 " placeholder="输入配件名称" />

                        <div class="btn-glow" onclick="search()"><i class="icon-search" ></i></div>
                    </div>
                </div>
                <?php
                header("Content-Type: text/html;charset=utf-8");
                $servername = "localhost:8066";
                $username = "root";
                $password = "123";
                $dbname = "TESTDB";
                // 创建连接
                $conn = new mysqli($servername, $username, $password, $dbname);
                // 检测连接
                if ($conn->connect_error) {
                    die("连接失败: " . $conn->connect_error);
                }
                mysqli_set_charset ($conn,'utf8');


                $sql = "select outCage.*,outCage_detail.* from outCage,outCage_detail where outCage.`id`=outCage_detail.`recordid`
union
select obCage.*,obCage_detail.* from obCage,obCage_detail where obCage.`id`=obCage_detail.`recordid`
order by opedate desc";

                $result = $conn->query($sql);
                //$row = $result->fetch_assoc();
                $conn->close();
                ?>
                <div style="margin-bottom: 10px;">  查询日期： <input id="start_time" type="date" style="margin:0 5px 0 0 ;height: 10px;">至<input id="end_time" type="date" style="margin:0 0 0 5px;height: 10px;">
                </div>
                <div class="ui-dropdown">
                    <select style="min-height: 30px;margin-bottom: 10px;" id="cage" onchange="search()">
                        <option disabled="disabled" value="" selected/>按仓库查看
                        <option value=""/>所有仓库
                        <option />成都
                        <option />上海
                        <option />深圳

                    </select>
                </div>
                <!-- Users table -->
                <div class="row-fluid table">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="span1 sortable">
                                    日期
                                </th>
                                <th class="span1 sortable">
                                    <span class="line"></span>流水单号
                                </th>

                                <th class="span1 sortable">
                                    <span class="line"></span>配件编号
                                </th>
                                <th class="span1 sortable">
                                    <span class="line"></span>配件名称
                                </th>
                                <th class="span1 sortable">
                                    <span class="line"></span>客户
                                </th>
                                <th class="span1 sortable">
                                    <span class="line"></span>说明
                                </th>
                                <th class="span1 sortable">
                                    <span class="line"></span>售价
                                </th>
                                <th class="span1 sortable">
                                    <span class="line"></span>操作量
                                </th>
                                <th class="span1 sortable">
                                    <span class="line"></span>利润
                                </th>
                                <th class="span1 sortable">
                                    <span class="line"></span>经办人
                                </th>
                                <th class="span1 sortable">
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
                                    <td><?php echo $row["recordid"];?></td>
                                    <td><?php echo $row["accid"];?></td>
                                    <td>


                                    </td>
                                    <td><?php echo $row["supplier"];?></td>
                                    <td>
                                        <?php
                                            switch (substr($row['recordid'],0,2)){
                                                case "IN": {echo "采购进货"; break;}
                                                case "IB": {echo "采购退货"; break;}
                                                case "OT": {echo "配件销售"; break;}
                                                case "OB": {echo "客户退货"; break;}
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


                                    </td>
                                    <td><?php echo $row["cnt"];?></td>

                                    <td>

                                    </td>
                                    <td>
                                        <?php echo $row["operator"];?>
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
        function CompareDate(d1,d2)
        {
            return ((new Date(d1.replace(/-/g,"\/"))) > (new Date(d2.replace(/-/g,"\/"))));
        }
        function search() {
            var accname = document.getElementById('accname').value;
            var cage = document.getElementById('cage').value;

            var stime = document.getElementById('start_time').value;
            var etime = document.getElementById('end_time').value;
            if(CompareDate(stime,etime)) {alert("起始日期不能大于终止日期！"); return;}
            filter(function(tr) {
                if(stime && CompareDate(stime,tr.cells[0].innerText)) {
                    return false;
                }
                if(etime && CompareDate(tr.cells[0].innerText,etime)) {
                    return false;
                }
                if(accname && tr.cells[3].innerHTML.indexOf(accname) < 0) {
                    return false;
                }
                if(cage && tr.cells[10].innerHTML.indexOf(cage) < 0) {
                    return false;
                }
                return true;
            });
        }

        var accname = new Array();
        var accpriceo = new Array();
        var accprice = new Array();
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
                    accpriceo[infoobj[i].id] = infoobj[i].priceout;
                }
            }
        });


        var list = document.getElementsByTagName('table')[0].getElementsByTagName('tbody')[0].rows;
        var size = list.length;
        var tr;
        for(var i = 0; i < size; i++) {
            tr = list[i];
            var id = tr.cells[2].innerText;
            tr.cells[3].innerText = accname[id];
            tr.cells[6].innerText = accpriceo[id];
            tr.cells[8].innerText = (parseInt(accpriceo[id])-parseInt(accprice[id]))*parseInt(tr.cells[7].innerText);

        }
    </script>

</body>
</html>