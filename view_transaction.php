<?php
    include("include/header.php");
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<style>
    .table{
        color:black;
    }
</style>
<div class="container">
    <div class="table-responsive" style="background-color:white;">
        <table border="1" class="table table-info">
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Date</th>
                    <th>Party Name</th>
                    <th>CR</th>
                    <th>DB</th>
                    <th>Remarks</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $transaction=mysqli_query($con,"select * from transaction order by id desc");
                 $i=0;
                while($r=mysqli_fetch_array($transaction)){
               
                $i++;
            ?>
                <tr>
                    <td><?=$i?></td>
                    <td><?=date("d-m-Y",strtotime($r['date']));?></td>
                    <td>
                        <?php
                        $name=mysqli_fetch_array(mysqli_query($con,"select name from party where id='".$r['party_id']."'"))['name'];
                        echo $name;
                        ?>    
                    </td>
                    <td>
                        <?php
                            if($r['type']=="credit"){
                                echo $r['amount'];
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            if($r['type']=="debit"){
                                echo $r['amount'];
                            }
                        ?>
                    </td>
                    <td><?=$r['remark'];?></td>
                    <td><a href="transaction.php?doid=<?=$r['id'];?>" class="text-success"><i class="fa fa-pencil"></i></a> &nbsp;&nbsp;&nbsp; <a href="transaction.php?did=<?=$r['id'];?>" class="text-danger"><i class="fa fa-close"></i></a></td>
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
        "pageLength": 50
    });
});
</script>
                