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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">
        tr.hide,tr.hide td{display:none;}
    </style></head>
<body>

<!-- navbar -->
<?php require_once "navbar.html";?>

<!-- end navbar -->

<!-- sidebar -->
<?php require_once "sidebar.html";?>
<script type="text/javascript">
    document.getElementById('forset').className = "active";

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


        $sql = "SELECT * FROM accClass";

    $result = $conn->query($sql);
    //$row = $result->fetch_assoc();
    $conn->close();
    $classname = array();
    ?>
    <div class="container-fluid">
        <div id="pad-wrapper" class="users-list">
            <div style="margin-bottom: 30px;" class="row-fluid header">
                <h3 style="margin-bottom: 20px;">配件信息</h3>
                <div class="span10 pull-right">
                    <input id="searchname" style="margin-bottom: 0; max-width: 80%;" type="text" class="span5 " placeholder="输入配件名称" />
                    <div class="btn-glow" onclick="search()"><i class="icon-search" ></i></div>
                    <!-- custom popup filter -->
                    <!-- styles are located in css/elements.css -->
                    <!-- script that enables this dropdown is located in js/theme.js -->
                    <div class="ui-dropdown">
                        <select style="min-height: 30px;" id="classname" onchange="search()">
                            <option disabled="disabled" selected/>按类别查看
                            <option value=""/>所有类别
                            <?php
                            if ($result->num_rows > 0) {
                            // 输出每行数据
                            while($row = $result->fetch_assoc())  {
                                $classname[$row['id']] = $row['classname']; ?>
                                <option /> <?php echo $row["classname"];?>
                            <?php     }
                            }
                            ?>


                        </select>
                     </div>

                    <a style="margin-top: 40px;" href="newacc.php" class="btn-flat success pull-right">
                        <span>&#43;</span>
                        新增配件
                    </a>
                </div>
            </div>
            <script type="text/javascript">
                var xmlhttp;
                if (window.XMLHttpRequest)
                {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
                }
                else
                {// code for IE6, IE5
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }


                xmlhttp.onreadystatechange=function()
                {

                    if (xmlhttp.readyState==4 && xmlhttp.status==200)
                    {

                        var str=xmlhttp.responseText;


                    }
                }
                xmlhttp.open("POST","Controller.php?controller=Set&method=showClassName",true);
                xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                xmlhttp.send();
            </script>
            <!-- Users table -->

            <script type="text/javascript">
                function addRow(tbody,obj)
                {

                    //添加一行
                    var newTr = document.createElement('tr');
                    //添加两列
                    var newTd0 = newTr.insertCell();
                    var newTd1 = newTr.insertCell();
                    var newTd2 = newTr.insertCell();
                    var newTd3 = newTr.insertCell();
                    var newTd4 = newTr.insertCell();
                    var newTd5 = newTr.insertCell();
                    var newTd6 = newTr.insertCell();
                    var newTd7 = newTr.insertCell();
                    var newTd8 = newTr.insertCell();

                    //设置列内容和属性
                    newTd0.innerText= obj.id;
                    newTd1.innerText= obj.accname;
                    newTd2.innerText= obj.classname;
                    newTd3.innerText= obj.pricein;
                    newTd4.innerText= obj.priceout;
                    newTd5.innerText= obj.lowrange;
                    newTd6.innerText= obj.uprange;
                    newTd7.innerText= obj.note;
                    newTd8.innerHTML = '<div class="btn-glow" onclick="jump('+obj.id+')" style="margin-left: 20px;"><i class="icon-remove-sign" ></i> 修改</div>' +
                        '<div class="btn-glow" onclick="destroyCommit('+obj.id+')" style="margin-left: 20px;"><i class="icon-remove-sign" ></i> 删除</div>';

                    tbody.appendChild(newTr);
                }

                var xmlhttp;
                if (window.XMLHttpRequest)
                {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
                }
                else
                {// code for IE6, IE5
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }


                xmlhttp.onreadystatechange=function()
                {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200)
                    {
                        var str=xmlhttp.responseText;
                        //alert(str);
                        var obj = JSON.parse(str);
                        //console.log(obj[0]);
                        if(obj.length>0)
                        {
                            var tbody = document.createElement('tbody');
                            for(var i=0;i<obj.length;i++){
                                addRow(tbody,obj[i]);
                            }
                            document.getElementById('info').appendChild(tbody);
                        }

                        else{
                            var newTr = document.getElementById('info').insertRow();
                            //添加两列
                            var newTd0 = newTr.insertCell();
                            newTd0.innerText= "没有记录";
                        }
                    }
                }
                xmlhttp.open("POST","Controller.php?controller=Set&method=showAccInfo",true);
                xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                xmlhttp.send();
            </script>

            <div class="row-fluid table">
                <table class="table table-hover" id="info">
                    <thead>
                    <tr>
                        <th class="span2 sortable">
                            编号
                        </th>

                        <th class="span2 sortable">
                            <span class="line"></span>名称
                        </th>
                        <th class="span1 sortable">
                            <span class="line"></span>类别
                        </th>
                        <th class="span1 sortable">
                            <span class="line"></span>进价
                        </th>
                        <th class="span1 sortable">
                            <span class="line"></span>售价
                        </th>
                        <th class="span1 sortable">
                            <span class="line"></span>库存下限
                        </th>
                        <th class="span1 sortable">
                            <span class="line"></span>库存上限
                        </th>
                        <th class="span2 sortable">
                            <span class="line"></span>备注
                        </th>
                        <th class="span2 sortable ">
                            <span class="line"></span>操作
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


    function destroyCommit(id) {
        if(confirm("确定要删除该配件信息吗？"))
            $.ajax({
                type: 'POST',
                url: 'Controller.php?controller=Set&method=delAcc',
                data: "id="+id,
                success: window.location.href='accinfo.php'
            });
        else return false;
    }

    function jump(id) {
        window.location.href="updateacc.php?id="+id;
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
        var classname = document.getElementById('classname').value;
        var name = document.getElementById('searchname').value;
        //var course = document.getElementById('course').value;
        filter(function(tr) {
            if(classname && tr.cells[2].innerHTML != classname) {
                return false;
            }
            if(name && tr.cells[1].innerHTML.indexOf(name) < 0) {
                return false;
            }

            return true;
        });
    }
</script>

</body>
</html>