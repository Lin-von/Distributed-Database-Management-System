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
mysqli_set_charset ($conn,'utf8');

$sql = "SELECT supname FROM supplier";
$result = $conn->query($sql);
//$row = $result->fetch_assoc();

?>

<!-- main container -->
<div class="content">

    <!-- settings changer -->


    <div class="container-fluid">
        <div id="pad-wrapper" class="users-list">
            <div style="margin-bottom: 30px;" class="row-fluid header">
                <h3 style="margin-bottom: 20px;">配件销售排行</h3>
                <div class="span10 pull-right">
                    <div class="ui-dropdown" style="display: none">
                        <select style="min-height: 30px;margin-top: 0px; width: 150px;" id="cage" onchange="cagechange()" >
                            <option disabled="disabled" value="" selected/>选择仓库
                            <option value=""/>所有仓库
                            <option />成都
                            <option />上海
                            <option />深圳

                        </select>

                    </div>

                    <!-- custom popup filter -->
                    <!-- styles are located in css/elements.css -->
                    <!-- script that enables this dropdown is located in js/theme.js -->



                </div>
            </div>

            <!-- Users table -->

            <?php $sql = "SELECT accid,sum(cnt) FROM outCage_detail GROUP BY accid ORDER BY sum(cnt) DESC	";

            $result = $conn->query($sql);
            //$row = $result->fetch_assoc();

            ?>
            <div class="row-fluid table" id="account" >
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="span2 sortable">
                            配件编号
                        </th>

                        <th class="span2 sortable">
                            <span class="line"></span>配件名称
                        </th>
                        <th class="span2 sortable">
                            <span class="line"></span>进价
                        </th>
                        <th class="span2 sortable">
                            <span class="line"></span>售价
                        </th>
                        <th class="span2 sortable">
                            <span class="line"></span>销售量
                        </th>
                        <th class="span2 sortable">
                            <span class="line"></span>销售额
                        </th>
                        <th class="span2 sortable">
                            <span class="line"></span>总利润
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
                        <td><?php echo $row["accid"];?></td>
                        <td></td>
                        <td>


                        </td>
                        <td>


                        </td>
                        <td>
                            <?php echo $row["sum(cnt)"];?>

                        </td>
                        <td>


                        </td>
                        <td>


                        </td>


                    </tr>

                    <?php     }
                    } else { ?>
                        <tr  ><td>没有记录</td></tr>
                        <?php

                    }
                    ?>

                    </tbody>
                </table>

            </div>
            <?php
            $sql = "SELECT accid,sum(cnt),province FROM outCage_detail GROUP BY accid,province ORDER BY sum(cnt) DESC";

            $result = $conn->query($sql);
            //$row = $result->fetch_assoc();
            $conn->close();
            ?>
            <div class="row-fluid table" id="goods" style="display: none">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="span2 sortable">
                            配件编号
                        </th>

                        <th class="span2 sortable">
                            <span class="line"></span>配件名称
                        </th>
                        <th class="span2 sortable">
                            <span class="line"></span>进价
                        </th>
                        <th class="span2 sortable">
                            <span class="line"></span>售价
                        </th>
                        <th class="span2 sortable">
                            <span class="line"></span>销售量
                        </th>
                        <th class="span2 sortable">
                            <span class="line"></span>销售额
                        </th>
                        <th class="span2 sortable">
                            <span class="line"></span>总利润
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
                                <td><?php echo $row["accid"];?></td>
                                <td></td>
                                <td>


                                </td>
                                <td>


                                </td>
                                <td>
                                    <?php echo $row["sum(cnt)"];?>

                                </td>
                                <td>


                                </td>
                                <td>


                                </td>
                                <td style="display:none;"><?php echo $row["province"];?></td>
                            </tr>

                        <?php     }
                    } else { ?>
                        <tr  ><td>没有记录</td></tr>
                        <?php

                    }
                    ?>

                    </tbody>
                </table>

            </div>


            <!-- row -->

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
    var accname = new Array();
    var accprice = new Array();
    var accclass = new Array();
    var accpriceo = new Array();
    $.ajax({
        type: 'POST',
        url: 'http://111.230.12.120/Controller/Controller.php?controller=Set&method=showAccInfo',
        async: false,
        success: function (data) {
            var str = data;
            infoobj = JSON.parse(str);
            for(var i=0;i<infoobj.length;i++){
               // console.log(infoobj[i].accname);

                accname[infoobj[i].id] = infoobj[i].accname;
                accprice[infoobj[i].id] = infoobj[i].pricein;
                accclass[infoobj[i].id] = infoobj[i].classname;
                accpriceo[infoobj[i].id] = infoobj[i].priceout;
            }

        }
    });

    var list = document.getElementsByTagName('table')[0].getElementsByTagName('tbody')[0].rows;
    var size = list.length;
    var tr;
    for(var i = 0; i < size; i++) {
        tr = list[i];
        var id = tr.cells[0].innerText;
        // console.log(accname);
        tr.cells[1].innerText = accname[id];
        tr.cells[2].innerText = accprice[id];
        tr.cells[3].innerText = accpriceo[id];
        tr.cells[5].innerText = parseInt(accpriceo[id])*parseInt(tr.cells[4].innerText);
        tr.cells[6].innerText = (parseInt(accpriceo[id])-parseInt(accprice[id]))*parseInt(tr.cells[4].innerText);

    }



    var list = document.getElementsByTagName('table')[1].getElementsByTagName('tbody')[0].rows;
    var size = list.length;
    var tr;
    for(var i = 0; i < size; i++) {
        tr = list[i];
        var id = tr.cells[0].innerText;
       // console.log(accname);
        tr.cells[1].innerText = accname[id];
        tr.cells[2].innerText = accprice[id];
        tr.cells[3].innerText = accpriceo[id];
        tr.cells[5].innerText = parseInt(accpriceo[id])*parseInt(tr.cells[4].innerText);
        tr.cells[6].innerText = (parseInt(accpriceo[id])-parseInt(accprice[id]))*parseInt(tr.cells[4].innerText);

    }


