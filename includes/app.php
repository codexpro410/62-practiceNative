<?php
$helpers = [];
$helperFiles = glob(__DIR__ ."/helpers/*.php");
foreach($helperFiles as $helper){
  include $helper;
  // echo $helper."<br>";
}

$localhost = "localhost";
$username = "root";
$password = "";
$db = "phpAnonymous";

//    if database existed
$connect = mysqli_connect($localhost,$username,$password,$db);
if($connect){
  // echo "connected to database <br>";
}else{
  echo "not connected";
} 

$query=[];
