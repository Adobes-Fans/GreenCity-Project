<!DOCTYPE html>
<html lang="zh-CN">

<?php
    $conn = mysqli_connect("localhost","root","123456","GreenCity","2711");
    if (!$conn) {
        die('Could not connect: ' . mysqli_error());
    }
    // mysqli_select_db("GreenCity", $con);
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
                        <div class="col-md-4" style="margin-top:7px;" data-toggle="modal" data-target="#myModal">
                            <button type="button" class="btn btn-info">选择项目</button>
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
                                                    <td>项目名称</td>
                                                    <td>建筑类型</td>
                                                    <td>项目创建人</td>
                                                    <td>选择项目</td>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                    $proRes = mysqli_query($conn,"SELECT projectName, buildingType, inputerID FROM Project");
                                                    while($row = mysqli_fetch_array($proRes,MYSQLI_ASSOC)){
                                                        echo "<tr name='proTable' class = 'proTableClass'>";
                                                        echo "<td>".$row['projectName']."</td>";
                                                        echo "<td>".$row['buildingType']."</td>";
                                                        $inputerRes = mysqli_query($conn,"SELECT name FROM user where id = '".$row['inputerID']."'");
                                                        $inputerName = mysqli_fetch_array($inputerRes,MYSQLI_ASSOC)['name'];
                                                        echo "<td>".$inputerName."</td>";
                                                        echo "<td><input type='radio' name='project'></td>";
                                                        echo "</tr>";
                                                    }
                                                ?>
                                                <!-- <tr>
                                                    <td>xxx</td>
                                                    <td>住宅</td>
                                                    <td>name</td>
                                                    <td><input type="radio" name="project"></td>
                                                </tr>
                                                <tr>
                                                    <td>xxx</td>
                                                    <td>住宅</td>
                                                    <td>name</td>
                                                    <td><input type="radio" name="project"></td>
                                                </tr>
                                                <tr>
                                                    <td>xxx</td>
                                                    <td>住宅</td>
                                                    <td>name</td>
                                                    <td><input type="radio" name="project"></td>
                                                </tr>
                                                <tr>
                                                    <td>xxx</td>
                                                    <td>住宅</td>
                                                    <td>name</td>
                                                    <td><input type="radio" name="project"></td>
                                                </tr>
                                                <tr>
                                                    <td>xxx</td>
                                                    <td>住宅</td>
                                                    <td>name</td>
                                                    <td><input type="radio" name="project"></td>
                                                </tr>
                                                <tr>
                                                    <td>xxx</td>
                                                    <td>住宅</td>
                                                    <td>name</td>
                                                    <td><input type="radio" name="project"></td>
                                                </tr>
                                                <tr>
                                                    <td>xxx</td>
                                                    <td>住宅</td>
                                                    <td>name</td>
                                                    <td><input type="radio" name="project"></td>
                                                </tr>
                                                <tr>
                                                    <td>xxx</td>
                                                    <td>住宅</td>
                                                    <td>name</td>
                                                    <td><input type="radio" name="project"></td>
                                                </tr>
                                                <tr>
                                                    <td>xxx</td>
                                                    <td>住宅</td>
                                                    <td>name</td>
                                                    <td><input type="radio" name="project"></td>
                                                </tr>
                                                <tr>
                                                    <td>xxx</td>
                                                    <td>住宅</td>
                                                    <td>name</td>
                                                    <td><input type="radio" name="project"></td>
                                                </tr>
                                                <tr>
                                                    <td>xxx</td>
                                                    <td>住宅</td>
                                                    <td>name</td>
                                                    <td><input type="radio" name="project"></td>
                                                </tr>
                                                <tr>
                                                    <td>xxx</td>
                                                    <td>住宅</td>
                                                    <td>name</td>
                                                    <td><input type="radio" name="project"></td>
                                                </tr>
                                                <tr>
                                                    <td>xxx</td>
                                                    <td>住宅</td>
                                                    <td>name</td>
                                                    <td><input type="radio" name="project"></td>
                                                </tr>
                                                <tr>
                                                    <td>xxx</td>
                                                    <td>住宅</td>
                                                    <td>name</td>
                                                    <td><input type="radio" name="project"></td>
                                                </tr> -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                    <button type="button" class="btn btn-primary">提交</button>
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
                            <input type="radio" name="loft" required><label class="control-label singleSelect">有</label>
                        </div>
                        <div class="col-md-2">
                            <input type="radio" name="loft" required><label class="control-label singleSelect">无</label>
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
                            <button type=" submit " class="btn btn-info btn-default btn-lg ">提交地上建筑</button>
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
        function setNavHeight() {
            var h = $('#main').height();
            var padH = $('#main').css('padding-top');
            var navH = Number(h.toString().substring(0, 5)) + Number(padH.toString().substring(0, 3));
            $('#nav').css('height', navH + "px");
        }

        window.onload = function() {
            setNavHeight();
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
            $proNameQueryArg = document.getElementById('ProName').value;
            $proTable = document.getElementsByName('proTable');
            for (var i = $proTable.length - 1; i >= 0; i--) {
                if ($proTable[i].childNodes[0].textContent == $proNameQueryArg) {
                    $('.proTableClass').slice(i,i+1).css('display', '')
                }else{
                    $('.proTableClass').slice(i,i+1).css('display', 'none')
                }
            }
        }
    </script>
</body>

</html>