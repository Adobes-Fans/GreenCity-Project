<?php
$servername = "localhost";
$username = "root"; 
$password = "123456"; 
$dbname = "GreenCity";
$operation = $_SESSION[operation];
$

try {
  $conn = new PDO("mysql:host = localhost; dbname = GreenCity", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $userip = $_SERVER["REMOTE_ADDR"];
  $sql = "use GreenCity";
  $conn -> exec ($sql);
  
  if ($operation == '0') {
    $sql = "INSERT INTO Project (projectName, buildingType, city, seismicPreIntensity, developer, 
      basicWindPressure, basicSnowPressure, isExisting, 
      inputerIP, inputerID, inputerName) VALUES ('$_POST[projectName]', '$_POST[buildingType]', 
      '$_POST[city]', '$_POST[seismicPreIntensity]', '$_POST[developer]', '$_POST[basicWindPressure]', 
      '$_POST[basicSnowPressure]', '1', '$userip', '$_SESSION[id]', '$_SESSION[name]')";
    $conn -> exec ($sql);
  }
  else if ($operation == '2') {
    $sql = "UPDATE Project SET (projectName = '$_POST[projectName]', buildingType = '$_POST[buildingType]', 
      city = '$_POST[city]', 
      seismicPreIntensity = '$_POST[seismicPreIntensity]', developer = '$_POST[developer]', 
      basicWindPressure = '$_POST[basicWindPressure]', 
      basicSnowPressure = '$_POST[basicSnowPressure]',
      inputerIP = '$userip', inputerID = '$_SESSION[id]', inputerName = '$_SESSSION[name]') WHERE projectName = '$_COOKIE[itemName]'";
    $conn -> exec($sql);
    $sql = "UPDATE basement SET (projectName = '$_POST[projectName]') WHERE projectName = '$_COOKIE[itemName]'";
    $conn -> exec($sql);
    $sql = "UPDATE superStructure SET (projectName = '$_POST[projectName]') WHERE projectName = '$_COOKIE[itemName]'";
    $conn -> exec($sql);
  }
}
catch (PDOException $e) {
  echo $e -> getMessage();
}


$conn = null;
echo "项目数据增加成功，正在跳转回原页面";

sleep(2);
$url  =  "List.php";  
echo " <script language = 'javascript'  
type = 'text/javascript' > ";  
echo " window.location.href = '$url' ";  
echo " </script> "; 


?>