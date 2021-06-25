<!DOCTYPE html>
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
            width: 680px;
            height: 280px;
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
        .content .border-1{
            width: 100%;
            height: 2.5%;
            display: flex;
            align-items: center;    
        }
        .border-1 > hr{
            width: 100%;
            color: black;
        }
        .content .schedule{
            width: 100%;
            height: calc(100% - 15% - 2.5%);
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
            font-size: 15px;
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
            font-size: 20px;
            font-weight: bold;
            background-color: white;
        }
        .items-schedule .schedule-items.time{
            text-align: left;
            flex-basis: 20%;
        }
        .items-schedule .schedule-items{
            text-align: center;
            line-height: 57.75px;
            justify-content: center;    
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
    <?php
    include '../../Apps/config.php';

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
    ?>
    <body>
        <div class="content">
            <div class="text">
                <p>Your teaching schedule</p>
            </div>
            <div class="border-1">
                <hr>
            </div>
            
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
                    <p class="schedule-items"><?php
                        getSchedule("Thứ 2", "Buổi sáng");
                        ?></p>
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
    </body>
</html>

