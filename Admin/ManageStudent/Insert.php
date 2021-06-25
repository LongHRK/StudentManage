<?php
    include '../../Apps/config.php';
    $pages = new Apps_Libs_UserIdentity();
    $student = new Apps_Model_Student();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <style>
        .content-insert-div{
            position: relative;
            width: 100%;
            height: 100%;
        }
        .content-insert{
            position: absolute;
            text-align: left;
            max-width:50%;
            max-height:100%;
            font-size: 25px;
        }
        .content-insert .col-info{
            width: 30%;
            height:100%;
        }
        .content-insert .col-input{
            width:70%;
            height:100%;
        }
        .col-input .txtinput{
            font-size: 25px;
            height: 35px;
            width: 100%;
        }
        #col-handle-insert #btn-add-insert{
            font-size: 25px;
            height: 35px;
            background-color: green;
            margin-right: 20px;
            margin-left: calc(100% - 230px);
        }
        #img-insert{
            max-height: 35px;
            border-radius:50%;
            -moz-border-radius:50%;
            -webkit-border-radius:50%;
            -ms-border-radius: 50%;
            -o-border-radius: 50%;
        }
        #col-handle-insert #btn-cancel-insert{
            font-size: 25px;
            height: 35px;
            background-color: red;
            margin-left: 20px;
            width: 100px;
        }
    </style>
    <body>
        <div id="content-insert-div">
            <form action="#" method="post" enctype="multipart/form-data">
                <table class="content-insert">
                    <tr>
                        <td class="col-info">Student ID</td>
                        <td class="col-input"><input type="text" name="idstu" class="txtinput"></td>
                    </tr>
                    <tr>
                        <td class="col-info">Full Name</td>
                        <td class="col-input"><input type="text" name="namestu" class="txtinput"></td>
                    </tr>
                    <tr>
                        <td class="col-info">Birth Day</td>
                        <td class="col-input"><input type="date" name="birthstu" class="txtinput"></td>
                    </tr>
                    <tr>
                        <td class="col-info">Gender</td>
                        <td class="col-input">
                            <input type="radio" name="genderstu" value="Nam" checked="checked" id="">Nam&nbsp;
                            <input type="radio" name="genderstu" value="Nữ" id="">Nữ&nbsp;    
                            <input type="radio" name="genderstu" value="Khác" id="">Khác
                        </td>
                    </tr>
                    <tr>
                        <td class="col-info">Home Town</td>
                        <td class="col-input"><input type="text" name="townstu" class="txtinput"></td>
                    </tr>
                    <tr>
                        <td class="col-info">Avatar</td>
                        <td class="col-input">
                            <input type="file" name="avatarstu" class="txtinput">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" id="col-handle-insert">
                            <input id="btn-add-insert" class="btn-handle" type="submit" name="addstu" value="Add">
                            <input id="btn-cancel-insert" class="btn-handle" type="button" name="cancelstu" value="Cancel">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
    
    <?php
    
    if ($pages->getPOST("addstu")) {
        $images;
        if(isset($_FILES["avatarstu"]) && !isset($_FILES["avatarstu"]["errors"])){
            move_uploaded_file($_FILES["avatarstu"]["tmp_name"], "../../Public/StoreImage/".$_FILES["avatarstu"]["name"]);
        }
        $images = "../../Public/StoreImage/".$_FILES["avatarstu"]["name"];
        
        $images === "../../Public/StoreImage/" ? $images = "Trống" : $images;
        
        if (!$pages->getPOST("idstu") || !$pages->getPOST("namestu") || !$pages->getPOST("townstu")) {
            if($images !== "Trống"){
                unlink($images);
            }
            echo '<script language="javascript">';
            echo "alert('Please enter full information')";
            echo '</script>';
        }
        else {
            try {
                $student->buildparam([
            "field" => "(id,name,birthday,gender,hometown,avatar) VALUES (?,?,?,?,?,?)",
            "values" => [
                $pages->getPOST("idstu"),
                $pages->getPOST("namestu"),
                $pages->getPOST("birthstu"),
                $pages->getPOST("genderstu"),
                $pages->getPOST("townstu"),
                $images
            ]
            ])->insert();
            
            echo '<script language="javascript">';
            echo "location.replace('http://localhost/StudentManage/Admin/ManageStudent/Show.php');";
            echo '</script>';
            } catch (Exception $ex) {
                $a = $ex->getMessage();
                echo '<script language="javascript">';
                echo "alert('$a')";
                echo '</script>';
            }
        }
    }
    ?>
    
    <script>
        document.getElementById("btn-cancel-insert").onclick = function () {
            document.getElementById("container-insert").classList.remove("active");
            document.getElementById("container-table").classList.add("active");
        };
        document.getElementById("btn-add-insert").onclick = function (){
            document.getElementById("container-insert").classList.remove("active");
            document.getElementById("container-table").classList.add("active");
        };
    </script>
</html>