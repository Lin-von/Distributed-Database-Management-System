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
    document.getElementById('forcage').className = "active";

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


        $sql = "SELECT count(*) FROM cage  WHERE status = '周转备用新件'";

        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $conn->close();
        ?>
        
        <div class="container-fluid">
            <div id="pad-wrapper" class="users-list">
                <div style="margin-bottom: 30px;" class="row-fluid header">
                    <h3 style="margin-bottom: 20px;">仓库盘点</h3>
                    <div class="span10 pull-right">
                        <input id="id" style="margin-bottom: 0; max-width: 35%;" type="text" class="span5 " placeholder="输入配件编号" />

                        <div class="btn-glow" onclick="addacc()"><i class="icon-plus" ></i></div>
                        <!-- custom popup filter -->
                        <!-- styles are located in css/elements.css -->
                        <!-- script that enables this dropdown is located in js/theme.js -->



                    </div>
                    <span style="margin-top: 40px;margin-left: 50px;" id="sum" class="label label-success pull-right"><i class="icon-money" ></i>盈亏：0</span>
                    <span style="margin-top: 40px;margin-left: 30px;" id="aldcnt" class="label label-info pull-right"><i class="icon-tag" ></i>已盘种数：0</span>
                    <span style="margin-top: 40px;" id="sumcnt" class="label label-info pull-right"><i class="icon-tags" ></i>配件总数：<?php echo $row['count(*)'];?></span>

                </div>
                <a style="margin-bottom: 20px;" onclick="deleteRows()" class="btn-flat info ">
                    清空

                </a>
                <!-- Users table -->
                <div class="row-fluid table">
                    <table class="table table-hover" id="info">
                        <thead>
                            <tr>
                                <th class="span2 sortable">
                                    配件编号
                                </th>

                                <th class="span2 sortable">
                                    <span class="line"></span>配件名称
                                </th>

                                <th class="span2 sortable">
                                    <span class="line"></span>库存量
                                </th>
                                <th class="span2 sortable">
                                    <span class="line"></span>盘点量
                                </th>
                                <th class="span2 sortable">
                                    <span class="line"></span>盈亏
                                </th>

                            </tr>
                        </thead>

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

        function deleteRows(){
            var list = document.getElementsByTagName('table')[0].getElementsByTagName('tbody')[0].rows;
            var size = list.length;
            var tr;
            for(var i = size-1; i >= 0; i--) {
                tr = list[i];
                var tbody=tr.parentNode;
                tbody.removeChild(tr);
            }
        }


        var tbody = document.createElement('tbody');
        document.getElementById('info').appendChild(tbody);

        function addRow(tbody,id,cnt)
        {

            //添加一行
            var newTr = document.createElement('tr');
            //添加两列
            var newTd0 = newTr.insertCell();
            var newTd1 = newTr.insertCell();
            var newTd2 = newTr.insertCell();
           // var newTd3 = newTr.insertCell();
            var newTd4 = newTr.insertCell();
         //   var newTd5 = newTr.insertCell();
            var newTd8 = newTr.insertCell();

            //设置列内容和属性
            newTd0.innerText= id;
            newTd1.innerText= accname[id];
            newTd2.innerText= cnt;

            newTd4.innerHTML= "<td><input type=\"text\" onchange='recalc(this)' style=\"width: 20px;margin:0;height: 10px;\"></td>\n";

            //   newTd5.innerText= (parseInt(cnt)*parseInt(obj.pricein)).toString();


            tbody.appendChild(newTr);
        }



        function recalc(tem) {
            var id = $(tem).parents("tr").children("td").eq(0)[0].innerText;

            var cnt = $(tem).parents("tr").children("td").eq(2)[0].innerText;
            cnt = tem.value - parseInt(cnt);
            var pri = accpriceo[id]-accprice[id];
            $(tem).parents("tr").children("td").eq(4)[0].innerText = (parseInt(cnt)*parseInt(pri)).toString();
            resum();
        }

        function resum() {
            var list = document.getElementsByTagName('table')[0].getElementsByTagName('tbody')[0].rows;
            var size = list.length;
            var tr;
            sum = 0;
            for(var i = 0; i < size; i++) {
                tr = list[i];
                sum += parseInt(tr.cells[4].innerText);

            }
            document.getElementById('sum').innerText = "盈亏：￥" + sum.toString();
        }

        var accname = new Array();
        var accprice = new Array();
        var accclass = new Array();
        var accpriceo = new Array();
        $.ajax({
            type: 'POST',
            url: 'Controller/Controller.php?controller=Set&method=showAccInfo',
           // async:false,
            success: function (data) {
                var str = data;
                infoobj = JSON.parse(str);
                for(var i=0;i<infoobj.length;i++){
                    accname[infoobj[i].id] = infoobj[i].accname;
                    accprice[infoobj[i].id] = infoobj[i].pricein;
                    accclass[infoobj[i].id] = infoobj[i].classname;
                    accpriceo[infoobj[i].id] = infoobj[i].priceout;
                }
            }
        });


       function addacc() {

           var id = document.getElementById('id').value;

           var list = document.getElementsByTagName('table')[0].getElementsByTagName('tbody')[0].rows;
           var size = list.length;
           var tr;
           for(var i = 0; i < size; i++) {
               tr = list[i];
               if(tr.cells[0].innerText == id) {
                   alert("该配件已盘点！");
                   return;
               }
           }
           document.getElementById('aldcnt').innerText = "已盘种数："+(size+1).toString();
           $.ajax({
               type: 'POST',
               url: 'Controller/Controller.php?controller=Cage&method=showAccCnt',
               data: "id="+id,
               // async:false,
               success: function (data) {
                   addRow(tbody,id,data)

               }
           });
       }
    </script>

</body>
</html>