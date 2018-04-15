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
                <a href="personal-info.html" role="button">
                    <i class="icon-cog"></i>
                </a>
            </li>
            <li class="settings ">
                <a href="signin.html" role="button">
                    <i class="icon-share-alt"></i>
                </a>
            </li>
        </ul>
    </div>
</div>

<!-- end navbar -->

<!-- sidebar -->
<div id="sidebar-nav">
    <ul id="dashboard-menu">
        <li >
            <div class="pointer">
                <div class="arrow"></div>
                <div class="arrow_border"></div>
            </div>
            <a href="index.php">
                <i class="icon-home"></i>
                <span>首页</span>
            </a>
        </li>




        <li class="active">
            <a href="cage-local.php">
                <i class="icon-th-large"></i>
                <span>本地仓库管理</span>
            </a>
        </li>
        <li>
            <a  href="new-acc.php">
                <i class="icon-edit"></i>
                <span>新进配件</span>
            </a>

        </li>
        <li class="onlevel" style="display: none">
            <a  href="transfer.php">
                <i class="icon-share-alt"></i>
                <span>配件调度</span>
            </a>

        </li>

        <li class="onlevel" style="display: none">
            <a href="cage-center.php">
                <i class="icon-code-fork" style="margin-left: 5px;"></i>
                <span>仓库管理中心</span>
            </a>

        </li>
        <li class="onlevel" style="display: none">
            <a href="chart-showcase.php">
                <i class="icon-signal"></i>
                <span>数据统计中心</span>
            </a>
        </li>

        <li>
            <a href="personal-info.html">
                <i class="icon-cog"></i>
                <span>设置</span>
            </a>
        </li>

    </ul>
</div>
<!-- end sidebar -->
    

	<!-- main container -->
    <div class="content">
        
        <!-- settings changer -->

        
        <div class="container-fluid">
            <div id="pad-wrapper" class="users-list">
                <div style="margin-bottom: 30px;" class="row-fluid header">
                    <h3 style="margin-bottom: 20px;">本地仓库管理</h3>
                    <div class="span10 pull-right">
                        <input id="searchname" style="margin-bottom: 0; max-width: 80%;" type="text" class="span5 " placeholder="输入配件名称" />
                        <div class="btn-glow" onclick="window.location.href = 'cage-local.php?name='+document.getElementById('searchname').value;"><i class="icon-search" ></i></div>
                        <!-- custom popup filter -->
                        <!-- styles are located in css/elements.css -->
                        <!-- script that enables this dropdown is located in js/theme.js -->
                        <div class="ui-dropdown">
                            <select style="min-height: 30px;" onchange="window.location.href = 'cage-local.php?status='+this.value;">
                                <option disabled="disabled" selected/>按状态查看
                                <option value=""/>所有状态
                                <option />周转备用新件
                                <option />周转备用旧件
                                <option />返修配件
                                <option />报损件
                            </select>
<!--                            <div class="dialog">
                                <div class="pointer">
                                    <div class="arrow"></div>
                                    <div class="arrow_border"></div>
                                </div>
                                <div class="body">
                                    <p class="title">
                                        Show users where:
                                    </p>
                                    <div class="form">
                                        <select>
                                            <option />Name
                                            <option />Email
                                            <option />Number of orders
                                            <option />Signed up
                                            <option />Last seen
                                        </select>
                                        <select>
                                            <option />is equal to
                                            <option />is not equal to
                                            <option />is greater than
                                            <option />starts with
                                            <option />contains
                                        </select>
                                        <input type="text" />
                                        <a class="btn-flat small">Add filter</a>
                                    </div>
                                </div>
                            </div>
