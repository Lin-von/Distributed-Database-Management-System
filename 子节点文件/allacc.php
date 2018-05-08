<!DOCTYPE html>
<html lang="en">
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
<div class="content" style="margin: 0;">

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


    $sql = "SELECT * FROM cage WHERE status = '周转备用新件'";

    $result = $conn->query($sql);
    //$row = $result->fetch_assoc();
    $conn->close();
    ?>


    <div class="container-fluid">
        <div id="pad-wrapper" class="users-list">
            <div style="margin-bottom: 30px;" class="row-fluid header">
                <div class="span10 pull-right">
                    <input id="searchname" style="margin-bottom: 0; max-width: 80%;" type="text" class="span5 " placeholder="查询配件" />
                    <div class="btn-glow" onclick="search()"><i class="icon-search" ></i></div>
                    <!-- custom popup filter -->
                    <!-- styles are located in css/elements.css -->
                    <!-- script that enables this dropdown is located in js/theme.js -->



                </div>
            </div>

            <!-- Users table -->
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
                        <th class="span2 sortable">
                            <span class="line"></span>类别
                        </th>

                        <th class="span2 sortable">
                            <span class="line"></span>库存
                        </th>

                        <th class="span2 sortable">
                            <span class="line"></span>数量
                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    <!-- row -->
                    <?php
                    if ($result->num_rows > 0) {
                        // 输出每行数据
                        while($row = $result->fetch_assoc())
                        if($row['cnt']==0) continue ; else
                        { ?>
                            <tr >
                                <td><?php echo $row["id"];?></td>
                                <td>

                                </td>

                                <td>


                                </td>
                                <td>

                                    <?php echo $row["cnt"];?>
                                </td>
                                <td style="padding-left: 15px;"><input type="checkbox"  style="margin:0;" name="test"><input type="text" style="margin:0;width: 20px;margin:0;height: 10px;"></td>
                                <td style="display: none">
                                    <?php echo $row["province"];?>
                                </td>
                            </tr>

                        <?php     }
                    } else { ?>
                        <tr  ><td>没有记录</td></tr>
                        <?php

                    }
                    ?>
                    </tbody>
                </table>
            <a style="margin-top: 40px;"  id="addbutton" onclick="count()" class="btn-flat success pull-right">

                添加配件
            </a>
            </div>
        </div>
<!-- end users table -->
</div>
</div>
</div>
<script src="js/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/theme.js"></script>
<script type="text/javascript">
    function count() {
        var flag  = 0;
        $('input[name="test"]:checked').each(function(){
            var cnt = $(this).parents("tr").find("input:text").val();
            var left = $(this).parents("tr").children("td").eq(4)[0].innerText;
            if(parseInt(cnt)>parseInt(left)) {
                alert("超出库存上限！");
                flag = 1;
                return;
            }
        });
        if(flag == 0)sub();
    }
    function sub() {
        // 找到选中行的input

        var id_array=new Array();

        $('input[name="test"]:checked').each(function(){
            id_array.push($(this).parents("tr").children("td").eq(0)[0].innerText);//向数组中添加元素

            id_array.push($(this).parents("tr").children("td").eq(3)[0].innerText);//向数组中添加元素

            //console.log($(this).parents("tr").children("td").eq(0)[0].innerText);
            id_array.push($(this).parents("tr").find("input:text").val());//向数组中添加元素
        });
        var idstr=id_array.join(',');//将数组元素连接起来以构建一个字符串
     //   alert(idstr);
        //str = .map(function() {return $(this).val();}).get().join(", ");
        var wind = self.opener;
        wind.show(idstr);
        this.close();

    }
    function parseURL(url) {
        var a =  document.createElement('a');
        a.href = url;
        return {
            source: url,
            protocol: a.protocol.replace(':',''),
            host: a.hostname,
            port: a.port,
            query: a.search,
            params: (function(){
                var ret = {},
                    seg = a.search.replace(/^\?/,'').split('&'),
                    len = seg.length, i = 0, s;
                for (;i<len;i++) {
                    if (!seg[i]) { continue; }
                    s = seg[i].split('=');
                    ret[s[0]] = s[1];
                }
                return ret;
            })(),
            file: (a.pathname.match(/\/([^\/?#]+)$/i) || [,''])[1],
            hash: a.hash.replace('#',''),
            path: a.pathname.replace(/^([^\/])/,'/$1'),
            relative: (a.href.match(/tps?:\/\/[^\/]+(.+)/) || [,''])[1],
            segments: a.pathname.replace(/^\//,'').split('/')
        };
    }



    var accname = new Array();
    var accprice = new Array();
    var accclass = new Array();
    var accpriceo = new Array();
    $.ajax({
        type: 'POST',
        url: 'http://111.230.12.120/Controller/Controller.php?controller=Set&method=showAccInfo',
        async:false,
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


    var list = document.getElementsByTagName('table')[0].getElementsByTagName('tbody')[0].rows;
    var size = list.length;
    var tr;
    for(var i = 0; i < size; i++) {
        tr = list[i];
        var id = tr.cells[0].innerText;
        tr.cells[1].innerText = accname[id];
        tr.cells[2].innerText = accclass[id];

    }

    var myurl = parseURL(window.location.href);
    var prv = myurl.params.province;
    prv = decodeURIComponent(prv);
    console.log(prv);

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
    function search() {
        var name = document.getElementById('searchname').value;
        filter(function(tr) {

            if(name && tr.cells[1].innerHTML.indexOf(name) < 0) {
                return false;
            }
            if(prv && tr.cells[5].innerHTML.indexOf(prv) < 0) {
                return false;
            }
            return true;
        });
    }

    filter(function(tr) {

        if(prv && tr.cells[5].innerHTML.indexOf(prv) < 0) {
            return false;
        }

        return true;
    });
</script>
</body>
</html>