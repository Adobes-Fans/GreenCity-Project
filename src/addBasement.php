<?php
$servername = "localhost";
$username = "root"; //
$password = "123456"; //
$dbname = "GreenCity";
$operation = "1";
$id = "112";
/* user info
  $_SESSION["id"] = $record['id'];
    //$_SESSION["name"] = $_POST[username];
    $_SESSION["name"] = $record['name'];
    $_SESSION["nick_name"] = $record['nick_name'];
    $_SESSION["group"] = $record['group'];
    $_SESSION["authority"] = $record['authority'];
    $_SESSION["branch"] = $record['branch'];
*/

try {
  $conn = new PDO("mysql:host = localhost; dbname = GreenCity", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $userip = $_SERVER["REMOTE_ADDR"];
  $sql = "use GreenCity";
  $conn -> exec ($sql);
  if ($operation == '1') {
    $sql = "INSERT INTO basement (name, floor, airShelterArea, basementArea, 
    basementStructure, designStartDay, designEndDay, waterLevel, coveredDepth, 
    basementDescription, rebarAirShelter, rebarNoAirShelter, rebarTower, rebarNoTower,
    rebarIntegrated, concreteAirShelter, concreteNoAirShelter, concreteTower, 
    concreteNoTower, concreteIntegrated, steelAirShelter, steelNoAirShelter, 
    steelTower, steelNoTower, steelIntegrated, authorIP, isExisting) VALUES ('$_POST[name]', '$_POST[floor]', 
    '$_POST[airShelterArea]', '$_POST[basementArea]', 
    '$_POST[basementStructure]', '$_POST[designStartDay]', '$_POST[designEndDay]', 
    '$_POST[waterLevel]', '$_POST[coveredDepth]', '$_POST[basementDescription]', 
    '$_POST[rebarAirShelter]', '$_POST[rebarNoAirShelter]', '$_POST[rebarTower]', 
    '$_POST[rebarNoTower]',
    '$_POST[rebarIntegrated]', '$_POST[concreteAirShelter]', '$_POST[concreteNoAirShelter]', '$_POST[concreteTower]', 
    '$_POST[concreteNoTower]', '$_POST[concreteIntegrated]', '$_POST[steelAirShelter]', '$_POST[steelNoAirShelter]', 
    '$_POST[steelTower]', '$_POST[steelNoTower]', '$_POST[steelIntegrated]', '$userip', '1')";
  }
  else if ($operation == '2') {
    $sql = "UPDATE basement SET name = '$_POST[name]', floor = '$_POST[floor]', airShelterArea = '$_POST[airShelterArea]', 
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
      authorIP = '$userip' WHERE id = '$id'";
  }
  $conn -> exec($sql);
}
catch (PDOException $e) {
  echo $e -> getMessage();
  echo "Wrong";
}

/*
$sql = "INSERT INTO basement (name, floor, airShelter, airShelterArea, basementArea, 
    basementStructure, designStartDay, designEndDay, waterLevel, coveredDepth, 
    basementDescription, rebarAirShelter, rebarNoAirShelter, rebarTower, rebarNoTower,
    rebarIntegrated, concreteAirShelter, concreteNoAirShelter, concreteTower, 
    concreteNoTower, concreteIntegrated, steelAirShelter, steelNoAirShelter, 
    steelTower, steelNoTower, steelIntegrated) VALUES ('$_POST[name]', '$_POST[floor]', 
    '$_POST[airShelter]', '$_POST[airShelterArea]', '$_POST[basementArea]', 
    '$_POST[basementStructure]', '$_POST[designStartDay]', '$_POST[designEndDay]', 
    '$_POST[waterLevel]', '$_POST[coveredDepth]', '$_POST[basementDescription]', 
    '$_POST[rebarAirShelter]', '$_POST[rebarNoAirShelter]', '$_POST[rebarTower]', 
    '$_POST[rebarNoTower]',
    '$_POST[rebarIntegrated]', '$_POST[concreteAirShelter]', '$_POST[concreteNoAirShelter]', '$_POST[concreteTower]', 
    '$_POST[concreteNoTower]', '$_POST[concreteIntegrated]', '$_POST[steelAirShelter]', '$_POST[steelNoAirShelter]', 
    '$_POST[steelTower]', '$_POST[steelNoTower]', '$_POST[steelIntegrated]')";
*/

$conn = null;
echo "地下室数据增加成功，正在跳转回原页面";
/*
sleep(2);
$url  =  "basementForm.html" ;  
echo " <script language = 'javascript'  
type = 'text/javascript' > ";  
echo " window.location.href = '$url' ";  
echo " </script> "; 
*/

?>