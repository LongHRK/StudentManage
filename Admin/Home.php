<?php
    include '../Apps/config.php';
    $acc = new Apps_Libs_UserIdentity();
    if($acc->isLogin() === false){
        header("location:http://localhost/StudentManage/Login/");
        die();
    }
    if($acc->isUser() === 2){
        header("location:http://localhost/StudentManage/Teacher/");
        die();
    }
    if($acc->isUser() === 3){
        header("location:http://localhost/StudentManage/Student/");
        die();
    }
    
    $admin = new Apps_Model_Admin();
    $re = $admin->buildparam([
        "where"=>"id = ?",
        "values"=>[$acc->getSESSION("username")]
    ])->selectone();
?>

<!DOCTYPE html>
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
}
/*
    Phần Header
    cấu hình phần header contaniner
    gồn hai phần logo và hanle
*/
.header-container{
    position: relative;
    background-color: #2574A9;
    width: 100%;
    height: 70px;
}
.header-container a{
    color: #fff;
    text-decoration: none;
}
/*
    cấu hình phần logo
*/
.header-container .header-logo{
    position: absolute;
    height: 70px;
    width: 250px;
    background-color: #146ba5;
}

/*
    cấu hình phần handle
*/

.header-container .header-handle{
    position: absolute;
    left: 250px;
    width: calc(100% - 250px);
    height: 70px;
    background-color: #2574A9;
}

/*
    chỉnh lại các element trong logo
*/

.header-logo a img{
    position: absolute;
    padding: 10px;
    max-width: 60px;
    max-height: 50px;
    border-radius:50%;
    -moz-border-radius:50%;
    -webkit-border-radius:50%;
    -ms-border-radius: 50%;
    -o-border-radius: 50%;
}
.header-logo p{
    line-height: 75px;
    color: white;
    font-size: 15px;
    padding-left: 70px;
}

/*
    chỉnh lại các element trong handle
*/

.handle-logout a img{
    position: absolute;
    right: 10px;
    padding: 20px;
    max-height: 30px;
}
.handle-edit a img{
    position: absolute;
    right: calc(40px + 20px);
    padding: 20px;
    max-height: 30px;
}

/**
    Phần Content-Body
*/

.content-body{
    position: relative;
    height: calc(100vh - 70px);
    width: 100%;
}

/**
    Phần menu
*/

.sidebar-container {
  position: fixed;
  width: 250px;
  height: 100%;
  left: 0;
  overflow: hidden;
  background: #1a1a1a;
  color: #fff;
}

/* .sidebar-logo {
  padding: 10px 15px 10px 30px;
  font-size: 20px;
  background-color: #2574A9;
} */

.sidebar-navigation {
  padding: 0;
  margin: 0;
  list-style-type: none;
  position: relative;
}

.sidebar-navigation li {
  background-color: transparent;
  position: relative;
  display: inline-block;
  width: 100%;
  line-height: 20px;
}

.sidebar-navigation li a {
  padding: 10px 15px 10px 30px;
  display: block;
  color: #fff;
  text-decoration: none;
}

.sidebar-navigation li .fa {
  margin-right: 10px;
}

.sidebar-navigation li a.active{
  background-color: #2574A9;
}

.sidebar-navigation li a:active,
.sidebar-navigation li a:hover,
.sidebar-navigation li a:focus {
  outline: none;
}

.sidebar-navigation li::before {
  background-color: #2574A9;
  position: absolute;
  content: '';
  height: 100%;
  left: 0;
  top: 0;
  -webkit-transition: width 0.2s ease-in;
  transition: width 0.2s ease-in;
  width: 3px;
  z-index: -1;
}

.sidebar-navigation li:hover::before {
  width: 100%;
}

.sidebar-navigation .header {
  font-size: 12px;
  text-transform: uppercase;
  background-color: #151515;
  padding: 10px 15px 10px 30px;
}

.sidebar-navigation .header::before {
  background-color: transparent;
}

/**
    Phần Content
*/

.content{
    position: absolute;
    height: 100%;
    top: 0;
    width: calc(100% - 260px);
    left: 260px;
    overflow-x: hidden;
    overflow-y: hidden;
}
.content .content-item {
    display: none;
  }
  .content .content-item.active {
    position: absolute;
    display: block;
    width: 100%;
    height: 100%;
    top: 0;
    text-align: center;
  }
  .content-item.active .item-contents{
      position: absolute;
      width: 100%;
      height: 100%;
      left: 0;
      top: 0;
  }
  
</style>

