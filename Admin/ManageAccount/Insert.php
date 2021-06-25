<?php
    include '../../Apps/config.php';
    $pages = new Apps_Libs_UserIdentity();
    $accounts = new Apps_Model_Account();
    $student = new Apps_Model_Student();
    $teacher = new Apps_Model_Teacher();
    $admin = new Apps_Model_Admin();
    $result = null;
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
            <form action="#" method="post">
                <table class="content-insert">
                    <tr>
                        <td class="col-info">Type Account</td>
                        <td class="col-input">
                            <select name="typeacc" class="txtinput">
                                <option value="" selected="selected">--Select Type--</option>
                                <option value="student">Student</option>
                                <option value="teacher">Teacher</option>
                                <option value="admin">Admin</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-info">Username</td>
                        <td class="col-input"><input type="text" name="usernameacc" class="txtinput"></td>
                    </tr>
                    <tr>
                        <td class="col-info">Password</td>
                        <td class="col-input"><input type="password" name="passwordacc" class="txtinput"></td>
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
        $type;
        $status = "";
        $combo;
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $combo = $pages->getPOST("typeacc");
            switch ($combo){
                case "student":
                    $type = 3;
                    $result = $student->buildparam([
                        "select"=>"id"
                    ])->select();
                    break;
                case "teacher":
                    $type = 2;
                    $result = $teacher->buildparam([
                        "select"=>"id"
                    ])->select();
                    break;
                case "admin":
                    $type = 1;
                    $result = $admin->buildparam([
                        "select"=>"id"
                    ])->select();
                    break;
                default :
                    $type = null;
                    $result = null;
                    break;
            }
        }
        
        
    if (!$pages->getPOST("usernameacc") || !$combo || !$pages->getPOST("passwordacc")) {
            echo '<script language="javascript">';
            echo "alert('Please enter full information')";
            echo '</script>';
            return;
        }
        else {
            if($result){
                foreach ($result as $va){
                    if($va["id"] === $pages->getPOST("usernameacc")){
                        $status = "ok";
                    }
                }
            }
            
            if($status === "ok"){
                $result = $accounts->buildparam([
                    "select"=>"username",
                    "where"=>"username = ?",
                    "values"=>[$pages->getPOST("usernameacc")]
                ])->selectone();
                if(!$result){
                        $accounts->buildparam([
                    "field" => "(username,password,type) VALUES (?,?,?)",
                    "values" => [
                $pages->getPOST("usernameacc"),
                md5($pages->getPOST("passwordacc")),
                $type
            ]
            ])->insert();                    
                echo '<script language="javascript">';
                echo "location.replace('http://localhost/StudentManage/Admin/ManageAccount/Show.php');";
                echo '</script>';
                }
                else {
                    echo '<script language="javascript">';
                    echo "alert('This account already exists')";
                    echo '</script>';
                    return; 
                }
            } else {
                echo '<script language="javascript">';
                echo "alert('user not on the list')";
                echo '</script>';
                return;
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