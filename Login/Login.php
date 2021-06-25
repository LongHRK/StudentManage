<?php
include '../Apps/config.php';
$notification = "";
$identity = new Apps_Libs_UserIdentity();
$account = trim($identity->getPOST("user"));
$pass = trim($identity->getPOST("pass"));



if ($identity->isLogin()) {
    switch ($identity->isUser()) {
            case 1:
                header("location:http://localhost/StudentManage/Admin/");
            break;
            case 2:
                header("location:http://localhost/StudentManage/Teacher/");
            break;
            default:
                header("location:http://localhost/StudentManage/Student/");
                break;
        } 
}

if ($identity->getPOST("btnlogin") && $account && $pass) {
    $identity->username = $account;
    $identity->password = $pass;
    if ($identity->login()) {
        switch ($identity->isUser()) {
            case 1:
                header("location:http://localhost/StudentManage/Admin/");
            break;
            case 2:
                header("location:http://localhost/StudentManage/Teacher/");
            break;
            default:
                header("location:http://localhost/StudentManage/Student/");
                break;
        }  
    } else {
        $notification = "Login failed";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" rel="stylesheet" id="bootstrap-css">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" />
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="../Media/css/Login.css">
        <title>Login</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <form action="#" method="POST" class="box">
                            <h1>Login</h1>
                            <p class="text-muted"> Please enter your username and password!</p> 
                            <input type="text" name="user" placeholder="Username" > 
                            <input type="password" name="pass" placeholder="Password"> 
                            <p id="notificationlogin" class="text-muted"><?php if($notification !== "") echo $notification; ?></p> 
                            <input type="submit" name="btnlogin" value="Login">                            
                            <div class="col-md-12">
                                <ul class="social-network social-circle">
                                    <li><a href="#" class="icoFacebook" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#" class="icoTwitter" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#" class="icoGoogle" title="Google +"><i class="fab fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
