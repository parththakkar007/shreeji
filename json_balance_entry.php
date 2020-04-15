<?php
    include("include/config.inc.php");
    switch($_REQUEST['do']){
        case "ClosingBalance":
            $upid=$_REQUEST['upid'];
            $q=mysqli_query($con,"select * from opening_balance where id='$upid'");
            $r=mysqli_fetch_array($q);
            echo json_encode($r);
        break;
        case "OpeningBalance":
            $upid=$_REQUEST['upid'];
            $q=mysqli_query($con,"select date,id,opening from opening_balance where id='$upid'");
            $r=mysqli_fetch_array($q);
            echo json_encode($r);
        break;
    }
?>