<?php
include '../../Apps/config.php';
$page = new Apps_Libs_UserIdentity();
if ($page->isLogin() === false) {
    header("location:http://localhost/StudentManage/Login/");
    die();
}
    $student = new Apps_Model_Student();
    $teacher = new Apps_Model_Teacher();
    $subjects = new Apps_Model_Subject();
    $course = new Apps_Model_Course();
    $room = new Apps_Model_ClassRoom();
    $account = new Apps_Model_Account();
    
    $result = null;
    $total = 0;
    $girl;
    $boy;
    $other;
    $persent;
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
            margin: 0 auto;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
            box-sizing: border-box;
        }
        .content{
            width: 100%;
            height: 100vh;
        }
        .content .Statistical{
            height: 40%;
            width: 100%;
            display: flex;
        }
        .Statistical .items.table-Statistical{
            flex: 1;
            height: 100%;
        }
        .items.table-Statistical .header-text{
            height: 15%;
            width: 100%;
            display: flex;
            align-items: center;
        }
        .header-text > h2{
            text-align: left;
            margin-left: 5px;
        }
        .items.table-Statistical .border{
            height: 5%;
            width: 100%;
        }
        .border > hr{
            width: 100%;
        }
        .items.table-Statistical .body-content{
            height: 80%;
            width: 100%;
        }
        .body-content .statistical-table{
            height: 100%;
            width: calc(100% - 10px);
            margin-left: 5px;
            border: 1px solid black;
            font-size: 20px;
        }
        .statistical-table .tre{
            background-color:#FEEBD0;
        }
        .statistical-table .tro{
            background-color:#C9E4D6;
        }
        .statistical-table tr:hover{
            background-color: gray;
            color: white;
            opacity: 0.7;
            cursor: pointer;
        }
        .Statistical .items.gender-student-teacher{
            flex: 1;
            height: 100%;
            display: flex;
        }
        .items.gender-student-teacher .gender-student{
            flex: 1;
            height: 100%;
        }
        .gender-student .header-text-student{
            height: 15%;
            width: 100%;
            display: flex;
            align-items: center;
        }
        .header-text-student > h2{
            text-align: left;
            margin-left: 5px;
        }
        .gender-student .border-student{
            height: 5%;
            width: 100%;
        }
        .border-student > hr{
            width: 100%;
        }
        .gender-student .gender-student-all-text{
            height: 5%;
            width: 100%;
            display: flex;
            justify-content: space-around;
            align-items: center;
        }
        .Gender-student-all-text .gender-text{
            width: 60px;
        }
        .gender-student .gender-student-all{
            height: 75%;
            width: 100%;
            display: flex;
            justify-content: space-around;
            align-items: flex-end;
        }
        .gender-student-all .gender{
            width: 60px;
            height: var(--persent);
            background-color:#F09C42;
            text-align: center;
            color: white;
            border: 1px solid black;
            animation: growth ease-in 0.7s;
        }

        .items.gender-student-teacher .gender-teacher{
            flex: 1;
            height: 100%;
        }
        .gender-teacher .header-text-teacher{
            height: 15%;
            width: 100%;
            display: flex;
            align-items: center;
        }
        .header-text-teacher > h2{
            text-align: left;
            margin-left: 5px;
        }
        .gender-teacher .border-teacher{
            height: 5%;
            width: 100%;
        }
        .border-teacher > hr{
            width: 100%;
        }
        .gender-teacher .gender-teacher-all-text{
            height: 5%;
            width: 100%;
            display: flex;
            justify-content: space-around;
            align-items: center;
        }
        .Gender-teacher-all-text .gender-text{
            width: 60px;
        }
        .gender-teacher .gender-teacher-all{
            height: 75%;
            width: 100%;
            display: flex;
            justify-content: space-around;
            align-items: flex-end;
        }
        .gender-teacher-all .gender{
            width: 60px;
            height: var(--persent);
            background-color:#F09C42;
            text-align: center;
            color: white;
            border: 1px solid black;
            animation: growth ease-in 0.7s;
        }

        @keyframes growth {
            from {
                opacity: 0;
                height: calc(var(--persent) / 50%);
            }
            to {
                opacity: 1;
                height: var(--persent);
            }
        }
    </style>
    <body>
        <div class="content">
            <div class="Statistical">
                <div class="items table-Statistical">
                    <div class="header-text">
                        <h2>
                            General Statistics
                        </h2>
                    </div>
                    <div class="border">
                        <hr>
                    </div>
                    <div class="body-content">
                        <table class="statistical-table">
                            <tr class="tre">
                                <td class="col1">Total Students</td>
                                <td class="col2"><?php
                                    $total = count($result = $student->buildparam([])->select());
                                    echo $total;
                                ?></td>
                            </tr>
                            <tr class="tro">
                                <td class="col1">Total Teachers</td>
                                <td class="col2"><?php
                                    $total = count($result = $teacher->buildparam([])->select());
                                    echo $total;
                                ?></td>
                            </tr>
                            <tr class="tre">
                                <td class="col1">Total Subjects</td>
                                <td class="col2"><?php
                                    $total = count($result = $subjects->buildparam([])->select());
                                    echo $total;
                                ?></td>
                            </tr>
                            <tr class="tro">
                                <td class="col1">Total Courses</td>
                                <td class="col2"><?php
                                    $total = count($result = $course->buildparam([])->select());
                                    echo $total;
                                ?></td>
                            </tr>
                            <tr class="tre">
                                <td class="col1">Total Rooms</td>
                                <td class="col2"><?php
                                    $total = count($result = $student->buildparam([])->select());
                                    echo $total;
                                ?></td>
                            </tr>
                            <tr class="tro">
                                <td class="col1">Total Accounts</td>
                                <td class="col2"><?php
                                    $total = count($result = $account->buildparam([])->select());
                                    echo $total;
                                ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="items gender-student-teacher">
                    <div class="gender-student">
                        <div class="header-text-student">
                            <h2>
                                Gender Student
                            </h2>
                        </div>
                        <div class="border-student">
                            <hr>
                        </div>
                        <div class="gender-student-all-text">
                            <div class="gender-text">Nam</div>
                            <div class="gender-text">Nữ</div>
                            <div class="gender-text">Khác</div>
                        </div>
                        <div class="gender-student-all">
                            <div class="gender" style="--persent: <?php
                                    $total = count($result = $student->buildparam([])->select());
                                    $boy = count($result = $student->buildparam(["where"=>"gender = 'Nam'"])->select());
                                    $persent = $boy * 100 / $total;
                                    echo $persent."%";
                                ?>"><?php echo $persent."%"?></div>
                            <div class="gender" style="--persent: <?php
                                    $total = count($result = $student->buildparam([])->select());
                                    $girl = count($result = $student->buildparam(["where"=>"gender = 'Nữ'"])->select());
                                    $persent = $girl * 100 / $total;
                                    echo $persent."%";
                                ?>"><?php echo $persent."%" ?></div>
                            <div class="gender" style="--persent: <?php
                                    $total = count($result = $student->buildparam([])->select());
                                    $other = count($result = $student->buildparam(["where"=>"gender = 'Khác'"])->select());
                                    $persent = $other * 100 / $total;
                                    echo $persent."%";
                                ?>"><?php echo $persent."%" ?></div>
                        </div>
                    </div>
                    <div class="gender-teacher">
                        <div class="header-text-teacher">
                            <h2>
                                Gender Teacher
                            </h2>
                        </div>
                        <div class="border-teacher">
                            <hr>
                        </div>
                        <div class="gender-teacher-all-text">
                            <div class="gender-text">Nam</div>
                            <div class="gender-text">Nữ</div>
                            <div class="gender-text">Khác</div>
                        </div>
                        <div class="gender-teacher-all">
                            <div class="gender" style="--persent: <?php
                                    $total = count($result = $teacher->buildparam([])->select());
                                    $boy = count($result = $teacher->buildparam(["where"=>"gender = 'Nam'"])->select());
                                    $persent = $boy * 100 / $total;
                                    echo $persent."%";
                                ?>"><?php echo $persent."%" ?></div>
                            <div class="gender" style="--persent: <?php
                                    $total = count($result = $teacher->buildparam([])->select());
                                    $girl = count($result = $teacher->buildparam(["where"=>"gender = 'Nữ'"])->select());
                                    $persent = $girl * 100 / $total;
                                    echo $persent."%";
                                ?>"><?php echo $persent."%" ?></div>
                            <div class="gender" style="--persent: <?php
                                    $total = count($result = $teacher->buildparam([])->select());
                                    $other = count($result = $teacher->buildparam(["where"=>"gender = 'Khác'"])->select());
                                    $persent = $other * 100 / $total;
                                    echo $persent."%";
                                ?>"><?php echo $persent."%" ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>