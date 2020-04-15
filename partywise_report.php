<?php
    include("include/header.php");
?>
<style>
    .select2-results__option {
        color:black;
    }
</style>
        <center><h1>Partywise Report<h1></center>
        <form method="post">
            <div class="form-group">
                <label>Select Party:</label>
            <select name="party_id" id="party_id" class="form-control col-md-3 " style="border:none; border-radius:5px;">
                        <option>--select--</option>
                        <?php
                            $Q=mysqli_query($con,"select * from party");
                            while($R=mysqli_fetch_array($Q)){
                        ?>
                        <option value="<?=$R['id']?>" <?php if(!empty($_REQUEST['doid'])&&$Row['party_id']==$R['id']){ echo "selected"; } ?>><?=$R['name'];?></option>
                        <?php
                            }
                        ?>
            </select>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="form-control col-md-1 btn btn-primary">
            </div>
        </form>
        <table border="1" class="table table-info">
            <tr>
                <th>Sr.No</th>
                <th>Date</th>
                <th>Party Name</th>
                <th>CR</th>
                <th>DB</th>
                <th>Remarks</th>
            </tr>
            <?php
                $condition="";
                if(!empty($_REQUEST['party_id'])){
                    $condition.=" AND party_id=".$_REQUEST['party_id'];
                }
                $transaction=mysqli_query($con,"select * from transaction where 1=1 $condition order by id desc");
                 $i=0;
                while($r=mysqli_fetch_array($transaction)){
               
                $i++;
            ?>
                <tr>
                        <td><?=$i?></td>
                        <td><?=date("d-m-Y",strtotime($r['date']));?></td>
                        <td><?php
                            $name=mysqli_fetch_array(mysqli_query($con,"select name  from party where id='".$r['party_id']."'"))['name'];
                            echo $name;
                        ?>
                        </td>
                        <td>
                            <?php
                                if($r['type']==credit){
                                    echo $r['amount'];
                                }
                            ?>
                        </td>
                        <td>
                            <?php
                                if($r['type']==debit){
                                    echo $r['amount'];
                                }
                            ?>
                        </td>
                        <td><?=$r['remark'];?></td>
                    </tr>            
            <?php
                }
            ?>
        </table>

        
<?php
include("include/footer.php")
?>
<script>
    $(document).ready(function(){
        $("#party_id").select2();
    });
</script>