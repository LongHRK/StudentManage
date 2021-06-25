<?php
include '../Apps/config.php';
$user = new Apps_Libs_UserIdentity();
$user->logout();

header("location:http://localhost/StudentManage/Login/login.php");
?>

