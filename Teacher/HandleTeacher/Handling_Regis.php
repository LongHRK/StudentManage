<?php
include '../../Apps/config.php';
$page = new Apps_Libs_UserIdentity();
$courseval = "";
$subjectsval = "";
$classval = "";
$status = "";
$insertsuccess = "";
?>
<style>
    *{
        font-family: Arial, Helvetica, sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        overflow: hidden;
    }
    .content{
        height: 100vh;
        width: 100vw;
    }
    .content .items-regis{
        width: 100%;
        height: 100%;
    }
    .items-regis .text-2{
        width: 100%;
        height: 7%;
    }
    .text-2 > p{
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        font-size: 25px;
        margin-left: 10px;
    }
    .items-regis .border-2{
        width: 100%;
        height: 3%;
    }
    .border-2 > hr{
        width: 100%;
    }
    .items-regis .content-regis{
        height: 90%;
        width: 100%;
    }
    .content-regis .items-content-regis{
        margin-bottom: 15px;
    }
    .content-regis #items-regis1{
        height: 10%;
        width: 100%;
    }
    #items-regis1 .text-select{
        height: 50%;
        width: 100%;
    }
    .text-select > p{
        margin-left: 10px;
        height: 100%;
        width: 100%;
        font-size: 20px;
        font-weight: bold;
        display: flex;
        align-items: center;
    }
    #items-regis1 .option-select{
        height: 50%;
        width: 100%;
        display: flex;
        align-items: center;
    }
    .option-select > select{
        margin-left: 5px;
        width: calc(100% - 10px);
        font-size: 20px;
        padding: 3px;
        background-color: #808080;
        color: white;
        border-style: none;
        cursor: pointer;
    }
    .content-regis #items-regis2{
        height: 10%;
        width: 100%;
    }
    #items-regis2 .text-select{
        height: 50%;
        width: 100%;
    }
    .text-select > p{
        margin-left: 10px;
        height: 100%;
        width: 100%;
        font-size: 20px;
        font-weight: bold;
        display: flex;
        align-items: center;
    }
    #items-regis2 .option-select{
        height: 50%;
        width: 100%;
        display: flex;
        align-items: center;
    }
    .option-select > select{
        margin-left: 5px;
        width: calc(100% - 10px);
        font-size: 20px;
        padding: 3px;
        background-color: #808080;
        color: white;
        border-style: none;
        cursor: pointer;
    }
    .content-regis #items-regis3{
        height: 10%;
        width: 100%;
    }
    #items-regis3 .text-select{
        height: 50%;
        width: 100%;
    }
    .text-select > p{
        margin-left: 10px;
        height: 100%;
        width: 100%;
        font-size: 20px;
        font-weight: bold;
        display: flex;
        align-items: center;
    }
    #items-regis3 .option-select{
        height: 50%;
        width: 100%;
        display: flex;
        align-items: center;
    }
    .option-select > select{
        margin-left: 5px;
        width: calc(100% - 10px);
        font-size: 20px;
        padding: 3px;
        background-color: #808080;
        color: white;
        border-style: none;
        cursor: pointer;
    }
    .content-regis .items-btn{
        height: 10%;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        margin-bottom: 15px;
    }
    .items-btn > input{
        font-size: 20px;
        padding: 5px 15px;
        margin-right: 5px;
        background-color: #808080;
        color: white;
        font-weight: bold;
    }
    .items-btn > input:hover{
        opacity: 0.7;
        cursor: pointer;
    }
    .option-select select:hover{
        opacity: 0.7;
        cursor: pointer;
    }
    .content-regis .items-status{
        height: 10%;
        width: 100%;
    }
    .items-status .items-status-text{
        width: 100%;
        height: 100%;
        font-size: 20px;
        font-weight: bold;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .items-status-text.errorr{
        color: red;
    }
    .items-status-text.success{
        color: green;
    }
</style>
<body>
    <div class="content">
        <div class="items-regis">
            <div class="text-2">
                <p>Registration teach</p>
            </div>
            <div class="border-2">
                <hr>
            </div>
            <?php
            $courseval = $page->getPOST("course");
            $subjectsval = $page->getPOST("subjects");
            $classval = $page->getPOST("classroom");
            if ($page->getPOST("add")) {
                if ($courseval === "" || $classval === "" || $subjectsval === "") {
                    switch ("") {
                        case $courseval:
                            $status = "Please choose a course";
                            break;
                        case $subjectsval:
                            $status = "Please choose a subjects";
                            break;
                        case $classval:
                            $status = "Please choose a class room";
                            break;
                    }
                } else {
                    $courseInfo = new Apps_Model_CourseInfo();
                    try {
                        $res = $courseInfo->buildparam([
                                    "field" => "(`idcourse`, `idclassroom`, `idsubjects`, `idteacher`) "
                                    . "values (?,?,?,?)",
                                    "values" => [$courseval, $classval, $subjectsval, $page->getSESSION("username")]
                                ])->insert();
                        if ($res) {
                            $insertsuccess = "registration is successful. Wait for admin to schedule a lesson";
                        } else {
                            $insertsuccess = "";
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
                            <p>Select course want you teach</p>
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
                            <p>Select Subjects want you teach</p>
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

                    <div id="items-regis3" class="items-content-regis">
                        <div class="text-select">
                            <p>Select Class Room want you teach</p>
                        </div>

                        <div class="option-select">
                            <select name="classroom" >
                                <option class="selects" value="">--Select Class Room--</option>
                                <?php
                                $room = new Apps_Model_ClassRoom();
                                $roomResult = $room->buildparam([
                                            "select" => "id,name"
                                        ])->select();
                                foreach ($roomResult as $val) {
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
                            <div class="items-status-text success"><?php echo $insertsuccess ?></div>
                            <?php
                        } else {
                            ?>
                            <div class="items-status-text errorr"><?php echo $status ?></div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>