-->                        </div>

                        <a style="margin-top: 40px;" href="new-acc.php" class="btn-flat success pull-right">
                            <span>&#43;</span>
                            新进配件
                        </a>
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

                $status = $_GET['status'];
                $name = $_GET['name'];
                if($status!="")
                {
                    $sql = "SELECT * FROM accessory WHERE status = '$status' ";
                }
                else if($name!="")
                {
                    $sql = "SELECT * FROM accessory WHERE accname = '$name' ";
                }
                else
                {
                    $sql = "SELECT * FROM accessory";
                }
                $result = $conn->query($sql);
                //$row = $result->fetch_assoc();
                $conn->close();
                ?>
                <!-- Users table -->
                <div class="row-fluid table">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="span5 sortable">
                                    名称及描述
                                </th>

                                <th class="span1 sortable">
                                    <span class="line"></span>状态
                                </th>
                                <th class="span3 sortable align-right">
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
                                <tr class="first">
                                    <td>
                                        <a href="#" class="name"><?php echo $row["accname"];?></a>
                                        <span class="subtext"><?php echo $row["accdescribe"];?></span>
<!--                                        <span style="display: none" id="accid<?php /*echo $row["id"];*/?>"><?php /*echo $row["id"];*/?></span>
-->                                    </td>

                                    <td>
                                        <span id="status<?php echo $row["id"];?>" class="label " style="background-color: <?php
                                        switch ($row["status"]){
                                            case  "周转备用新件": echo "rgb(129, 189, 130);"; break;
                                            case  "周转备用旧件": echo "rgb(104, 163, 213);"; break;
                                            case  "返修配件": echo "#f1c359"; break;
                                            case  "报损件": echo "#d5393e"; break;

                                        } ;?>">
                                            <?php echo $row["status"];?>
                                        </span>
                                    </td>
                                    <td class="align-right">
                                        <div class="btn-group">

                                            <button id="changeStatus<?php echo $row["id"];?>" class="btn glow" onclick="changeCommit(this,<?php echo $row["id"];?>)">更改配件状态</button>
                                            <button class="btn glow dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" style="text-align: left;">
                                                <li><a href="#" onclick=selectStatus(this,<?php echo $row["id"];?>)>周转备用新件</a></li>
                                                <li><a href="#" onclick=selectStatus(this,<?php echo $row["id"];?>)>周转备用旧件</a></li>
                                                <li><a href="#" onclick=selectStatus(this,<?php echo $row["id"];?>)>返修配件</a></li>
                                                <li><a href="#" onclick=selectStatus(this,<?php echo $row["id"];?>)>报损件</a></li>
                                            </ul>
                                        </div>

                                        <div class="btn-glow" onclick="destroyCommit(<?php echo $row["id"];?>)" style="margin-left: 20px;"><i class="icon-remove-sign" ></i> 销毁</div>

                                        <!--                                <a href="#">alejandra@canvas.com</a>
                                        -->
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
                <div class="pagination pull-right">
                    <ul>
                        <li><a href="#">&#8249;</a></li>
                        <li><a class="active" href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">&#8250;</a></li>
                    </ul>
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
    <?php
    if($_SESSION['level'] == 1) {
    ?>

    var doc = document.getElementsByClassName("onlevel");
    /*用for循环遍历所有doc标签*/
    for(var i=0;i<doc.length;i++){
        doc[i].style.display="";
    }

    <?php
    }
    ?>
</script>
    <script type="text/javascript">
        function selectStatus(obj,id) {
            var text = obj.innerText;

            document.getElementById("changeStatus"+id).innerText = text;

        }
        
        function changeCommit(obj,id) {
            var text = obj.innerText;
            if(text == "更改配件状态") alert("请先选择一个配件状态");
            else if (text == document.getElementById("status"+id).innerText) alert("配件正处于该状态");
            else if(confirm("确定要更改配件状态吗？")) window.location.href="accOperation.php?method=1&status="+text+"&id="+id+"&oldstatus="+document.getElementById("status"+id).innerText;
            else return false;
        }
        
        function destroyCommit(id) {
            if(confirm("确定要销毁该配件吗？")) window.location.href="accOperation.php?method=2&id="+id;
            else return false;
        }
    </script>

</body>
</html>