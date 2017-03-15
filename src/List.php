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

    <title>绿城建筑 项目列表</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <style>
        #container {
            width: 100.8%;
        }
        
        #nav {
            background-color: #000000;
            height: 100%;
            margin-right: 0.0016%
        }
        
        #main {
            height: 100%;
            background-color: rgba(240, 242, 247, 1);
            padding: 0;
        }
        
        #list {
            background-color: #ffffff;
            margin: 3.3% 5%;
            padding: 2% 3% 1% 3%;
            height: 73%;
            overflow: scroll;
        }
        
        .table>tbody>tr>td,
        .table>tbody>tr>th,
        .table>tfoot>tr>td,
        .table>tfoot>tr>th,
        .table>thead>tr>td,
        .table>thead>tr>th {
            min-width: 100px;
            text-align: center;
            vertical-align: middle;
            padding: 10px;
        }
        
        td button {
            margin-right: 6px;
        }
        
        #page {
            width: 100%;
            text-align: center;
        }
        
        #myTab li a {
            color: #000000;
            font-size: 18px;
            font-family: 微软雅黑;
        }
        
        #myTabContent {
            margin-top: 30px;
            min-height: 700px;
        }
    </style>
</head>

<body>
    <div class="container-fluid" style="padding: 0">
        <div class="row" id="container">
            <!-- 这一块为系统原有导航栏 -->
            <div class="col-md-2" id="nav"></div>

            <div class="col-md-10" id="main">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <span class="nav navbar-nav" style="margin-right: 10px; line-height: 50px; font-size: 22px; font-family: 'Times New Roman', Times, serif">建筑单体信息列表</span>

                            <ul class="nav navbar-nav">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">添加<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a style = 'cursor:pointer' OnClick = 'newItem(0)'>新项目</a></li>
                                        <li><a style = 'cursor:pointer' OnClick = 'newItem(1)'>地上建筑</a></li>
                                        <li><a style = 'cursor:pointer' OnClick = 'newItem(2)'>地下室</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <div class="navbar-form navbar-right">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="searchInput" placeholder="Search">
                                </div>
                                <button class="btn btn-default" OnClick="searchItem()">搜索</button>
                            </div>
                        </div>
                    </div>
                </nav>

                <div id="list">
                    <ul id="myTab" class="nav nav-tabs">
                        <li class="active"><a href="#proTable" data-toggle="tab" OnClick="tabSelect(0)">项目列表</a></li>
                        <li><a href="#superStructureTable" data-toggle="tab" OnClick="tabSelect(1)">地上建筑单体列表</a></li>
                        <li><a href="#basementTable" data-toggle="tab" OnClick="tabSelect(2)">地下室单体列表</a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade in active" id="proTable">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>项目id</th>
                                        <th>项目名称</th>
                                        <th>建筑类型</th>
                                        <th>所在城市</th>
                                        <th>抗震烈度</th>
                                        <th>开发商</th>
                                        <th>基本风压</th>
                                        <th>基本雪压</th>
                                        <th>输入者id</th>
                                        <th>输入者姓名</th>
                                        <th style="min-width: 220px">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $proRes = $pdo->query("SELECT * FROM Project WHERE isExisting = 1");
                                        $proNum = 0;
                                        foreach ($proRes as $row) {
                                            echo "<tr class='projectTable'>";
                                            echo "<td>".$row['projectID']."</td>";
                                            echo "<td name ='itemName'>".$row['projectName']."</td>";
                                            echo "<td>".$row['buildingType']."</td>";
                                            echo "<td>".$row['city']."</td>";
                                            echo "<td>".$row['seismicPreIntensity']."</td>";
                                            echo "<td>".$row['developer']."</td>";
                                            echo "<td>".$row['basicWindPressure']."</td>";
                                            echo "<td>".$row['basicSnowPressure']."</td>";
                                            echo "<td>".$row['inputerID']."</td>";
                                            echo "<td>".$row['inputerName']."</td>";
                                            echo "<td><button class='btn btn-info'  OnClick='viewInfo(0,$proNum)'>查看</button> <button class='btn btn-success' OnClick='updateItem(0,$proNum)'>更新</button></td>";
                                            echo "</tr>";
                                            $proNum += 1;
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <div id="page">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination-lg">
                                        <li>
                                            <a href="#" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                        <?php
                                            $pageNum = $proNum / 10;
                                            for ($i=0; $i <= $pageNum; $i++) {
                                                $temp = $i+1;
                                                echo "<li><a style = 'cursor:pointer' OnClick = 'pageChange(0,$i)'>".$temp."</a></li>";
                                            }
                                        ?>
                                        <li>
                                            <a href="#" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="superStructureTable">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>项目id</th>
                                        <th>单体名称</th>
                                        <th>项目名称</th>
                                        <th>主要结构类型</th>
                                        <th>钢筋实算值(裙房)</th>
                                        <th>钢筋实算值(标准层)</th>
                                        <th>混凝土实算值(裙房)</th>
                                        <th>混凝土实算值(标准层)</th>
                                        <th>钢材实算值(裙房)</th>
                                        <th>钢材料实算值(标准层)</th>
                                        <th>输入者id</th>
                                        <th>输入者姓名</th>
                                        <th style="min-width: 220px">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $supStrRes = $pdo->query("SELECT * FROM superStructure WHERE isExisting = 1");
                                        $supStrNum = 0;
                                        foreach ($supStrRes as $row) {
                                            echo "<tr class='supStrTable'>";
                                            echo "<td>".$row['id']."</td>";
                                            echo "<td>".$row['name']."</td>";
                                            echo "<td>".$row['projectName']."</td>";
                                            echo "<td>".$row['mainType']."</td>";
                                            echo "<td>".$row['rebarPodiumReal']."</td>";
                                            echo "<td>".$row['rebarStandardReal']."</td>";
                                            echo "<td>".$row['concretePodiumReal']."</td>";
                                            echo "<td>".$row['concreteStandardReal']."</td>";
                                            echo "<td>".$row['steelPodiumReal']."</td>";
                                            echo "<td>".$row['steelStandardReal']."</td>";
                                            echo "<td>".$row['inputerID']."</td>";
                                            echo "<td>".$row['inputerName']."</td>";
                                            echo "<td><button class='btn btn-info' OnClick='viewInfo(1,$supStrNum)'>查看</button> <button class='btn btn-success' OnClick='updateItem(1,$supStrNum)'>更新</button> <button class='btn btn-warning' OnClick='deleteItem(1,$supStrNum)'>删除</button></td>";
                                            echo "</tr>";
                                            $supStrNum+=1;
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <div id="page">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination-lg">
                                        <li>
                                            <a href="#" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                        <?php
                                            $pageNum = $supStrNum / 10;
                                            for ($i=0; $i <= $pageNum; $i++) {
                                                $temp = $i+1;
                                                echo "<li><a style = 'cursor:pointer' OnClick = 'pageChange(1,$i)'>".$temp."</a></li>";
                                            }
                                        ?>
                                        <li>
                                            <a href="#" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="basementTable">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>项目id</th>
                                        <th>单体名称</th>
                                        <th>项目名称</th>
                                        <th>层数</th>
                                        <th>是否有人防</th>
                                        <th>人防面积</th>
                                        <th>面积</th>
                                        <th>结构形式</th>
                                        <th>钢筋(综合)</th>
                                        <th>混凝土(综合)</th>
                                        <th>钢材(综合)</th>
                                        <th>输入者id</th>
                                        <th>输入者姓名</th>
                                        <th style="min-width: 220px">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $basementRes = $pdo->query("SELECT * FROM basement WHERE isExisting = 1");
                                        $basementNum = 0;
                                        foreach ($basementRes as $row) {
                                            echo "<tr class='basementTable'>";
                                            echo "<td>".$row['id']."</td>";
                                            echo "<td>".$row['name']."</td>";
                                            echo "<td>".$row['projectName']."</td>";
                                            echo "<td>".$row['floor']."</td>";
                                            if ($row['airShelter'] == '1') {
                                                echo "<td>是</td>";
                                            }else{
                                                echo "<td>否</td>";
                                            }
                                            echo "<td>".$row['airShelterArea']."</td>";
                                            echo "<td>".$row['basementArea']."</td>";
                                            echo "<td>".$row['basementStructure']."</td>";
                                            echo "<td>".$row['rebarIntegrated']."</td>";
                                            echo "<td>".$row['concreteIntegrated']."</td>";
                                            echo "<td>".$row['steelIntegrated']."</td>";
                                            echo "<td>".$row['authorID']."</td>";
                                            echo "<td>".$row['authorName']."</td>";
                                            echo "<td><button class='btn btn-info' OnClick='viewInfo(2,$basementNum)'>查看</button> <button class='btn btn-success' OnClick='updateItem(2,$basementNum)'>更新</button> <button class='btn btn-warning' OnClick='deleteItem(2,$basementNum)'>删除</button></td>";
                                            echo "</tr>";
                                            $basementNum+=1;
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <div id="page">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination-lg">
                                        <li>
                                            <a href="#" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                        <?php
                                            $pageNum = $basementNum / 10;
                                            for ($i=0; $i <= $pageNum; $i++) {
                                                $temp = $i+1;
                                                echo "<li><a style = 'cursor:pointer' OnClick = 'pageChange(2,$i)'>".$temp."</a></li>";
                                            }
                                        ?>
                                        <li>
                                            <a href="#" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script>
        var tabSelected = 0;
        function setNavHeight() {
            var h = $('#main').height();
            var padH = 0;
            var navH = Number(h.toString().substring(0, 5)) + Number(padH.toString().substring(0, 3));
            $('#nav').css('height', navH + "px");
        }

        window.onload = function() {
            <?php
                $_COOKIE["itemName"]='';
            ?>
            setNavHeight();
            for (var i = 10; i < $('.projectTable').length; i++) {
                $('.projectTable').eq(i).css('display', 'none');
            }
            for (var i = 10; i < $('.supStrTable').length; i++) {
                $('.supStrTable').eq(i).css('display', 'none');
            }
            for (var i = 10; i < $('.basementTable').length; i++) {
                $('.basementTable').eq(i).css('display', 'none');
            }
            // if($.cookie("reload") == "1"){
            //     // document.cookie = "reload=0";
            //     $.cookie("reload","0");
            //     setTimeout(location.reload(true),1000);
            // }
        }

        function pageChange(type,pageNO){
            if (type == 0) {
                $('.projectTable').css('display', 'none');
                for (var i = pageNO*10; i < pageNO*10+10; i++) {
                    $('.projectTable').eq(i).css('display', '');
                }
            }
            if (type == 1) {
                $('.supStrTable').css('display', 'none');
                for (var i = pageNO*10; i < pageNO*10+10; i++) {
                    $('.supStrTable').eq(i).css('display', '');
                }
            }
            if (type == 2) {
                $('.basementTable').css('display', 'none');
                for (var i = pageNO*10; i < pageNO*10+10; i++) {
                    $('.basementTable').eq(i).css('display', '');
                }
            }
        }

        function newItem(type){
            document.cookie = "operation=0";
            if (type == 0) {
                window.location.href="/src/projectsForm.php";
            }
            if (type == 1) {
                window.location.href="/src/superStructureForm.php";
            }
            if (type == 2) {
                window.location.href="/src/basementForm.php";
            }
        }

        function viewInfo(type,itemNO){
            document.cookie = "operation=1";
            if (type == 0) {
                document.cookie = "itemName="+$('.projectTable')[itemNO].childNodes[0].textContent;
                window.location.href="/src/projectsForm.php";
            }
            if (type == 1) {
                document.cookie = "itemName="+$('.supStrTable')[itemNO].childNodes[0].textContent;
                window.location.href="/src/superStructureForm.php";
            }
            if (type == 2) {
                document.cookie = "itemName="+$('.basementTable')[itemNO].childNodes[0].textContent;
                window.location.href="/src/basementForm.php";
            }
        }

        function deleteItem(type,itemNO){
            var EntererID;
            if (type == 0) {
                EntererID = $('.projectTable')[itemNO].childNodes[8].textContent;

            }
            else if (type == 1) {
                EntererID = $('.supStrTable')[itemNO].childNodes[10].textContent;
            }
            else if (type == 2) {
                EntererID = $('.basementTable')[itemNO].childNodes[11].textContent;
            }
            if (<?php echo $_SESSION["authority"];?> != 3 || EntererID == '<?php echo $_SESSION["id"];?>') {
                if(confirm("确认删除？")){
                    document.cookie = "operation=3";
                    if (type == 0) {
                        document.cookie = "itemName="+$('.projectTable')[itemNO].childNodes[0].textContent;
                        document.cookie = "deleteType=0";
                    }
                    if (type == 1) {
                        document.cookie = "itemName="+$('.supStrTable')[itemNO].childNodes[0].textContent;
                        document.cookie = "deleteType=1";
                    }
                    if (type == 2) {
                        document.cookie = "itemName="+$('.basementTable')[itemNO].childNodes[0].textContent;
                        document.cookie = "deleteType=2";
                    }
                    window.location.href="/src/deleteOperation.php";
                }
            }else{
                alert("没有权限！");
            }
        }

        function updateItem(type,itemNO){
            var EntererID;
            if (type == 0) {
                EntererID = $('.projectTable')[itemNO].childNodes[8].textContent;

            }
            else if (type == 1) {
                EntererID = $('.supStrTable')[itemNO].childNodes[10].textContent;
            }
            else if (type == 2) {
                EntererID = $('.basementTable')[itemNO].childNodes[11].textContent;
            }
            if (<?php echo $_SESSION["authority"];?> != 3 || EntererID == <?php echo $_SESSION["id"];?>) {
                document.cookie = "operation=2";
                if (type == 0) {
                    document.cookie = "itemName="+$('.projectTable')[itemNO].childNodes[0].textContent;
                    window.location.href="/src/projectsForm.php";
                }
                if (type == 1) {
                    document.cookie = "itemName="+$('.supStrTable')[itemNO].childNodes[0].textContent;
                    window.location.href="/src/superStructureForm.php";
                }
                if (type == 2) {
                    document.cookie = "itemName="+$('.basementTable')[itemNO].childNodes[0].textContent;
                    window.location.href="/src/basementForm.php";
                }
            }else{
                alert("没有权限！");
            }
        }
        function tabSelect(tab){
            tabSelected = tab;
        }

        function searchItem(){
            var keyword = document.getElementById('searchInput').value;
            if (keyword.length == 0) {
                $('.projectTable').css('display', '');
                $('.supStrTable').css('display', '');
                $('.basementTable').css('display', '');
                for (var i = 10; i < $('.projectTable').length; i++) {
                    $('.projectTable').eq(i).css('display', 'none');
                }
                for (var i = 10; i < $('.supStrTable').length; i++) {
                    $('.supStrTable').eq(i).css('display', 'none');
                }
                for (var i = 10; i < $('.basementTable').length; i++) {
                    $('.basementTable').eq(i).css('display', 'none');
                }
            }else{
                tableAll = $('.projectTable');
                if (tabSelected == 1){
                    tableAll = $('.supStrTable');
                }
                if (tabSelected == 2) {
                    tableAll = $('.basementTable');
                }
                for (var i = tableAll.length - 1; i >= 0; i--) {
                    if (tableAll[i].childNodes[1].textContent.search(keyword) != -1) {
                        tableAll.eq(i).css('display', '')
                    }else{
                        tableAll.eq(i).css('display', 'none')
                    }
                }
            }            
        }

    </script>
</body>

</html>