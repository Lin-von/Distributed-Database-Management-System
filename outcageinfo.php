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

    <![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>

<!-- navbar -->
<?php require_once "navbar.html";?>
<!-- end navbar -->

<!-- sidebar -->
<?php require_once "sidebar.html";?>
<script type="text/javascript">
    document.getElementById('forsell').className = "active";

</script>


<!-- main container -->
    <div class="content">
        
        <!-- settings changer -->

        
        <div class="container-fluid">
            <div id="pad-wrapper" class="users-list">
                <div style="margin-bottom: 30px;" class="row-fluid header">
                    <h3 style="margin-bottom: 20px;">销售单据信息</h3>
                    <div class="span10 pull-right">
                        <input id="searchname" style="margin-bottom: 0; max-width: 30%;" type="text" class="span5 " placeholder="输入流水单号" />
                        <input id="cliname" style="margin-bottom: 0; max-width: 30%;" type="text" class="span5 " placeholder="输入客户名称" />
                        <input id="oprname" style="margin-bottom: 0; max-width: 30%;" type="text" class="span5 " placeholder="输入经办人" />

                        <div class="btn-glow" onclick="search()"><i class="icon-search" ></i></div>


                    </div>
                </div>
                <div style="margin-bottom: 10px;">  查询日期： <input id="start_time" type="date" style="margin:0 5px 0 0 ;height: 10px;">至<input id="end_time" type="date" style="margin:0 0 0 5px;height: 10px;">
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
                mysqli_set_charset ($conn,'utf8');


                $sql = "SELECT * FROM outCage ORDER BY opedate DESC";

                $result = $conn->query($sql);
                //$row = $result->fetch_assoc();
                $conn->close();
                ?>
                <!-- Users table -->
                <div class="row-fluid table">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="span2 sortable">
                                    流水单号
                                </th>

                                <th class="span2 sortable">
                                    <span class="line"></span>客户
                                </th>
                                <th class="span2 sortable">
                                    <span class="line"></span>金额
                                </th>
                                <th class="span2 sortable">
                                    <span class="line"></span>时间
                                </th>
                                <th class="span2 sortable">
                                    <span class="line"></span>经办人
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
                                        <?php echo $row["client"];?>

                                    </td>
                                    <td>
                                        <?php echo $row["cost"];?>

                                    </td>
                                    <td>
                                        <?php echo $row["opedate"];?>

                                    </td>
                                    <td>
                                        <?php echo $row["operator"];?>

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


        function oopen(recordid) {
            var width=Math.round((window.screen.width-500)/2);
            var height=Math.round((window.screen.height-400)/2);
            window.open('accountdetail.php?id='+recordid,'title','height=400,width=500,top='+height+',left='+width+',toolbar=no,menubar=no,scrollbars=no,resizable=no,location=no,status=no');
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

        function CompareDate(d1,d2)
        {
            return ((new Date(d1.replace(/-/g,"\/"))) > (new Date(d2.replace(/-/g,"\/"))));
        }
        function search() {
            var cli = document.getElementById('cliname').value;
            var opr = document.getElementById('oprname').value;
            var name = document.getElementById('searchname').value;
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
                if(name && tr.cells[0].innerHTML.indexOf(name) < 0) {
                    return false;
                }
                if(cli && tr.cells[1].innerHTML.indexOf(cli) < 0) {
                    return false;
                }
                if(opr && tr.cells[4].innerHTML.indexOf(opr) < 0) {
                    return false;
                }

                return true;
            });
        }
    </script>

</body>
</html>