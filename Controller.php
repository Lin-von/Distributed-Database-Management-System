<?php
/**
 * Created by PhpStorm.
 * User: linvon
 * Date: 2018/5/1
 * Time: 14:45
 */



$class_name = $_GET['controller']."Controller";

$method_name = $_GET['method'];
set_include_path("/"); //这里需要将路径放入include
spl_autoload($class_name);

$class = new ReflectionClass($class_name);
$instance =  $class->newInstance();

$method = $class->getmethod($method_name); // 获取Person 类中的setName方法



$parameters = $method->getParameters();
$params = array();


foreach($parameters as $key=>$param) {
    $value = $_POST[$param->getName()];
    array_push($params,$value);
}

$method->invokeArgs($instance,$params);