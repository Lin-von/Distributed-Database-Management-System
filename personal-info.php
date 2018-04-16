<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<title>Detail Admin - My Info</title>
    
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
    <link rel="stylesheet" type="text/css" href="css/lib/font-awesome.css" />
    
    <!-- this page specific styles -->
    <link rel="stylesheet" href="css/compiled/personal-info.css" type="text/css" media="screen" />


    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>

    <!-- navbar -->
    <div class="navbar navbar-inverse">
        <div class="navbar-inner">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li class="active"><a href="index.php">首页</a></li>

                </ul>
            </div>
            <ul class="nav pull-right">

                <li class="settings">
                    <a href="personal-info.php" role="button">
                        <span class="navbar_icon"></span>
                    </a>
                </li>
                <li id="fat-menu" class="dropdown">
                    <a href="signin.html" role="button" class="logout">
                        <span class="navbar_icon"></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- end navbar -->
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

    $username = $_SESSION['user'];

    $sql = "SELECT * FROM users WHERE username = '$username' ";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
   // print_r($row);

    $conn->close();
    ?>
	<!-- main container .wide-content is used for this layout without sidebar :)  -->
    <div class="content wide-content">
        <div class="container-fluid">
            <div class="settings-wrapper" id="pad-wrapper">
                <!-- avatar column -->
                <div class="span3 avatar-box">
                    <div class="personal-image">
                        <img src="img/personal-info.png" class="avatar img-circle" />

                    </div>
                </div>

                <!-- edit form column -->
                <div class="span7 personal-info">
                    <div class="alert alert-info">
                        <i class="icon-lightbulb"></i>
                        这是个人账户详情页，您可以在此修改个人信息
                    </div>
                    <h5 class="personal-title">个人信息</h5>

                    <form action="updatepinfo.php" method="post">
                        <div class="field-box">
                            <label>姓名:</label>
                            <input class="span5 inline-input" type="text" name="realname" value="<?php echo $row['realname'];?>" />
                        </div>
                       <div class="field-box">
                            <label>电话:</label>
                            <input class="span5 inline-input" type="text" name="tel" value="<?php echo $row['tel'];?>" />
                        </div>
                        <div class="field-box">
                            <label>密码:</label>
                            <input class="span5 inline-input" type="password" name="password" value="<?php echo $row['password'];?>" />
                        </div>
                        <div class="field-box">
                            <label>确认密码:</label>
                            <input class="span5 inline-input" type="password" name="cpassword" value="blablablabla" />
                        </div>
                        <div class="span6 field-box actions">
                            <input type="submit" class="btn-glow primary" value="Save Changes" />

                        </div>
                    </form>
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