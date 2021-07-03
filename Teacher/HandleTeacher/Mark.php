<?php
include '../../Apps/config.php';
$page = new Apps_Libs_UserIdentity(); 
?>

<style>
    *{
        margin: 0 auto;
        padding: 0;
        font-family: Arial, Helvetica, sans-serif;
        box-sizing: border-box;
    }
    .main-show{
        position: relative;
        height: 100%;
        width: 100%;
    }
    .container-header{
        position: absolute;
        height: 70px;
        width: 100%;
    }
    .container-header .header-btnadd{
        position: absolute;
        height: 60%;
        width: 150px;
        top: 20%;
    }
    .container-header .header-course{
        position: absolute;
        height: 60%;
        width: 300px;
        top: 20%;
        right: 530px;
    }
    .header-course #selectcourse{
        padding: 10px;
        font-size: 20px;
        height: 100%;
        width: 100%;
        border: solid 1px #2574A9;
        border-top-right-radius:5px;
        border-bottom-right-radius:5px;
    }
    .header-btnadd #btnadd{
        font-size: 20px;
        height: 100%;
        padding: 5px 20px;
        background-color: gray;
    }
    .container-header .header-txtsearch{
        position: absolute;
        right: 180px;
        height: 60%;
        width: 350px;
        top: 20%;
    }
    .container-header .header-btnsearch{
        position: absolute;
        right: 100px;
        height: 60%;
        width: 80px;
        top: 20%;
    }
    .header-txtsearch #txtsearch{
        padding: 10px;
        font-size: 20px;
        height: 100%;
        width: 100%;
        border: solid 1px #2574A9;
        border-top-right-radius:5px;
        border-bottom-right-radius:5px;
    }
    .header-btnsearch #btnsearch{
        font-size: 20px;
        height: 100%;
        width: 100%;
        border-top-left-radius:5px;
        border-bottom-left-radius:5px;
    }
    .container-inserts{
        display: none;
    }
    .container-inserts.active{
        display: block;
        position: absolute;
        height: calc(100vh - 70px);
        width: 100%;
        top: 70px;
    }
    .container-tables.active{
        display: block;
        position: absolute;
        height: calc(100vh - 100px);
        width: 100%;
        top: 70px;
    }
    .container-tables{
        display: none;
    }
    .container-tables.active table{
        width: 100%;
        text-align: left;
        font-size: 20px;
        border-collapse:collapse
    }
    table thead{
        font-size: 25px;
        background-color: #B0E0E6;
        color: rgb(0, 0, 0);
    }
    tbody tr{
        border: solid black 1px;
        border-right-style: none;
        border-left-style: none;
    }
    tr td{
        padding: 10px 5px;
        line-height: 35px;
    }
    tbody .row-data .data{
        display: block;
    }
    .row-data .input{
        display: none;
    }
    .row-data.on-edit .data{
        display: none;
    }
    .row-data.on-edit .input{
        display: block;
    }
    .row-data.on-edit .col1,
    .row-data.on-edit .col6{
        text-align: left;
        width: 10%;
    }
    .row-data.on-edit .col2,
    .row-data.on-edit .col3,
    .row-data.on-edit .col4,
    .row-data.on-edit .col5{
        text-align: left;
        width: 20%;
    }
    .row-data.on-edit #col-2-in,
    .row-data.on-edit #col-3-in,
    .row-data.on-edit #col-4-in,
    .row-data.on-edit #col-5-in{
        height: 20px;
        width: 100%;
    }
    td .btn-handle{
        display: block;
        float: left;
        height: 30px;
        width: 80px;
        margin-right: 5px;
        font-size: 20px;
    }
    td #btn-delete{
        background-color: red;
    }
    td #btn-edit{
        background-color: orange;
    }
    td #btn-save{
        background-color: #00e0ff;
    }
    td #btn-cancel{
        background-color: #f00101;
    }
    .btn-handle{
        border: none;
        background-color: #2574A9;
        color: white; 
    }
    #tr_pagination{
        text-align: right;
        border-bottom-style: none;
        border-top-style: none;
    }
    #tr_pagination:hover{
        background-color: white;
        cursor: auto;
    }
    .btn-handle:hover{
        cursor: pointer;
        color: #D7D7D7;
    }
    input{
        cursor: pointer;
    }
    table tbody tr:hover{
        background-color: #F8F8FF;
        color: #000000;
        cursor: pointer;
    }
