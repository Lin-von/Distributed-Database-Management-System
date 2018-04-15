<?php session_start();?>
<?php
if(!isset($_SESSION['user']))  header( "location:signin.html");

?>
<!DOCTYPE html>

<html>
<head>
	<title>售后配件库管理系统</title>
    
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
    <!-- bootstrap -->
    <link href="css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="css/bootstrap/bootstrap-responsive.css" rel="stylesheet" />
    <link href="css/bootstrap/bootstrap-overrides.css" type="text/css" rel="stylesheet" />

    <!-- libraries -->
    <link href="css/lib/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css" />
    <link href="css/lib/font-awesome.css" type="text/css" rel="stylesheet" />

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="css/layout.css" />
    <link rel="stylesheet" type="text/css" href="css/elements.css" />
    <link rel="stylesheet" type="text/css" href="css/icons.css" />

    <!-- this page specific styles -->
    <link rel="stylesheet" href="css/compiled/index.css" type="text/css" media="screen" />    

    <!-- open sans font -->
    <!--<link href='http://fonts.useso.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css' />

    &lt;!&ndash; lato font &ndash;&gt;
    <link href='http://fonts.useso.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css' />
-->
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
            <li class="active">
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
        $incage[$row['dateduan']] = $row['count(*)'];
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
        $outcage[$row['dateduan']] = $row['count(*)'];
    }



    $conn->close();
    ?>
	<!-- main container -->
    <div class="content">

        <!-- settings changer -->

        <div class="container-fluid">

            <!-- upper main stats -->
            <div id="main-stats">
                <div class="row-fluid stats-row">
                    <div class="span3 stat">
                        <div class="data">
                            <span class="number"><?php echo $count1?></span>
                            条记录
                        </div>
                        <span class="date">周转备用新件</span>
                    </div>
                    <div class="span3 stat">
                        <div class="data">
                            <span class="number"><?php echo $count2?></span>
                            条记录
                        </div>
                        <span class="date">周转备用旧件</span>
                    </div>
                    <div class="span3 stat">
                        <div class="data">
                            <span class="number"><?php echo $count3?></span>
                            条记录
                        </div>
                        <span class="date">返修配件</span>
                    </div>
                    <div class="span3 stat last">
                        <div class="data">
                            <span class="number"><?php echo $count4?></span>
                            条记录
                        </div>
                        <span class="date">报损件</span>
                    </div>
                </div>
            </div>
            <!-- end upper main stats -->

            <div id="pad-wrapper">

                <!-- statistics chart built with jQuery Flot -->
                <div class="row-fluid chart">
                    <h4>
                        进出库变化统计
                    </h4>
                    <div class="span12">
                        <div id="statsChart"></div>
                    </div>
                </div>
                <!-- end statistics chart -->

                <!-- UI Elements section -->
                <div class="row-fluid section ui-elements">
                    <h4>UI Elements</h4>
                    <div class="span5 knobs">
                        <div class="knob-wrapper">
                            <input type="text" value="50" class="knob" data-thickness=".3" data-inputcolor="#333" data-fgcolor="#30a1ec" data-bgcolor="#d4ecfd" data-width="150" />
                            <div class="info">
                                <div class="param">
                                    <span class="line blue"></span>
                                    Active users
                                </div>
                            </div>
                        </div>
                        <div class="knob-wrapper">
                            <input type="text" value="75" class="knob second" data-thickness=".3" data-inputcolor="#333" data-fgcolor="#3d88ba" data-bgcolor="#d4ecfd" data-width="150" />
                            <div class="info">
                                <div class="param">
                                    <span class="line blue"></span>
                                    % disk space usage
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="span6 showcase">
                        <div class="ui-sliders">
                            <div class="slider slider-sample1 vertical-handler"></div>
                            <div class="slider slider-sample2"></div>
                            <div class="slider slider-sample3"></div>
                        </div>
                        <div class="ui-group">
                            <a class="btn-flat inverse">Large Button</a>
                            <a class="btn-flat gray">Large Button</a>
                            <a class="btn-flat default">Large Button</a>
                            <a class="btn-flat primary">Large Button</a>
                        </div>                        

                        <div class="ui-group">
                            <a class="btn-flat icon">
                                <i class="tool"></i> Icon button
                            </a>
                            <a class="btn-glow small inverse">
                                <i class="shuffle"></i>
                            </a>
                            <a class="btn-glow small primary">
                                <i class="setting"></i>
                            </a>
                            <a class="btn-glow small default">
                                <i class="attach"></i>
                            </a>
                            <div class="ui-select">
                                <select>
                                    <option selected="" />Dropdown
                                    <option />Custom selects
                                    <option />Pure css styles
                                </select>
                            </div>

                            <div class="btn-group">
                                <button class="glow left">LEFT</button>
                                <button class="glow right">RIGHT</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end UI elements section -->

                <!-- table sample -->
                <!-- the script for the toggle all checkboxes from header is located in js/theme.js -->
                <div class="table-products section">
                    <div class="row-fluid head">
                        <div class="span12">
                            <h4>Products <small>Table sample</small></h4>
                        </div>
                    </div>

                    <div class="row-fluid filter-block">
                        <div class="pull-right">
                            <div class="ui-select">
                                <select>
                                  <option />Filter users
                                  <option />Signed last 30 days
                                  <option />Active users
                                </select>
                            </div>
                            <input type="text" class="search" />
                            <a class="btn-flat new-product">+ Add product</a>
                        </div>
                    </div>

                    <div class="row-fluid">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="span3">
                                        <input type="checkbox" />
                                        Product
                                    </th>
                                    <th class="span3">
                                        <span class="line"></span>Description
                                    </th>
                                    <th class="span3">
                                        <span class="line"></span>Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- row -->
                                <tr class="first">
                                    <td>
                                        <input type="checkbox" />
                                        <div class="img">
                                            <img src="img/table-img.png" />
                                        </div>
                                        <a href="#">There are many variations </a>
                                    </td>
                                    <td class="description">
                                        if you are going to use a passage of Lorem Ipsum.
                                    </td>
                                    <td>
                                        <span class="label label-success">Active</span>
                                        <ul class="actions">
                                            <li><i class="table-edit"></i></li>
                                            <li><i class="table-settings"></i></li>
                                            <li class="last"><i class="table-delete"></i></li>
                                        </ul>
                                    </td>
                                </tr>
                                <!-- row -->
                                <tr>
                                    <td>
                                        <input type="checkbox" />
                                        <div class="img">
                                            <img src="img/table-img.png" />
                                        </div>
                                        <a href="#">Internet tend</a>
                                    </td>
                                    <td class="description">
                                        There are many variations of passages.
                                    </td>
                                    <td>
                                        <ul class="actions">
                                            <li><i class="table-edit"></i></li>
                                            <li><i class="table-settings"></i></li>
                                            <li class="last"><i class="table-delete"></i></li>
                                        </ul>
                                    </td>
                                </tr>
                                <!-- row -->
                                <tr>
                                    <td>
                                        <input type="checkbox" />
                                        <div class="img">
                                            <img src="img/table-img.png" />
                                        </div>
                                        <a href="#">Many desktop publishing </a>
                                    </td>
                                    <td class="description">
                                        if you are going to use a passage of Lorem Ipsum.
                                    </td>
                                    <td>
                                        <ul class="actions">
                                            <li><i class="table-edit"></i></li>
                                            <li><i class="table-settings"></i></li>
                                            <li class="last"><i class="table-delete"></i></li>
                                        </ul>
                                    </td>
                                </tr>
                                <!-- row -->
                                <tr>
                                    <td>
                                        <input type="checkbox" />
                                        <div class="img">
                                            <img src="img/table-img.png" />
                                        </div>
                                        <a href="#">Generate Lorem </a>
                                    </td>
                                    <td class="description">
                                        There are many variations of passages.
                                    </td>
                                    <td>
                                        <span class="label label-info">Standby</span>
                                        <ul class="actions">
                                            <li><i class="table-edit"></i></li>
                                            <li><i class="table-settings"></i></li>
                                            <li class="last"><i class="table-delete"></i></li>
                                        </ul>
                                    </td>
                                </tr>
                                <!-- row -->
                                <tr>
                                    <td>
                                        <input type="checkbox" />
                                        <div class="img">
                                            <img src="img/table-img.png" />
                                        </div>
                                        <a href="#">Internet tend</a>
                                    </td>
                                    <td class="description">
                                        There are many variations of passages.
                                    </td>
                                    <td>                                        
                                        <ul class="actions">
                                            <li><i class="table-edit"></i></li>
                                            <li><i class="table-settings"></i></li>
                                            <li class="last"><i class="table-delete"></i></li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination">
                      <ul>
                        <li><a href="#">&#8249;</a></li>
                        <li><a class="active" href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">&#8250;</a></li>
                      </ul>
                    </div>
                </div>
                <!-- end table sample -->
            </div>
        </div>
    </div>


	<!-- scripts -->
    <script src="js/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-ui-1.10.2.custom.min.js"></script>
    <!-- knob -->
    <script src="js/jquery.knob.js"></script>
    <!-- flot charts -->
    <script src="js/jquery.flot.js"></script>
    <script src="js/jquery.flot.stack.js"></script>
    <script src="js/jquery.flot.resize.js"></script>
    <script src="js/theme.js"></script>

    <script type="text/javascript">
        $(function () {

            // jQuery Knobs
            $(".knob").knob();



            // jQuery UI Sliders
            $(".slider-sample1").slider({
                value: 100,
                min: 1,
                max: 500
            });
            $(".slider-sample2").slider({
                range: "min",
                value: 130,
                min: 1,
                max: 500
            });
            $(".slider-sample3").slider({
                range: true,
                min: 0,
                max: 500,
                values: [ 40, 170 ],
            });

            

            // jQuery Flot Chart
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
                                fillColor: { colors: [ { opacity: 0.1 }, { opacity: 0.13 } ] }
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
                            color: "#697695"
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
        });


    </script>

</body>
</html>