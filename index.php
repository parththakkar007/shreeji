<?php
    include('include/config.inc.php');
    session_start();
    if(isset($_SESSION['username'])){
        header("location:dashboard.php");
        exit();
    }
    
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="assets/bootstrap.min.css" />
        <title>Login Form</title>
    </head>
    <body>
        <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-3">
        <form action="login_check.php" method="post" style="margin-left:100px; margin-top:100px;  padding:20px; background-color:#058882; border-radius:10px;" >
        <div class="form-group ">
          <label>UserName</label>
          <input type="name" name="username" class="form-control"  aria-describedby="emailHelp" placeholder="Enter username" style="border:none; border-radius:5px;">
        </div>
        <div class="form-group ">
          <label>Password</label>
          <input type="password" name="password" class="form-control"  placeholder="Password" style="border:none; border-radius:5px;">
        </div>
        <div class="form-group ">
        <button type="submit" class="btn btn-primary" style="border:none; border-radius:5px;">LogIn</button>
        </div>
        </form>
        </div>
        <div class="col-md-4"></div>
        <div>
    </body>
</html>