<?php
include '../../Apps/config.php';
$page = new Apps_Libs_UserIdentity();

$selectResult = null;
$result = null;
$radioselect = "teacher";
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
    .content .header-text{
        width: 100%;
        height: 7%;
    }
    .header-text > p{
        width: 100%;
        height: 100%;
        display: flex;
        font-weight: bold;
        align-items: center;
        font-size: 25px;
        margin-left: 10px;
    }
    .content .border{
        width: 100%;
        height: 3%;
    }
    .border > hr{
        width: 100%;
    }
    .content .content-select-result{
        height: 90%;
        width: 100%;
    }
    .content-select-result .content-select{
        height: 15%;
        width: 100%;
    }
    .content-select .radiobtn{
        height: 30%;
        width: 100%;
        display: flex;
        justify-content: space-around;
        align-items: center;
    }
    .radiobtn .radiobtn-items{
        flex-basis: 15%;
        font-size: 20px;
        font-weight: bold;
        text-align: center;
    }
    .radiobtn .radiobtn-items input:hover{
        cursor: pointer;
    }
    .content-select .text-btn{
        height: 70%;
        width: 100%;
        display: flex;
    }
    .text-btn .text-search{
        flex: 1;
        height: 100%;
        display: flex;
        align-items: center;
    }
    .text-search > p{
        font-size: 20px;
        font-weight: bold;
        margin-left: 10px;
    }
    .text-btn .input-text-btn{
        flex: 3;
        height: 100%;
        display: flex;
        align-items: center;
    }
    .input-text-btn .input-text{
        height: 50%;
        width: 75%;
        font-size: 20px;
        border: 0.5px #146ba5 solid;
        padding: 5px 10px;
        border-bottom-right-radius: 5%;
        border-top-right-radius: 5%;
    }
    .input-text-btn .input-btn{
        height: 50%;
        width: 25%;
        margin-right: 5px;
        font-size: 20px;
        font-weight: bold;
        background-color: #808080;
        color: white;
        border-bottom-left-radius: 5%;
        border-top-left-radius: 5%;
    }
    .input-text-btn .input-btn:hover{
        opacity: 0.7;
        cursor: pointer;
    }
    .content-select-result .content-result{
        margin-top: 3%;
        height: 82%;
        width: 100%;
    }
    .content-result .result-errorr{
        width: 100%;
        height: 100%;
        color: red;
        text-align: center;
        font-size: 20px;
        font-weight: bold;
    }
    .content-result .result-success{
        margin: 0 5px;
        width: calc(100% - 10px);
        height: 100%;
    }
    .result-success .items-info{
        width: 100%;
        height: 10%;
        font-size: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .result-success .items-info:hover{
        opacity: 0.7;
        cursor: pointer;
    }
    .items-info .items-text{
        padding-left: 10px;
        flex-basis: 30%;
        height: 100%;
        background-color: #DDDDDD;
        border-bottom: 2px solid black;
        border-top: 2px solid black;
        display: flex;
        align-items: center;
    }
    .items-info .items-content{
        flex-basis: 70%;
        height: 100%;
        font-weight: bold;
        background-color: #DDDDDD;
        border-bottom: 2px solid black;
        border-top: 2px solid black;
        display: flex;
        align-items: center;
    }
    .items-info .items-content img{
        height: 90%;
    }
</style>

<body>
    <div class="content">
        <div class="header-text">
            <p>Check details information</p>
        </div>
        <div class="border">
            <hr>
        </div>

        <div class="content-select-result">
            <form action="" method="get">
                <div class="content-select">
                    <div class="radiobtn">
                        <div class="radiobtn-items"><input type="radio" value="teacher" checked="checked" name="selects">Teacher</div>
                        <div class="radiobtn-items"><input type="radio" value="student" name="selects">Student</div>
                        <div class="radiobtn-items"><input type="radio" value="subjects" name="selects">Subjects</div>
                        <div class="radiobtn-items"><input type="radio" value="classroom" name="selects">Room</div>
                        <div class="radiobtn-items"><input type="radio" value="course" name="selects">Course</div>
                    </div>
                    <div class="text-btn">
                        <div class="text-search">
                            <p>Enter ID Search</p>
                        </div>
                        <div class="input-text-btn">
                            <input class="input-text" type="text" placeholder="Enter here text" value="<?php echo $page->getGet("search") ?>" name="search">
                            <input class="input-btn" type="submit" name="btn" value="Search" onclick="DefaultRadio('<?php echo $page->getGet("selects") ?>')">
                        </div>
                    </div>
                </div>

                <div class="content-result">
                    <?php
                    if ($page->getGet("btn")) {
                        $radioselect = $page->getGet("selects");

                        switch ($radioselect) {
                            case "teacher":
                                $selectResult = new Apps_Model_Teacher();
                                break;
                            case "student":
                                $selectResult = new Apps_Model_Student();
                                break;
                            case "subjects":
                                $selectResult = new Apps_Model_Subject();
                                break;
                            case "course":
                                $selectResult = new Apps_Model_Course();
                                break;
                            case "classroom":
                                $selectResult = new Apps_Model_ClassRoom();
                                break;
                        }

                        if ($page->getGet("search")) {
                            switch ($radioselect) {
                                case "teacher":
                                    $result = $selectResult->buildparam([
                                                "where" => "id like '%" . $page->getGet("search") . "%'"
                                            ])->select();
                                    if ($result) {
                                        $counts = count($result);
                                        if ($counts == 1) {
                                            ?>
                                            <div class="result-success">
                                                <div class="items-info">
                                                    <div class="items-text">Id</div>
                                                    <div class="items-content"><?php echo $result[0]["id"]; ?></div>
                                                </div>
                                                <div class="items-info">
                                                    <div class="items-text">Name</div>
                                                    <div class="items-content"><?php echo $result[0]["name"] ?></div>
                                                </div>
                                                <div class="items-info">
                                                    <div class="items-text">Birth day</div>
                                                    <div class="items-content"><?php echo $result[0]["birthday"] ?></div>
                                                </div>
                                                <div class="items-info">
                                                    <div class="items-text">Gender</div>
                                                    <div class="items-content"><?php echo $result[0]["gender"] ?></div>
                                                </div>
                                                <div class="items-info">
                                                    <div class="items-text">Salary</div>
                                                    <div class="items-content"><?php echo $result[0]["salary"] ?>$</div>
                                                </div>
                                                <div class="items-info">
                                                    <div class="items-text">Home Town</div>
                                                    <div class="items-content"><?php echo $result[0]["hometown"] ?></div>
                                                </div>
                                                <div class="items-info">
                                                    <div class="items-text">Avatar</div>
                                                    <div class="items-content"><?php
                                                        if ($result[0]["avatar"] === "Trống") {
                                                            echo $result[0]["avatar"];
                                                        } else {
                                                            ?>
                                                            <img src="<?php echo $result[0]["avatar"] ?>" alt="image"/>
                                                            <?php
                                                        }
                                                        ?></div>
                                                </div>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="result-errorr">
                                                Please Enter Full ID
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="result-errorr">
                                            ID does not exist please check again
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <?php
                                    break;
                                case "student":
                                    $result = $selectResult->buildparam([
                                                "where" => "id like '%" . $page->getGet("search") . "%'"
                                            ])->select();
                                    if ($result) {
                                        $counts = count($result);
                                        if ($counts == 1) {
                                            ?>
                                            <div class="result-success">
                                                <div class="items-info">
                                                    <div class="items-text">Id</div>
                                                    <div class="items-content"><?php echo $result[0]["id"]; ?></div>
                                                </div>
                                                <div class="items-info">
                                                    <div class="items-text">Name</div>
                                                    <div class="items-content"><?php echo $result[0]["name"] ?></div>
                                                </div>
                                                <div class="items-info">
                                                    <div class="items-text">Birth day</div>
                                                    <div class="items-content"><?php echo $result[0]["birthday"] ?></div>
                                                </div>
                                                <div class="items-info">
                                                    <div class="items-text">Gender</div>
                                                    <div class="items-content"><?php echo $result[0]["gender"] ?></div>
                                                </div>
                                                <div class="items-info">
                                                    <div class="items-text">Home Town</div>
                                                    <div class="items-content"><?php echo $result[0]["hometown"] ?></div>
                                                </div>
                                                <div class="items-info">
                                                    <div class="items-text">Avatar</div>
                                                    <div class="items-content"><?php
                                                        if ($result[0]["avatar"] === "Trống") {
                                                            echo $result[0]["avatar"];
                                                        } else {
                                                            ?>
                                                            <img src="<?php echo $result[0]["avatar"] ?>" alt="image"/>
                                                            <?php
                                                        }
                                                        ?></div>
                                                </div>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="result-errorr">
                                                Please Enter Full ID
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="result-errorr">
                                            ID does not exist please check again
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <?php
                                    break;
                                case "subjects":
                                    $result = $selectResult->buildparam([
                                                "where" => "id like '%" . $page->getGet("search") . "%'"
                                            ])->select();
                                    if ($result) {
                                        $counts = count($result);
                                        if ($counts == 1) {
                                            ?>
                                            <div class="result-success">
                                                <div class="items-info">
                                                    <div class="items-text">Id</div>
                                                    <div class="items-content"><?php echo $result[0]["id"]; ?></div>
                                                </div>
                                                <div class="items-info">
                                                    <div class="items-text">Name</div>
                                                    <div class="items-content"><?php echo $result[0]["name"] ?></div>
                                                </div>
                                                <div class="items-info">
                                                    <div class="items-text">Credits</div>
                                                    <div class="items-content"><?php echo $result[0]["credits"] ?></div>
                                                </div>
                                                <div class="items-info">
                                                    <div class="items-text">Number Lesson</div>
                                                    <div class="items-content"><?php echo $result[0]["numberlesson"] ?></div>
                                                </div>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="result-errorr">
                                                Please Enter Full ID
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="result-errorr">
                                            ID does not exist please check again
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <?php
                                    break;
                                case "course":
                                    $result = $selectResult->buildparam([
                                                "where" => "id like '%" . $page->getGet("search") . "%'"
                                            ])->select();
                                    if ($result) {
                                        $counts = count($result);
                                        if ($counts == 1) {
                                            ?>
                                            <div class="result-success">
                                                <div class="items-info">
                                                    <div class="items-text">Id</div>
                                                    <div class="items-content"><?php echo $result[0]["id"]; ?></div>
                                                </div>
                                                <div class="items-info">
                                                    <div class="items-text">Name</div>
                                                    <div class="items-content"><?php echo $result[0]["name"] ?></div>
                                                </div>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="result-errorr">
                                                Please Enter Full ID
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="result-errorr">
                                            ID does not exist please check again
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <?php
                                    break;
                                case "classroom":
                                    $result = $selectResult->buildparam([
                                                "where" => "id like '%" . $page->getGet("search") . "%'"
                                            ])->select();
                                    if ($result) {
                                        $counts = count($result);
                                        if ($counts == 1) {
                                            ?>
                                            <div class="result-success">
                                                <div class="items-info">
                                                    <div class="items-text">Id</div>
                                                    <div class="items-content"><?php echo $result[0]["id"]; ?></div>
                                                </div>
                                                <div class="items-info">
                                                    <div class="items-text">Name</div>
                                                    <div class="items-content"><?php echo $result[0]["name"] ?></div>
                                                </div>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="result-errorr">
                                                Please Enter Full ID
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="result-errorr">
                                            ID does not exist please check again
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <?php
                                    break;
                            }
                        } else {
                            ?>
                            <div class="result-errorr">
                                Please enter a value in the text box
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </form>    
        </div>
    </div>
    <?php
        
    ?>
</body>