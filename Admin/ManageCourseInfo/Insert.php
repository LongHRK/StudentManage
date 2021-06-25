<?php
    include '../../Apps/config.php';
    $pages = new Apps_Libs_UserIdentity();
    $courseinfos = new Apps_Model_CourseInfo();
    $student = new Apps_Model_Student();
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
                        <td class="col-info">Course</td>
                        <td class="col-input">
                            <select name="typecourseinfos" class="txtinput">
                                <option value="" selected="selected">--Select Course--</option>
                                <?php
                            $courses = new Apps_Model_Course();
                            $listcourses = $courses->buildparam([
                            ])->select();
                        foreach ($listcourses as $val){
                        ?>
                        <option value="<?php echo $val["id"] ?>"><?php echo $val["name"] ?></option>
                        <?php
                        }
                        ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-info">ID Room</td>
                        <td class="col-input"><input type="text" name="idrooms" class="txtinput"></td>
                    </tr>
                    <tr>
                        <td class="col-info">ID Subject</td>
                        <td class="col-input"><input type="text" name="idsubjectss" class="txtinput"></td>
                    </tr>
                    <tr>
                        <td class="col-info">ID Teacher</td>
                        <td class="col-input"><input type="text" name="idteachers" class="txtinput"></td>
                    </tr>
                    <tr>
                        <td class="col-info">ID Student</td>
                        <td class="col-input"><input type="text" name="idstudents" class="txtinput"></td>
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
        $combo;
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $combo = $pages->getPOST("typecourseinfos");
        }
        
        if (!$pages->getPOST("idrooms") || !$combo || !$pages->getPOST("idsubjectss") || 
            !$pages->getPOST("idteachers") || !$pages->getPOST("idstudents")) {
            echo '<script language="javascript">';
            echo "alert('Please enter full information')";
            echo '</script>';
            return;
        }
        else {
            try {
                $courseinfos->buildparam([
                    "field" => "(`idcourse`, `idclassroom`, `idsubjects`, `idteacher`, `idstudent`) VALUES (?,?,?,?,?)",
                    "values" => [
                $combo,$pages->getPOST("idrooms"),$pages->getPOST("idsubjectss"),
                        $pages->getPOST("idteachers"),$pages->getPOST("idstudents")
            ]
            ])->insert();  
            }catch (Exception $ex) {
                $a = $ex->getMessage();
                echo '<script language="javascript">';
                echo "alert('$a')";
                echo '</script>';
            }                  
                echo '<script language="javascript">';
                echo "location.replace('http://localhost/StudentManage/Admin/ManageCourseInfo/Show.php');";
                echo '</script>';
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