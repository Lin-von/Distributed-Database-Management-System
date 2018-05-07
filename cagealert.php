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
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>

<!-- navbar -->
<div class="navbar navbar-inverse">
    <div class="navbar-inner">
        <button type="button" class="btn btn-navbar visible-phone" id="menu-toggler">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <ul class="nav pull-right" style="float: right">

            <li class="dropdown">
                <a href="#" class="dropdown-toggle " data-toggle="dropdown">
                    欢迎您，<?php  echo $_SESSION['user']; ?>

                </a>

            </li>
            <li class="settings ">
                <a href="setting.php" role="button">
                    <i class="icon-cog"></i>
                </a>
            </li>
            <li class="settings ">
                <a href="signout.php" role="button">
                    <i class="icon-share-alt"></i>
                </a>
            </li>
        </ul>
    </div>
</div>

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
                    <h3 style="margin-bottom: 20px;">库存报警</h3>
                    <div class="span10 pull-right">
                        <input id="accid" style="margin-bottom: 0; max-width: 30%;" type="text" class="span5 " placeholder="输入配件编号" />
                        <input id="accname" style="margin-bottom: 0; max-width: 30%;" type="text" class="span5 " placeholder="输入配件名称" />
                        <input id="alertname" style="margin-bottom: 0; max-width: 30%;" type="text" class="span5 " placeholder="输入报警类型" />

                        <div class="btn-glow" onclick="search()"><i class="icon-search" ></i></div>
                        <!-- custom popup filter -->
                        <!-- styles are located in css/elements.css -->
                        <!-- script that enables this dropdown is located in js/theme.js -->



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


                $sql = "SELECT * FROM cage WHERE status = '周转备用新件'";

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
                                    配件编号
                                </th>

                                <th class="span2 sortable">
                                    <span class="line"></span>名称
                                </th>
                                <th class="span2 sortable">
                                    <span class="line"></span>类别
                                </th>
                                <th class="span2 sortable ">
                                    <span class="line"></span>报警类型
                                </th>
                                <th class="span2 sortable">
                                    <span class="line"></span>库存量
                                </th>
                                <th class="span2 sortable">
                                    <span class="line"></span>库存下限
                                </th>
                                <th class="span2 sortable">
                                    <span class="line"></span>库存上限
                                </th>



                            </tr>
                        </thead>
                        <tbody>
                        <!-- row -->
                        <?php
                        if ($result->num_rows > 0) {
                            // 输出每行数据
                            while($row = $result->fetch_assoc()) { ?>
                                <tr class="first">
                                    <td><?php echo $row["id"];?></td>
                                    <td>


                                    </td>
                                    <td>
                                    </td>
                                    <td >

                                    </td>
                                    <td>
                                        <?php echo $row["cnt"];?>

                                    </td>
                                    <td>


                                    </td>
                                    <td>

                                    </td>


                                </tr>



                                </div>

                            <?php     }
                        } else { ?>
                                <tr class="first"><td>没有记录</td></tr>
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
        function jump(id) {
            window.location.href="updatecli.php?id="+id;
        }

        function oopen(recordid) {
            var width=Math.round((window.screen.width-500)/2);
            var height=Math.round((window.screen.height-400)/2);
            window.open('accountdetail.php?id='+recordid,'title','height=400,width=500,top='+height+',left='+width+',toolbar=no,menubar=no,scrollbars=no,resizable=no,location=no,status=no');
        }

        function destroyCommit(id) {
            if(confirm("确定要删除该客户信息吗？"))
                $.ajax({
                    type: 'POST',
                    url: 'Controller.php?controller=Set&method=delCli',
                    data: "id="+id,
                    success: window.location.href='cliinfo.php'
                });
            else return false;
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
        function value(id) {
            return document.getElementById(id).value;
        }
        function search() {
            var accname = document.getElementById('accname').value;
            var alertname = document.getElementById('alertname').value;
            var accid = document.getElementById('accid').value;
            filter(function(tr) {

                if(accid && tr.cells[0].innerHTML.indexOf(accid) < 0) {
                    return false;
                }
                if(accname && tr.cells[1].innerHTML.indexOf(accname) < 0) {
                    return false;
                }
                if(alertname && tr.cells[3].innerHTML.indexOf(alertname) < 0) {
                    return false;
                }


                return true;
            });
        }

        var accname = new Array();
        var acclowrange = new Array();
        var accclass = new Array();
        var accuprange = new Array();
        $.ajax({
            type: 'POST',
            url: 'Controller.php?controller=Set&method=showAccInfo',
            async:false,
            success: function (data) {
                var str = data;
                infoobj = JSON.parse(str);
                for(var i=0;i<infoobj.length;i++){
                    accname[infoobj[i].id] = infoobj[i].accname;
                    acclowrange[infoobj[i].id] = infoobj[i].lowrange;
                    accclass[infoobj[i].id] = infoobj[i].classname;
                    accuprange[infoobj[i].id] = infoobj[i].uprange;
                }
            }
        });


        var list = document.getElementsByTagName('table')[0].getElementsByTagName('tbody')[0].rows;
        var size = list.length;
        var tr;
        for(var i = size-1; i >= 0 ; i--) {
            tr = list[i];

            var id = tr.cells[0].innerText;
            var cnt = parseInt(tr.cells[4].innerText);
            var low = parseInt(acclowrange[id]);
            var up = parseInt(accuprange[id]);


            tr.cells[1].innerText = accname[id];
            tr.cells[2].innerText = accclass[id];
            tr.cells[5].innerText = acclowrange[id];
            tr.cells[6].innerText = accuprange[id];
            if(cnt<low)  tr.cells[3].innerText = "低于下限";
            else if(cnt>up) tr.cells[3].innerText = "高于上限";
            else {var tbody=tr.parentNode;
                tbody.removeChild(tr);}


            //    tr.cells[4].innerText = accuprange[id];
        }
    </script>

</body>
</html>