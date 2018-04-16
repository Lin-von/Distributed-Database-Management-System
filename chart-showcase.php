<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<title>Detail Admin - Chart Showcase</title>
    
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
    <link href="css/lib/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css" />
    <link href="css/lib/font-awesome.css" type="text/css" rel="stylesheet" />
    <link href="css/lib/morris.css" type="text/css" rel="stylesheet" />
    
    <!-- this page specific styles -->
    <link rel="stylesheet" href="css/compiled/chart-showcase.css" type="text/css" media="screen" />


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
                <a href="personal-info.php" role="button">
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

        <li class="active onlevel" style="display: none">
            <div class="pointer">
                <div class="arrow"></div>
                <div class="arrow_border"></div>
            </div>
            <a href="chart-showcase.php">
                <i class="icon-signal"></i>
                <span>数据统计中心</span>
            </a>
        </li>

        <li>
            <a href="personal-info.php">
                <i class="icon-cog"></i>
                <span>设置</span>
            </a>
        </li>

    </ul>
</div>
<!-- end sidebar -->
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

$sql = "SELECT * FROM accessory WHERE status = '周转备用新件'";
$result = $conn->query($sql);
$count1 = $result->num_rows;
$sql = "SELECT * FROM accessory WHERE status = '周转备用旧件'";
$result = $conn->query($sql);
$count2 = $result->num_rows;
$sql = "SELECT * FROM accessory WHERE status = '返修配件'";
$result = $conn->query($sql);
$count3 = $result->num_rows;
$sql = "SELECT * FROM accessory WHERE status = '报损件'";
$result = $conn->query($sql);
$count4 = $result->num_rows;

$sum = $count1+$count2+$count3+$count4;
$num1 = $count1*100/$sum;
$num2 = $count2*100/$sum;
$num3 = $count3*100/$sum;
$num4 = 100-$num1-$num2-$num3;

$sql = "select dateduan,count(*)
from 
(select  
        operation,
        case    
            when   (opedate>='2018-12-01 00:00:00')              then   '12' 
            when   (opedate>='2018-11-01 00:00:00' and opedate<'2018-12-01 00:00:00')   then   '11'
            when   (opedate>='2018-10-01 00:00:00' and opedate<'2018-11-01 00:00:00')    then    '10' 
            when   (opedate>='2018-09-01 00:00:00' and opedate<'2018-10-01 00:00:00')    then    '09' 
            when   (opedate>='2018-08-01 00:00:00' and opedate<'2018-09-01 00:00:00')    then    '08' 
            when   (opedate>='2018-07-01 00:00:00' and opedate<'2018-08-01 00:00:00')    then    '7' 
            when   (opedate>='2018-06-01 00:00:00' and opedate<'2018-07-01 00:00:00')    then    '6' 
            when   (opedate>='2018-05-01 00:00:00' and opedate<'2018-06-01 00:00:00')    then    '5' 
            when   (opedate>='2018-04-01 00:00:00' and opedate<'2018-05-01 00:00:00')    then    '4' 
            when   (opedate>='2018-03-01 00:00:00' and opedate<'2018-04-01 00:00:00')     then    '3'  
            when   (opedate>='2018-02-01 00:00:00' and opedate<'2018-03-01 00:00:00')     then    '2'  
            when   (opedate>='2018-01-01 00:00:00' and opedate<'2018-02-01 00:00:00')     then    '1'  
            else     'opedate unknow'
        end     as dateduan from 

         record
)  as t where operation = 1 or operation = 3 group by dateduan";
$result = $conn->query($sql);
$incage = array(0,0,0,0,0,0,0,0,0,0,0,0,0);
while($row = $result->fetch_assoc()){
    $incage[$row['dateduan']] = $row['COUNT1'];
}
//print_r($incage);

