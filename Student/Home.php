<?php
include '../Apps/config.php';
    $acc = new Apps_Libs_UserIdentity();
    if($acc->isLogin() === false){
        header("location:http://localhost/StudentManage/Login/");
        die();
    }
    if($acc->isUser() === 1){
        header("location:http://localhost/StudentManage/Admin/");
        die();
    }
    if($acc->isUser() === 2){
        header("location:http://localhost/StudentManage/Teacher/");
        die();
    }
    $teacher = new Apps_Model_Teacher();
    $re = $teacher->buildparam([
        "where"=>"id = ?",
        "values"=>[$acc->getSESSION("username")]
    ])->selectone();
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
    </head>

    <style>
        *{
            margin: 0 auto;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
            background-color: #e7ecf0;
        }
        #conten{
            position: relative;
            width: 80%;
            height: 90%;
            top: 5%;
        }
        /*
            info
        */
        #conten #info{
            position: absolute;
            width: 40%;
            height: 40%;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        #info > .item-contents{
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: white;
        }
        /*
            Schedule
        */
        #conten #schedule{
            position: absolute;
            width: calc(100% - 41%);
            height: 40%;
            background-color: white;
            left: 41%;
        }
        #schedule > .item-contents{
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: white;
        }
        /*
            Action
        */
        #conten #action{
            position: absolute;
            width: 100%;
            height: 14%;
            background-color: white;
            top: 42%;
        }
        #action > .content{
            position: absolute;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: space-around;
            align-items: center;
            background-color: white;
        }
        .items{
            height: 100%;
            flex: 15%;
            display: flex;
            align-items: center;
            justify-content: space-around;
            background-color: white;
        }
        .items a{
            flex: 1;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: white;
        }
        a .items-image{
            flex: 3;
            background-color: white;
        }
        a .items-text{
            flex: 1;
            background-color: white;
        }
        a .items-image{
            max-width: 40px;
            margin: 10px;
        }
        a .items-text{
            font-size: 20px;
            color: black;
        }
        /*
            Registration Course
        */
        #conten #registration_Course{
            position: absolute;
            width: 100%;
            height: calc(100% - 58%);
            background-color: white;
            top: 58%;
        }
        #registration_Course > .item-contents{
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: white;
        }
    </style>

    <body>
        <div id="conten">
            <div id="info">
                <iframe class="item-contents" src="./PageItems/Info.php" scrolling="no" frameBorder="0"></iframe>
            </div>

            <div id="schedule">
                <iframe class="item-contents" src="./PageItems/Schedule.php" scrolling="no" frameBorder="0"></iframe>
            </div>

            <div id="action">
                <div class="content">
            <div class="items">
                <a href="./HandleTeacher/UpdateInFo.php">
                <img class="items-image" src="../Media/image/Edit.png" alt="Errorr"/>
                <p class="items-text">Edit</p>
                </a>
            </div>
            <div class="items">
                <a href="./HandleTeacher/Schedule.php">
                <img class="items-image" src="../Media/image/Schedule.png" alt="Errorr"/>
                <p class="items-text">Schedule</p>
                </a>
            </div>
            <div class="items">
                <a href="./HandleTeacher/Handling.html">
                <img class="items-image" src="../Media/image/Action.png" alt="Errorr"/>
                <p class="items-text">Handling</p>
                </a>
            </div>
            <div class="items">
                <a id="logout-handle" href="../Login/Logout.php">
                <img class="items-image" src="../Media/image/logout.png" alt="Errorr"/>
                <p class="items-text">Log Out</p>
                </a>
            </div>
            <div class="items">
                <a href="./HandleTeacher/Mark.php">
                    <img class="items-image" src="../Media/image/EditInfo.png" alt="Errorr"/>
                <p class="items-text">Mark</p>
                </a>
            </div>
        </div>
            </div>

            <div id="registration_Course">
                <iframe class="item-contents" src="./PageItems/RegistrationTeach.php" scrolling="no" frameBorder="0"></iframe>
            </div>
        </div>
    </body>
</html>