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
    document.getElementById('forcage').className = "active";

</script>


<!-- main container -->
    <div class="content">
        
        <!-- settings changer -->

        
        <div class="container-fluid">
            <div id="pad-wrapper" class="users-list">
                <div style="margin-bottom: 30px;" class="row-fluid header">
                    <h3 style="margin-bottom: 20px;">当前仓库信息</h3>
                    <div class="span10 pull-right">
                        <input id="accid" style="margin-bottom: 0; max-width: 25%;" type="text" class="span5 " placeholder="输入配件编号" />
                        <input id="accname" style="margin-bottom: 0; max-width: 20%;" type="text" class="span5 " placeholder="输入配件名称" />
                        <input id="classname" style="margin-bottom: 0; max-width: 20%;" type="text" class="span5 " placeholder="输入类别" />
                        <input id="status" style="margin-bottom: 0; max-width: 20%;" type="text" class="span5 " placeholder="输入状态" />

                        <div class="btn-glow" onclick="search()"><i class="icon-search" ></i></div>
                    </div>
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


                $sql = "SELECT * FROM cage";

                $result = $conn->query($sql);
                //$row = $result->fetch_assoc();
                $conn->close();
                ?>
                <!-- Users table -->
                <div class="ui-dropdown" style="display: none">
                    <select style="min-height: 30px;margin-bottom: 10px;" id="cage" onchange="search()">
                        <option disabled="disabled" value="" selected/>按仓库查看
                        <option value=""/>所有仓库
                        <option />成都
                        <option />上海
                        <option />深圳

                    </select>
                </div>
                <div class="row-fluid table">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="span1 sortable">
                                    配件编号
                                </th>

                                <th class="span1 sortable">
                                    <span class="line"></span>名称
                                </th>
                                <th class="span1 sortable">
                                    <span class="line"></span>类别
                                </th>
                                <th class="span1 sortable">
                                    <span class="line"></span>库存量
                                </th>
                                <th class="span1 sortable">
                                    <span class="line"></span>进价
                                </th>
                                <th class="span1 sortable">
                                    <span class="line"></span>售价
                                </th>
                                <th class="span1 sortable">
                                    <span class="line"></span>总值
                                </th>
                                <th class="span2 sortable">
                                    <span class="line"></span>状态
                                </th>
                                <th class="span1 sortable">
                                    <span class="line"></span>仓库
                                </th>
                                <th class="span2 sortable ">
                                    <span class="line"></span>操作
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
                                    <td><?php echo $row["id"];?></td>
                                    <td>


                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                        <?php echo $row["cnt"];?>

                                    </td>
                                    <td>
                                        <?php echo $row["operator"];?>

                                    </td>
                                    <td>

                                    </td>

                                    <td>

                                    </td>
                                    <td><?php echo $row["status"];?>

                                    </td>
                                    <td><?php echo $row["province"];?>

                                    </td>
                                    <td >
                                        <div class="btn-glow" onclick="oopen('<?php echo $row["id"];?>')" style="margin-left: 0px;"><i class="icon-search" ></i> 查看详情</div>

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

        function oopen(recordid) {
            var width=Math.round((window.screen.width-600)/2);
            var height=Math.round((window.screen.height-400)/2);
            window.open('accdetail.php?id='+recordid,'title','height=400,width=600,top='+height+',left='+width+',toolbar=no,menubar=no,scrollbars=no,resizable=no,location=no,status=no');
        }


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
            var accname = document.getElementById('accname').value;
            var classname = document.getElementById('classname').value;
            var accid = document.getElementById('accid').value;
            var cage = document.getElementById('cage').value;
            var status = document.getElementById('status').value;
            filter(function(tr) {

                if(accid && tr.cells[0].innerHTML.indexOf(accid) < 0) {
                    return false;
                }
                if(accname && tr.cells[1].innerHTML.indexOf(accname) < 0) {
                    return false;
                }
                if(classname && tr.cells[2].innerHTML.indexOf(classname) < 0) {
                    return false;
                }
                if(status && tr.cells[7].innerHTML.indexOf(status) < 0) {
                    return false;
                }

                if(cage && tr.cells[8].innerHTML.indexOf(cage) < 0) {
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
            url: 'http://111.230.12.120/Controller/Controller.php?controller=Set&method=showAccInfo',
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
            tr.cells[4].innerText = accprice[id];
            tr.cells[5].innerText = accpriceo[id];
            tr.cells[6].innerText = parseInt(accpriceo[id])*parseInt(tr.cells[3].innerText);

            //    tr.cells[4].innerText = accpriceo[id];
        }
    </script>

</body>
</html>