<?php
include '../../Apps/config.php';
$page = new Apps_Libs_UserIdentity();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <style>
        *{
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .content{
            width: 460px;
            height: 285px;
            cursor: pointer;
        }
        .content .text{
            width: 100%;
            height: 15%;
            display: flex;
            align-items: center;
        }
        .text > p{
            font-weight: bold;
            font-size: 20px;
        }
        .content .border-1{
            width: 100%;
            height: 2.5%;
            display: flex;
            align-items: center;    
        }
        .border-1 > hr{
            width: 100%;
            color: black;
        }
        .content .avatar-info{
            display: none;
        }
        .content .avatar-info.active{
            width: 100%;
            height: 65%;
            display: flex;
            justify-content: space-around;
        }
        .avatar-info.active > .info2{
            flex: 1;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
        }
        .info2 .row{
            width: 100%;
            flex-basis: 12%;
            display: flex;
            justify-content: space-around;
        }
        .row .col1{
            flex-basis: 30%;
            font-weight: bold;
        }
        .row .col2{
            flex-basis: 65%;
            display: flex;
        }
        .col2 input{
            width: 100%;
        }
        .row >.col2.radio{
            flex-basis: 65%;
            display: flex;
            justify-content: space-around;
            align-items: center;
        }
        .row > .col2.radio input{
            max-width: 10px;
        }
        .avatar-info.active > .avatar{
            flex-basis: 30%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .avatar > img{
            width: 100%;
            border: 0.5px solid black;
            border-radius:50%;
            -moz-border-radius:50%;
            -webkit-border-radius:50%;
            -ms-border-radius: 50%;
            -o-border-radius: 50%;
        }
        .avatar-info.active .info{
            flex-basis: 70%;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            align-items: flex-start;
            margin-left: 10px;
        }
        .info .col{
            font-size: 15px;
        }
        .content .border-2{
            width: 100%;
            height: 2.5%;
            display: flex;
            align-items: center;
        }
        .border-2 > hr{
            width: 100%;
            color: black;
        }
        .content .action{
            display: none;
        }
        .content .action.active{
            width: 100%;
            height: 15%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .action.active > .btn{
            flex: 1;
            height: 100%;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }
        .action.active .btn input{
            margin-right: 10px;
            margin-left: 10px;
            font-size: 13px;
            padding: 5px 12px;
            border-radius: 20%;
            font-weight: bold;
            color: white;
        }
        .action.active .btn #back-btn{
            background-color: red;
        }
        .action.active .btn #save-btn{
            background-color: blue;
        }
        .action.active .btn #back-btn:hover,
        .action.active .btn #save-btn:hover{
            background-color: gray;
            cursor: pointer;
        }

        .active > div{
            flex: 1;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .action.active div > a{
            text-align: center;
            text-decoration: none;
            color: blue;
            font-size: 20px;
        }
        .action.active > div:hover{
            background-color: #e4dfdf;
            font-weight: bold;
        }

    </style>

    <?php
    $teacher = new Apps_Model_Teacher();
    $result = $teacher->buildparam([
                "where" => "id = ?",
                "values" => [$page->getSESSION("username")]
            ])->selectone();
    ?>
    <body>
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="content">
                <div class="text">
                    <p>Teacher Information</p>
                </div>
                <div class="border-1">
                    <hr>
                </div>
                <div id="start1" class="avatar-info active">
                    <div class="avatar">
                        <?php
                        if ($result["avatar"] === "Trống") {
                            ?>
                            <img id="img-up" src="../../Media/image/Defaultimage.jpg" alt="Image Errorr"/>
                            <?php
                        } else {
                            ?>
                            <img id="img-up" src="<?php echo $result["avatar"] ?>" alt="Image Errorr"/>
                            <?php
                        }
                        ?>
                        <!-- comment
                            js giúp biến ảnh thành hình vuông
                        -->
            <!--            <script>
                        var height = document.getElementById("img-up").width;
                        document.getElementById("img-up").height = height;
                        </script>-->
                    </div>
                    <div class="info">
                        <p class="col">ID<strong>: <?php echo $result["id"]; ?></strong></p>
                        <p class="col">Name<strong>: <?php echo $result["name"]; ?></strong></p>
                        <p class="col">Birth Day<strong>: <?php echo $result["birthday"]; ?></strong></p>
                        <p class="col">Gender<strong>: <?php echo $result["gender"]; ?></strong></p>
                        <p class="col">Salary<strong>: <?php echo $result["salary"]; ?> $</strong></p>
                        <p class="col">Home Town<strong>: <?php echo $result["hometown"]; ?></strong></p>
                    </div>    
                </div>

                <div id="start2" class="avatar-info">
                    <div class="info2">
                        <div class="row">
                            <p class="col1">Avatar</p><p class="col2"><input type="file" name="avatar"></p>
                        </div>
                        <div class="row">
                            <p class="col1">ID</p><p class="col2"><input type="text" name="id" value="<?php echo $result["id"]; ?>" readonly="readonly"></p>
                        </div>
                        <div class="row">
                            <p class="col1">Name</p><p class="col2"><input  type="text" name="name" value="<?php echo $result["name"]; ?>"></p>
                        </div>
                        <div class="row">
                            <p class="col1">Birth Day</p><p class="col2"><input type="date" name="birth" value="<?php echo $result["birthday"]; ?>"></p>
                        </div>
                        <div class="row">
                            <p class="col1">Gender</p><p class="col2 radio">
                                <input type="radio" value="Nam" name="genders">Nam
                                <input type="radio" value="Nữ" name="genders">Nữ
                                <input type="radio" value="Khác" name="genders">Khác
                            </p>
                        </div>
                        <div class="row">
                            <p class="col1">Salary</p><p class="col2"><input type="number" name="salary" value="<?php echo $result["salary"]; ?>"></p>
                        </div>
                        <div class="row">
                            <p class="col1">Home Town</p><p class="col2"><input type="text" name="hometown" value="<?php echo $result["hometown"]; ?>"></p>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="border-2">
                    <hr>
                </div>
                <div id="end1" class="action active">
                    <div>
                        <a href="#" onclick="Edit('<?php echo $result["gender"]; ?>');">Edit Information</a>
                    </div>
                </div>
                <div id="end2" class="action">
                    <div class="btn">
                        <input id="back-btn" type="button" value="Back" onclick="Back()">
                        <input id="save-btn" type="submit" name="save" value="Save">
                    </div>
                </div>
            </div>
        </form>
    </body>
    <?php
    if ($page->getPOST("save")) {
        $imageupdate;

        $linking = $teacher->buildparam([
                    "select" => "avatar",
                    "where" => "id = ?",
                    "values" => [$page->getPOST("id")]
                ])->selectone();

        if (isset($_FILES["avatar"]) && !isset($_FILES["avatar"]["errors"])) {
            move_uploaded_file($_FILES["avatar"]["tmp_name"], "../../Public/StoreImage/" . $_FILES["avatar"]["name"]);
        }

        $imageupdate = "../../Public/StoreImage/" . $_FILES["avatar"]["name"];
        $imageupdate === "../../Public/StoreImage/" ? $imageupdate = "Trống" : $imageupdate;

        if ($linking["avatar"] !== "Trống" && $imageupdate !== "Trống") {
            unlink($linking["avatar"]);
        }

        if ($imageupdate === "Trống") {
            $imageupdate = $linking["avatar"];
        }

        try {
            $result = $teacher->buildparam(
                            [
                                "field" => "name=?,birthday=?,gender=?,salary=?,hometown=?,avatar=?",
                                "where" => "id=?",
                                "values" => [
                                    $page->getPOST("name"),
                                    $page->getPOST("birth"),
                                    $page->getPOST("genders"),
                                    $page->getPOST("salary"),
                                    $page->getPOST("hometown"),
                                    $imageupdate,
                                    $page->getPOST("id")
                                ]
                            ]
                    )->update();
            echo '<script language="javascript">';
            echo "location.replace('http://localhost/StudentManage/Teacher/PageItems/Info.php');";
            echo '</script>';
        } catch (Exception $ex) {
            echo '<script language="javascript">';
            echo "alert('Update Failed')";
            echo '</script>';
        }
    }
    ?>
</html>
<script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
<script type="text/javascript">
                    function Edit(radio) {
                        document.getElementById("start1").classList.remove("active");
                        document.getElementById("start2").classList.add("active");
                        document.getElementById("end1").classList.remove("active");
                        document.getElementById("end2").classList.add("active");

                        var check = document.getElementsByName("genders");
                        for (var i = 0; i < check.length; i++) {
                            if (check[i].value === radio) {
                                check[i].checked = true;
                            }
                        }
                    }
                    function Back() {
                        document.getElementById("start1").classList.add("active");
                        document.getElementById("start2").classList.remove("active");
                        document.getElementById("end1").classList.add("active");
                        document.getElementById("end2").classList.remove("active");
                    }
</script>