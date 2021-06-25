<?php
    include '../../Apps/config.php';
    $page = new Apps_Libs_UserIdentity();
    if($page->isLogin() === false){
        header("location:http://localhost/StudentManage/Login/");
        die();
    }
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
        width: 150%;
        background-color: #008080;
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
                    <input type="button" name="btnadd" class="btn-handle" value="Add Course Info" id="btnadd" onclick="Showinsert()">
                </div>
                <div class="header-course">
                    <select name="course" id="selectcourse">
                        <?php
                            $course = new Apps_Model_Course();
                            $listcourse = $course->buildparam([
                            ])->select();
                    foreach ($listcourse as $val){
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
            <?php
                include_once './Insert.php';
            ?>
        </div>

        <div id="container-table" class="container-tables active">
            <table>
                <thead>
                <td class="col1">NO</td>
                <td class="col2">Room ID</td>
                <td class="col3">Subjects ID</td>
                <td class="col4">Teacher ID</td>
                <td class="col5">Student ID</td>
                <td class="col6">Handle</td>
                </thead>
                <tbody>
                    <?php
                    $item_per_page = 5;
                    $curren_page = !empty($_GET["page"]) ? $_GET["page"] : 1;
                    $totalitem = 0;
                    $totalpage;
                    $offset = ($curren_page -1) * $item_per_page;
                    
                    $getCourse = "course1";

                    $courseinfo = new Apps_Model_CourseInfo();
                    $result = null;
                    
                    $getCourse = $page->getGet("course");
                    $search = $page->getGet("txtsearch");
                    
                    if ($search || $getCourse) {
                        $result = $courseinfo->buildparam([
                                    "where" => "idcourse = '".$getCourse."' And idsubjects like '%" . $page->getGet("txtsearch") . "%'",
                                    "other" => "LIMIT ".$item_per_page." OFFSET ".$offset
                            ])->select();
                        $totalresult = $courseinfo->buildparam([
                            "where" => "idcourse = '".$getCourse."'",
                                ])->select();
                            foreach ($totalresult as $a){
                                $totalitem++;
                            }
                            $totalpage = ceil($totalitem / $item_per_page);
                    } else {
                        if($getCourse == "")
                            $getCourse = "course1";
                            $result = $courseinfo->buildparam([
                            "where" => "idcourse = '".$getCourse."'",
                            "other" => "LIMIT ".$item_per_page." OFFSET ".$offset
                                ])->select();
                            $totalresult = $courseinfo->buildparam([
                            "where" => "idcourse = '".$getCourse."'",
                                ])->select();
                            foreach ($totalresult as $a){
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
                                <p id="col-2" class="data"><?php echo $value["idclassroom"] ?></p>
                                <input type="text" name="idclassroom" value="<?php echo $value["idclassroom"] ?>" id="col-2-in" class="input">
                            </td>
                            <td class="col3">
                                <p id="col-3" class="data"><?php echo $value["idsubjects"] ?></p>
                                <input type="text" readonly="readonly" name="idsubjects" value="<?php echo $value["idsubjects"] ?>" id="col-3-in" class="input">
                            </td>
                            <td class="col4">
                                <p id="col-4" class="data"><?php echo $value["idteacher"] ?></p>
                                <input type="text" name="idteacher" value="<?php echo $value["idteacher"] ?>" id="col-4-in" class="input">
                            </td>
                            <td class="col5">
                                <p id="col-5" class="data"><?php echo $value["idstudent"] ?></p>
                                <input type="text" readonly="readonly" name="idstudent" value="<?php echo $value["idstudent"] ?>" id="col-5-in" class="input">
                            </td>
                            <td id="td-handle" class="col6">
                                <p id="col-6" class="data">
                                    <input type="button" id="btn-edit" value="Edit" name="btnedit" class="btn-handle" onclick="AddClass(<?php echo $i ?>);">
                                    <input type="button" id="btn-delete" value="Delete" name="btndelete" class="btn-handle" onclick="Deletedata('<?php echo $value["idsubjects"] ?>','<?php echo $value["idteacher"] ?>','<?php echo $value["idstudent"] ?>')">
                                </p>
                                <p id="col-6-in" class="input">
                                    <input type="submit" id="btn-save" value="Save" name="btnsave" class="btn-handle" onclick="Editdata();">
                                    <input type="button" id="btn-cancel" value="Cancel" name="btncancel" class="btn-handle" onclick="DropClass(<?php echo $i ?>);">
                                </p>
                            </td>
                        </tr>
                    </form>
                    <?php
                    $i++;
                }
                ?>
                <tr id="tr_pagination">
                    <td colspan="6" id="td_pagination"><?php include_once '../HandleAdmin/PageNumber.php'; ?></td>
                </tr>
                </tbody>
            </table>
            <?php
            if ($page->getPOST("btnsave")) {
                try {
                    $courseinfo->buildparam([
                        "field"=>"idclassroom=?,idteacher=?",
                        "where"=>"idsubjects=?",
                        "values"=>[
                            $page->getPOST("idclassroom"),
                            $page->getPOST("idteacher"),
                            $page->getPOST("idsubjects")
                        ]
                    ])->update();
                    
                    echo '<script language="javascript">';
                    echo "location.replace('http://localhost/StudentManage/Admin/ManageCourseInfo/Show.php');";
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
                                        function AddClass(id,radio) {
                                            document.getElementById("row" + id).classList.add("on-edit");
                                        }
                                        function DropClass(id) {
                                            document.getElementById("row" + id).classList.remove("on-edit");
                                        }
                                        function Deletedata(subject,teacher,student) {
                                            if(student === ""){
                                                option = confirm("Do you want delete this subject and teacher from the course?");
                                            if (!option) {
                                                return;
                                            }
                                            $.post('./Delete.php', {
                                                'subject': subject,
                                                'teacher': teacher
                                            }, function (data) {
                                                alert(data);
                                                location.reload();
                                            });    
                                            }
                                            
                                            if(student !== ""){
                                                option = confirm("Do you want delete this Student from the subject?");
                                            if (!option) {
                                                return;
                                            }
                                            $.post('./Delete.php', {
                                                'subject': subject,
                                                'student': student
                                            }, function (data) {
                                                alert(data);
                                                location.reload();
                                            });
                                            }
                                            
                                        }
                                        function Showinsert() {
                                            document.getElementById("container-table").classList.remove("active");
                                            document.getElementById("container-insert").classList.add("active");
                                        }
        </script>
    </div>
</body>
