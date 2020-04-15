<?php
    include('include/config.inc.php');
    if(isset($_POST['username']))
    {
        $username=$_REQUEST['username'];
        $password=$_REQUEST['password'];
        $Q=mysqli_query($con,"select * from user where password='$password' AND username='$username'");
        $R=mysqli_fetch_array($Q);
        if(!empty($R['username'] ))
        {
            session_start();
            $_SESSION['id']=$R['id'];
            header("location:dashboard.php");
            exit();
        }else
        {
            session_start();
            $_SESSION['errmessage']='Invalid Detail';
        }
        header("location:index.php");
    }else
    {
        echo "Something went wrong";
    }
?>