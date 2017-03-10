<!DOCTYPE html> 
<html> 
<?php
    session_start();
    $pdo = new PDO('mysql:host=localhost;dbname=GreenCity', "root", "123456", array(PDO::ATTR_PERSISTENT => true));
    function getIP(){ 
        $ip=""; 
        if (getenv("HTTP_CLIENT_IP")) 
            $ip = getenv("HTTP_CLIENT_IP"); 
        else if(getenv("HTTP_X_FORWARDED_FOR")) 
            $ip = getenv("HTTP_X_FORWARDED_FOR"); 
        else if(getenv("REMOTE_ADDR")) 
            $ip = getenv("REMOTE_ADDR"); 
        else 
            $ip = "Unknow"; 
        return $ip; 
    }
?>
<body> 
<?php
    $userIP = getIP();
    if (isset($_COOKIE["operation"]) && $_COOKIE["operation"]==0) {
        $sqlquery = "INSERT INTO `superStructure`(`name`, `projectName`, `mainType`, `mainMeterial`, `floor`, `havaLoft`, `height`, `deepWidthRadioMin`, `deepWidthRadioMax`, `deepLengthRadioMin`, `deepLengthRadioMax`, `seismicOverrun`, `seismicPerformance`, `designBegin`, `designEnd`, `softwaveAndVer`, `rebarPodiumReal`, `rebarPodiumTheo`, `rebarStandardReal`, `rebarStandardTheo`, `concretePodiumReal`, `concretePodiumTheo`, `concreteStandardReal`, `concreteStandardTheo`, `steelPodiumReal`, `steelPodiumTheo`, `steelStandardReal`, `steelStandardTheo`, `inputerID`, `inputerName`, `inputerIP`, `inputTime`, `isExisting`) VALUES ('$_COOKIE[name]','$_COOKIE[projectName]','$_COOKIE[mainType]','$_COOKIE[mainMeterial]',$_COOKIE[floor],$_COOKIE[havaLoft],$_COOKIE[height],$_COOKIE[deepWidthRadioMin],$_COOKIE[deepWidthRadioMax],$_COOKIE[deepLengthRadioMin],$_COOKIE[deepLengthRadioMax],$_COOKIE[seismicOverrun],'$_COOKIE[seismicPerformance]','$_COOKIE[designBegin]','$_COOKIE[designEnd]','$_COOKIE[softwaveAndVer]',$_COOKIE[rebarPodiumReal],$_COOKIE[rebarPodiumTheo],$_COOKIE[rebarStandardReal],$_COOKIE[rebarStandardTheo],$_COOKIE[concretePodiumReal],$_COOKIE[concretePodiumTheo],$_COOKIE[concreteStandardReal],$_COOKIE[concreteStandardTheo],$_COOKIE[steelPodiumReal],$_COOKIE[steelPodiumTheo],$_COOKIE[steelStandardReal],$_COOKIE[steelStandardTheo],'$_SESSION[id]','$_SESSION[name]','".getIP()."','".date("Y-m-d")."',1)";
    }else{
        $sqlquery = "UPDATE `superStructure` SET `name`='$_COOKIE[name]', `projectName`='$_COOKIE[projectName]', `mainType`='$_COOKIE[mainType]', `mainMeterial`='$_COOKIE[mainMeterial]', `floor`=$_COOKIE[floor], `havaLoft`=$_COOKIE[havaLoft], `height`=$_COOKIE[height], `deepWidthRadioMin`=$_COOKIE[deepWidthRadioMin], `deepWidthRadioMax`=$_COOKIE[deepWidthRadioMax], `deepLengthRadioMin`=$_COOKIE[deepLengthRadioMin], `deepLengthRadioMax`=$_COOKIE[deepLengthRadioMax], `seismicOverrun`=$_COOKIE[seismicOverrun], `seismicPerformance`='$_COOKIE[seismicPerformance]', `designBegin`='$_COOKIE[designBegin]', `designEnd`='$_COOKIE[designEnd]', `softwaveAndVer`='$_COOKIE[softwaveAndVer]', `rebarPodiumReal`=$_COOKIE[rebarPodiumReal], `rebarPodiumTheo`=$_COOKIE[rebarPodiumTheo], `rebarStandardReal`=$_COOKIE[rebarStandardReal], `rebarStandardTheo`=$_COOKIE[rebarStandardTheo], `concretePodiumReal`=$_COOKIE[concretePodiumReal], `concretePodiumTheo`=$_COOKIE[concretePodiumTheo], `concreteStandardReal`=$_COOKIE[concreteStandardReal], `concreteStandardTheo`=$_COOKIE[concreteStandardTheo], `steelPodiumReal`=$_COOKIE[steelPodiumReal], `steelPodiumTheo`=$_COOKIE[steelPodiumTheo], `steelStandardReal`=$_COOKIE[steelStandardReal], `steelStandardTheo`=$_COOKIE[steelStandardTheo], `isExisting`=1 WHERE id = $_COOKIE[superStructureID]";
    }
    // echo $sqlquery;
    $pdo->exec($sqlquery);
?>
</body> 
</html>