$sql = "select dateduan,count(*)
from 
(select  
        operation,
        case    
            when   (opedate>='2018-12-01 00:00:00')              then   '12' 
            when   (opedate>='2018-11-01 00:00:00' and opedate<'2018-12-01 00:00:00')   then   '11'
            when   (opedate>='2018-10-01 00:00:00' and opedate<'2018-11-01 00:00:00')    then    '10' 
            when   (opedate>='2018-09-01 00:00:00' and opedate<'2018-10-01 00:00:00')    then    '09' 
            when   (opedate>='2018-08-01 00:00:00' and opedate<'2018-09-01 00:00:00')    then    '08' 
            when   (opedate>='2018-07-01 00:00:00' and opedate<'2018-08-01 00:00:00')    then    '7' 
            when   (opedate>='2018-06-01 00:00:00' and opedate<'2018-07-01 00:00:00')    then    '6' 
            when   (opedate>='2018-05-01 00:00:00' and opedate<'2018-06-01 00:00:00')    then    '5' 
            when   (opedate>='2018-04-01 00:00:00' and opedate<'2018-05-01 00:00:00')    then    '4' 
            when   (opedate>='2018-03-01 00:00:00' and opedate<'2018-04-01 00:00:00')     then    '3'  
            when   (opedate>='2018-02-01 00:00:00' and opedate<'2018-03-01 00:00:00')     then    '2'  
            when   (opedate>='2018-01-01 00:00:00' and opedate<'2018-02-01 00:00:00')     then    '1'  
            else     'opedate unknow'
        end     as dateduan from 

         record
)  as t where operation = 4 group by dateduan";
$result = $conn->query($sql);
$outcage = array(0,0,0,0,0,0,0,0,0,0,0,0,0);
while($row = $result->fetch_assoc()){
    $outcage[$row['dateduan']] = $row['COUNT1'];
}

$sql = "select dateduan,count(*)
from 
(select  
        province,
        case    
            when   (opedate>='2018-12-01 00:00:00')              then   '12' 
            when   (opedate>='2018-11-01 00:00:00' and opedate<'2018-12-01 00:00:00')   then   '11'
            when   (opedate>='2018-10-01 00:00:00' and opedate<'2018-11-01 00:00:00')    then    '10' 
            when   (opedate>='2018-09-01 00:00:00' and opedate<'2018-10-01 00:00:00')    then    '09' 
            when   (opedate>='2018-08-01 00:00:00' and opedate<'2018-09-01 00:00:00')    then    '08' 
            when   (opedate>='2018-07-01 00:00:00' and opedate<'2018-08-01 00:00:00')    then    '7' 
            when   (opedate>='2018-06-01 00:00:00' and opedate<'2018-07-01 00:00:00')    then    '6' 
            when   (opedate>='2018-05-01 00:00:00' and opedate<'2018-06-01 00:00:00')    then    '5' 
            when   (opedate>='2018-04-01 00:00:00' and opedate<'2018-05-01 00:00:00')    then    '4' 
            when   (opedate>='2018-03-01 00:00:00' and opedate<'2018-04-01 00:00:00')     then    '3'  
            when   (opedate>='2018-02-01 00:00:00' and opedate<'2018-03-01 00:00:00')     then    '2'  
            when   (opedate>='2018-01-01 00:00:00' and opedate<'2018-02-01 00:00:00')     then    '1'  
            else     'opedate unknow'
        end     as dateduan from 

         record
)  as t where province = 'shanghai' group by dateduan";
$result = $conn->query($sql);
$shanghaic = array(0,0,0,0,0,0,0,0,0,0,0,0,0);
while($row = $result->fetch_assoc()){
    $shanghaic[$row['dateduan']] = $row['COUNT1'];
}

$sql = "select dateduan,count(*)
from 
(select  
        province,
        case    
            when   (opedate>='2018-12-01 00:00:00')              then   '12' 
            when   (opedate>='2018-11-01 00:00:00' and opedate<'2018-12-01 00:00:00')   then   '11'
            when   (opedate>='2018-10-01 00:00:00' and opedate<'2018-11-01 00:00:00')    then    '10' 
            when   (opedate>='2018-09-01 00:00:00' and opedate<'2018-10-01 00:00:00')    then    '09' 
            when   (opedate>='2018-08-01 00:00:00' and opedate<'2018-09-01 00:00:00')    then    '08' 
            when   (opedate>='2018-07-01 00:00:00' and opedate<'2018-08-01 00:00:00')    then    '7' 
            when   (opedate>='2018-06-01 00:00:00' and opedate<'2018-07-01 00:00:00')    then    '6' 
            when   (opedate>='2018-05-01 00:00:00' and opedate<'2018-06-01 00:00:00')    then    '5' 
            when   (opedate>='2018-04-01 00:00:00' and opedate<'2018-05-01 00:00:00')    then    '4' 
            when   (opedate>='2018-03-01 00:00:00' and opedate<'2018-04-01 00:00:00')     then    '3'  
            when   (opedate>='2018-02-01 00:00:00' and opedate<'2018-03-01 00:00:00')     then    '2'  
            when   (opedate>='2018-01-01 00:00:00' and opedate<'2018-02-01 00:00:00')     then    '1'  
            else     'opedate unknow'
        end     as dateduan from 

         record
)  as t where province = 'shenzhen' group by dateduan";
$result = $conn->query($sql);
$shenzhenc = array(0,0,0,0,0,0,0,0,0,0,0,0,0);
while($row = $result->fetch_assoc()){
    $shenzhenc[$row['dateduan']] = $row['COUNT1'];
}


