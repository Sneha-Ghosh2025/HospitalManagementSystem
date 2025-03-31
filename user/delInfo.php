<?php
    include('method.php');

    $reg_id=$_GET['reg_id'];
    $result= deleteInfo($reg_id);
    if($result==1)
    {
        echo"Data deleted";
    }
    else{
        echo" Data not deleted";
    }
?>