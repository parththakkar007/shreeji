<?php
    include("include/header.php");
    if(!empty($_REQUEST['did'])){
        $did=$_REQUEST['did'];
        mysqli_query($con,"delete from bank where id='$did'");
        header("location:bank.php");
    }

    if(!empty($_REQUEST['doid'])){
        $do="EditBank";
        $doid=$_REQUEST['doid'];
        $Query=mysqli_query($con,"select * from bank where id='$doid'");
        $Row=mysqli_fetch_array($Query);
    }else{
        $do="Bank";
        $doid='';
    }
?>

        
        <center><h1>Bank Details<h1></center>
        <?php 
            if(!empty($_SESSION['msg'])){
                 $msg=$_SESSION['msg'];
                echo "<div class='col-md-5'>
                <div class='alert alert-success alert-dismissible'>
                <a href='javascript:void(0);' class='close' data-dismiss='alert' area-label='close'> &times; </a>
                $msg
                </div>
                </div>
                ";
                $_SESSION['msg']="";
            }
            
        ?>
        <form action="action.php" method="post">
            <input type="hidden" name="do" value="<?php echo $do;?>">
            <input type="hidden" name="doid" value="<?php echo $doid;?>">
            
            <div class="form-group col-md-3" >
                <label>Bank Name</label>
                <input type="text" name="name" style="border:none; border-radius:5px;" class="form-control"  value="<?php if(isset($_REQUEST['doid'])) {echo $Row['name'];}?>"/>
            </div>
            <div class="form-group col-md-3">
                <label>Account Holder</label>
                <input type="text" name="holder" style="border:none; border-radius:5px;" class="form-control" value="<?php if(isset($_REQUEST['doid'])) {echo $Row['holder'];}?>"/>
            </div>
            <div class="form-group col-md-3">
                <input type="submit" name="submit" style="border:none; border-radius:5px;" class="btn btn-primary">
            </div>
            </table>
            
        </form>
        <table border="1" class="table table-info">
            <tr>
                <th>Sr.No</th>
                <th>Bank Name</th>
                <th>Account Holder</th>
                <th>Amount</th>
                <th>Action</th>
                
            </tr>
            <?php
                $q=mysqli_query($con,"select * from bank order by id desc");
                $i=0;
                while($r=mysqli_fetch_array($q)){
                $i++;
             ?>
                    <tr>
                        <td><?=$i?></td>
                        <td><?=$r['name'];?></td>
                        <td><?=$r['holder'];?></td>
                        <td></td>
                        <td><a href="bank.php?doid=<?=$r['id'];?>" class="text-success"><i class="fa fa-pencil"></i></a> &nbsp;&nbsp;&nbsp; <a href="bank.php?did=<?=$r['id'];?>" class="text-danger"><i class="fa fa-close"></i></a></td>
                    </tr>
            <?php
                } 
            ?>
        </table>
        
<?php
include("include/footer.php")
?>
                