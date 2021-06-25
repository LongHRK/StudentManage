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
    .header-btnadd #btnadd{
        font-size: 20px;
        height: 100%;
        width: 100%;
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
        height: calc(100vh - 50px);
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
    .row-data.on-edit .col2,
    .row-data.on-edit .col6,
    .row-data.on-edit .col8{
        width: 5%;
    }
    .row-data.on-edit .col5{
        width: 20%;
        text-align: center;
    }
    .row-data.on-edit .col3,
    .row-data.on-edit .col4,
    .row-data.on-edit .col7,
    .row-data.on-edit .col8{
        width: 15%;
    }
    .row-data.on-edit #col-2-in,
    .row-data.on-edit #col-3-in,
    .row-data.on-edit #col-4-in,
    .row-data.on-edit #col-6-in,
    .row-data.on-edit #col-7-in,
    .row-data.on-edit #col-8-in{
        width: 100%;
        height: 20px;
    }
    #col-8 img{
        max-height: 35px;
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
    #tr_pagination{
        text-align: right;
        border-bottom-style: none;
        border-top-style: none;
    }
    #tr_pagination:hover{
        background-color: white;
        cursor: auto;
    }
</style>
<body>
    <div class="main-show">
        <div class="container-header"> 
            <form action="#" method="GET">
                <div class="header-btnadd">
                    <input type="button" name="btnadd" class="btn-handle" value="Add Teacher" id="btnadd" onclick="Showinsert()">
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
                <td class="col2">Teacher ID</td>
                <td class="col3">Full Name</td>
                <td class="col4">Birth Day</td>
                <td class="col5">Gender</td>
                <td class="col6">Salary</td>
                <td class="col7">Home Town</td>
                <td class="col8">Avatar</td>
                <td class="col9">Handle</td>
                </thead>
                <tbody>
                    <?php
                    $item_per_page = 5;
                    $curren_page = !empty($_GET["page"]) ? $_GET["page"] : 1;
                    $totalitem = 0;
                    $totalpage;
                    $offset = ($curren_page -1) * $item_per_page;
                    
                    $teacher = new Apps_Model_Teacher();
                    
                    $result = null;
                    
                    $search = $page->getGet("txtsearch");
                    
                    if ($search) {
                        $result = $teacher->buildparam([
                                    "where" => "name like '%" . $page->getGet("txtsearch") . "%'",
                                    "other" => "LIMIT ".$item_per_page." OFFSET ".$offset
                                ])->select();
                        $totalresult = $teacher->buildparam([
                            "where" => "name like '%" . $page->getGet("txtsearch") . "%'"
                        ])->select();
                            foreach ($totalresult as $a){
                                $totalitem++;
                            }
                            $totalpage = ceil($totalitem / $item_per_page);
                    } else {
                        $result = $teacher->buildparam([
                            "other" => "LIMIT ".$item_per_page." OFFSET ".$offset
                                ])->select();
                        $totalresult = $teacher->buildparam([
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
                                <p id="col-2" class="data"><?php echo $value["id"] ?></p>
                                <input type="text" name="idteacher" readonly="readonly" value="<?php echo $value["id"] ?>" id="col-2-in" class="input">
                            </td>
                            <td class="col3">
                                <p id="col-3" class="data"><?php echo $value["name"] ?></p>
                                <input type="text" name="nameteacher" value="<?php echo $value["name"] ?>" id="col-3-in" class="input">
                            </td>
                            <td class="col4">
                                <p id="col-4" class="data"><?php echo $value["birthday"] ?></p>
                                <input type="date" name="birthdayteacher" value="<?php echo $value["birthday"] ?>" id="col-4-in" class="input">
                            </td>
                            <td class="col5">
                                <p id="col-5" class="data"><?php echo $value["gender"] ?></p>
                                <div id="col-3-in" class="input">
                                    <input type="radio" value="Nam" name="genderteacher">Nam&nbsp;
                                    <input type="radio" value="Nữ" name="genderteacher" >Nữ&nbsp;
                                    <input type="radio" value="Khác" name="genderteacher" >Khác
                                </div>
                            </td>
                            <td class="col6">
                                <p id="col-6" class="data"><?php echo $value["salary"]." $" ?></p>
                                <input type="number" name="salaryteacher" value="<?php echo $value["salary"] ?>" id="col-6-in" class="input">
                            </td>
                            <td class="col7">
                                <p id="col-7" class="data"><?php echo $value["hometown"] ?></p>
                                <input type="text" name="hometownteacher" value="<?php echo $value["hometown"] ?>" id="col-7-in" class="input">
                            </td>
                            <td class="col8">
                                <p id="col-8" class="data"><?php
                                    if ($value["avatar"] === "Trống") {
                                        echo $value["avatar"];
                                    } else {
                                        ?>
                                        <img src="<?php echo $value["avatar"] ?>" alt="Image"/>
                                        <?php
                                    }
                                    ?>
                                </p>
                                <input type="file" name="avatarteacher" id="col-8-in" class="input">
                            </td>
                            <td id="td-handle" class="col8">
                                <p id="col-9" class="data">
                                    <input type="button" id="btn-edit" value="Edit" name="btnedit" class="btn-handle" onclick="AddClass(<?php echo $i ?> , '<?php echo $value["gender"] ?>');">
                                    <input type="button" id="btn-delete" value="Delete" name="btndelete" class="btn-handle" onclick="Deletedata('<?php echo $value["id"] ?>')">
                                </p>
                                <p id="col-9-in" class="input">
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
                
                $imageupdate;
                
                $linking = $teacher->buildparam([
                    "select"=>"avatar",
                    "where"=>"id = ?",
                    "values"=>[$page->getPOST("idteacher")]
                ])->selectone();
                
                if (isset($_FILES["avatarteacher"]) && !isset($_FILES["avatarteacher"]["errors"])) {
                    move_uploaded_file($_FILES["avatarteacher"]["tmp_name"], "../../Public/StoreImage/" . $_FILES["avatarteacher"]["name"]);
                }

                $imageupdate = "../../Public/StoreImage/" . $_FILES["avatarteacher"]["name"];
                $imageupdate === "../../Public/StoreImage/" ? $imageupdate = "Trống" : $imageupdate;
                
                if($linking["avatar"] !== "Trống" && $imageupdate !== "Trống"){
                    unlink($linking["avatar"]);
                }
                
                if($imageupdate === "Trống"){
                    $imageupdate = $linking["avatar"];
                }

                try {
                    $result = $teacher->buildparam(
                        [
                           "field"=>"name=?,birthday=?,gender=?,salary=?,hometown=?,avatar=?", 
                            "where"=>"id=?",
                            "values"=>[
                                $page->getPOST("nameteacher"),
                                $page->getPOST("birthdayteacher"),
                                $page->getPOST("genderteacher"),
                                $page->getPOST("salaryteacher"),
                                $page->getPOST("hometownteacher"),
                                $imageupdate,
                                $page->getPOST("idteacher")
                            ]
                        ]
                )->update();
            echo '<script language="javascript">';
            echo "location.replace('http://localhost/StudentManage/Admin/ManageTeacher/Show.php');";
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
                                            var check = document.getElementsByName("genderteacher");
                                            for (var i = 0; i < check.length; i++){
                                                if (check[i].value === radio){
                                                    check[i].checked = true;
                                                }
                                            }
                                        }
                                        function DropClass(id) {
                                            document.getElementById("row" + id).classList.remove("on-edit");
                                        }
                                        function Deletedata(id) {
                                            option = confirm("Do you want delete this teacher?");
                                            if (!option) {
                                                return;
                                            }
                                            console.log(id);
                                            $.post('./Delete.php', {
                                                'id': id
                                            }, function (data) {
                                                alert(data);
                                                location.reload();
                                            });
                                        }
                                        function Showinsert() {
                                            document.getElementById("container-table").classList.remove("active");
                                            document.getElementById("container-insert").classList.add("active");
                                        }
        </script>
    </div>
</body>
