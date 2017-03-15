<!DOCTYPE html>
<html lang="zh-CN">
<?php
    session_start();
    $pdo = new PDO('mysql:host=localhost;dbname=GreenCity', "root", "123456", array(PDO::ATTR_PERSISTENT => true));
     
    // echo "test";
    // if(isset($_SESSION["operation"])){
    //     echo $_SESSION["operation"];
    //     echo $_COOKIE["itemName"];
    // }
    // else
    //     echo " sad";
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>绿城建筑 地上建筑</title>

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
                    <h2 style="padding-left: 5%;">地上建筑信息录入</h2>
                </div>
                <form class="form-horizontal">
                    <div class="form-group form-group-lg">
                        <label for="inputEmail3" class="col-md-3 control-label"><span class="mustType">* </span>地上建筑名称：</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label for="inputEmail3" class="col-md-3 control-label"><span class="mustType">* </span>对应项目：</label>

                        <div class="col-md-2" style="margin-top:7px;" data-toggle="modal" data-target="#myModal">
                            <button type="button" class="btn btn-info">选择项目</button>
                        </div>

                        <div class="col-md-3">
                            <label id="selectedPro" style="font-size: 17px; font-family: 微软雅黑; font-weight: normal; padding-top:10px"></label>
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
                        <label for="inputEmail3" class="col-md-3 control-label"><span class="mustType">* </span>主要结构类型：</label>
                        <div class="col-md-9">
                            <select class="form-control" id="structureType1" multiple required>
                                <option>框架结构</option>
                                <option>框架—剪力墙（支撑）结构</option>
                                <option>剪力墙结构</option>
                                <option>框架—核心筒结构</option>
                                <option>筒中筒结构</option>
                                <option>板柱—剪力墙结构</option>
                                <option>异形柱框架结构</option>
                                <option>异形柱框架—剪力墙结构</option>
                                <option>其他</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-lg" id="structureType2" style="display: none">
                        <div class="col-md-offset-3 col-md-9">
                            <input type="text" class="form-control" placeholder="Main Structure Type">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label for="inputEmail3" class="col-md-3 control-label"><span class="mustType">* </span>主要材料：</label>
                        <div class="col-md-9">
                            <select class="form-control" required> 
                                <option>钢筋混凝土</option>
                                <option>钢-混凝土混合</option>
                                <option>钢</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label for="inputEmail3" class="col-md-3 control-label"><span class="mustType">* </span>层数：</label>
                        <div class="col-md-9">
                            <input type="number" min="0" class="form-control" placeholder="Floor" required>
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label for="inputEmail3" class="col-md-3 control-label"><span class="mustType">* </span>是否有阁楼：</label>
                        <div class="col-md-2">
                            <input type="radio" name="loft" value="true" required><label class="control-label singleSelect">有</label>
                        </div>
                        <div class="col-md-2">
                            <input type="radio" name="loft" value="false" required><label class="control-label singleSelect">无</label>
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label for="inputEmail3" class="col-md-3 control-label"><span class="mustType">* </span>总高度(m)：</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Height" required>
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label for="inputEmail3" class="col-md-3 control-label">高宽比：</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="最小值">
                        </div>
                        <div class="col-md-offset-1 col-md-4">
                            <input type="text" class="form-control" placeholder="最大值">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label for="inputEmail3" class="col-md-3 control-label">长宽比：</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="最小值">
                        </div>
                        <div class="col-md-offset-1 col-md-4">
                            <input type="text" class="form-control" placeholder="最大值">
                        </div>
                    </div>
                    <div class="form-group form-group-lg" id="earthquakeMore">
                        <label for="inputEmail3" class="col-md-3 control-label"><span class="mustType">* </span>抗震超限：</label>
                        <div class="col-md-2">
                            <input type="radio" name="earthquake" value="true" required><label class="control-label singleSelect">是</label>
                        </div>
                        <div class="col-md-2">
                            <input type="radio" name="earthquake" value="false" required><label class="control-label singleSelect">否</label>
                        </div>
                    </div>
                    <div class="form-group form-group-lg" id="earthquakePerformance" style="display: none">
                        <label for="inputEmail3" class="col-md-3 control-label"><span class="mustType">* </span>抗震性能目标：</label>
                        <div class="col-md-9">
                            <select class="form-control" multiple>
                                <option>B</option>
                                <option>C</option>
                                <option>D</option>
                                <option>C+D</option>
                            </select>
                        </div>
                    </div>
                    <!-- 上传超限报告，本次可不实现，数据库设计留字段 -->
                    <div class="form-group form-group-lg">
                        <label for="inputEmail3" class="col-md-3 control-label">设计起止日期：</label>
                        <div class="col-md-4">
                            <input type="text" id="datetimepicker1" class="form-control">
                        </div>
                        <div class="col-md-1" style="text-align: center">
                            <label class="control-label">——</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" id="datetimepicker2" class="form-control">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label for="inputEmail3" class="col-md-3 control-label">软件名称及版本：</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Name and Version">
                        </div>
                    </div>
                    <div class="row">
                        <h3 class="col-md-12 subTitle">结构主材用量信息(关键数据)</h3>
                        <hr style="margin-left:10%; width: 88%; border: 1px #000000 solid">
                    </div>
                    <div class="form-group form-group-lg">
                        <label for="inputEmail3" class="col-md-3 control-label">钢筋(kg/m2)：</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="(裙房)实算值">
                        </div>
                        <div class="col-md-offset-1 col-md-4">
                            <input type="text" class="form-control" placeholder="(裙房)理论值">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <div class="col-md-offset-3 col-md-4">
                            <input type="text" class="form-control" placeholder="(标准层)实算值">
                        </div>
                        <div class="col-md-offset-1 col-md-4">
                            <input type="text" class="form-control" placeholder="(标准层)理论值">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label for="inputEmail3" class="col-md-3 control-label">混凝土(m3/m2)：</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="(裙房)实算值">
                        </div>
                        <div class="col-md-offset-1 col-md-4">
                            <input type="text" class="form-control" placeholder="(裙房)理论值">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <div class="col-md-offset-3 col-md-4">
                            <input type="text" class="form-control" placeholder="(标准层)实算值">
                        </div>
                        <div class="col-md-offset-1 col-md-4">
                            <input type="text" class="form-control" placeholder="(标准层)理论值">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label for="inputEmail3" class="col-md-3 control-label">钢材(kg/m2)：</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="(裙房)实算值">
                        </div>
                        <div class="col-md-offset-1 col-md-4">
                            <input type="text" class="form-control" placeholder="(裙房)理论值">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <div class="col-md-offset-3 col-md-4">
                            <input type="text" class="form-control" placeholder="(标准层)实算值">
                        </div>
                        <div class="col-md-offset-1 col-md-4">
                            <input type="text" class="form-control" placeholder="(标准层)理论值">
                        </div>
                    </div>

                    <div class="form-group form-group-lg">
                        <div class="col-md-offset-5 col-md-3" style="padding-top: 20px; padding-bottom: 20px; margin-bottom: 0">
                            <button type="button" class="btn btn-info btn-default btn-lg " OnClick="submitForm()">提交地上建筑</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../js/jquery-3.1.1.min.js "></script>
    <script src="../js/bootstrap.min.js "></script>
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
                    $sqlquery = "SELECT * FROM superStructure WHERE id = '".$_COOKIE['itemName']."'";
                    // echo "alert(\"$sqlquery\");";
                    $rs = $pdo->query($sqlquery);
                    $existRecord = $rs->fetch();
                }
            ?>
            if(operation!=0){
                allInput.eq(0).val('<?php echo $existRecord["name"]; ?>');
                mainType = '<?php echo $existRecord["mainType"]; ?>';
                if (mainType != "框架结构" && mainType != "框架—剪力墙（支撑）结构" && mainType != "剪力墙结构" && mainType != "框架—核心筒结构" && mainType != "筒中筒结构" && mainType != "板柱—剪力墙结构" && mainType != "异形柱框架结构" && mainType != "异形柱框架—剪力墙结构") {
                    allInput.eq(2).val("其它");
                    allInput.eq(3).val(mainType);
                }else{
                    allInput.eq(2).val(mainType);
                }
                allInput.eq(4).val('<?php echo $existRecord["mainMeterial"]; ?>');
                allInput.eq(5).val('<?php echo $existRecord["floor"]; ?>');
                allInput.eq(6).val('<?php echo $existRecord["height"]; ?>');
                allInput.eq(7).val('<?php echo $existRecord["deepWidthRadioMin"]; ?>');
                allInput.eq(8).val('<?php echo $existRecord["deepWidthRadioMax"]; ?>');
                allInput.eq(9).val('<?php echo $existRecord["deepLengthRadioMin"]; ?>');
                allInput.eq(10).val('<?php echo $existRecord["deepLengthRadioMax"]; ?>');
                allInput.eq(12).val('<?php echo $existRecord["designBegin"]; ?>');
                allInput.eq(13).val('<?php echo $existRecord["designEnd"]; ?>');
                allInput.eq(14).val('<?php echo $existRecord["softwaveAndVer"]; ?>');
                allInput.eq(15).val('<?php echo $existRecord["rebarPodiumReal"]; ?>');
                allInput.eq(16).val('<?php echo $existRecord["rebarPodiumTheo"]; ?>');
                allInput.eq(17).val('<?php echo $existRecord["rebarStandardReal"]; ?>');
                allInput.eq(18).val('<?php echo $existRecord["rebarStandardTheo"]; ?>');
                allInput.eq(19).val('<?php echo $existRecord["concretePodiumReal"]; ?>');
                allInput.eq(20).val('<?php echo $existRecord["concretePodiumTheo"]; ?>');
                allInput.eq(21).val('<?php echo $existRecord["concreteStandardReal"]; ?>');
                allInput.eq(22).val('<?php echo $existRecord["concreteStandardTheo"]; ?>');
                allInput.eq(23).val('<?php echo $existRecord["steelPodiumReal"]; ?>');
                allInput.eq(24).val('<?php echo $existRecord["steelPodiumTheo"]; ?>');
                allInput.eq(25).val('<?php echo $existRecord["steelStandardReal"]; ?>');
                allInput.eq(26).val('<?php echo $existRecord["steelStandardTheo"]; ?>');
                document.getElementById('selectedPro').innerHTML = '<?php echo $existRecord["projectName"]; ?>';
                if ('<?php echo $existRecord["havaLoft"]; ?>' == '1') {
                    $("input[name='loft']").eq(0).prop("checked",true);
                }else{
                    $("input[name='loft']").eq(1).prop("checked",true);
                }
                if ('<?php echo $existRecord["seismicOverrun"]; ?>' == '1') {
                    $('input[name="earthquake"]').eq(0).prop("checked",true);
                    allInput.eq(11).val('<?php echo $existRecord["seismicPerformance"]; ?>');
                    $('#earthquakePerformance').css('display', 'block');
                }else{
                    $('input[name="earthquake"]').eq(1).prop("checked",true);
                }
                if(operation == 1){
                    allInput.prop("disabled",true);
                    $('input[name="earthquake"]').prop("disabled",true);
                    $("input[name='loft']").prop("disabled",true);
                    $("button").prop("disabled",true);
                }
                document.cookie = "superStructureID="+"<?php echo $existRecord['id']; ?>";
            }
        }

        $('#structureType1').change(function() {
            var text = $('#structureType1').find("option:selected").text();
            if (text == "其他") {
                $('#structureType2').css('display', 'block');
            } else {
                $('#structureType2').css('display', 'none');
            }

            setNavHeight();
        })

        $('input:radio[name="earthquake"]').change(function() {
            var val = $('input:radio[name="earthquake"]:checked').val();
            if (val == "true") {
                $('#earthquakePerformance').css('display', 'block');
            } else {
                $('#earthquakePerformance').css('display', 'none');
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
                projectNowID = selected.parent().parent().children().eq(0).text();
                document.cookie = "projectID=" + projectNowID;
                document.getElementById('selectedPro').innerHTML = selected.parent().parent().children().eq(1).text();
            }
        }
        function submitForm(){
            document.cookie = "name="+allInput.eq(0).val();
            if (allInput.eq(2).val() == "其它") {
                document.cookie = "mainType="+allInput.eq(3).val();
            }else{
                document.cookie = "mainType="+allInput.eq(2).val();
            }
            document.cookie = "mainMeterial="+allInput.eq(4).val();
            document.cookie = "floor="+allInput.eq(5).val();
            document.cookie = "height="+allInput.eq(6).val();
            document.cookie = "deepWidthRadioMin="+allInput.eq(7).val();
            document.cookie = "deepWidthRadioMax="+allInput.eq(8).val();
            document.cookie = "deepLengthRadioMin="+allInput.eq(9).val();
            document.cookie = "deepLengthRadioMax="+allInput.eq(10).val();
            document.cookie = "designBegin="+allInput.eq(12).val();
            document.cookie = "designEnd="+allInput.eq(13).val();
            document.cookie = "softwaveAndVer="+allInput.eq(14).val();
            document.cookie = "rebarPodiumReal="+allInput.eq(15).val();
            document.cookie = "rebarPodiumTheo="+allInput.eq(16).val();
            document.cookie = "rebarStandardReal="+allInput.eq(17).val();
            document.cookie = "rebarStandardTheo="+allInput.eq(18).val();
            document.cookie = "concretePodiumReal="+allInput.eq(19).val();
            document.cookie = "concretePodiumTheo="+allInput.eq(20).val();
            document.cookie = "concreteStandardReal="+allInput.eq(21).val();
            document.cookie = "concreteStandardTheo="+allInput.eq(22).val();
            document.cookie = "steelPodiumReal="+allInput.eq(23).val();
            document.cookie = "steelPodiumTheo="+allInput.eq(24).val();
            document.cookie = "steelStandardReal="+allInput.eq(25).val();
            document.cookie = "steelStandardTheo="+allInput.eq(26).val();

            projectNameNow = document.getElementById('selectedPro').innerHTML;
            document.cookie = "projectName="+projectNameNow;
            if ($('input:radio[name="loft"]').val() == "true") {
                document.cookie = "havaLoft=1";
            }else{
                document.cookie = "havaLoft=0";
            }
            if ($('input:radio[name="earthquake"]').val() == "true") {
                document.cookie = "seismicOverrun=1";
                if (allInput.eq(11).val() == "C+D") {
                    document.cookie = "seismicPerformance=C%2BD"
                }else{
                    document.cookie = "seismicPerformance="+allInput.eq(11).val();
                }
            }else{
                document.cookie = "seismicOverrun=0";
                document.cookie = "seismicPerformance=''";
            }
            window.location.href="/src/superStructureOperate.php";
        }
    </script>
</body>
</html>