$sql = "select dateduan,count(*)
from 
(select  
        province,
        case    
            when   (opedate>='2018-12-01 00:00:00')              then   '12' 
            when   (opedate>='2018-11-01 00:00:00' and opedate<'2018-12-01 00:00:00')   then   '11'
            when   (opedate>='2018-10-01 00:00:00' and opedate<'2018-11-01 00:00:00')    then    '10' 
            when   (opedate>='2018-09-01 00:00:00' and opedate<'2018-10-01 00:00:00')    then    '09' 
            when   (opedate>='2018-08-01 00:00:00' and opedate<'2018-09-01 00:00:00')    then    '08' 
            when   (opedate>='2018-07-01 00:00:00' and opedate<'2018-08-01 00:00:00')    then    '7' 
            when   (opedate>='2018-06-01 00:00:00' and opedate<'2018-07-01 00:00:00')    then    '6' 
            when   (opedate>='2018-05-01 00:00:00' and opedate<'2018-06-01 00:00:00')    then    '5' 
            when   (opedate>='2018-04-01 00:00:00' and opedate<'2018-05-01 00:00:00')    then    '4' 
            when   (opedate>='2018-03-01 00:00:00' and opedate<'2018-04-01 00:00:00')     then    '3'  
            when   (opedate>='2018-02-01 00:00:00' and opedate<'2018-03-01 00:00:00')     then    '2'  
            when   (opedate>='2018-01-01 00:00:00' and opedate<'2018-02-01 00:00:00')     then    '1'  
            else     'opedate unknow'
        end     as dateduan from 

         record
)  as t where province = 'chengdu' group by dateduan";
$result = $conn->query($sql);
$chengduc = array(0,0,0,0,0,0,0,0,0,0,0,0,0);
while($row = $result->fetch_assoc()){
    $chengduc[$row['dateduan']] = $row['COUNT1'];
}

