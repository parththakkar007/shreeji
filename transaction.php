<?php
    include("include/header.php");
     if(!empty($_REQUEST['did'])){
        $did=$_REQUEST['did'];
        mysqli_query($con,"delete from transaction where id='$did'");
        header("location:view_transaction.php");
    }
    if(!empty($_REQUEST['doid'])){
        $do="EditTransaction";
        $doid=$_REQUEST['doid'];
        $Query=mysqli_query($con,"select * from transaction where id='$doid'");
        $Row=mysqli_fetch_array($Query);
    }else{

  
        $do="AddTransaction";
        $doid='';
    }
?>
        <style>
        .select2-results__option {
            color:black;
        }
        .table{
            color:black;
        }
        label{
            font-size:12px;
            margin-bottom:0px;
        }
        .form-group{
            padding-bottom:0px;
        }
       </style>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
        <center><h6>Transaction<h6></center>
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
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <form action="action.php" method="post">
                    <input type="hidden" name="do" value="<?php echo $do;?>">
                    <input type="hidden" name="doid" value="<?php echo $doid;?>">            
                    <div class="form-group" >
                        <label>Date</label>
                        <input type="date" name="date" step="any" class="form-control " style="border:none; border-radius:5px;" value="<?php if(isset($_REQUEST['doid'])) {echo $Row['date'];}else { echo date("Y-m-d");}?>"/>
                        
                    </div>
                    <div class="form-group">
                            <label>Party Name</label>
                            <select name="party_id" class="form-control" id="party_id" style="border:none; border-radius:5px;">
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
                    <div class="form-group type" style="margin-top:250px;">
                        <label>Type</label><br>
                        <input type="radio" name="type"  value="credit" <?php if((!empty($_REQUEST['doid'])&&$Row['type']=="credit")||$_SESSION['transaction_type']=="credit"){ echo "checked"; } ?> />Credit
                        <input type="radio" name="type"  value="debit" <?php if((!empty($_REQUEST['doid'])&&$Row['type']=="debit")||$_SESSION['transaction_type']=="debit"){ echo "checked"; } ?> />Debit
                    </div>
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="text" name="amount" class="form-control" style="border:none; border-radius:5px;" value="<?php if(isset($_REQUEST['doid'])) {echo $Row['amount'];}?>"/>
                    </div>
                    <div class="form-group">
                        <label>Remarks</label>
                        <textarea class="form-control" name="remark"><?php if(!empty($_REQUEST['doid'])) {echo $Row['remark'];} ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Bank</label>
                        <select name="bank" class="form-control">
                            <option>- - Select Bank - -</option>
                            <?php
                                $bankQ=mysqli_query($con,"select name,id from bank order by id desc");
                                while($bankR=mysqli_fetch_array($bankQ)){
                            ?>
                                <option value="<?=$bankR['id'];?>" <?php if(!empty($_REQUEST['doid'])){ echo "selected"; }?>><?=$bankR['name'];?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-primary">
                    </div>
                    </table>
                    
                </form>
            </div>
            <div class="table-responsive col-md-8" style="background-color:white;border-radius:5px;">
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
                        $transaction=mysqli_query($con,"select * from transaction where date=CURDATE() order by id desc");
                         $i=0;
                        while($r=mysqli_fetch_array($transaction)){
                       
                        $i++;
                    ?>
                        <tr>
                            <td><?=$i?></td>
                            <td><?=date("d-m-Y",strtotime($r['date']));?></td>
                            <td>
                                <?php
                                $name=mysqli_fetch_array(mysqli_query($con,"select name  from party where id='".$r['party_id']."'"))['name'];
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
    </div>
<?php
include("include/footer.php")
?>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
    // $(document).ready(function(){
    //     $("#party_id").select2({
    //         tags:true
    //     }); 
    //     $("#party_id").select2("open");
    //     $('.table').dataTable({
    //         "pageLength": 50
    //     });
    // });
    $(document).ready(function(){
        $("#party_id").select2({
            tags:true,
            createTag: function (params) {
                var term = $.trim(params.term);
                if (term ===''||term.charCodeAt(term.length-1)!=43) {
                  return null;
                }
                if(term.charCodeAt(term.length-1)==43){
                    term=term.substring(0,term.length-1);
                }
                
                var newOption = new Option(term,term, false, false);
                $('#party_id').append(newOption).trigger('change');
                $('#party_id').val(term);
                return {
                  id: term,
                  text: term,
                  newTag: true // add additional parameters
                }
              }
        }); 
        $("#party_id").select2("open");
        $('.table').dataTable({
            "pageLength": 50
        });
    });
</script>
                