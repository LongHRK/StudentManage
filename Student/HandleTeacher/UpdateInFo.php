<?php
    include '../../Apps/config.php';
    $page = new Apps_Libs_UserIdentity();
    
    $student = new Apps_Model_Student();
    $result = $student->buildparam([
        "where"=>"id = ?",
        "values"=>[$page->getSESSION("username")]
    ])->selectone();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Information</title>
</head>

<style>
        *{
            font-family: Arial, Helvetica, sans-serif;
            margin: 0 auto;
            padding: 0;
            box-sizing: border-box;
            background-color: #e7ecf0;
            overflow: hidden;
        }
        body{
            width: 100vw;
            height: 100vh;
        }
        body .content{
            margin-top: calc((100vh - 670px) / 2);
            width: 60%;
            height: 670px;
            background-color: white;
        }
        .content .content__title{
            width: 100%;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            font-weight: bold;
            background-color: white;
        }
        .content .content__border{
            width: 100%;
            height: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: white;
        }
        .content__border> hr{
            width: 100%;
            font-weight: bold;
        }
        .content .content__content{
            width: 100%;
            height: 450px;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            background-color: white;
        }
        .content__content .row{
            width: 100%;
            flex-direction: 13%;
            display: flex;
            justify-items: justify;
            align-items: center;
            background-color: white;
        }
        .row .col1{
            flex-basis: 30%;
            font-size: 25px;
            font-weight: bold;
            background-color: white;
        }
        .row .col2{
            flex-basis: 60%;
            background-color: white;
        }
        .col2 input{
            padding: 5px;
            font-size: 20px;
            width: 100%;
            background-color: white;
        }
        #radio > .col2{
            display: inline-block;
            background-color: white;
        }
        #radio > .col2 input{
            width: 20px;
            cursor: pointer;
            background-color: white;
        }
        .content .content__btn{
            margin-top: 20px;
            width: 100%;
            height: 90px;
            position: relative;
            background-color: white;
        }
        .content__btn input{
            font-size: 25px;
            padding: 10px 20px;
            position:absolute;
            border-style: none;
            background-color: white;
        }
        .content__btn #back{
            right: 180px;
            border-radius: 20%;
            background-color: red;
            color: white;
        }
        .content__btn #edit{
            right: 20px;
            border-radius: 20%;
            background-color:blue;
            color: white;
        }
        .content__btn input:hover{
            color: black;
            opacity: 0.7;
            cursor:pointer;
        }
</style>

<body>
    <form action="#" method="post" enctype="multipart/form-data">
    <div class="content">
        <div class="content__title">
            Update Personal Information
        </div>
        <div class="content__border">
            <hr>
        </div>
        <div class="content__content">
            <div class="row">
                <div class="col1">Avatar</div>
                <div class="col2"><input type="file" name="avatar" id=""></div>
            </div>
            <div class="row">
                <div class="col1">ID</div>
                <div class="col2"><input type="text" name="id" value="<?php echo $result["id"] ?>" readonly="readonly" id=""></div>
            </div>
            <div class="row">
                <div class="col1">Name</div>
                <div class="col2"><input type="text" name="name" value="<?php echo $result["name"] ?>" id=""></div>
            </div>
            <div class="row">
                <div class="col1">Birth Day</div>
                <div class="col2"><input type="date" name="birth" value="<?php echo $result["birthday"] ?>" id=""></div>
            </div>
            <div id="radio" class="row">
                <div class="col1">Gender</div>
                <div class="col2">
                    <input type="radio" name="gender" value="Nam" id="radio1">Nam&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="gender" value="Nữ" id="radio2">Nữ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="gender" value="Khác" id="radio3">Khác
                </div>
            </div>
            <div class="row">
                <div class="col1">Home Town</div>
                <div class="col2"><input type="text" name="town" value="<?php echo $result["hometown"] ?>" id=""></div>
            </div>
        </div>
        <div class="content__border">
            <hr>
        </div>
        <div class="content__btn">
            <input id="back" type="button" value="Back" name="back" onclick="Back()">
            <input id="edit" type="submit" value="Update" name="update">
        </div>
    </div>
    </form>
    <?php
    if ($page->getPOST("update")) {
        $imageupdate;

        $linking = $student->buildparam([
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
            $result = $student->buildparam(
                            [
                                "field" => "name=?,birthday=?,gender=?,hometown=?,avatar=?",
                                "where" => "id=?",
                                "values" => [
                                    $page->getPOST("name"),
                                    $page->getPOST("birth"),
                                    $page->getPOST("gender"),
                                    $page->getPOST("town"),
                                    $imageupdate,
                                    $page->getPOST("id")
                                ]
                            ]
                    )->update();
            echo '<script language="javascript">';
            echo "location.replace('https://localhost/StudentManage/Student/');";
            echo '</script>';
        } catch (Exception $ex) {
            echo '<script language="javascript">';
            echo "alert('Update Failed')";
            echo '</script>';
        }
    }
    ?>
    <script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
    <script type="text/javascript">
    // gắn radiob
                        var radio = '<?php echo $result["gender"] ?>';
                        var check = document.getElementsByName("gender");
                        for (var i = 0; i < check.length; i++) {
                            if (check[i].value === radio) {
                                check[i].checked = true;
                            }
                        }
                    function Back() {
                        location.replace("https://localhost/StudentManage/Student/Home.php");
                    }
</script>
</body>

</html>