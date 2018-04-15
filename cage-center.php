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
        <li class="onlevel" style="display: none">
            <a  href="transfer.php">
                <i class="icon-share-alt"></i>
                <span>配件调度</span>
            </a>

        </li>

        <li class="active onlevel" style="display: none">
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
    <div class="skins-nav">
        <a href="#" class="skin first_nav selected">
            <span class="icon"></span><span class="text">Default</span>
        </a>
        <a href="#" class="skin second_nav" data-file="css/skins/dark.css">
            <span class="icon"></span><span class="text">Dark skin</span>
        </a>
    </div>

    <div class="container-fluid">
        <div id="pad-wrapper" class="users-list">
            <div class="row-fluid header">
                <h3>Users</h3>
                <div class="span10 pull-right">
                    <input type="text" class="span5 search" placeholder="Type a user's name..." />

                    <!-- custom popup filter -->
                    <!-- styles are located in css/elements.css -->
                    <!-- script that enables this dropdown is located in js/theme.js -->
                    <div class="ui-dropdown">
                        <div class="head" data-toggle="tooltip" title="Click me!">
                            Filter users
                            <i class="arrow-down"></i>
                        </div>
                        <div class="dialog">
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
                    </div>

                    <a href="new-acc.php" class="btn-flat success pull-right">
                        <span>&#43;</span>
                        NEW USER
                    </a>
                </div>
            </div>

            <!-- Users table -->
            <div class="row-fluid table">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="span4 sortable">
                            Name
                        </th>
                        <th class="span3 sortable">
                            <span class="line"></span>Signed up
                        </th>
                        <th class="span2 sortable">
                            <span class="line"></span>Total spent
                        </th>
                        <th class="span3 sortable align-right">
                            <span class="line"></span>Email
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- row -->
                    <tr class="first">
                        <td>
                            <img src="img/contact-img.png" class="img-circle avatar hidden-phone" />
                            <a href="user-profile.php" class="name">Alejandra Galvan Castillo</a>
                            <span class="subtext">Graphic Design</span>
                        </td>
                        <td>
                            Mar 13, 2012
                        </td>
                        <td>
                            $ 4,500.00
                        </td>
                        <td class="align-right">
                            <a href="#">alejandra@canvas.com</a>
                        </td>
                    </tr>
                    <!-- row -->
                    <tr>
                        <td>
                            <img src="img/contact-img2.png" class="img-circle avatar hidden-phone" />
                            <a href="user-profile.php" class="name">Alejandra Galvan Castillo</a>
                            <span class="subtext">Graphic Design</span>
                        </td>
                        <td>
                            Jun 03, 2012
                        </td>
                        <td>
                            $ 549.99
                        </td>
                        <td class="align-right">
                            <a href="#">alejandra@canvas.com</a>
                        </td>
                    </tr>
                    <!-- row -->
                    <tr>
                        <td>
                            <img src="img/contact-img.png" class="img-circle avatar hidden-phone" />
                            <a href="user-profile.php" class="name">Alejandra Galvan Castillo</a>
                            <span class="subtext">Graphic Design</span>
                        </td>
                        <td>
                            Mar 01, 2014
                        </td>
                        <td>
                            $ 30.00
                        </td>
                        <td class="align-right">
                            <a href="#">alejandra@canvas.com</a>
                        </td>
                    </tr>
                    <!-- row -->
                    <tr>
                        <td>
                            <img src="img/contact-img2.png" class="img-circle avatar hidden-phone" />
                            <a href="user-profile.php" class="name">Alejandra Galvan Castillo</a>
                            <span class="subtext">Graphic Design</span>
                        </td>
                        <td>
                            Jan 28, 2012
                        </td>
                        <td>
                            $ 1,320.00
                        </td>
                        <td class="align-right">
                            <a href="#">alejandra@canvas.com</a>
                        </td>
                    </tr>
                    <!-- row -->
                    <tr>
                        <td>
                            <img src="img/contact-img.png" class="img-circle avatar hidden-phone" />
                            <a href="user-profile.php" class="name">Alejandra Galvan Castillo</a>
                            <span class="subtext">Graphic Design</span>
                        </td>
                        <td>
                            May 16, 2012
                        </td>
                        <td>
                            $ 89.99
                        </td>
                        <td class="align-right">
                            <a href="#">alejandra@canvas.com</a>
                        </td>
                    </tr>
                    <!-- row -->
                    <tr>
                        <td>
                            <img src="img/contact-img2.png" class="img-circle avatar hidden-phone" />
                            <a href="user-profile.php" class="name">Alejandra Galvan Castillo</a>
                            <span class="subtext">Graphic Design</span>
                        </td>
                        <td>
                            Sep 06, 2012
                        </td>
                        <td>
                            $ 344.00
                        </td>
                        <td class="align-right">
                            <a href="#">alejandra@canvas.com</a>
                        </td>
                    </tr>
                    <!-- row -->
                    <tr>
                        <td>
                            <img src="img/contact-img.png" class="img-circle avatar hidden-phone" />
                            <a href="user-profile.php" class="name">Alejandra Galvan Castillo</a>
                            <span class="subtext">Graphic Design</span>
                        </td>
                        <td>
                            Jul 13, 2012
                        </td>
                        <td>
                            $ 800.00
                        </td>
                        <td class="align-right">
                            <a href="#">alejandra@canvas.com</a>
                        </td>
                    </tr>
                    <!-- row -->
                    <tr>
                        <td>
                            <img src="img/contact-img2.png" class="img-circle avatar hidden-phone" />
                            <a href="user-profile.php" class="name">Alejandra Galvan Castillo</a>
                            <span class="subtext">Graphic Design</span>
                        </td>
                        <td>
                            Feb 13, 2014
                        </td>
                        <td>
                            $ 250.00
                        </td>
                        <td class="align-right">
                            <a href="#">alejandra@canvas.com</a>
                        </td>
                    </tr>
                    <!-- row -->
                    <tr>
                        <td>
                            <img src="img/contact-img.png" class="img-circle avatar hidden-phone" />
                            <a href="user-profile.php" class="name">Alejandra Galvan Castillo</a>
                            <span class="subtext">Graphic Design</span>
                        </td>
                        <td>
                            Feb 27, 2014
                        </td>
                        <td>
                            $ 1,300.00
                        </td>
                        <td class="align-right">
                            <a href="#">alejandra@canvas.com</a>
                        </td>
                    </tr>
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