<?php
include '../../Apps/config.php';
if(isset($_POST["id"])){
    try {
        $dele = new Apps_Model_Teacher();
    
    $results = $dele->buildparam([
    "select"=>"avatar",
    "where"=>"id = ?",
    "values"=>[$_POST["id"]]
    ])->selectone();
    
    if($results["avatar"] !== "Trống"){
        unlink($results["avatar"]);
    }
    
    $results = $dele->buildparam([
    "where"=>"id = ?",
    "values"=>[$_POST["id"]]
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
} else {
    echo "Can't find id to delete";
}