</style>
<body>
    <div class="main-show">
        <div class="container-header"> 
            <form action="#" method="GET">
                <div class="header-btnadd">
                    <input type="button" class="btn-handle" value="Back" id="btnadd" onclick="Back()">
                </div>
                <div class="header-course">
                    <select name="subjects" id="selectcourse">
                        <option value="">---Select Subjects---</option>
                        <?php
                        $subjects = new Apps_Model_Subject();
                        $listsubjects = $subjects->buildparam([
                                ])->select();
                        foreach ($listsubjects as $val) {
                            ?>
                            <option value="<?php echo $val["id"] ?>"><?php echo $val["name"] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="header-txtsearch">
                    <input type="search" name="txtsearch" placeholder="serach here" id="txtsearch">
                </div>
                <div class="header-btnsearch">
                    <input type="submit" name="btnsearch" value="Search" id="btnsearch" class="btn-handle">
                </div>
            </form>
        </div>

        <div id="container-insert" class="container-inserts">

        </div>

        <div id="container-table" class="container-tables active">
            <table>
                <thead>
                <td class="col1">NO</td>
                <td class="col2">Student ID</td>
                <td class="col3">Subjects ID</td>
                <td class="col4">Mark by number</td>
                <td class="col5">Mark by word</td>
                <td class="col6">Handle</td>
                </thead>
                <tbody>
                    <?php
                    $item_per_page = 5;
                    $curren_page = !empty($_GET["page"]) ? $_GET["page"] : 1;
                    $totalitem = 0;
                    $totalpage;
                    $offset = ($curren_page - 1) * $item_per_page;

                    $mark = new Apps_Model_Mark();
                    $result = null;

                    $getSubjects = $page->getGet("subjects");
                    $search = $page->getGet("txtsearch");

                    if ($search || $getSubjects) {
                        if ($getSubjects) {
                            $result = $mark->buildparam([
                                        "where" => "idteacher = '".$page->getSESSION("username") ."' " ."and idsubjects = '" . $getSubjects . "'",
                                        "other" => "LIMIT " . $item_per_page . " OFFSET " . $offset
                                    ])->select();
                            $totalresult = $mark->buildparam([
                                        "where" => "idteacher = '".$page->getSESSION("username") ."' " ."and idsubjects = '" . $getSubjects . "'",
                                    ])->select();
                            foreach ($totalresult as $a) {
                                $totalitem++;
                            }
                            $totalpage = ceil($totalitem / $item_per_page);
                        }

                        if ($search) {
                            $result = $mark->buildparam([
                                        "where" => "idteacher = '".$page->getSESSION("username") ."' " ."and idstudent like '%" . $page->getGet("txtsearch") . "%'",
                                        "other" => "LIMIT " . $item_per_page . " OFFSET " . $offset
                                    ])->select();
                            $totalresult = $mark->buildparam([
                                        "where" => "idteacher = '".$page->getSESSION("username") ."' " ."and idstudent = '" . $search . "'",
                                    ])->select();
                            foreach ($totalresult as $a) {
                                $totalitem++;
                            }
                            $totalpage = ceil($totalitem / $item_per_page);
                        }

                        if ($search && $getSubjects) {
                            $result = $mark->buildparam([
                                        "where" => "idteacher = '".$page->getSESSION("username") ."' " ."and idstudent like '%" . $page->getGet("txtsearch") . "%' and " . "idsubjects = '" . $getSubjects . "'",
                                        "other" => "LIMIT " . $item_per_page . " OFFSET " . $offset
                                    ])->select();
                            $totalresult = $mark->buildparam([
                                        "where" => "idteacher = '".$page->getSESSION("username") ."' " ."and idstudent = '" . $search . "'",
                                    ])->select();
                            foreach ($totalresult as $a) {
                                $totalitem++;
                            }
                            $totalpage = ceil($totalitem / $item_per_page);
                        }
                    } else {
                        $result = $mark->buildparam([
                                    "where"=> "idteacher = '".$page->getSESSION("username") ."'",
                                    "other" => "LIMIT " . $item_per_page . " OFFSET " . $offset
                                ])->select();
                        $totalresult = $mark->buildparam([
                            "where"=> "idteacher = '".$page->getSESSION("username") ."'"
                        ])->select();
                        foreach ($totalresult as $a) {
                            $totalitem++;
                        }
                        $totalpage = ceil($totalitem / $item_per_page);
                    }
                    $i = 1;
                    foreach ($result as $value) {
                        ?>
                    <form action="#" method="post" enctype="multipart/form-data">
                        <tr class="row-data" id="<?php echo 'row' . $i ?>">
                            <td class="col1"><?php echo $i ?></td>
                            <td class="col2">
                                <p id="col-2" class="data"><?php echo $value["idstudent"] ?></p>
                                <input type="text" readonly="readonly" name="idstudent" value="<?php echo $value["idstudent"] ?>" id="col-2-in" class="input">
                            </td>
                            <td class="col3">
                                <p id="col-3" class="data"><?php echo $value["idsubjects"] ?></p>
                                <input type="text" readonly="readonly" name="idsubjects" value="<?php echo $value["idsubjects"] ?>" id="col-3-in" class="input">
                            </td>
                            <td class="col4">
                                <p id="col-4" class="data"><?php echo $value["markbynumber"] ?></p>
                                <input type="number" min="0" max="10" step="any" name="markbynumber" value="<?php echo $value["markbynumber"] ?>" id="col-4-in<?php echo $i; ?>" onchange="SetValuesText('col-4-in<?php echo $i; ?>','col-5-in<?php echo $i; ?>')" onkeyup="SetValuesText('col-4-in<?php echo $i; ?>','col-5-in<?php echo $i; ?>')" class="input">
                            </td>
                            <td class="col5">
                                <p id="col-5" class="data"><?php echo $value["markbyword"] ?></p>
                                <input type="text" readonly="readonly" name="markbyword" value="<?php echo $value["markbyword"] ?>" id="col-5-in<?php echo $i; ?>" class="input">
                            </td>
                            <td id="td-handle" class="col6">
                                <p id="col-6" class="data">
                                    <input type="button" id="btn-edit" value="Update" name="btnedit" class="btn-handle" onclick="AddClass(<?php echo $i ?>);">
                                    <!--<input type="button" id="btn-delete" value="Delete" name="btndelete" class="btn-handle" onclick="Deletedata('<?php echo $value["idsubjects"] ?>','<?php echo $value["idteacher"] ?>','<?php echo $value["idstudent"] ?>')">-->
                                </p>
                                <p id="col-6-in" class="input">
                                    <input type="submit" id="btn-save" value="Save" name="btnsave" class="btn-handle">
                                    <input type="button" id="btn-cancel" value="Back" name="btncancel" class="btn-handle" onclick="DropClass(<?php echo $i ?>);">
                                </p>
                            </td>
                        </tr>
                    </form>
                    <?php
                    $i++;
                }
                ?>
                <tr id="tr_pagination">
                    <td colspan="6" id="td_pagination"><?php include_once '../../Admin/HandleAdmin/PageNumber.php'; ?></td>
                </tr>
                </tbody>
            </table>
            
            <?php
            if ($page->getPOST("btnsave")) {
                try {
                    $mark->buildparam([
                        "field" => "markbynumber=?,markbyword=?",
                        "where" => "idsubjects=? and idstudent=?",
                        "values" => [
                            $page->getPOST("markbynumber"),
                            $page->getPOST("markbyword"),
                            $page->getPOST("idsubjects"),
                            $page->getPOST("idstudent")
                        ]
                    ])->update();

                    echo '<script language="javascript">';
                    echo "location.replace('http://localhost/StudentManage/Teacher/HandleTeacher/Mark.php');";
                    echo '</script>';
                } catch (Exception $ex) {
                    echo '<script language="javascript">';
                    echo "alert('Update Failed')";
                    echo '</script>';
                }
            }
            ?>
        </div>
        <script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
        <script type="text/javascript">
                                    function AddClass(id) {
                                        document.getElementById("row" + id).classList.add("on-edit");
                                    }
                                    function DropClass(id) {
                                        document.getElementById("row" + id).classList.remove("on-edit");
                                    }

                                    var th = ['', 'Nghìn', 'Triệu', 'Tỷ', 'Nghìn tỷ'];
                                    var dg = ['Không', 'Một', 'Hai', 'Ba', 'Bốn', 'Năm', 'Sáu', 'Bảy', 'Tám', 'Chín'];
                                    var tn = ['Mười', 'Mười một', 'Mười hai', 'Mười ba', 'Mười bốn', 'Mười lăm', 'Mười sáu', 'Mười bảy', 'Mười tám', 'Mười chín'];
                                    var tw = ['Hai mươi', 'Ba mươi', 'Bốn mươi', 'Năm mươi', 'Sáu mươi', 'Bảy mươi', 'Tám mươi', 'Chín mươi'];

                                    function toWords(s) {
                                        s = s.toString();
                                        s = s.replace(/[\, ]/g, '');
                                        if (s != parseFloat(s))
                                            return 'not a number';
                                        var x = s.indexOf('.');
                                        if (x == -1)
                                            x = s.length;
                                        if (x > 15)
                                            return 'too big';
                                        var n = s.split('');
                                        var str = '';
                                        var sk = 0;
                                        for (var i = 0; i < x; i++) {
                                            if ((x - i) % 3 == 2) {
                                                if (n[i] == '1') {
                                                    str += tn[Number(n[i + 1])] + ' ';
                                                    i++;
                                                    sk = 1;
                                                } else if (n[i] != 0) {
                                                    str += tw[n[i] - 2] + ' ';
                                                    sk = 1;
                                                }
                                            } else if (n[i] != 0) { // 0235
                                                str += dg[n[i]] + ' ';
                                                if ((x - i) % 3 == 0)
                                                    str += 'Trăm ';
                                                sk = 1;
                                            }
                                            if ((x - i) % 3 == 1) {
                                                if (sk)
                                                    str += th[(x - i - 1) / 3] + ' ';
                                                sk = 0;
                                            }
                                        }

                                        if (x != s.length) {
                                            var y = s.length;
                                            str += 'Phẩy ';
                                            for (var i = x + 1; i < y; i++)
                                                str += dg[n[i]] + ' ';
                                        }
                                        return str.replace(/\s+/g, ' ')+"Điểm";
                                    }
                                    
                                    function SetValuesText(ide,ida){
                                        var x = document.getElementById(ide).value;
                                        document.getElementById(ida).value = toWords(x);
                                    }
                                    function Back(){
                                        location.replace('http://localhost/StudentManage/Teacher/Home.php');
                                    }
        </script>
    </div>
</body>
