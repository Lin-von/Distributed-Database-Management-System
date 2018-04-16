<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<title>Detail Admin - Tables showcase</title>
    
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
    <link rel="stylesheet" href="css/compiled/tables.css" type="text/css" media="screen" />


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
        <li>

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
            <a  href="new-acc.php">
                <i class="icon-edit"></i>
                <span>新进配件</span>
            </a>

        </li>
        <li  class="onlevel active" style="display: none">
            <div class="pointer">
                <div class="arrow"></div>
                <div class="arrow_border"></div>
            </div>
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
            <div id="pad-wrapper">
                
                <!-- products table-->
                <!-- the script for the toggle all checkboxes from header is located in js/theme.js -->
                <div class="table-wrapper products-table section">
                    <div class="row-fluid head">
                        <div class="span12">
                            <h4>选择配件</h4>
                        </div>
                    </div>

                    <div class="row-fluid filter-block">
                        <div class="pull-right">

                            <a class="btn-flat success new-product" onclick="sumCheck()">执行调度</a>
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

                    $province = $_GET['select'];

                    if($province!="")
                    {
                        $sql = "SELECT * FROM accessory WHERE province <> '$province' ";
                    }
                    else
                    {
                        header("location:transfer.php");
                    }
                    $result = $conn->query($sql);
                    //$row = $result->fetch_assoc();
                    $conn->close();
                    ?>

                    <div class="row-fluid">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="span3">
                                        <input type="checkbox" />
                                        名称
                                    </th>
                                    <th class="span4">
                                        <span class="line"></span>描述
                                    </th>
                                    <th class="span2">
                                        <span class="line"></span>状态
                                    </th>
                                    <th class="span2">
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
                                        <input style="margin-top: 4px" type="checkbox" name="sel"  value="<?php echo $row["id"];?>"/>

                                        <h5><?php echo $row["accname"];?></h5>
                                    </td>
                                    <td class="description">
                                        <?php echo $row["accdescribe"];?>
                                    </td>
                                    <td>
                                        <span class="label " style="background-color: <?php
                                        switch ($row["status"]){
                                            case  "周转备用新件": echo "rgb(129, 189, 130);"; break;
                                            case  "周转备用旧件": echo "rgb(104, 163, 213);"; break;
                                            case  "返修配件": echo "#f1c359"; break;
                                            case  "报损件": echo "#d5393e"; break;

                                        } ;?>">
                                            <?php echo $row["status"];?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-glow"  style="margin-left: 20px;"><i class="icon-globe" ></i>
                                            <?php
                                            switch ($row["province"]){
                                                case  "shanghai": echo "上海"; break;
                                                case  "shenzhen": echo "深圳"; break;
                                                default : echo "成都";


                                            } ;?>
                                        </div>
                                    </td>
                                </tr>
                    </div>

                <?php     }
                } else { ?>
                    <tr class="first"><td>没有可以调度的配件</td></tr>
                    <?php

                }
                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end products table -->


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

    function sumCheck() {
        if(!confirm("确定要进行调度吗？"))  return false;
        var id_array=new Array();
        $('input[name="sel"]:checked').each(function(){
            id_array.push($(this).val());//向数组中添加元素
        });
        var idstr=id_array.join(',');//将数组元素连接起来以构建一个字符串
        //alert(idstr);
        window.location.href = "accCenter.php?method=1&idstr="+idstr+"&province=<?php echo $province?>";
    }
</script>


</body>
</html>