<?php
include '../../Apps/config.php';
if(isset($_POST["subject"]) && isset($_POST["student"])){
    try {
    $dele = new Apps_Model_CourseInfo();
    
    $results = $dele->buildparam([
    "where"=>"idsubjects = ? and idstudent = ?",
    "values"=>[$_POST["subject"],$_POST["student"]]
    ])->delete();
    if($results){
        echo "successful delete";
    } else {
        echo "Deletion failed";
    }
    } catch (Exception $ex) {
        $a = $ex->getMessage();
        echo '<script language="javascript">';
        echo "alert('$a')";
        echo '</script>';
    } 
} 
    if(isset($_POST["subject"]) && isset($_POST["teacher"])){
    try {
    $dele = new Apps_Model_CourseInfo();
    
    $results = $dele->buildparam([
    "where"=>"idsubjects = ? and idteacher = ?",
    "values"=>[$_POST["subject"],$_POST["teacher"]]
    ])->delete();
    if($results){
        echo "successful delete";
    } else {
        echo "Deletion failed";
    }
    } catch (Exception $ex) {
        $a = $ex->getMessage();
        echo '<script language="javascript">';
        echo "alert('$a')";
        echo '</script>';
    } 
}


