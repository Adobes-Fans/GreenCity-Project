<?php 
if(!isset($_SESSION)){
   session_start();
}
//echo $_SESSION['name'];
if(!isset($_SESSION['name'])){
	$host=$_SERVER ['HTTP_HOST'];
	echo "<script>alert('您无权访问');top.location='http://$host/GAD/index.php';</script>";
}
//if($_SERVER['HTTP_REFERER'] == "")
/*	echo "<script>alert('本系统不允许直接从地址栏访问');window.close();</script>";*/
?>