$conn->close();
?>

	<!-- main container -->
    <div class="content">

        <!-- settings changer -->


        <div class="container-fluid">
            <div id="pad-wrapper">
                <!-- morris stacked chart -->
                <div class="row-fluid">
                    <h4 class="title">配件操作量变化图</h4>
                    <div class="span12">
                        <h5>配件操作包括进库、更改配件状态、销毁</h5>
                        <br />
                        <div id="hero-area" style="height: 250px;"></div>
                    </div>
                </div>

                <!-- morris graph chart -->
                <div class="row-fluid section" style="display: none">
                    <h4 class="title">Morris.js <small>Monthly growth</small></h4>
                    <div class="span12 chart">
                        <div id="hero-graph" style="height: 230px;"></div>
                    </div>
                </div>

                <!-- jQuery flot chart -->
                <div class="row-fluid section">
                    <h4 class="title">
                        进出库变化统计 <small>全局统计</small>

                    </h4>
                    <div class="span12">
                        <div id="statsChart"></div>
                    </div>
                </div>

                <!-- morris bar & donut charts -->
                <div class="row-fluid section">
                    <h4 class="title">
                        配件状态统计
                    </h4>
                    <div class="span6 chart">
                        <h5>各状态配件数量统计</h5>
                        <div id="hero-bar" style="height: 250px;"></div>
                    </div>
                    <div class="span5 chart">
                        <h5>各状态配件占比</h5>
                        <div id="hero-donut" style="height: 250px;"></div>    
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- end main container -->


	<!-- scripts for this page -->
    <script src="js/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-ui-1.10.2.custom.min.js"></script>
    <!-- knob -->
    <script src="js/jquery.knob.js"></script>
    <!-- flot charts -->
    <script src="js/jquery.flot.js"></script>
    <script src="js/jquery.flot.stack.js"></script>
    <script src="js/jquery.flot.resize.js"></script>
    <!-- morrisjs -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="js/morris.min.js"></script>
    <!-- call all plugins -->
    <script src="js/theme.js"></script>

    <!-- build the charts -->
    <script type="text/javascript">

        // Morris Bar Chart
        Morris.Bar({
            element: 'hero-bar',
            data: [
                {device: '周转备用新件', sells: <?php echo $count1;?>},
                {device: '周转备用旧件', sells: <?php echo $count2;?>},
                {device: '返修配件', sells: <?php echo $count3;?>},
                {device: '报损件', sells: <?php echo $count4;?>}
            ],
            xkey: 'device',
            ykeys: ['sells'],
            labels: ['Sells'],
            barRatio: 0.4,
            xLabelMargin: 10,
            hideHover: 'auto',
            barColors: ["#3d88ba"]
        });


        // Morris Donut Chart
        Morris.Donut({
            element: 'hero-donut',
            data: [
                {label: '周转备用新件', value: <?php echo $num1;?>},
                {label: '周转备用旧件', value: <?php echo $num2;?> },
                {label: '返修配件', value: <?php echo $num3;?> },
                {label: '报损件', value: <?php echo $num4;?> }
            ],
            colors: ["rgb(129, 189, 130)", "rgb(104, 163, 213)", "#f1c359","#d5393e"],
            formatter: function (y) { return y + "%" }
        });


        // Morris Line Chart
        var tax_data = [
            {"period": "2014-04", "visits": 2407, "signups": 660},
            {"period": "2014-03", "visits": 3351, "signups": 729},
            {"period": "2014-02", "visits": 2469, "signups": 1318},
            {"period": "2014-01", "visits": 2246, "signups": 461},
            {"period": "2012-12", "visits": 3171, "signups": 1676},
            {"period": "2012-11", "visits": 2155, "signups": 681},
            {"period": "2012-10", "visits": 1226, "signups": 620},
            {"period": "2012-09", "visits": 2245, "signups": 500}
        ];
        Morris.Line({
            element: 'hero-graph',
            data: tax_data,
            xkey: 'period',
            xLabels: "month",
            ykeys: ['visits', 'signups'],
            labels: ['Visits', 'User signups']
        });



        // Morris Area Chart
        Morris.Area({
            element: 'hero-area',
            data: [
                {period: '2018-01', chengdu: <?php echo $chengduc[1];?>, shanghai: <?php echo $shanghaic[1];?>, shenzhen: <?php echo $shenzhenc[1];?>},
                {period: '2018-02', chengdu: <?php echo $chengduc[2];?>, shanghai: <?php echo $shanghaic[2];?>, shenzhen: <?php echo $shenzhenc[2];?>},
                {period: '2018-03', chengdu: <?php echo $chengduc[3];?>, shanghai: <?php echo $shanghaic[3];?>, shenzhen: <?php echo $shenzhenc[3];?>},
                {period: '2018-04', chengdu: <?php echo $chengduc[4];?>, shanghai: <?php echo $shanghaic[4];?>, shenzhen: <?php echo $shenzhenc[4];?>},
                {period: '2018-05', chengdu: <?php echo $chengduc[5];?>, shanghai: <?php echo $shanghaic[5];?>, shenzhen: <?php echo $shenzhenc[5];?>},
                {period: '2018-06', chengdu: <?php echo $chengduc[6];?>, shanghai: <?php echo $shanghaic[6];?>, shenzhen: <?php echo $shenzhenc[6];?>},
                {period: '2018-07', chengdu: <?php echo $chengduc[7];?>, shanghai: <?php echo $shanghaic[7];?>, shenzhen: <?php echo $shenzhenc[7];?>},
                {period: '2018-08', chengdu: <?php echo $chengduc[8];?>, shanghai: <?php echo $shanghaic[8];?>, shenzhen: <?php echo $shenzhenc[8];?>},
                {period: '2018-09', chengdu: <?php echo $chengduc[9];?>, shanghai: <?php echo $shanghaic[9];?>, shenzhen: <?php echo $shenzhenc[9];?>},
                {period: '2018-10', chengdu: <?php echo $chengduc[10];?>, shanghai: <?php echo $shanghaic[10];?>, shenzhen: <?php echo $shenzhenc[10];?>},
                {period: '2018-11', chengdu: <?php echo $chengduc[11];?>, shanghai: <?php echo $shanghaic[11];?>, shenzhen: <?php echo $shenzhenc[11];?>},
                {period: '2018-12', chengdu: <?php echo $chengduc[12];?>, shanghai: <?php echo $shanghaic[12];?>, shenzhen: <?php echo $shenzhenc[12];?>}
            ],
            xkey: 'period',
            ykeys: ['chengdu', 'shanghai', 'shenzhen'],
            labels: ['成都', '上海', '深圳'],
            lineWidth: 2,
            hideHover: 'auto',
            lineColors: ["#81d5d9", "#a6e182", "#67bdf8"]
          });



        // Build jQuery Knobs
        $(".knob").knob();



        //  jQuery Flot Chart
        var visits = [[1, <?php echo $outcage[1];?>],
            [2, <?php echo $outcage[2];?>],
            [3, <?php echo $outcage[3];?>],
            [4, <?php echo $outcage[4];?>],
            [5, <?php echo $outcage[5];?>],
            [6, <?php echo $outcage[6];?>],
            [7, <?php echo $outcage[7];?>],
            [8, <?php echo $outcage[8];?>],
            [9, <?php echo $outcage[9];?>],
            [10, <?php echo $outcage[10];?>],
            [11, <?php echo $outcage[11];?>],
            [12, <?php echo $outcage[12];?>]];


        var visitors = [[1, <?php echo $incage[1]-$outcage[1];?>],
            [2, <?php echo $incage[2]-$outcage[2];?>],
            [3, <?php echo $incage[3]-$outcage[3];?>],
            [4, <?php echo $incage[4]-$outcage[4];?>],
            [5, <?php echo $incage[5]-$outcage[5];?>],
            [6, <?php echo $incage[6]-$outcage[6];?>],
            [7, <?php echo $incage[7]-$outcage[7];?>],
            [8, <?php echo $incage[8]-$outcage[8];?>],
            [9, <?php echo $incage[9]-$outcage[9];?>],
            [10,<?php echo $incage[10]-$outcage[10];?>],
            [11,<?php echo $incage[11]-$outcage[11];?>],
            [12,<?php echo $incage[12]-$outcage[12];?>]];

        var plot = $.plot($("#statsChart"),
            [ { data: visits, label: "出库"},
             { data: visitors, label: "入库" }], {
                series: {
                    lines: { show: true,
                            lineWidth: 1,
                            fill: true, 
                            fillColor: { colors: [ { opacity: 0.05 }, { opacity: 0.09 } ] }
                         },
                    points: { show: true, 
                             lineWidth: 2,
                             radius: 3
                         },
                    shadowSize: 0,
                    stack: true
                },
                grid: { hoverable: true, 
                       clickable: true, 
                       tickColor: "#f9f9f9",
                       borderWidth: 0
                    },
                legend: {
                        // show: false
                        labelBoxBorderColor: "#fff"
                    },  
                colors: ["#a7b5c5", "#30a0eb"],
                xaxis: {
                    ticks: [[1, "JAN"], [2, "FEB"], [3, "MAR"], [4,"APR"], [5,"MAY"], [6,"JUN"], 
                           [7,"JUL"], [8,"AUG"], [9,"SEP"], [10,"OCT"], [11,"NOV"], [12,"DEC"]],
                    font: {
                        size: 12,
                        family: "Open Sans, Arial",
                        variant: "small-caps",
                        color: "#9da3a9"
                    }
                },
                yaxis: {
                    ticks:3, 
                    tickDecimals: 0,
                    font: {size:12, color: "#9da3a9"}
                }
             });

        function showTooltip(x, y, contents) {
            $('<div id="tooltip">' + contents + '</div>').css( {
                position: 'absolute',
                display: 'none',
                top: y - 30,
                left: x - 50,
                color: "#fff",
                padding: '2px 5px',
                'border-radius': '6px',
                'background-color': '#000',
                opacity: 0.80
            }).appendTo("body").fadeIn(200);
        }

        var previousPoint = null;
        $("#statsChart").bind("plothover", function (event, pos, item) {
            if (item) {
                if (previousPoint != item.dataIndex) {
                    previousPoint = item.dataIndex;

                    $("#tooltip").remove();
                    var x = item.datapoint[0].toFixed(0),
                        y = item.datapoint[1].toFixed(0);

                    var month = item.series.xaxis.ticks[item.dataIndex].label;

                    showTooltip(item.pageX, item.pageY,
                                item.series.label + " of " + month + ": " + y);
                }
            }
            else {
                $("#tooltip").remove();
                previousPoint = null;
            }
        });
    </script>

</body>
</html>