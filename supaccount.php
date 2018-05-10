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
    document.getElementById('forbuy').className = "active";

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
                <h3 style="margin-bottom: 20px;">供货商往来账务</h3>
                <div class="span10 pull-right">
                    <div class="ui-dropdown">
                        <select style="min-height: 30px;margin-top: 0px; width: 150px;" id="supname" onchange="supchange()" >
                            <option disabled="disabled"  selected/>选择供货商
                            <?php
                            if ($result->num_rows > 0) {
                                // 输出每行数据
                                while($row = $result->fetch_assoc())  {
                                    ?>
                                    <option /> <?php echo $row["supname"];?>
                                <?php     }
                            }
                            ?>


                        </select>

                    </div>

                </div>
            </div>

            <!-- Users table -->
            <a  id="addbutton" onclick="show(1)" class="btn-flat success pull-left">

                查看单据
            </a><a style="margin: 0px 0px 20px 10px;"  id="addbutton" onclick="show(2)" class="btn-flat success pull-left">

                查看供货
            </a>
            <?php $sql = "SELECT * FROM inCage UNION SELECT * FROM ibCage ORDER BY opedate DESC	";

            $result = $conn->query($sql);
            //$row = $result->fetch_assoc();

            ?>
            <div class="row-fluid table" id="account" style="display: none">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="span2 sortable">
                            流水单号
                        </th>

                        <th class="span2 sortable">
                            <span class="line"></span>供货商
                        </th>
                        <th class="span2 sortable">
                            <span class="line"></span>说明
                        </th>
                        <th class="span2 sortable">
                            <span class="line"></span>金额
                        </th>
                        <th class="span2 sortable">
                            <span class="line"></span>时间
                        </th>
                        <th class="span2 sortable">
                            <span class="line"></span>经办人
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
                        <td>
                            <?php echo $row["id"];?>

                        </td>
                        <td><?php echo $row["supplier"];?></td>
                        <td>
                            <?php if(substr($row['id'],0,2)=="IN") echo "进货"; else echo "退货";?>

                        </td>
                        <td>
                            <?php echo $row["cost"];?>

                        </td>
                        <td>
                            <?php echo $row["opedate"];?>

                        </td>
                        <td>
                            <?php echo $row["operator"];?>

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
            $sql = "select accid,sum(cnt),supplier from inCage_detail  group by accid,supplier";

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
                            <span class="line"></span>配件类别
                        </th>
                        <th class="span2 sortable">
                            <span class="line"></span>进价
                        </th>
                        <th class="span2 sortable">
                            <span class="line"></span>售价
                        </th>
                        <th class="span2 sortable">
                            <span class="line"></span>数量
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
                                <td style="display: none"><?php echo $row["supplier"];?></td>

                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>
                                    <?php echo $row["sum(cnt)"];?>

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
    accname = new Array();
    accprice = new Array();
    accclass = new Array();
    accpriceo = new Array();
    $.ajax({
        type: 'POST',
        url: 'Controller/Controller.php?controller=Set&method=showAccInfo',
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

    var list = document.getElementsByTagName('table')[1].getElementsByTagName('tbody')[0].rows;
    var size = list.length;
    var tr;
    for(var i = 0; i < size; i++) {
        tr = list[i];
        var id = tr.cells[0].innerText;
       // console.log(accname);
        tr.cells[2].innerText = accname[id];
        tr.cells[3].innerText = accclass[id];
        tr.cells[4].innerText = accprice[id];
        tr.cells[5].innerText = accpriceo[id];
    }


</script>
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

    function search() {
        var sup = document.getElementById('supname').value;

        //var course = document.getElementById('course').value;
        filter(function(tr) {


            if(sup && tr.cells[1].innerHTML != sup) {
                return false;
            }


            return true;
        });
    }
    flag = 0;
    function show(num) {
        if(document.getElementById('supname').value == "选择供货商") {
            alert("请选择供货商！");
            return;
        }

        if(num===1) {
            document.getElementById('account').style.display = "";
            document.getElementById('goods').style.display = "none";
        }
        else{


            document.getElementById('account').style.display = "none";
            document.getElementById('goods').style.display = "";
        }

    }
    function supchange() {

        search();

        if(flag==0) show(1);

    }
</script>


</body>
</html>