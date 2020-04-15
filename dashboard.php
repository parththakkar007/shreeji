<?php
    include("include/header.php");
    $openingR=mysqli_fetch_array(mysqli_query($con,"select opening,date from opening_balance order by id desc limit 1"));
    $cre=mysqli_fetch_array(mysqli_query($con,"select sum(amount) as cre from transaction where type='credit' AND date='".$openingR['date']."'"))['cre'];
    $dbe=mysqli_fetch_array(mysqli_query($con,"select sum(amount) as dbe from transaction where type='debit' AND date='".$openingR['date']."'"))['dbe'];
    
    $cr=mysqli_fetch_array(mysqli_query($con,"select sum(amount) as cre from transaction where type='credit' AND date='".date("Y-m-d")."'"))['cre'];
    $db=mysqli_fetch_array(mysqli_query($con,"select sum(amount) as dbe from transaction where type='debit' AND date='".date("Y-m-d")."'"))['dbe'];
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
<div class="container">
    <div class="row">
        <div class="col-md-4">
        <div class="card border-warning mb-3 col-md-3" style="max-width: 20rem;">
          <div class="card-header">Total Balance</div>
          <div class="card-body">
            <h4 class="card-title"><?=$openingR['opening']+$cre-$dbe;?></h4>
            </div>
        </div>
        </div>
        <div class="col-md-4">
        <div class="card border-warning mb-3 col-md-3" style="max-width: 20rem;">
          <div class="card-header">Today's Credit</div>
          <div class="card-body">
            <h4 class="card-title"><?=$cr;?></h4>
        </div>
        </div>
        </div>
        <div class="col-md-4">
        <div class="card border-warning mb-3 col-md-3" style="max-width: 20rem;">
          <div class="card-header">Today's Debit</div>
          <div class="card-body">
            <h4 class="card-title"><?=$db;?></h4>
        </div>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table>
                <tr>
                    <?php
                        $graphQ=mysqli_query($con,"select * from opening_balance order by id desc limit 10");
                        while($graphR=mysqli_fetch_array($graphQ)){
                            $graphCR=mysqli_fetch_array(mysqli_query($con,"select sum(amount) as total from transaction where date='".$graphR['date']."' AND type='credit'"))['total'];
                            $graphDB=mysqli_fetch_array(mysqli_query($con,"select sum(amount) as total from transaction where date='".$graphR['date']."' AND type='debit'"))['total'];
                    ?>
                    <td>
                        <a href="#" data-toggle="popover" title="" data-placement="bottom"style="color:white;background-color:#5a7691;border-radius:15px;padding:5px 11px;"><?=date("d-m-Y",strtotime($graphR['date']));?></a>
                        <div id="popover-content" style="display:none;">
                         <ul>
                             <li><small>Opening:</small> <?=$graphR['opening'];?></li>
                             <li><small>CR:</small> <span style="color:#2bf2a6;"><?=$graphCR;?></span></li>
                             <li><small>DB:</small> <span style="color:orange;"><?=$graphDB;?></span></li>
                             <li><small>Actual Closing:</small> <?=$graphR['opening']+$graphCR-$graphDB;?></li>
                             <li><small>Cash:</small> <?=$graphR['closing'];?></li>
                         </ul>
                       </div> 
                    </td>
                    <?php
                        }
                    ?>
                </tr>
            </table>
        </div>
        <canvas id="myChart" height="90px"></canvas>
    </div>
</div>
<?php
    include("include/footer.php");
?>

<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover({
        
        html: true, 
        content: function(){
           return $(this).next().html();
        }
    }); 
});
</script>
<?php
$chartQ=mysqli_query($con,"select date from opening_balance");
$chartQ1=mysqli_query($con,"select date,closing from opening_balance");
$chartQ2=mysqli_num_rows(mysqli_query($con,"select date,closing from opening_balance"));
$chartN=mysqli_num_rows($chartQ);
?>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [<?php $x=0; while($chartR=mysqli_fetch_array($chartQ)){ $x++; echo "'".date("d-m-Y",strtotime($chartR['date']))."'"; if($x!=$chartN){ echo ","; }} ?>],
        datasets: [{
            label: 'Closing Balance',
            data: [<?php $x=0; while($chartR=mysqli_fetch_array($chartQ1)){ $x++; echo $chartR['closing']; if($x!=$chartN){ echo ","; }} ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                <?php for($a=0;$a<$chartQ2;$a++){
                    echo "'rgba(255, 99, 132, 1)',";
                } ?>
                
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>