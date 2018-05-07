<!DOCTYPE html>
<html lang="en">
<head>
    <title>单据详情</title>

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

    $id = $_GET['id'];
    if($id)
    $sql = "SELECT * FROM inCage WHERE id = '$id'
            UNION SELECT * FROM outCage WHERE id = '$id'";

    $result = $conn->query($sql);
    $info = $result->fetch_assoc();

    $sql = "SELECT * FROM inCage_detail WHERE recordid = '$id' 
            UNION 
            SELECT * FROM outCage_detail WHERE recordid = '$id' ";


    $result = $conn->query($sql);
    //$row = $result->fetch_assoc();
    $conn->close();
    ?>

    <div class="container-fluid">
        <div id="pad-wrapper" class="users-list" style="margin-top: 20px;">
            <div style="margin-bottom: 0px;" class="row-fluid header">
                <h4 style="margin-bottom: 10px;">流水单号:<?php echo $info["id"];?></h4>

            </div>
            <h5 style="float: left;margin-left: 20px;margin-bottom: 20px;">供货商/客户:<?php if($info["supplier"] == "") echo $info["client"]; else echo $info["supplier"]; ?></h5>
            <h5 style="float: left;margin-left: 20px;">金额:<?php echo $info["cost"];?></h5>
            <h5 style="float: left;margin-left: 20px;">经办人:<?php echo $info["operator"];?></h5>
            <h5 style="float: right;margin-left: 20px;">时间:<?php echo $info["opedate"];?></h5>
            <!-- Users table -->
            <div class="row-fluid table">
                <table class="table table-hover" id="info">
                    <thead>
                    <tr>
                        <th class="span2 sortable">
                            编号
                        </th>

                        <th class="span2 sortable">
                            <span class="line"></span>名称
                        </th>
                        <th class="span2 sortable">
                            <span class="line"></span>类别
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
                    <tr >
                        <td><?php echo $row["accid"];?></td>
                        <td>

                        </td>
                        <td>


                        </td>
                        <td>


                        </td>
                        <td>


                        </td>
                        <td >
                            <?php echo $row["cnt"];?>
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


                <a style="margin-top: 40px;"  id="addbutton" onclick="window.close()" class="btn-flat success pull-right">

                    关闭窗口
                </a>
            </div>
            <!-- end users table -->
        </div>
    </div>
</div>
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
        url: 'Controller.php?controller=Set&method=showAccInfo',
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


    var list = document.getElementsByTagName('table')[0].getElementsByTagName('tbody')[0].rows;
    var size = list.length;
    var tr;
    for(var i = 0; i < size; i++) {
        tr = list[i];
        var id = tr.cells[0].innerText;
        tr.cells[1].innerText = accname[id];
        tr.cells[2].innerText = accclass[id];
        tr.cells[3].innerText = accprice[id];
        tr.cells[4].innerText = accpriceo[id];
    }

</script>
</body>
</html>