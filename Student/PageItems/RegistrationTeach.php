<!dDOCTYPE html>
<?php
include '../../Apps/config.php';
$page = new Apps_Libs_UserIdentity();
$courseval = "";
$subjectsval = "";
$status = "";
$insertsuccess = "";
?>


<!-- Đang ở dòng 265 -->
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
            width: 100%;
            height: 295px;
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
        .content > .border-1{
            width: 100%;
            height: 2.5%;
            display: flex;
            align-items: center;    
        }
        .border-1 > hr{
            width: 100%;
            color: black;
        }
        .content .Regis{
            width: 100%;
            height: calc(100% - 17.5%);
            display: flex;
            justify-content: space-between;
        }
        .Regis .items-regis{
            height: 100%;
            flex-basis: 40%;
        }
        .items-regis .text-2{
            width: 100%;
            height: 15%;
            display: flex;
            align-items: center;
        }
        .text-2 > p{
            font-weight: bold;
            font-size: 15px;
        }
        .items-regis > .border-2{
            width: 100%;
            height: 2.5%;
            display: flex;
            align-items: center;    
        }
        .border-2 > hr{
            width: 100%;
            color: black;
        }
        .items-regis .content-regis{
            width: 100%;
            height: calc(100% - 17.5%);
            display: flex;
            flex-direction: column;
        }
        .content-regis .items-content-regis{
            width: 100%;
            flex-basis: 20%;
            display: flex;
            justify-content: space-around;
            align-items: center;
        }
        .content-regis .items-btn{
            flex-basis: 20%;
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .items-btn > input{
            cursor: pointer;
            padding: 5px;
            width: 150px;
            border-style: none;
            font-size: 13px;
            background-color: #5fb4ff;
            color: white;
            font-weight: bold;;
        }
        .items-btn > input:hover{
            color: black;
        }

        .content-regis .items-status{
            margin-top: 20px;
            width: 100%;
            flex-basis: 20%;
            text-align: center;
            font-size: 12px;
            font-weight: bold;
        }
        .items-status .items-status-text.errorr{
            color: red;
        }
        .items-status .items-status-text.success{
            color: green;
        }
        .items-content-regis .text-select{
            height: 100%;
            flex-basis: 50%;
            text-align: left;
            display: flex;
            align-items: center;
        }
        .text-select > p{
            font-size: 12px;
            font-weight: bold;
        }
        .items-content-regis .option-select{
            height: 100%;
            flex-basis: 50%;
            display: flex;
            align-items: center;
        }
        .option-select select{
            width: 100%;
            font-size: 13px;
            padding: 2px;
            font-weight: bold;
            background-color: black;
            color: white;
            border-style: none;
            cursor: pointer;
        }
        .Regis .items-schedule{
            height: 100%;
            flex-basis: 59%;
        }
        .items-schedule .text-3{
            width: 100%;
            height: 15%;
            display: flex;
            align-items: center;
        }
        .text-3 > p{
            font-weight: bold;
            font-size: 15px;
        }
        .items-schedule > .border-3{
            width: 100%;
            height: 2.5%;
            display: flex;
            align-items: center;    
        }
        .border-3 > hr{
            width: 100%;
            color: black;
        }
        .items-schedule .content-schedule{
            width: 100%;
            height: calc(100% - 17.5%);
        }
        .content-schedule .schedule{
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background-color: black;
        }
        .schedule > .title-schedule{
            flex-basis: 15%;
            display: flex;
            justify-content: space-around;
            align-items: center;
            font-size: 10px;
            font-weight: bold;
            background-color: white;
        }
        .title-schedule .title-items.time{
            text-align: center;
            flex-basis: 20%;
        }
        .title-schedule .title-items{
            text-align: center;
            flex-basis: 10%;
        }

        .schedule .items-schedule{
            flex-basis: 25%;
            display: flex;
            justify-content: space-around;
            align-items: center;
            font-size: 15px;
            font-weight: bold;
            background-color: white;
        }
        .items-schedule .schedule-items.time{
            text-align: left;
            flex-basis: 20%;
        }
        .items-schedule .schedule-items{
            text-align: center;
            justify-content: center;
            line-height: 50.19px;
            flex-basis: 10%;
        }
        .items-schedule .schedule-items:hover{
            background-color: #c8c8c8;
        }
        .items-schedule .schedule-items.time:hover{
            background-color: white;
        }
        .items-schedule.items1 .schedule-items.time{
            color: green;
            font-weight: bold;
        }
        .items-schedule.items2 .schedule-items.time{
            color: orange;
            font-weight: bold;
        }
        .items-schedule.items3 .schedule-items.time{
            color: gray;
            font-weight: bold;
        }
    </style>
    <body>
        <div class="content">
            <div class="text">
                <p>Registration your subjects want to study</p>
            </div>
            <div class="border-1">
                <hr>
            </div>
            <div class="Regis">
                <div class="items-regis">
                    <div class="text-2">
                        <p>Registration study</p>
                    </div>
                    <div class="border-2">
                        <hr>
                    </div>
                    <?php
                    $courseval = $page->getPOST("course");
                    $subjectsval = $page->getPOST("subjects");
                    if ($page->getPOST("add")) {
                        if ($courseval === "" || $subjectsval === "") {
                            switch ("") {
                                case $courseval:
                                    $status = "Please choose a course";
                                    break;
                                case $subjectsval:
                                    $status = "Please choose a subjects";
                                    break;
                            }
                        } else {
                            $courseInfo = new Apps_Model_CourseInfo();
                            try {
                                $check = $courseInfo->buildparam([
                                    "where"=>"idcourse = ? and idsubjects = ?",
                                    "values"=>[$courseval,$subjectsval]
                                ])->selectone();
                                if($check){
                                    $roomdb = $check["idclassroom"];
                                    $teacherdb = $check["idteacher"];
          
                                    $res = $courseInfo->buildparam([
                                            "field" => "(`idcourse`, `idclassroom`, `idsubjects`, `idteacher` , `idstudent`) ".
                                            "values (?,?,?,?,?)",
                                            "values" => [$courseval, $roomdb, $subjectsval, $teacherdb,$page->getSESSION("username")]
                                        ])->insert();
                                if ($res) {
                                    $insertsuccess = "registration is successful.";
                                } else {
                                    $insertsuccess = "";
                                }
                                } else {
                                    $status = "The subject is not available or no teacher is available";
                                }
                            } catch (Exception $exc) {
                                $status = $exc->getTraceAsString();
                            }
                        }
                    }
                    ?>
                    <form action="" method="post">
                        <div class="content-regis">

                            <div id="items-regis1" class="items-content-regis">
                                <div class="text-select">
                                    <p>Select course want you study</p>
                                </div>
                                <div class="option-select">
                                    <select name="course" >
                                        <option class="selects" value="">--Select Cuourse--</option>
                                        <?php
                                        $course = new Apps_Model_Course();
                                        $courseResult = $course->buildparam([])->select();
                                        foreach ($courseResult as $val) {
                                            ?>
                                            <option class="selects" value="<?php echo $val["id"]; ?>"><?php echo $val["name"] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div id="items-regis2" class="items-content-regis">
                                <div class="text-select">
                                    <p>Select Subjects want you study</p>
                                </div>
                                <div class="option-select">
                                    <select name="subjects" >
                                        <option class="selects" value="">--Select Subjects--</option>
                                        <?php
                                        $subjects = new Apps_Model_Subject();
                                        $subjectsResult = $subjects->buildparam([
                                                    "select" => "id,name"
                                                ])->select();
                                        foreach ($subjectsResult as $val) {
                                            ?>
                                            <option class="selects" value="<?php echo $val["id"]; ?>"><?php echo $val["name"] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="items-btn">
                                <input type="submit" name="add" value="Register To Teach">
                            </div>
                            <div class="items-status">
                                <?php
                                if ($insertsuccess) {
                                    ?>
                                    <p class="items-status-text success"><?php echo $insertsuccess ?></p>
                                    <?php
                                } else {
                                    ?>
                                    <p class="items-status-text errorr"><?php echo $status ?></p>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="items-schedule">
                    <div class="text-3">
                        <p>Your class schedule</p>
                    </div>
                    <div class="border-3">
                        <hr>
                    </div>
                    <div class="content-schedule">
                        <?php

                        function getResult() {
                            $page = new Apps_Libs_UserIdentity();
                            $result = [];
                            $schedule = new Apps_Model_Schedule();
                            $courseInfo = new Apps_Model_CourseInfo();
                            $resultsub = $courseInfo->buildparam([
                                        "select" => "idsubjects",
                                        "where" => "idstudent = ?",
                                        "values" => [$page->getSESSION("username")]
                                    ])->select();
                            foreach ($resultsub as $val) {
                                $re = $schedule->buildparam([
                                            "where" => "idsubjects = ?",
                                            "values" => [$val["idsubjects"]]
                                        ])->select();
                                $result = array_merge($result, $re);
                            }
                            return $result;
                        }

                        function getSchedule($i, $d) {
                            $result = getResult();
                            foreach ($result as $values) {
                                if ($values["timeday"] === $d) {
                                    if ($values["day"] === $i) {
                                        echo 'Có';
                                    }
                                }
                            }
                        }
                        ?>
                        <div class="schedule">
                            <div class="title-schedule">
                                <p class="title-items time">Time</p>
                                <p class="title-items">Monday</p>
                                <p class="title-items">Tuesday</p>
                                <p class="title-items">Wednesday</p>
                                <p class="title-items">Thursday</p>
                                <p class="title-items">Friday</p>
                                <p class="title-items">Saturday</p>
                            </div>
                            <div class="items-schedule items1">
                                <p class="schedule-items time">Buổi sáng</p>
                                <div class="schedule-items"><?php
                                    getSchedule("Thứ 2", "Buổi sáng");
                                    ?></div>
                                <p class="schedule-items"><?php
                                    getSchedule("Thứ 3", "Buổi sáng");
                                    ?></p>
                                <p class="schedule-items"><?php
                                    getSchedule("Thứ 4", "Buổi sáng");
                                    ?></p>
                                <p class="schedule-items"><?php
                                    getSchedule("Thứ 5", "Buổi sáng");
                                    ?></p>
                                <p class="schedule-items"><?php
                                    getSchedule("Thứ 6", "Buổi sáng");
                                    ?></p>
                                <p class="schedule-items"><?php
                                    getSchedule("Thứ 7", "Buổi sáng");
                                    ?></p>
                            </div>
                            <div class="items-schedule items2">
                                <p class="schedule-items time">Buổi chiều</p>
                                <p class="schedule-items"><?php
                                    getSchedule("Thứ 2", "Buổi chiều");
                                    ?></p>
                                <p class="schedule-items"><?php
                                    getSchedule("Thứ 3", "Buổi chiều");
                                    ?></p>
                                <p class="schedule-items"><?php
                                    getSchedule("Thứ 4", "Buổi chiều");
                                    ?></p>
                                <p class="schedule-items"><?php
                                    getSchedule("Thứ 5", "Buổi chiều");
                                    ?></p>
                                <p class="schedule-items"><?php
                                    getSchedule("Thứ 6", "Buổi chiều");
                                    ?></p>
                                <p class="schedule-items"><?php
                                    getSchedule("Thứ 7", "Buổi chiều");
                                    ?></p>
                            </div>
                            <div class="items-schedule items3">
                                <p class="schedule-items time">Buổi tối</p>
                                <p class="schedule-items"><?php
                                    getSchedule("Thứ 2", "Buổi tối");
                                    ?></p>
                                <p class="schedule-items"><?php
                                    getSchedule("Thứ 3", "Buổi tối");
                                    ?></p>
                                <p class="schedule-items"><?php
                                    getSchedule("Thứ 4", "Buổi tối");
                                    ?></p>
                                <p class="schedule-items"><?php
                                    getSchedule("Thứ 5", "Buổi tối");
                                    ?></p>
                                <p class="schedule-items"><?php
                                    getSchedule("Thứ 6", "Buổi tối");
                                    ?></p>
                                <p class="schedule-items"><?php
                                    getSchedule("Thứ 7", "Buổi tối");
                                    ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

</script>
</html>