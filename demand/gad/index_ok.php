<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
session_start();
include "conn/conn.php";
include "inc/func.php";
include "inc/record.php";
$username=$_POST['username'];
$pwd=$_POST['pwd'];
$username=trim($username,"*!$?");
$subcompany=$_POST['subcompany'];
//$branch='default';
switch($subcompany){
    case 1: break;
    case 2: $username="!".$username;break;
    case 3: $username="$".$username;break;
    case 4: $username="*".$username;break;
    case 5: $username="?".$username;break;
    default: break;
}

$sqlstr = "select * from user where name = '$username' and pwd = '$pwd'";
    $rs=$pdo->query($sqlstr);
    $record = $rs->fetch();
    if($record != "") 
    {
        $_SESSION["id"] = $record['id'];
        //$_SESSION["name"] = $_POST[username];
        $_SESSION["name"] = $record['name'];
        $_SESSION["nick_name"] = $record['nick_name'];
        $_SESSION["group"] = $record['group'];
        $_SESSION["authority"] = $record['authority'];
        $_SESSION["branch"] = $record['branch'];
//      echo $_SESSION["name"];
//      $_SESSION["type"] = read_field($conn,"user","d_name",$record[2]);
        Record($_POST['action']);
        echo "<script>alert('欢迎光临');location='pub_main.php';</script>";
    }
    else
//      echo $sqlstr;
        echo "<script>alert('用户名或密码错误');history.go(-1);</script>";
?>