<!DOCTYPE html>
<html lang="zh-CN">

<?php
    session_start();
    $pdo = new PDO('mysql:host=localhost;dbname=GreenCity', "root", "123456", array(PDO::ATTR_PERSISTENT => true)); 
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>绿城建筑 项目信息</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <style>
        #container {
            width: 100.8%;
            /*height: 100vh;*/
        }
        
        #nav {
            background-color: #000000;
            height: 100%;
            margin-right: 0.0016%
        }
        
        #main {
            height: 100%;
            background-color: rgba(240, 242, 247, 1);
            padding: 3% 20% 0 3%;
        }
        
        form {
            margin-top: 2.5%;
        }
        
        .mustType {
            color: #ff0000;
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <div class="container-fluid" style="padding: 0">
        <div class="row" id="container">
            <!-- 这一块为系统原有导航栏 -->
            <div class="col-md-2" id="nav"></div>

            <div class="col-md-10" id="main">
                <div class="row">
                    <h2>项目总体信息录入</h2>
                </div>
                <form class="form-horizontal" action = "addProjects.php" method = "post">
                    <div class="form-group form-group-lg">
                        <label for="inputEmail3" class="col-md-3 control-label"><span class="mustType">* </span>项目名称：</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Project Name" name = "projectName" required>
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label for="inputEmail3" class="col-md-3 control-label">对应子项：</label>
                        <div class="col-md-9">
                            <select class="form-control" disabled> 
                                <option>暂无</option>
                                <option>项目1</option>
                                <option>项目2</option>
                                <option>项目3</option>
                                <option>项目4</option>
                                <option>项目5</option>
                                <option>项目6</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label for="inputEmail3" class="col-md-3 control-label"><span class="mustType">* </span>建筑类型：</label>
                        <div class="col-md-9">
                            <select class="form-control" id="buildingType1" multiple required>
                                <option>住宅</option>
                                <option>办公楼</option>
                                <option>商业</option>
                                <option>酒店</option>
                                <option>学校</option>
                                <option>综合体</option>
                                <option>其他</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-lg" id="buildingType2" style="display: none">
                        <div class="col-md-offset-3 col-md-9">
                            <select class="form-control" multiple>
                                <option>别墅</option>
                                <option>合院</option>
                                <option>排屋</option>
                                <option>多高层普通住宅</option>
                                <option>酒店式公寓</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label for="inputEmail3" class="col-md-3 control-label">所在城市：</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Location" name = "city">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label for="inputEmail3" class="col-md-3 control-label"><span class="mustType">* </span>抗震烈度：</label>
                        <div class="col-md-9">
                            <select class="form-control" name = "seismicPreIntensity" multiple required> 
                                <option>非抗震</option>
                                <option>6度</option>
                                <option>7度</option>
                                <option>7.5度</option>
                                <option>8度</option>
                                <option>8.5度</option>
                                <option>9度</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label for="inputEmail3" class="col-md-3 control-label">开发商：</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Developer" name = "developer">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label for="inputEmail3" class="col-md-3 control-label">基本风压：</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Wind Pressure" name = "basicWindPressure">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label for="inputEmail3" class="col-md-3 control-label">基本雪压：</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Snow Pressure" name = "basicSnowPressure">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <div class="col-md-offset-5 col-md-3" style="padding-top: 20px; padding-bottom: 20px; margin-bottom: 80px">
                            <button type="submit" class="btn btn-info btn-default btn-lg" onClick = submitForm()>提交项目</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script>
        operation = <?php echo $_COOKIE["operation"];?>;

        function setNavHeight() {
            var h = $('#main').height();
            var padH = $('#main').css('padding-top');
            var navH = Number(h.toString().substring(0, 5)) + Number(padH.toString().substring(0, 3));
            $('#nav').css('height', navH);
        }
        window.onload = function() {
            setNavHeight();
            allInput = $(".form-control");
            <?php
                if(isset($_COOKIE["operation"]) and $_COOKIE["operation"]!=0){
                    $sqlquery = "SELECT * FROM Project WHERE projectName = '".$_COOKIE['itemName']."'";
                    $rs = $pdo->query($sqlquery);
                    $existRecord = $rs->fetch();             
                }
            ?>

            if(operation!=0){
                
                allInput.eq(0).val('<?php echo $existRecord["projectName"]; ?>');
                mainType = '<?php echo $existRecord["buildingType"]; ?>';
                if (mainType != "别墅" && mainType != "合院" && mainType != "排屋" && mainType != "多高层普通住宅" && mainType != "酒店式公寓") {
                    allInput.eq(2).val(mainType);
                }else{
                    allInput.eq(2).val("住宅");
                    $('#buildingType2').css('display', 'block');
                    allInput.eq(3).val(mainType);
    
                }
                allInput.eq(4).val('<?php echo $existRecord["city"]; ?>');
                allInput.eq(5).val('<?php echo $existRecord["seismicPreIntensity"]; ?>');
                allInput.eq(6).val('<?php echo $existRecord["developer"]; ?>');
                allInput.eq(7).val('<?php echo $existRecord["basicWindPressure"]; ?>');
                allInput.eq(8).val('<?php echo $existRecord["basicSnowPressure"]; ?>');
     
                
                if(operation == 1){
                    allInput.prop("disabled",true);
                    $("button").prop("disabled",true);
                }
                document.cookie = "projectName="+"<?php echo $existRecord['projectName']; ?>";
                
            }
        }


        $('#buildingType1').change(function() {
            var text = $('#buildingType1').find("option:selected").text();
            if (text == "住宅") {
                $('#buildingType2').css('display', 'block');
            } else {
                $('#buildingType2').css('display', 'none');
            }

            setNavHeight();
        })

        function submitForm() {
            if (allInput.eq(2).val() == "住宅") {
                document.cookie = "buildingType="+allInput.eq(3).val();
            }else{
                document.cookie = "buildingType="+allInput.eq(2).val();
            }
        }
    </script>
</body>

</html>