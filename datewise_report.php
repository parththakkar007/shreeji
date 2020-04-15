<?php
    include("include/header.php");
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<style>
    .table{
        color:black;
        font-size:14px;
    }
    .internal-table{
        color:black;
        
    }
    .internal-table td{
        font-weight:bold;
        font-size:11px;
        padding:2px;
    }
</style>
    <div class="container">
        <center><h6>DateWise Report<h6></center>
        <form method="post" >
                From:
                <input type="date" name="from" style="border:none; border-radius:5px;" class="col-md-2" value="<?php if(!empty($_REQUEST['from'])){ echo $_REQUEST['from']; }?>">
                To:
                <input type="date" name="to" style="border:none; border-radius:5px;" class="col-md-2" value="<?php if(!empty($_REQUEST['to'])){ echo $_REQUEST['to']; }?>">
                <input type="submit" name="submit" class="form-control col-md-1 btn btn-primary">
        </form>
        <div class="table-responsive" style="background-color:#f5f4f4;border-radius:7px;border:2px solid #409be5;">
        <table border="1" class="table table-info">
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Date</th>
                    <th>Credit</th>
                    <th>Debit</th>
                </tr>
            </thead>  
            <tbody>      
            <?php
                $condition="";
                if(!empty($_REQUEST['from'])){
                    $condition.=" AND transaction.date>='".$_REQUEST['from']."'";
                }if(!empty($_REQUEST['to'])){
                    $condition.=" AND transaction.date<='".$_REQUEST['to']."'";
                }
                $transaction=mysqli_query($con,"select DISTINCT date from transaction where 1=1 $condition order by transaction.id desc");
                 $i=0;
                while($r=mysqli_fetch_array($transaction)){
               
                $i++;
            ?>
                <tr>
                    <td><?=$i?></td>
                    <td style="position:relative;">
                        <?=date("d-m-Y",strtotime($r['date']));?>
                        <div style="position:absolute;bottom:0;">
                            <table class="internal-table">
                                <tr>
                                    <td colspan="2" style="text-align:center;"><?=date("d-m-Y",strtotime($r['date']))."<br>";?></td>
                                </tr>
                                <?php
                                    $op=mysqli_fetch_array(mysqli_query($con,"select opening from opening_balance where date='".$r['date']."'"))['opening'];
                                    $cr=mysqli_fetch_array(mysqli_query($con,"select sum(amount) as total from transaction where date='".$r['date']."'
                                AND type='credit'"))['total'];
                                    $db=mysqli_fetch_array(mysqli_query($con,"select sum(amount) as total from transaction where date='".$r['date']."'
                                AND type='debit'"))['total'];
                                    $cashbal=mysqli_fetch_array(mysqli_query($con,"select closing from opening_balance where date='".$r['date']."'"))['closing'];
                                ?>
                                <tr>
                                    <td>Closing Err.</td>
                                    <td style="color:red;"><?=($op+$cr)-($cashbal+$db);?></td>
                                </tr>
                            </table>
                        </div>
                    </td>
                    <td style="position:relative;padding-bottom:90px;">
                        <table class="table">
                            <tr style="font-weight:bold;">
                                <td>Opening</td>
                                <td><?=$upperopening=mysqli_fetch_array(mysqli_query($con,"select opening from opening_balance where date='".$r['date']."'"))['opening'];?></td>
                                <td></td>
                            </tr>
                        <?php
                            $creditQ=mysqli_query($con,"select transaction.amount,party.name,transaction.remark from transaction 
                            left join party on party.id=transaction.party_id
                            where transaction.date='".$r['date']."' AND transaction.type='credit' order by transaction.id desc");
                            $credittotal=0;
                            while($creditR=mysqli_fetch_array($creditQ)){
                                $credittotal+=$creditR['amount'];
                        ?>
                                <tr>
                                    <td style="width:50%;"><?=$creditR['name'];?><br><b><small style="color:#86768a;"><?=$creditR['remark'];?></b></small></td>
                                    <td style="width:50%;"><?=$creditR['amount'];?></td>
                                </tr>
                        <?php
                            }
                        ?>
                        <!--<tr>-->
                        <!--    <td class="text-success" style="width:50%;">CR Total:</td>-->
                        <!--    <td style="width:50%;"><b><?=$credittotal;?></b></td>-->
                        <!--</tr>-->
                        </table>
                        <div style="position:absolute;bottom:0;right:0;">
                            <table class="table">
                                <tr>
                                    <td>
                                        <span class="text-success">CR Total:</span>
                                        <span><b><?=$credittotal+$upperopening;?></b></span>      
                                    </td>
                                </tr>
                            </table>
                            
                        </div>
                    </td>
                    <td style="position:relative;padding-bottom:90px;">
                        <table class="table">
                        <?php
                            $debitQ=mysqli_query($con,"select transaction.amount,party.name,transaction.remark from transaction 
                            left join party on party.id=transaction.party_id
                            where transaction.date='".$r['date']."' AND transaction.type='debit' order by transaction.id desc");
                            $debittotal=0;
                            while($debitR=mysqli_fetch_array($debitQ)){
                                $debittotal+=$debitR['amount'];
                        ?>
                                <tr>
                                    <td style="width:50%;"><?=$debitR['name'];?><br><b><small style="color:#86768a;"><?=$debitR['remark'];?></small></b></td>
                                    <td style="width:50%;"><?=$debitR['amount'];?></td>
                                </tr>
                        <?php
                            }
                        ?>
                        </table>
                        <div style="position:absolute;bottom:0;">
                            <table class="table">
                                <tr>
                                    <td>Cash: <?=$lowercash=mysqli_fetch_array(mysqli_query($con,"select closing from opening_balance where date='".$r['date']."'"))['closing'];?></td>
                                </tr>
                                <tr>
                                    <td>DB Total:<b><?=$debittotal+$lowercash;?></b></td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>            
            <?php
                }
            ?>
            </tbody>
        </table>
        </div>
    </div>
<?php
include("include/footer.php");
?>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready( function () {
    $('.table').dataTable({
        "pageLength": -1,
        "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]]
    });
});
</script>
                