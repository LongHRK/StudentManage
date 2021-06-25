<?php
    include '../../Apps/config.php';
    $page = new Apps_Libs_UserIdentity();
?>

<!DOCTYPE html>
<html lang="en">d
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        .app{
            height: 90vh;
            width: 80vw;
            background-color:white;
            margin-top: 5vh;
        }
        .app .text-title{
            height: 5vh;
            width: 100%;
            background-color:white;
            font-size: 25px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .app .text-title:hover{
            color: red;
            cursor: pointer;
        }
        .app .content{
            height: 80vh;
            width: 80vw;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .content .title.header{
            flex: 1;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #ffebcd;
            border-bottom: black 1px solid;
        }
        .title.header .header-items{
            flex-basis: 14%;
            font-size: 25px;
            text-align: center;
            font-weight: bold;
            background-color: #ffebcd;
        }
        .content .title.body{
            flex: 6;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .title.body .body-items{
            flex: 1;
            width: 100%;
            background-color:rgb(0, 0, 0);
            border-bottom: 1px black solid;
            display: flex;
            align-items: center;
        }
        .body-items .items-sub{
            height: 100%;
            flex-basis: 14%;
            font-size: 15px;
            text-align: center;
            font-weight: bold;
            display: flex;
            background-color:black;
            flex-direction: column;
            justify-content: space-between;
        }
        .items-sub .sub-values{
            flex-basis: 16%;
            width: 100%;
            display: flex;
            align-items: center;
            padding-left: 5px;
            background-color: white;
        }
        .sub-values:hover{
            cursor: pointer;
        }
        .items-sub.time{
            font-size: 25px;
            display: flex;
            flex-direction: row;
            align-items: center;
            background-color:#ffebcd;
        }
        .app .back-btn{
            height: 5vh;
            width: 80vw;
            display: flex;
            align-items: center;
            background-color:white;
        }
        .back-btn > button{
            font-size: 15px;
            font-weight: bold;
            padding: 5px 20px;
            background-color: gray;
            opacity: 0.7;
            color: white;
            border-style: none;
            margin-right: 5px;
        }
        .back-btn > button:hover{
            opacity: 0.5;
            color: black;
            cursor: pointer;
        }
</style>

    <?php

        function getResult() {
    $page = new Apps_Libs_UserIdentity();
    $schedule = new Apps_Model_Schedule();
    $result = $schedule->buildparam([
                "where" => "idteacher = ?",
                "values" => [$page->getSESSION("username")]
            ])->select();
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
    function getDetail($d, $t) {
        $result = getResult();
        $a = count($result);
        for ($i=0; $i < $a; $i++) { 
            if($result[$i]["day"] == $d && $result[$i]["timeday"] == $t){
                return $result[$i];
            }
        }
    }
    ?>

<body>
    <div class="app">
    <div class="text-title">
    YOUR DETAILED TEACHING SCHEDULE
    </div>
    <div class="content">
        <div class="title header">
            <div class="header-items">Time</div>
            <div class="header-items">Day</div>
            <div class="header-items">Status</div>
            <div class="header-items">Time Start</div>
            <div class="header-items">Time End</div>
            <div class="header-items">Room</div>
            <div class="header-items">Subjects</div>
        </div>
        <div class="title body">
            <div class="body-items">
                <div class="items-sub time">Buổi sáng</div>
                <div class="items-sub">
                <div class="sub-values">Thứ 2</div>
                <div class="sub-values">Thứ 3</div>
                <div class="sub-values">Thứ 4</div>
                <div class="sub-values">Thứ 5</div>
                <div class="sub-values">Thứ 6</div>
                <div class="sub-values">Thứ 7</div>
                </div>
                <div class="items-sub">
                <div class="sub-values"><?php getSchedule("Thứ 2", "Buổi sáng");?></div>
                <div class="sub-values"><?php getSchedule("Thứ 3", "Buổi sáng");?></div>
                <div class="sub-values"><?php getSchedule("Thứ 4", "Buổi sáng");?></div>
                <div class="sub-values"><?php getSchedule("Thứ 5", "Buổi sáng");?></div>
                <div class="sub-values"><?php getSchedule("Thứ 6", "Buổi sáng");?></div>
                <div class="sub-values"><?php getSchedule("Thứ 7", "Buổi sáng");?></div>
                </div>
                <div class="items-sub">
                <div class="sub-values"><?php $a = getDetail("Thứ 2", "Buổi sáng"); echo $a['timestart']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 3", "Buổi sáng"); echo $a['timestart']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 4", "Buổi sáng"); echo $a['timestart']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 5", "Buổi sáng"); echo $a['timestart']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 6", "Buổi sáng"); echo $a['timestart']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 7", "Buổi sáng"); echo $a['timestart']; ?></div>
                </div>
                <div class="items-sub">
                <div class="sub-values"><?php $a = getDetail("Thứ 2", "Buổi sáng"); echo $a['timeend']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 3", "Buổi sáng"); echo $a['timeend']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 4", "Buổi sáng"); echo $a['timeend']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 5", "Buổi sáng"); echo $a['timeend']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 6", "Buổi sáng"); echo $a['timeend']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 7", "Buổi sáng"); echo $a['timeend']; ?></div>
                </div>
                <div class="items-sub">
                <div class="sub-values"><?php $a = getDetail("Thứ 2", "Buổi sáng"); echo $a['idclassroom']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 3", "Buổi sáng"); echo $a['idclassroom']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 4", "Buổi sáng"); echo $a['idclassroom']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 5", "Buổi sáng"); echo $a['idclassroom']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 6", "Buổi sáng"); echo $a['idclassroom']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 7", "Buổi sáng"); echo $a['idclassroom']; ?></div>
                </div>
                <div class="items-sub">
                <div class="sub-values"><?php $a = getDetail("Thứ 2", "Buổi sáng"); echo $a['idsubjects']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 3", "Buổi sáng"); echo $a['idsubjects']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 4", "Buổi sáng"); echo $a['idsubjects']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 5", "Buổi sáng"); echo $a['idsubjects']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 6", "Buổi sáng"); echo $a['idsubjects']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 7", "Buổi sáng"); echo $a['idsubjects']; ?></div>
                </div>
            </div>
            <div class="body-items">
                <div class="items-sub time">Buổi chiều</div>
                <div class="items-sub">
                    <div class="sub-values">Thứ 2</div>
                    <div class="sub-values">Thứ 3</div>
                    <div class="sub-values">Thứ 4</div>
                    <div class="sub-values">Thứ 5</div>
                    <div class="sub-values">Thứ 6</div>
                    <div class="sub-values">Thứ 7</div>
                </div>
                <div class="items-sub">
                <div class="sub-values"><?php getSchedule("Thứ 2", "Buổi chiều");?></div>
                <div class="sub-values"><?php getSchedule("Thứ 3", "Buổi chiều");?></div>
                <div class="sub-values"><?php getSchedule("Thứ 4", "Buổi chiều");?></div>
                <div class="sub-values"><?php getSchedule("Thứ 5", "Buổi chiều");?></div>
                <div class="sub-values"><?php getSchedule("Thứ 6", "Buổi chiều");?></div>
                <div class="sub-values"><?php getSchedule("Thứ 7", "Buổi chiều");?></div>
                </div>
                <div class="items-sub">
                <div class="sub-values"><?php $a = getDetail("Thứ 2", "Buổi chiều"); echo $a['timestart']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 3", "Buổi chiều"); echo $a['timestart']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 4", "Buổi chiều"); echo $a['timestart']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 5", "Buổi chiều"); echo $a['timestart']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 6", "Buổi chiều"); echo $a['timestart']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 7", "Buổi chiều"); echo $a['timestart']; ?></div>
                </div>
                <div class="items-sub">
                <div class="sub-values"><?php $a = getDetail("Thứ 2", "Buổi chiều"); echo $a['timeend']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 3", "Buổi chiều"); echo $a['timeend']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 4", "Buổi chiều"); echo $a['timeend']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 5", "Buổi chiều"); echo $a['timeend']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 6", "Buổi chiều"); echo $a['timeend']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 7", "Buổi chiều"); echo $a['timeend']; ?></div>
                </div>
                <div class="items-sub">
                <div class="sub-values"><?php $a = getDetail("Thứ 2", "Buổi chiều"); echo $a['idclassroom']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 3", "Buổi chiều"); echo $a['idclassroom']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 4", "Buổi chiều"); echo $a['idclassroom']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 5", "Buổi chiều"); echo $a['idclassroom']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 6", "Buổi chiều"); echo $a['idclassroom']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 7", "Buổi chiều"); echo $a['idclassroom']; ?></div>
                </div>
                <div class="items-sub">
                <div class="sub-values"><?php $a = getDetail("Thứ 2", "Buổi chiều"); echo $a['idsubjects']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 3", "Buổi chiều"); echo $a['idsubjects']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 4", "Buổi chiều"); echo $a['idsubjects']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 5", "Buổi chiều"); echo $a['idsubjects']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 6", "Buổi chiều"); echo $a['idsubjects']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 7", "Buổi chiều"); echo $a['idsubjects']; ?></div>
                </div>
            </div>
            <div class="body-items">
                <div class="items-sub time">Buổi tối</div>
                <div class="items-sub">
                    <div class="sub-values">Thứ 2</div>
                    <div class="sub-values">Thứ 3</div>
                    <div class="sub-values">Thứ 4</div>
                    <div class="sub-values">Thứ 5</div>
                    <div class="sub-values">Thứ 6</div>
                    <div class="sub-values">Thứ 7</div>
                </div>
                <div class="items-sub">
                <div class="sub-values"><?php getSchedule("Thứ 2", "Buổi tối");?></div>
                <div class="sub-values"><?php getSchedule("Thứ 3", "Buổi tối");?></div>
                <div class="sub-values"><?php getSchedule("Thứ 4", "Buổi tối");?></div>
                <div class="sub-values"><?php getSchedule("Thứ 5", "Buổi tối");?></div>
                <div class="sub-values"><?php getSchedule("Thứ 6", "Buổi tối");?></div>
                <div class="sub-values"><?php getSchedule("Thứ 7", "Buổi tối");?></div>
                </div>
                <div class="items-sub">
                <div class="sub-values"><?php $a = getDetail("Thứ 2", "Buổi tối"); echo $a['timestart']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 3", "Buổi tối"); echo $a['timestart']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 4", "Buổi tối"); echo $a['timestart']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 5", "Buổi tối"); echo $a['timestart']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 6", "Buổi tối"); echo $a['timestart']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 7", "Buổi tối"); echo $a['timestart']; ?></div>
                </div>
                <div class="items-sub">
                <div class="sub-values"><?php $a = getDetail("Thứ 2", "Buổi tối"); echo $a['timeend']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 3", "Buổi tối"); echo $a['timeend']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 4", "Buổi tối"); echo $a['timeend']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 5", "Buổi tối"); echo $a['timeend']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 6", "Buổi tối"); echo $a['timeend']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 7", "Buổi tối"); echo $a['timeend']; ?></div>
                </div>
                <div class="items-sub">
                <div class="sub-values"><?php $a = getDetail("Thứ 2", "Buổi tối"); echo $a['idclassroom']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 3", "Buổi tối"); echo $a['idclassroom']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 4", "Buổi tối"); echo $a['idclassroom']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 5", "Buổi tối"); echo $a['idclassroom']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 6", "Buổi tối"); echo $a['idclassroom']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 7", "Buổi tối"); echo $a['idclassroom']; ?></div>
                </div>
                <div class="items-sub">
                <div class="sub-values"><?php $a = getDetail("Thứ 2", "Buổi tối"); echo $a['idsubjects']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 3", "Buổi tối"); echo $a['idsubjects']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 4", "Buổi tối"); echo $a['idsubjects']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 5", "Buổi tối"); echo $a['idsubjects']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 6", "Buổi tối"); echo $a['idsubjects']; ?></div>
                <div class="sub-values"><?php $a = getDetail("Thứ 7", "Buổi tối"); echo $a['idsubjects']; ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="back-btn">
        <button onclick="Back()">Back</button>
    </div>
    </div>
</body>
    <script>
        function Back(){
            location.replace("http://localhost/StudentManage/Teacher/Home.php");
        }
    </script>
</html>