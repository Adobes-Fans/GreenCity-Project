<!DOCTYPE html>
<html lang="zh-CN">
<?php
    session_start();
    $pdo = new PDO('mysql:host=localhost;dbname=GreenCity', "root", "123456", array(PDO::ATTR_PERSISTENT => true));
    if(isset($_COOKIE["operation"])){
        //echo $_COOKIE["operation"];
    }
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>绿城建筑 地下室</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-datetimepicker.min.css" rel="stylesheet">

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
            padding: 2% 10% 0% 3%;
        }
        
        form {
            margin-top: 2.5%;
        }
        
        .singleSelect {
            padding-left: 8px;
            font-weight: 400;
        }
        
        .subTitle {
            text-align: center;
            font-size: 28px;
            line-height: 50px;
        }
        
        .mustType {
            color: #ff0000;
            vertical-align: middle;
        }
        
        .searchTable {
            margin-top: 25px;
            max-height: 440px;
            overflow: scroll;
        }
        
        .table>tbody>tr>td,
        .table>tbody>tr>th,
        .table>tfoot>tr>td,
        .table>tfoot>tr>th,
        .table>thead>tr>td,
        .table>thead>tr>th {
            text-align: center;
            vertical-align: middle;
            padding: 10px;
        }
        
        td {
            font-family: 微软雅黑;
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
                    <h2 style="padding-left: 5%;">地下室信息录入</h2>
                </div>
                
                <form class="form-horizontal" action = "addBasement.php" method = "post">
                    <div class="form-group form-group-lg">
                        <label for="inputEmail3" class="col-md-3 control-label"><span class="mustType">* </span>地下室名称：</label>
                        <div class="col-md-9">

                            <input type="text" class="form-control" placeholder="Name" name = "name" required>
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label for="inputEmail3" class="col-md-3 control-label"><span class="mustType">* </span>对应项目：</label>
                        <div class="col-md-2" style="margin-top:7px;" data-toggle="modal" data-target="#myModal">
                            <button type="button" class="btn btn-info">选择项目</button>
                        </div>
                        <div class="col-md-3">
                            <label id="selectedPro" style="font-size: 17px; font-family: 微软雅黑; font-weight: normal; padding-top:10px" name = "projectName"></label>
                        </div>
                    </div>
                    <!-- 模拟弹出窗口 -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">项目选择</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-offset-1 col-md-6">
                                            <input type="text" class="form-control" placeholder="项目名称" id="ProName">
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-info" OnClick="ProNameQuery()">查询</button>
                                        </div>
                                    </div>
                                    <div class="row searchTable">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <td>项目id</td>
                                                    <td>项目名称</td>
                                                    <td>建筑类型</td>
                                                    <td>项目创建人</td>
                                                    <td>选择项目</td>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                    $proRes = $pdo->query("SELECT projectID, projectName, buildingType, inputerID, inputerName FROM Project WHERE isExisting = 1");
                                                    foreach ($proRes as $row) {
                                                        echo "<tr name='proTable' class = 'proTableClass'>";
                                                        echo "<td>".$row['projectID']."</td>";
                                                        echo "<td>".$row['projectName']."</td>";
                                                        echo "<td>".$row['buildingType']."</td>";
                                                        echo "<td>".$row['inputerName']."</td>";
                                                        echo "<td><input type='radio' name='project'></td>";
                                                        echo "</tr>";
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal" OnClick="selectPro()">提交</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 模拟弹出窗口结束 -->
                    <div class="form-group form-group-lg">
                        <label for="inputEmail3" class="col-md-3 control-label"><span class="mustType">*</span> 地下室层数：</label>
                        <div class="col-md-9">
                            <input type="number" min="0" class="form-control" placeholder="Floor" name = "floor" 



                            required>
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label for="inputEmail3" class="col-md-3 control-label"><span class="mustType">*</span> 是否有人防：</label>
                        <div class="col-md-2">
                            <input type="radio" name="defence" value="true" required><label class="control-label singleSelect">有</label>
                        </div>
                        <div class="col-md-2">
                            <input type="radio" name="defence" value="false" required><label class="control-label singleSelect">无</label>
                        </div>
                    </div>
                    <div class="form-group form-group-lg" id="defenceArea" style="display: none">
                        <label for="inputEmail3" class="col-md-3 control-label"><span class="mustType">*</span> 人防面积：</label>
                        <div class="col-md-9">
                            <?php 
                                $airShelterArea = 0;
                            ?>
                            <input type="text" class="form-control" placeholder="Area" name = "airShelterArea">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label for="inputEmail3" class="col-md-3 control-label"><span class="mustType">*</span> 地下室面积(万方)：</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Basement Area" name = "basementArea" required>
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label for="inputEmail3" class="col-md-3 control-label"><span class="mustType">*</span> 地下室结构形式：</label>
                        <div class="col-md-9">
                            <select class="form-control" name = "basementStructure">
                                <option>无梁楼盖</option>
                                <option>普通梁板</option>
                                <option>大板结构</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label for="inputEmail3" class="col-md-3 control-label">设计起止日期：</label>
                        <div class="col-md-4">
                            <input type="text" id="datetimepicker1" class="form-control" name = "designStartDay">
                        </div>
                        <div class="col-md-1" style="text-align: center">
                            <label class="control-label">——</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" id="datetimepicker2" class="form-control" name = "designEndDay">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label for="inputEmail3" class="col-md-3 control-label">地下室水位：</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Water Level" name = "waterLevel">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label for="inputEmail3" class="col-md-3 control-label">地下室覆水高度：</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Overburden height" name = "coveredDepth">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label for="inputEmail3" class="col-md-3 control-label">地下室说明(限256字)：</label>
                        <div class="col-md-9">
                            <textarea class="form-control" rows="4" name = "basementDescription"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <h3 class="col-md-12 subTitle">结构主材用量信息(关键数据)</h3>
                        <hr style="margin-left:10%; width: 88%; border: 1px #000000 solid">
                    </div>
                    <div class="form-group form-group-lg">
                        <label for="inputEmail3" class="col-md-3 control-label">钢筋(kg/m2)：</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="有人防" name = "rebarAirShelter">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="无人防" name = "rebarNoAirShelter">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="综合" name = "rebarIntegrated">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <div class="col-md-offset-3 col-md-3">
                            <input type="text" class="form-control" placeholder="塔楼区" name = "rebarTower">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="非塔楼区" name = "rebarNoTower">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label for="inputEmail3" class="col-md-3 control-label">混凝土(m3/m2)：</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="有人防" name = "concreteAirShelter">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="无人防" name = "concreteNoAirShelter">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="综合" name = "concreteIntegrated">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <div class="col-md-offset-3 col-md-3">
                            <input type="text" class="form-control" placeholder="塔楼区" name = "concreteTower">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="非塔楼区" name = "concreteNoTower">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label for="inputEmail3" class="col-md-3 control-label">钢材(kg/m2)：</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="有人防" name = "steelAirShelter">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="无人防" name = "steelNoAirShelter">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="综合" name = "steelIntegrated">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <div class="col-md-offset-3 col-md-3">
                            <input type="text" class="form-control" placeholder="塔楼区" name = "steelTower">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="非塔楼区" name = "steelNoTower">
                        </div>
                    </div>


                    <div class="form-group form-group-lg">
                        <div class="col-md-offset-5 col-md-3" style="padding-top: 20px; padding-bottom: 20px; margin-bottom: 20px">
                            <button type=" submit " class="btn btn-info btn-default btn-lg " onClick = submitForm()>提交地上建筑</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootstrap-datetimepicker.min.js"></script>
    <script>
        operation = <?php echo $_COOKIE["operation"];?>;
        function setNavHeight() {
            var h = $('#main').height();
            var padH = $('#main').css('padding-top');
            var navH = Number(h.toString().substring(0, 5)) + Number(padH.toString().substring(0, 3));
            $('#nav').css('height', navH + "px");
        }

        window.onload = function() {
            setNavHeight();
            allInput = $(".form-control");
            <?php
                if(isset($_COOKIE["operation"]) and $_COOKIE["operation"]!=0){
                    $sqlquery = "SELECT * FROM basement WHERE id = '".$_COOKIE['itemName']."'";
                    $rs = $pdo->query($sqlquery);
                    $existRecord = $rs->fetch();             
                }
            ?>
            if ('<?php echo $existRecord["airShelter"]; ?>' == '1') {
                    $("input[name='defence']").eq(0).prop("checked",true);
                }else{
                    $("input[name='defence']").eq(1).prop("checked",true);
                }
            if(operation!=0){
                allInput.eq(0).val('<?php echo $existRecord["name"]; ?>');
                allInput.eq(2).val('<?php echo $existRecord["floor"]; ?>');
                allInput.eq(3).val('<?php echo $existRecord["airShelterArea"]; ?>');
                allInput.eq(4).val('<?php echo $existRecord["basementArea"]; ?>');
                allInput.eq(5).val('<?php echo $existRecord["basementStructure"]; ?>');
                allInput.eq(6).val('<?php echo $existRecord["designStartDay"]; ?>');
                allInput.eq(7).val('<?php echo $existRecord["designEndDay"]; ?>');
                allInput.eq(8).val('<?php echo $existRecord["waterLevel"]; ?>');
                allInput.eq(9).val('<?php echo $existRecord["coveredDepth"]; ?>');
                allInput.eq(10).val('<?php echo $existRecord["basementDescription"]; ?>');
                allInput.eq(11).val('<?php echo $existRecord["rebarAirShelter"]; ?>');
                allInput.eq(12).val('<?php echo $existRecord["rebarNoAirShelter"]; ?>');
                allInput.eq(13).val('<?php echo $existRecord["rebarIntegrated"]; ?>');
                allInput.eq(14).val('<?php echo $existRecord["rebarTower"]; ?>');
                allInput.eq(15).val('<?php echo $existRecord["rebarNoTower"]; ?>');
                allInput.eq(16).val('<?php echo $existRecord["concreteAirShelter"]; ?>');
                allInput.eq(17).val('<?php echo $existRecord["concreteNoAirShelter"]; ?>');
                allInput.eq(18).val('<?php echo $existRecord["concreteIntegrated"]; ?>');
                allInput.eq(19).val('<?php echo $existRecord["concreteTower"]; ?>');
                allInput.eq(20).val('<?php echo $existRecord["concreteNoTower"]; ?>');
                allInput.eq(21).val('<?php echo $existRecord["steelAirShelter"]; ?>');
                allInput.eq(22).val('<?php echo $existRecord["steelNoAirShelter"]; ?>');
                allInput.eq(23).val('<?php echo $existRecord["steelIntegrated"]; ?>');
                allInput.eq(24).val('<?php echo $existRecord["steelTower"]; ?>');
                allInput.eq(25).val('<?php echo $existRecord["steelNoTower"]; ?>');

                document.getElementById('selectedPro').innerHTML = '<?php echo $existRecord["projectName"]; ?>';
                if ('<?php echo $existRecord["airShelter"]; ?>' == '1') {
                    $("input[name='defence']").eq(0).prop("checked",true);
                    $('#defenceArea').css('display', 'block');
                }else{
                    $("input[name='defence']").eq(1).prop("checked",true);
                    $('#defenceArea').css('display', 'none');
                }
                
                if(operation == 1){
                    allInput.prop("disabled",true);
                    $('input[name="defence"]').prop("disabled",true);
    
                    $("button").prop("disabled",true);
                }
                document.cookie = "id="+"<?php echo $existRecord['id']; ?>";
            }
        }

        $('input:radio[name="defence"]').change(function() {
            var val = $('input:radio[name="defence"]:checked').val();
            if (val == "true") {
                $('#defenceArea').css('display', 'block');
                document.cookie = "airShelter=1";
            } else {
                $('#defenceArea').css('display', 'none');
                document.cookie = "airShelter=0";
            }

            setNavHeight();
        })

        $('#datetimepicker1').datetimepicker({
            minView: "month",
            format: 'yyyy-mm-dd',
            todayBtn: 1,
        });

        $('#datetimepicker2').datetimepicker({
            minView: "month",
            format: 'yyyy-mm-dd',
            todayBtn: 1,
        });
        function ProNameQuery(){
            proNameQueryArg = document.getElementById('ProName').value;
            if(proNameQueryArg.length==0){
                $('.proTableClass').css('display', '')
            }
            if(proNameQueryArg.length!=0){
                proTable = document.getElementsByName('proTable');
                for (var i = proTable.length - 1; i >= 0; i--) {
                    if (proTable[i].childNodes[0].textContent.search(proNameQueryArg) != -1) {
                        $('.proTableClass').eq(i).css('display', '');
                    }else{
                        $('.proTableClass').eq(i).css('display', 'none');
                    }
                }
            }
        }
        function selectPro(){
            var selected = $('input:radio[name="project"]:checked');
            if (selected.length != 0) {
                document.cookie = "projectID="+selected.parent().parent().children().eq(0).text();
                document.getElementById('selectedPro').innerHTML = selected.parent().parent().children().eq(1).text();

            }
        }

        function submitForm() {
            projectNameNow = document.getElementById('selectedPro').innerHTML;
            document.cookie = "projectName="+projectNameNow;  
        }
    </script>

</body>
</html>