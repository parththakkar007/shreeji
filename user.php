<?php
    include("include/header.php");
    if(!empty($_REQUEST['did'])){
        $did=$_REQUEST['did'];
        mysqli_query($con,"delete from user where id='$did'");
        header("location:user.php");
    }

    if(!empty($_REQUEST['doid'])){
        $do="EditUser";
        $doid=$_REQUEST['doid'];
        $Query=mysqli_query($con,"select * from user where id='$doid'");
        $Row=mysqli_fetch_array($Query);
    }else{
        $do="AddUser";
        $doid='';
    }
?>

        
        <center><h1>User Details<h1></center>
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
                <label>UserName</label>
                <input type="text" name="username" style="border:none; border-radius:5px;" class="form-control"  value="<?php if(isset($_REQUEST['doid'])) {echo $Row['username'];}?>"/>
            </div>
            <div class="form-group col-md-3">
                    <label>Password</label>
                    <input type="Password" name="password" style="border:none; border-radius:5px;" class="form-control" value="<?php if(isset($_REQUEST['doid'])) {echo $Row['password'];}?>"/>
            </div>
            <div class="form-group col-md-3">
                <label>Delete</label>
                    <input type="checkbox" name="permission[]" value='delete' style="border:none; border-radius:5px;" class="form-control" <?php if(isset($_REQUEST['doid'])&&($Row['permission']==3||$Row['permission']==2)) {echo "checked";} ?>>
                <label>Edit</label>
                    <input type="checkbox" name="permission[]" value='edit' style="border:none; border-radius:5px;" class="form-control" <?php if(isset($_REQUEST['doid'])&&($Row['permission']==3||$Row['permission']==1)) {echo "checked";} ?>>
            </div>
            <div class="form-group col-md-3">
                    <input type="submit" name="submit" style="border:none; border-radius:5px;" class="btn btn-primary">
            </div>
            </table>
            
        </form>
        <table border="1" class="table table-info">
            <tr>
                <th>Sr.No</th>
                <th>UserName</th>
                <th>Password</th>
                <th>Permissions</th>
                <th>Action</th>
                
            </tr>
            <?php
                $q=mysqli_query($con,"select * from user order by id desc");
                $i=0;
                while($r=mysqli_fetch_array($q)){
                $i++;
             ?>
                    <tr>
                        <td><?=$i?></td>
                        <td><?=$r['username'];?></td>
                        <td><?=$r['password'];?></td>
                        <td><?php if($r['permission']==3||$r['permission']==2) {echo "Delete";} ?> / <?php if($r['permission']==3||$r['permission']==1) {echo "Edit";} ?></td>
                        <td><a href="user.php?doid=<?=$r['id'];?>" class="text-success"><i class="fa fa-pencil"></i></a> &nbsp;&nbsp;&nbsp; <a href="user.php?did=<?=$r['id'];?>" class="text-danger"><i class="fa fa-close"></i></a></td>
                    </tr>
            <?php
                } 
            ?>
        </table>
        
<?php
include("include/footer.php")
?>
                