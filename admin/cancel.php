<?php
    include('mymethod.php');

    $reg_id=$_GET['app_id'];
    $result= cancel($app_id);
    if($result==1)
    {
        echo"Data deleted";
    }
    else{
        echo" Data not deleted";
    }
?>