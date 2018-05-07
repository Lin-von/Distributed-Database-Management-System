<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<title>Detail Admin - New User Form</title>
    
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
    <link rel="stylesheet" href="css/compiled/new-user.css" type="text/css" media="screen" />


    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>

<!-- navbar -->
<?php require_once "navbar.html";?><!-- end navbar -->

<!-- sidebar -->
<?php require_once "sidebar.html";?>
<script type="text/javascript">
    document.getElementById('forset').className = "active";

</script><!-- end sidebar -->


	<!-- main container -->
    <div class="content">
        
        <!-- settings changer -->

        
        <div class="container-fluid">
            <div id="pad-wrapper" class="new-user">
                <div class="row-fluid header">
                    <h3>添加一个员工</h3>
                </div>

                <div class="row-fluid form-wrapper">
                    <!-- left column -->
                    <div class="span9 with-sidebar">
                        <div class="container">
                            <form class="new_user_form inline-input" action="Controller.php?controller=User&method=addUser"  method="post"/>

                                <div class="span12 field-box">
                                    <label>姓名:</label>
                                    <input class="span2" type="text" name="realname"/>
                                </div>


                            <div class="span12 field-box">
                                <label>电话</label>
                                <input class="span3" type="text" name="tel"/>
                            </div>

                            <div class="span12 field-box">
                                <label>类别:</label>
                                <div class="ui-select span2">
                                    <select name="uposition">

                                        <option /> 管理员
                                        <option /> 销售员
                                        <option /> 采购员
                                        <option /> 业务员
                                        <option /> 仓管员

                                    </select>
                                </div>
                            </div>
                            <div class="span12 field-box">
                                <label>账号</label>
                                <input class="span2" type="text" name="username"/>
                            </div><div class="span12 field-box">
                                <label>密码</label>
                                <input class="span2" type="password" name="password"/>
                            </div>

                                <div class="span11 field-box actions">
                                    <input type="submit" class="btn-glow primary" value="添加" />

                                </div>
                            <div id="mes"></div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end main container -->


	<!-- scripts -->
    <script src="js/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/theme.js"></script>

    <script type="text/javascript">
        $(function () {

            // toggle form between inline and normal inputs
            var $buttons = $(".toggle-inputs button");
            var $form = $("form.new_user_form");

            $buttons.click(function () {
                var mode = $(this).data("input");
                $buttons.removeClass("active");
                $(this).addClass("active");

                if (mode === "inline") {
                    $form.addClass("inline-input");
                } else {
                    $form.removeClass("inline-input");
                }
            });
        });
    </script>


<script type="text/javascript">
    var Mes = document.getElementById("mes");
    //alert(window.location.href.indexOf("mes=1"));
    if(window.location.href.indexOf("mes=1") != -1)  {Mes.innerText = "新进配件成功！";}

    if(window.location.href.indexOf("mes=2") != -1)  {Mes.innerText = "新进配件失败！";}
</script>

</body>
</html>