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
        .items-schedule .content-Statistical{
            width: 100%;
            height: calc(100% - 17.5%);
        }
        .content-Statistical .title-statistical{
            width: 100%;
            height: 15%;
            display: flex;
            align-items: center;
            justify-content: space-around;
        }
        .title-statistical .title-text{
            width: 60px;
            font-weight: bold;
            color: #F09C42;
            text-align: center;
        }
        .content-Statistical .body-statistical{
            width: 100%;
            height: 85%;
            display: flex;
            justify-content: space-around;
            align-items: flex-end;
        }
        .body-statistical .content-chart{
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
                        <p>Statistical Your Mark</p>
                    </div>
                    <div class="border-3">
                        <hr>
                    </div>
                    <?php
                        $mark = new Apps_Model_Mark();
                        $totalmark = count($mark->buildparam([
                            "where"=>"idstudent= '".$page->getSESSION("username")."'"
                        ])->select());
                        
                        $markbad = count($mark->buildparam([
                            "where"=>"idstudent= '".$page->getSESSION("username")."' and markbynumber < 5"
                        ])->select());
                        
                        $markmedium = count($mark->buildparam([
                            "where"=>"idstudent= '".$page->getSESSION("username")."' and markbynumber >= 5 and markbynumber <= 7"
                        ])->select());
                        
                        $markgood = count($mark->buildparam([
                            "where"=>"idstudent= '".$page->getSESSION("username")."' and markbynumber >= 7 and markbynumber <= 9"
                        ])->select());
                        
                        $markverrygood = count($mark->buildparam([
                            "where"=>"idstudent= '".$page->getSESSION("username")."' and markbynumber > 9"
                        ])->select());

                        function getPersent($totalmarks,$markingredient){
                            $persent = $markingredient / $totalmarks * 100;
                            return $persent;
                        }
                    ?>
                    <div class="content-Statistical">
                        <div class="title-statistical">
                            <div class="title-text"><- 5</div>
                            <div class="title-text">5 - 7</div>
                            <div class="title-text">7 - 9</div>
                            <div class="title-text">9 -></div>
                        </div>
                        <div class="body-statistical">
                            <div class="content-chart" style="--persent: <?php echo getPersent($totalmark, $markbad) ?>%"><?php echo getPersent($totalmark, $markbad) ?>%</div>
                            <div class="content-chart" style="--persent: <?php echo getPersent($totalmark, $markmedium) ?>%"><?php echo getPersent($totalmark, $markmedium) ?>%</div>
                            <div class="content-chart" style="--persent: <?php echo getPersent($totalmark, $markgood) ?>%"><?php echo getPersent($totalmark, $markgood) ?>%</div>
                            <div class="content-chart" style="--persent: <?php echo getPersent($totalmark, $markverrygood) ?>%"><?php echo getPersent($totalmark, $markverrygood) ?>%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

</script>
</html>