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
    document.getElementById('forset').className = "active";

</script>


<!-- main container -->
    <div class="content">
        
        <!-- settings changer -->

        
        <div class="container-fluid">
            <div id="pad-wrapper" class="users-list">
                <div style="margin-bottom: 30px;" class="row-fluid header">
                    <h3 style="margin-bottom: 20px;">供货商信息</h3>
                    <div class="span10 pull-right">
                        <input id="searchname" style="margin-bottom: 0; max-width: 80%;" type="text" class="span5 " placeholder="输入供货商名称" />
                        <div class="btn-glow" onclick="search()"><i class="icon-search" ></i></div>
                        <!-- custom popup filter -->
                        <!-- styles are located in css/elements.css -->
                        <!-- script that enables this dropdown is located in js/theme.js -->


                        <a style="margin-top: 40px;" href="newsup.php" class="btn-flat success pull-right">
                            <span>&#43;</span>
                            添加供货商
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


                $sql = "SELECT * FROM supplier";

                $result = $conn->query($sql);
                //$row = $result->fetch_assoc();
                $conn->close();
                ?>
                <!-- Users table -->
                <div class="row-fluid table">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="span3 sortable">
                                    名称
                                </th>

                                <th class="span2 sortable">
                                    <span class="line"></span>联系人
                                </th>
                                <th class="span2 sortable">
                                    <span class="line"></span>电话
                                </th>
                                <th class="span3 sortable">
                                    <span class="line"></span>地址
                                </th>
                                <th class="span2 sortable">
                                    <span class="line"></span>备注
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
                                        <?php echo $row["supname"];?>

                                    </td>
                                    <td>
                                        <?php echo $row["connector"];?>

                                    </td>
                                    <td>
                                        <?php echo $row["tel"];?>

                                    </td>
                                    <td>
                                        <?php echo $row["address"];?>

                                    </td>
                                    <td>
                                        <?php echo $row["note"];?>

                                    </td>
                                    <td class="align-right">

                                        <div class="btn-glow" onclick="jump(<?php echo $row["id"];?>)" style="margin-left: 20px;"><i class="icon-remove-sign" ></i> 修改</div>

                                        <div class="btn-glow" onclick="destroyCommit(<?php echo $row["id"];?>)" style="margin-left: 20px;"><i class="icon-remove-sign" ></i> 删除</div>

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
        function jump(id) {
            window.location.href="updatesup.php?id="+id;
        }

        function destroyCommit(id) {
            if(confirm("确定要删除该供货商信息吗？"))
                $.ajax({
                    type: 'POST',
                    url: 'Controller.php?controller=Set&method=delSup',
                    data: "id="+id,
                    success: window.location.href='supinfo.php'
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
          //  var classname = document.getElementById('classname').value;
            var name = document.getElementById('searchname').value;
            //var course = document.getElementById('course').value;
            filter(function(tr) {

                if(name && tr.cells[0].innerHTML.indexOf(name) < 0) {
                    return false;
                }

                return true;
            });
        }
    </script>

</body>
</html>