</script>
<script type="text/javascript">
    function filter(fn) {

         list = document.getElementsByTagName('table')[1].getElementsByTagName('tbody')[0].rows;
         size = list.length;

        for( i = 0; i < size; i++) {
            tr = list[i];
            tr.removeAttribute('class', 'hide')
            if(!fn(tr)) {
                tr.setAttribute('class', 'hide');
            }
        }
    }

    function search(prv) {
        filter(function(tr) {
            if(prv && tr.cells[7].innerHTML != prv) {
                return false;
            }
            return true;
        });
    }

    function show(num) {


        if(num===1) {
            document.getElementById('account').style.display = "";
            document.getElementById('goods').style.display = "none";
        }
        else{


            document.getElementById('account').style.display = "none";
            document.getElementById('goods').style.display = "";
        }

    }
    function cagechange() {
        var prv = document.getElementById('cage').value;
        if(prv == "所有仓库") show(1);
        else {
            search(prv);
            show(2);
        }

    }

    function makeSortable(table) {
        var headers=table.getElementsByTagName("th");
        for(var i=0;i<headers.length;i++){
            (function(n){
                var flag=false;
                headers[n].onclick=function(){
                    // sortrows(table,n);
                    var tbody=table.tBodies[0];//第一个<tbody>
                    var rows=tbody.getElementsByTagName("tr");//tbody中的所有行
                    rows=Array.prototype.slice.call(rows,0);//真实数组中的快照

                    //基于第n个<td>元素的值对行排序
                    rows.sort(function(row1,row2){
                        var cell1=row1.getElementsByTagName("td")[n];//获得第n个单元格
                        var cell2=row2.getElementsByTagName("td")[n];
                        var val1=cell1.textContent||cell1.innerText;//获得文本内容
                        var val2=cell2.textContent||cell2.innerText;

                        if(val1<val2){
                            return -1;
                        }else if(val1>val2){
                            return 1;
                        }else{
                            return 0;
                        }
                    });
                    if(flag){
                        rows.reverse();
                    }
                    //在tbody中按它们的顺序把行添加到最后
                    //这将自动把它们从当前位置移走，故没必要预先删除它们
                    //如果<tbody>还包含了除了<tr>的任何其他元素，这些节点将会悬浮到顶部位置
                    for(var i=0;i<rows.length;i++){
                        tbody.appendChild(rows[i]);
                    }

                    flag=!flag;
                }
            }(i));
        }
    }

    makeSortable(document.getElementsByTagName('table')[0]);
    makeSortable(document.getElementsByTagName('table')[1]);
</script>


</body>
</html>