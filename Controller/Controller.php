<?php
header("Access-Control-Allow-Origin: *");
$class_name = $_GET['controller']."Controller";
$method_name = $_GET['method'];
function __autoload($class_name) {
    require_once $class_name . '.php';
}
__autoload($class_name);
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