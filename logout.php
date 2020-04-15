<?php
    session_start();
    session_destroy();
    header("location:index.php");
?>
<html>
    <head>
        <title>logout</title>
    </head>
    <body>
        <input type="button" name="logout">
    </body>
</html>