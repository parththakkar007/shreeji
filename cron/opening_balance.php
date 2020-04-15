<?php
    $con=mysqli_connect("localhost","ragingdeveloper_joshi","ragingdeveloper_joshi","ragingdeveloper_accjoshi");
    $cre=mysqli_fetch_array(mysqli_query($con,"select sum(amount) as cre from transaction where type='credit'"))['cre'];
    $dbe=mysqli_fetch_array(mysqli_query($con,"select sum(amount) as dbe from transaction where type='debit'"))['dbe'];
    $ini=mysqli_fetch_array(mysqli_query($con,"select amount from initial_opening"))['amount'];
    $total=$cre-$dbe+$ini;
    
    $q=mysqli_query($con,"insert into closing_balance(amount)
                                    values('$total')");
?>