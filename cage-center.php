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
<div id="sidebar-nav">
    <ul id="dashboard-menu">
        <li >

            <a href="index.php">
                <i class="icon-home"></i>
                <span>首页</span>
            </a>
        </li>




        <li>
            <a href="cage-local.php">
                <i class="icon-th-large"></i>
                <span>本地仓库管理</span>
            </a>
        </li>
        <li>
            <a  href="buyman.php">
                <i class="icon-edit"></i>
                <span>新进配件</span>
            </a>

        </li>
        <li class="onlevel" style="display: none">
            <a  href="sellman.php">
                <i class="icon-share-alt"></i>
                <span>配件调度</span>
            </a>

        </li>

        <li class="active onlevel" style="display: none">
            <div class="pointer">
                <div class="arrow"></div>
                <div class="arrow_border"></div>
            </div>
            <a href="cage-center.php">
                <i class="icon-code-fork" style="margin-left: 5px;"></i>
                <span>仓库管理中心</span>
            </a>

        </li>
        <li class="onlevel" style="display: none">
            <a href="statistics.php">
                <i class="icon-signal"></i>
                <span>数据统计中心</span>
            </a>
        </li>

        <li>
            <a href="setting.php">
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
                <h3 style="margin-bottom: 20px;">仓库管理中心</h3>
                <div class="span10 pull-right">
                    <input id="searchname" style="margin-bottom: 0; max-width: 80%;" type="text" class="span5 " placeholder="输入配件名称" />
                    <div class="btn-glow" onclick="window.location.href = 'cage-center.php?name='+document.getElementById('searchname').value;"><i class="icon-search" ></i></div>
                    <!-- custom popup filter -->
                    <!-- styles are located in css/elements.css -->
                    <!-- script that enables this dropdown is located in js/theme.js -->
                    <div class="ui-dropdown">
                        <select style="min-height: 30px;" onchange="window.location.href = 'cage-center.php?status='+this.value;">
                            <option disabled="disabled" selected/>按状态查看
                            <option value=""/>所有状态
                            <option />周转备用新件
                            <option />周转备用旧件
                            <option />返修配件
                            <option />报损件
                        </select>
                    </div>


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
                        <th class="span4 sortable">
                            名称及描述
                        </th>

                        <th class="span2 sortable">
                            <span class="line"></span>状态
                        </th>
                        <th class="span3 sortable align-right">
                            <span class="line"></span>所属分库
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
                            <a href="detail.php?id=<?php echo $row["id"];?>" class="name"><?php echo $row["accname"];?></a>
                            <span class="subtext"><?php echo $row["accdescribe"];?></span>
                        </td>

                        <td>
                                        <span  class="label " style="background-color: <?php
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


                            <div class="btn-glow"  style="margin-left: 20px;"><i class="icon-globe" ></i>
                                <?php
                                switch ($row["province"]){
                                    case  "shanghai": echo "上海"; break;
                                    case  "shenzhen": echo "深圳"; break;
                                    default : echo "成都";


                                } ;?>
                            </div>

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

</body>
</html>