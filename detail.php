<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<title>Detail Admin - User Profile</title>
    
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
    <!-- bootstrap -->
    <link href="css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="css/bootstrap/bootstrap-responsive.css" rel="stylesheet" />
    <link href="css/bootstrap/bootstrap-overrides.css" type="text/css" rel="stylesheet" />

    <!-- libraries -->
    <link href="css/lib/font-awesome.css" type="text/css" rel="stylesheet" />

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="css/layout.css" />
    <link rel="stylesheet" type="text/css" href="css/elements.css" />
    <link rel="stylesheet" type="text/css" href="css/icons.css" />
    
    <!-- this page specific styles -->
    <link rel="stylesheet" href="css/compiled/user-profile.css" type="text/css" media="screen" />


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

        <li class="onlevel active" style="display: none">
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

$id = $_GET['id'];

if($id!="")
{
    $sql = "SELECT * FROM accessory WHERE id = '$id' ";
}
else
{
    header("location:cage-center.php");
}
$result = $conn->query($sql);
$acc = $result->fetch_assoc();

$sql = "SELECT * FROM record WHERE accid = '$id'  ORDER BY opedate ASC";
$result = $conn->query($sql);
$conn->close();
?>
	<!-- main container -->
    <div class="content">
        
        <!-- settings changer -->

        
        <div class="container-fluid">
            <div id="pad-wrapper" class="user-profile">
                <!-- header -->
                <div class="row-fluid header">
                    <div class="span8">
                        <h3 class="name"><?php echo $acc['accname'];?></h3>
                        <span class="area"><?php echo $acc['accdescribe'];?></span>
                    </div>

                </div>

                <div class="row-fluid profile">
                    <!-- bio, new note & orders column -->
                    <div class="span9 bio">
                        <div class="profile-box">
                            <!-- biography -->
                            <div class="span12 section">
                                <h6>状态</h6>
                                <p> <?php echo $acc['status'];?> </p>
                            </div>

                            <h6>活动轨迹</h6>
                            <br />
                            <!-- recent orders table -->
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="span2">
                                            操作
                                        </th>
                                        <th class="span3">
                                            <span class="line"></span>
                                            时间
                                        </th>
                                        <th class="span3">
                                            <span class="line"></span>
                                            旧状态/来自于分库
                                        </th>
                                        <th class="span3">
                                            <span class="line"></span>
                                            新状态/去往分库
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
                                            <?php
                                                switch ($row['operation']){
                                                    case 1: echo "进库"; break;
                                                    case 2: echo "更改状态"; break;
                                                    case 3: echo "库间调动"; break;

                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo $row['opedate'];?>
                                        </td>
                                        <td>
                                            <?php
                                            switch ($row['operation']){
                                                case 1: echo "/"; break;
                                                case 2: echo $row['oldstatus']; break;
                                                case 3: echo $row['accfrom']; break;

                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            switch ($row['operation']){
                                                case 1: echo $row['province']; break;
                                                case 2: echo $row['newstatus']; break;
                                                case 3: echo $row['accto']; break;

                                            }
                                            ?>
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

                            <!-- new comment form -->
                            <div class="span12 section comment">
                                <h6>修改描述</h6>
                                <p>你可以在此修改该配件的描述</p>
                                <form action="accCenter.php">
                                    <input name="method" value="2" style="display: none">
                                    <input name="id" value="<?echo $id;?>" style="display: none">
                                <textarea name="describe"></textarea>
                                <div class="span12 submit-box pull-right">
                                    <input type="submit" class="btn-glow primary" value="提交" />

                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- side address column -->
                </div>
            </div>
        </div>
    </div>
    <!-- end main container -->


	<!-- scripts -->
    <script src="js/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/theme.js"></script>


</body>
</html>