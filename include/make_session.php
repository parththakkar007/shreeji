<?php
    include('include/config.inc.php');
    session_start();
    if(empty($_SESSION['id'])){
        header("location:index.php");
        exit();
    }else
    {
        
    }
    
?>