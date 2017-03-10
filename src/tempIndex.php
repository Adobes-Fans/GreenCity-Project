<?php
    $pdo = new PDO('mysql:host=localhost;dbname=GreenCity', "root", "123456", array(PDO::ATTR_PERSISTENT => true));
    session_start();
    $sqlstr = "select * from user where name = 'BBB'";
    $rs=$pdo->query($sqlstr);
    $record = $rs->fetch();
    $_SESSION["id"] = $record['id'];
    $_SESSION["name"] = $record['name'];
    $_SESSION["nick_name"] = $record['nick_name'];
    $_SESSION["group"] = $record['group'];
    $_SESSION["authority"] = $record['authority'];
    $_SESSION["branch"] = $record['branch'];
    if(isset($_SESSION['branch'])){
        echo "<script>alert('".$_SESSION["name"]."');</script>";
        Header("Location:/src/List.php"); 
    }
    echo "text";
?>