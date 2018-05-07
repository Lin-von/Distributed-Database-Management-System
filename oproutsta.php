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
<?php require_once "navbar.html";?>
<!-- end navbar -->

<!-- sidebar -->
<?php require_once "sidebar.html";?>
<script type="text/javascript">
    document.getElementById('forsta').className = "active";

</script>


<!-- main container -->
    <div class="content">
        
        <!-- settings changer -->

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

        $sql = "SELECT * FROM users  ";

        $info = $conn->query($sql);

        $sql = "SELECT * FROM outCage UNION SELECT * FROM obCage ORDER BY opedate DESC ";

        $result = $conn->query($sql);
        //$row = $result->fetch_assoc();
        $conn->close();
        ?>
        <div class="container-fluid">
            <div id="pad-wrapper" class="users-list">
                <div style="margin-bottom: 30px;" class="row-fluid header">
                    <h3 style="margin-bottom: 20px;">业务员销售统计</h3>
                    <div class="span10 pull-right">
                        <div class="ui-dropdown">
                            <select style="min-height: 30px;margin-top: 40px; width: 150px;" id="opr" onchange="search()" >
                                <option disabled="disabled" value="" selected/>请选择经办人
                                <?php
                                if ($info->num_rows > 0) {
                                    // 输出每行数据
                                    while($row = $info->fetch_assoc())  {
                                        ?>
                                        <option /> <?php echo $row["realname"];?>
                                    <?php     }
                                }
                                ?>


                            </select>

                        </div><!-- custom popup filter -->
                        <!-- styles are located in css/elements.css -->
                        <!-- script that enables this dropdown is located in js/theme.js -->



                    </div>
                </div>
                <div style="margin-bottom: 10px;">  查询日期： <input id="start_time" type="date" style="margin:0 5px 0 0 ;height: 10px;">至<input id="end_time" type="date" style="margin:0 0 0 5px;height: 10px;">
                    <i class="icon-search" onclick="search()"></i>
                </div>
                <!-- Users table -->
                <div class="row-fluid table">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="span2 sortable">
                                    流水单号
                                </th>
                                <th class="span2 sortable">
                                    <span class="line"></span>时间
                                </th>
                                <th class="span2 sortable">
                                    <span class="line"></span>经办人
                                </th>
                                <th class="span2 sortable">
                                    <span class="line"></span>说明
                                </th>
                                <th class="span2 sortable">
                                    <span class="line"></span>客户
                                </th>
                                <th class="span2 sortable">
                                    <span class="line"></span>金额
                                </th>
                                <th class="span2 sortable">
                                    <span class="line"></span>仓库
                                </th>

                                <th class="span3 sortable ">
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
                                <tr  >
                                    <td>
                                        <?php echo $row["id"];?>

                                    </td>
                                    <td>
                                        <?php echo $row["opedate"];?>

                                    </td>
                                    <td>
                                        <?php echo $row["operator"];?>


                                    </td>
                                    <td>
                                        <?php
                                        switch (substr($row['id'],0,2)){
                                            case "IN": {echo "采购进货"; break;}
                                            case "IB": {echo "采购退货"; break;}
                                            case "OT": {echo "配件销售"; break;}
                                            case "Ob": {echo "客户退货"; break;}
                                            case "SO": {echo "配件报旧"; break;}
                                            case "SF": {echo "配件报修"; break;}
                                            case "SD": {echo "配件报损"; break;}
                                            case "SU": {echo "配件报溢"; break;}
                                            case "CI": {echo "调拨入库"; break;}
                                            case "CO": {echo "调拨出库"; break;}


                                        }
                                        ?>

                                    </td>
                                    <td>
                                        <?php echo $row["client"];?>

                                    </td>

                                    <td>
                                        <?php echo $row["cost"];?>

                                    </td>
                                    <td>
                                        <?php echo $row["province"];?>

                                    </td>
                                    <td >
                                        <div class="btn-glow" onclick="oopen('<?php echo $row["id"];?>')" style="margin-left: 20px;"><i class="icon-search" ></i> 查看详情</div>

                                    </td>
                                </tr>



                                </div>

                            <?php     }
                        } else { ?>
                                <tr  ><td>没有记录</td></tr>
                        <?php

                        }
                        ?>

                        <!-- row -->

                        </tbody>
                    </table>
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
            window.location.href="updatecli.php?id="+id;
        }

        function oopen(recordid) {
            var width=Math.round((window.screen.width-500)/2);
            var height=Math.round((window.screen.height-400)/2);
            window.open('accountdetail.php?id='+recordid,'title','height=400,width=500,top='+height+',left='+width+',toolbar=no,menubar=no,scrollbars=no,resizable=no,location=no,status=no');
        }

        function destroyCommit(id) {
            if(confirm("确定要删除该客户信息吗？"))
                $.ajax({
                    type: 'POST',
                    url: 'Controller.php?controller=Set&method=delCli',
                    data: "id="+id,
                    success: window.location.href='cliinfo.php'
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
        function CompareDate(d1,d2)
        {
            return ((new Date(d1.replace(/-/g,"\/"))) > (new Date(d2.replace(/-/g,"\/"))));
        }
        function search() {
            var opr = document.getElementById('opr').value;
            //var course = document.getElementById('course').value;
            var stime = document.getElementById('start_time').value;
            var etime = document.getElementById('end_time').value;
            if(CompareDate(stime,etime)) {alert("起始日期不能大于终止日期！"); return;}
            filter(function(tr) {
                if(stime && CompareDate(stime,tr.cells[3].innerText)) {
                    return false;
                }
                if(etime && CompareDate(tr.cells[3].innerText,etime)) {
                    return false;
                }

                if(opr && tr.cells[2].innerHTML.indexOf(opr) < 0) {
                    return false;
                }

                return true;
            });
        }
    </script>

</body>
</html>