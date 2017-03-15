<?php
session_start();
$servername = "localhost";
$username = "root"; //
$password = "123456"; //
$dbname = "GreenCity";
$operation = $_COOKIE[operation];


try {
  $conn = new PDO('mysql:host=localhost;dbname=GreenCity', "root", "123456", array(PDO::ATTR_PERSISTENT => true));
  $userip = $_SERVER["REMOTE_ADDR"];
  if ($operation == '0') {
    $sql = "INSERT INTO basement (name, projectName, projectID, floor, airShelter, airShelterArea, basementArea, 
    basementStructure, designStartDay, designEndDay, waterLevel, coveredDepth, 
    basementDescription, rebarAirShelter, rebarNoAirShelter, rebarTower, rebarNoTower,
    rebarIntegrated, concreteAirShelter, concreteNoAirShelter, concreteTower, 
    concreteNoTower, concreteIntegrated, steelAirShelter, steelNoAirShelter, 
    steelTower, steelNoTower, steelIntegrated, authorIP, isExisting, authorName, authorID) 
    VALUES ('$_POST[name]', '$_COOKIE[projectName]', '$_COOKIE[projectID]', '$_POST[floor]', '$_COOKIE[airShelter]',
    '$_POST[airShelterArea]', '$_POST[basementArea]', 
    '$_POST[basementStructure]', '$_POST[designStartDay]', '$_POST[designEndDay]', 
    '$_POST[waterLevel]', '$_POST[coveredDepth]', '$_POST[basementDescription]', 
    '$_POST[rebarAirShelter]', '$_POST[rebarNoAirShelter]', '$_POST[rebarTower]', 
    '$_POST[rebarNoTower]',
    '$_POST[rebarIntegrated]', '$_POST[concreteAirShelter]', '$_POST[concreteNoAirShelter]', '$_POST[concreteTower]', 
    '$_POST[concreteNoTower]', '$_POST[concreteIntegrated]', '$_POST[steelAirShelter]', '$_POST[steelNoAirShelter]', 
    '$_POST[steelTower]', '$_POST[steelNoTower]', '$_POST[steelIntegrated]', '$userip', '1', '$_SESSION[name]', '$_SESSION[id]')";
  }
  else if ($operation == '2') {
    $sql = "UPDATE basement SET name = '$_POST[name]', projectName = '$_COOKIE[projectName]', projectID = '$_COOKIE[projectID]', floor = '$_POST[floor]', 
      airShelter = '$_COOKIE[airShelter]', airShelterArea = '$_POST[airShelterArea]', 
      basementArea = '$_POST[basementArea]', basementStructure = '$_POST[basementStructure]', designStartDay = '$_POST[designStartDay]', 
      designEndDay = '$_POST[designEndDay]', waterLevel = '$_POST[waterLevel]', coveredDepth = '$_POST[coveredDepth]', 
      basementDescription = '$_POST[basementDescription]', rebarAirShelter = '$_POST[rebarAirShelter]', 
      rebarNoAirShelter = '$_POST[rebarNoAirShelter]', 
      rebarTower = '$_POST[rebarTower]', rebarNoTower = '$_POST[rebarNoTower]', rebarIntegrated = '$_POST[rebarIntegrated]', 
      concreteAirShelter = '$_POST[concreteAirShelter]', concreteNoAirShelter = '$_POST[concreteNoAirShelter]', 
      concreteTower = '$_POST[concreteTower]', concreteNoTower = '$_POST[concreteNoTower]', 
      concreteIntegrated = '$_POST[concreteIntegrated]', steelAirShelter = '$_POST[steelAirShelter]', 
      steelNoAirShelter = '$_POST[steelNoAirShelter]', steelTower = '$_POST[steelTower]', 
      steelNoTower = '$_POST[steelNoTower]', steelIntegrated = '$_POST[steelIntegrated]', 
      authorIP = '$userip', authorID = '$_SESSION[id]', authorName = '$_SESSION[name]' WHERE id = '$_COOKIE[id]'";
  }
  $conn -> exec ($sql);
}
catch (PDOException $e) {
  echo $e -> getMessage();
}

Header("Location:/src/List.php"); 

// $conn = null;
// echo "地下室数据增加成功，正在跳转回原页面";

// $url  =  "List.php" ;  
// echo " <script language = 'javascript'  
// type = 'text/javascript' > ";  
// echo " window.location.href = '$url' ";  
// echo " </script> "; 


?>