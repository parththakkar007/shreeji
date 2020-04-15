<?php
    include("include/header.php");
      if(!empty($_REQUEST['did'])){
        $did=$_REQUEST['did'];
        mysqli_query($con,"delete from party where id='$did'");
        header("location:view_party.php");
    }

    if(!empty($_REQUEST['doid'])){
        $do="EditParty";
        $doid=$_REQUEST['doid'];
        $Query=mysqli_query($con,"select * from party where id='$doid'");
        $Row=mysqli_fetch_array($Query);
    }else{

  
        $do="AddParty";
        $doid='';
    }
?>
        
        <center><h1>Party<h1></center>
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
                <label>Name</label>
                <input type="text" name="name" step="any" class="form-control" style="border:none; border-radius:5px;" value="<?php if(isset($_REQUEST['doid'])) {echo $Row['name'];}?>"/>
                
            </div>
            <div class="form-group col-md-3">
                    <label>Mobile No</label>
                    <input type="number" name="mobile" class="form-control" style="border:none; border-radius:5px;" value="<?php if(isset($_REQUEST['doid'])) {echo $Row['mobile'];}?>" />
            </div>
            <div class="form-group col-md-3">
                    <label>City</label>
                    <input type="text" name="city" class="form-control" style="border:none; border-radius:5px;" value="<?php if(isset($_REQUEST['doid'])) {echo $Row['city'];}?>"/>
            </div>
            <div class="form-group col-md-3">
                    <input type="submit" name="submit" class="btn btn-primary">
            </div>
            </table>
            
        </form>
        
<?php
include("include/footer.php")
?>
                