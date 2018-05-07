<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
    <title>仓库管理</title>

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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <style type="text/css">
        .selbtn{
            width: 130px;
            height: 130px;
            margin: 20px 20px 20px 20px;
            position: relative;
        }
    </style>
</head>
<body>

<!-- navbar -->
<?php require_once "navbar.html";?><!-- end navbar -->

<!-- sidebar -->
<?php require_once "sidebar.html";?>
<script type="text/javascript">
    document.getElementById('forcage').className = "active";

</script>
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
                        <h3>仓库管理</h3>
                    </div>
                </div>
                <div style="text-align:center;margin-top: 100px">
                    <div class="btn-glow selbtn" onclick="window.location.href='showcage.php'">当前库存查询</div>
                    <div class="btn-glow selbtn" onclick="window.location.href='cagechange.php'">库存变动查询 </div>
                    <div class="btn-glow selbtn" onclick="window.location.href='cagelack.php'">配件报损</div>
                    <div class="btn-glow selbtn" onclick="window.location.href='cageover.php'">配件报溢</div>
                    <div class="btn-glow selbtn" onclick="window.location.href='cagecount.php'">库存盘点</div>
                    <div class="btn-glow selbtn" onclick="window.location.href='cagealert.php'">库存报警</div>
                    <div class="btn-glow selbtn" onclick="window.location.href='cagetrans.php'">库存调拨</div>

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

</body>
</html>