<body>
<!-- Phần header -->
    <div class="header-container">
      <div class="header-logo">
          <a href="./HandleAdmin/UpdateInfo.php">
          <?php
            if($re["avatar"] !== "Trống"){
                ?>
              <img src="<?php echo substr($re["avatar"] , 3)?>" alt="No Image">
                <?php
            } else {
                ?>
            <img src="../Media/image/Defaultimage.jpg" alt="No Image">
                <?php
            }
          ?>
        </a>
        <a href="./HandleAdmin/UpdateInfo.php">
        <p><?php echo $re["name"] ?></p>
        </a>
      </div>
      <div class="header-handle">
        <div class="handle-edit">
          <a href="./HandleAdmin/UpdateInfo.php">
              <img src="../Media/image/Edit.png" alt="">
          </a>
        </div>
        <div class="handle-logout">
            <a href="../Login/Logout.php">
              <img src="../Media/image/logout.png" alt="">
          </a>
        </div>
      </div>
    </div>


    <!--
        Phần Menu
    -->
    <!--Created by- https://bootsnipp.com/ishwarkatwe-->
    <div class="content-body">
    <div class="sidebar-container">
        <ul class="sidebar-navigation">
        <li class="header">Statistical</li>
          <li>
            <a href="#" class="menu-item active" onclick="changeMenu(event,9);">
              <i class="fa fa-home" aria-hidden="true"></i> Statistical
            </a>
          </li>

          <li class="header">Student Management</li>
          <li>
            <a href="#" class="menu-item" onclick="changeMenu(event,1);">
              <i class="fa fa-home" aria-hidden="true"></i> Student
            </a>
          </li>

          <li class="header">Teacher Management</li>
          <li>
            <a href="#" class="menu-item" onclick="changeMenu(event,2);">
              <i class="fa fa-users" aria-hidden="true"></i> Teacher
            </a>
          </li>
          
          <li class="header">Other Manager</li>
          <li>
            <a href="#" class="menu-item" onclick="changeMenu(event,3);">
              <i class="fa fa-users" aria-hidden="true"></i> Subject
            </a>
          </li>
          <li>
            <a href="#" class="menu-item" onclick="changeMenu(event,10);">
              <i class="fa fa-users" aria-hidden="true"></i> Mark
            </a>
          </li>
          <li>
            <a href="#" class="menu-item" onclick="changeMenu(event,4);">
              <i class="fa fa-users" aria-hidden="true"></i> Class Room
            </a>
          </li>
          <li>
            <a href="#" class="menu-item" onclick="changeMenu(event,5);">
              <i class="fa fa-users" aria-hidden="true"></i> Course
            </a>
          </li>
          <li>
            <a href="#" class="menu-item" onclick="changeMenu(event,6);">
              <i class="fa fa-users" aria-hidden="true"></i> Course Info
            </a>
          </li>
          <li>
            <a href="#" class="menu-item" onclick="changeMenu(event,7);">
              <i class="fa fa-users" aria-hidden="true"></i> Schedule
            </a>
          </li>
          
          <li class="header">Account Manager</li>
          <li>
            <a href="#" class="menu-item" onclick="changeMenu(event,8);">
              <i class="fa fa-users" aria-hidden="true"></i> Account
            </a>
          </li>
        </ul> 
      </div>
    
    /**/<!-- Phaanf Content -->
      <div class="content">
        <div id="content-9" class="content-item active">
            <iframe class="item-contents" src="./Statistical/Show.php" scrolling="no" frameBorder="0"></iframe>
        </div>
        <div id="content-1" class="content-item">
            <iframe class="item-contents" src="./ManageStudent/Show.php" scrolling="no" frameBorder="0"></iframe>
        </div>
          <div id="content-2" class="content-item">
              <iframe class="item-contents" src="./ManageTeacher/Show.php" scrolling="no" frameBorder="0"></iframe>
          </div>
          <div id="content-3" class="content-item">
              <iframe class="item-contents" src="./ManageSubject/Show.php" scrolling="no" frameBorder="0"></iframe>
          </div>
          <div id="content-4" class="content-item">
              <iframe class="item-contents" src="./ManageClass/Show.php" scrolling="no" frameBorder="0"></iframe>
          </div>
          <div id="content-5" class="content-item">
              <iframe class="item-contents" src="./ManageCourse/Show.php" scrolling="no" frameBorder="0"></iframe>
          </div>
          <div id="content-6" class="content-item">
              <iframe class="item-contents" src="./ManageCourseInfo/Show.php" scrolling="no" frameBorder="0"></iframe>
          </div>
          <div id="content-7" class="content-item">
              <iframe class="item-contents" src="./ManageSchedule/Show.php" scrolling="no" frameBorder="0"></iframe>
          </div>
          <div id="content-8" class="content-item">
              <iframe class="item-contents" src="./ManageAccount/Show.php" scrolling="no" frameBorder="0"></iframe>
          </div>
          <div id="content-10" class="content-item">
              <iframe class="item-contents" src="./ManageMark/Show.php" scrolling="no" frameBorder="0"></iframe>
          </div>
      </div>
    </div>
    <script src="../Media/js/Menu.js"></script>
</body>
</html>