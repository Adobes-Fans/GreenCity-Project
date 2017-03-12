<!DOCTYPE html> 
<html> 
<?php
    session_start();
    $pdo = new PDO('mysql:host=localhost;dbname=GreenCity', "root", "123456", array(PDO::ATTR_PERSISTENT => true));
    // echo "hello world!";
    // echo "test";
?>
<body> 
<?php
    if (isset($_COOKIE["operation"]) && $_COOKIE["operation"]=='3'){
        if(isset($_COOKIE["deleteType"]) && $_COOKIE["deleteType"]=='0'){
            $sqlquery = "UPDATE Project SET isExisting = 0 WHERE projectName = '".$_COOKIE["itemName"]."'";
        }elseif (isset($_COOKIE["deleteType"]) && $_COOKIE["deleteType"]=='1') {
            $sqlquery = "UPDATE superStructure SET isExisting = 0 WHERE name = '".$_COOKIE["itemName"]."'";
        }elseif (isset($_COOKIE["deleteType"]) && $_COOKIE["deleteType"]=='2') {
            $sqlquery = "UPDATE basement SET isExisting = 0 WHERE name = '".$_COOKIE["itemName"]."'";
        }
        echo $sqlquery;
        $pdo->exec($sqlquery);
    }
    Header("Location:/src/List.php"); 
?>
</body> 
</html>