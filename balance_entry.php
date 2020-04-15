<?php
    include("include/header.php");
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<style>
    .table{
        color:black;
    }
    td{
        padding:10px;
    }
    td input{
        border:none;
        border-radius:3px;
    }
    .notes{
        padding:5px;
    }
</style>
    <div class="container">
        <center><h1>Balance Entry<h1></center>
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
        <div class="table-responsive" style="background-color:white;">
        <table border="1" class="table table-info">
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Date</th>
                    <th>Opening</th>
                    <th>Opening Error</th>
                    <th>Opening Action</th>
                    <th>Actual Closing</th>
                    <th>Closing</th>
                    <th>Closing Error</th>
                    <th>Action</th>
                </tr>
            </thead>  
            <tbody>    
                <tr>
                    <td></td>
                    <td></td>
                    <td><button type="button" class="btn btn-info btn-lg opening_balance" data-toggle="modal" data-target="#myModal1">Add Opening Balance</button></td>
                    <td></td>
                    <td></td>
                    <td>
                        <?php
                            $todayopening=mysqli_fetch_array(mysqli_query($con,"select opening from opening_balance order by id desc limit 1"))['opening'];
                            $credit=mysqli_fetch_array(mysqli_query($con,"select sum(amount) as total from transaction where type='credit' AND date=CURDATE()"))['total'];
                            $debit=mysqli_fetch_array(mysqli_query($con,"select sum(amount) as total from transaction where type='debit' AND date=CURDATE()"))['total'];
                        ?>
                        <?=$todayopening+$credit-$debit;?>
                    </td>
                    <td>
                        <button type="button" class="btn btn-info btn-lg closing_balance" data-preview="<?=$todayopening+$credit-$debit;?>" data-toggle="modal" data-target="#myModal">Add Closing Balance</button>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
            <?php
                $transaction=mysqli_query($con,"select id,opening,closing,date from opening_balance order by id desc");
                $transactionN=mysqli_num_rows($transaction);
                $i=0;
                while($r=mysqli_fetch_array($transaction)){
                    $i++;
                    $last_closing=mysqli_fetch_array(mysqli_query($con,"select closing from opening_balance where id<'".$r['id']."' order by id desc limit 1"))['closing'];
                    if($i==$transactionN){
                        $today_opening=$last_closing;
                    }else{
                        $today_opening=$r['opening'];
                    }
            ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><?=date("d-m-Y",strtotime($r['date']));?></td>
                    <td style="<?php if(($today_opening-$last_closing)!=0){echo "color:red;font-weight:bold;"; }?>"><?=$r['opening'];?></td>
                    <td style="<?php if(($today_opening-$last_closing)!=0){echo "color:red;font-weight:bold;"; }?>"><?=$today_opening-$last_closing; ?></td>
                    <td>
                        <button class="btn btn-success opening_edit_btn" data-val="<?=$r['id'];?>" type="button" data-toggle="modal" data-target="#myModal1"><i class="fa fa-pencil" style="color:green;"></i></button>
                    </td>
                    <td>
                        <?php
                            $credit_loop=mysqli_fetch_array(mysqli_query($con,"select sum(amount) as total from transaction where type='credit' AND date='".$r['date']."'"))['total'];
                            $debit_loop=mysqli_fetch_array(mysqli_query($con,"select sum(amount) as total from transaction where type='debit' AND date='".$r['date']."'"))['total'];
                            echo $r['opening']+$credit_loop-$debit_loop;
                        ?>
                    </td>
                    <td style="<?php if(($r['opening']+$credit_loop)-($r['closing']+$debit_loop)!=0){echo "color:red;font-weight:bold;"; }?>"><?=$r['closing']?></td>
                    <td style="<?php if(($r['opening']+$credit_loop)-($r['closing']+$debit_loop)!=0){echo "color:red;font-weight:bold;"; }?>"><?=($r['opening']+$credit_loop)-($r['closing']+$debit_loop);?></td>
                    <td>
                        <button class="btn btn-success edit" data-val="<?=$r['id'];?>" type="button" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil" style="color:green;"></i></button>
                    </td>
                </tr>            
            <?php
                    $last_closing=$r['closing'];
                }
            ?>
            </tbody>
        </table>
        </div>
        

<!-- Modal Closing Balance -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal Closing content-->
    <div class="modal-content" style="width:550px; border:none; border-radius:5px">
      <div class="modal-header">
        
        <h4 class="modal-title">Denomination</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="action.php" method="post">
            <input type="hidden" name="do" class="do" value="AddBalanceEntry" />
            <input type="hidden" name="upid" class="upid" value="" />
            <center>Date:<input type="date" name="date" style="border:none; border-radius:3px; padding:0px 8px;" class="form_control date" value="<?=date("Y-m-d");?>">
                Actual Closing: <span class="amount_preview"></span>
            </center>
            <table style="margin-top:20px;">
                <tr>
                    <td>200:</td>
                    <td><input type="number" name="note200" class="notes" value="0">
                    <input type="hidden" value="200"></td>
                    <td>50:</td>
                    <td><input type="number" name="note50" class="notes" value="0">
                    <input type="hidden" value="50"></td>
                </tr>
                <tr>
                    <td>20:</td>
                    <td><input type="number" name="note20" class="notes" value="0">
                    <input type="hidden" value="20"></td>
                    <td>10:</td>
                    <td><input type="number" name="note10" class="notes" value="0">
                    <input type="hidden" value="10"></td>
                </tr>
                <tr>
                    <td>5:</td>
                    <td><input type="number" name="note5" class="notes" value="0">
                    <input type="hidden" value="5"></td>
                    <td>2:</td>
                    <td><input type="number" name="note2" class="notes" value="0">
                    <input type="hidden" value="2"></td>
                </tr>
                <tr>
                    <td>1:</td>
                    <td><input type="number" name="note1" class="notes" value="0">
                    <input type="hidden" value="1"></td>
                    <td>Amount:</td>
                    <td> <input type="number" name="d_amount" style="padding:5px;" id="d_amount" value="0" placeholder="Enter Amount"></td>
                </tr>
            </table>
            <center><button type="submit" style="border-radius:5px; padding:8px 30px; margin-top:10px;" class="btn btn-primary save_btn">Save</button></center>
        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>

<!-- Modal Opening Balance -->
<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal Opening content-->
    <div class="modal-content" style="width:550px; border:none; border-radius:5px">
      <div class="modal-header">
        <h4 class="modal-title">Opening Balance</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="action.php" method="post">
            <input type="hidden" name="do" class="opening_do" value="AddOpeningBalance" />
            <input type="hidden" name="upid" class="opening_upid" value="" />
            <center>Date:<input type="date" name="opening_date" style="border:none; border-radius:3px; padding:8px;" class="form_control opening_date" value="<?=date("Y-m-d");?>">
            
            <table style="margin-top:20px;">
                <tr>
                    <td>Amount:</td>
                    <td> <input type="number" name="opening" style="padding:5px;" id="opening" value="0" placeholder="Enter Amount"></td>
                </tr>
            </table>
            </center>
            <center><button type="submit" style="border-radius:5px; padding:8px 30px; margin-top:10px;" class="btn btn-primary save_btn">Save</button></center>
        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
    </div>
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
    $(".notes").focus(function(){
        $(this).select();
    });
    $(".notes").keyup(function(){
        if($(this).val()==""){
            $(this).val(0);
            $(this).select();
        }
        var sum=0;
        var note_value=0;
        for(var i=0;i<$(".notes").length;i++){
            note_value=parseInt($($(".notes")[i]).next().val());
            sum+=parseInt($($(".notes")[i]).val()*note_value);
        }
        $("#d_amount").val(sum);
    });
    $(".edit").click(function(){
        $(".date").prop("disabled",true);
        $(".do").val("EditBalanceEntry");
        var upid=$(this).data("val");
        $.ajax({
            cache:false,
            type:"post",
            url:"json_balance_entry.php",
            data:{'upid':upid,'do':'ClosingBalance'},
            dataType:"json",
            success:function(response){
                $("input[name='note200']").val(response.note200);
                $("input[name='note50']").val(response.note50);
                $("input[name='note20']").val(response.note20);
                $("input[name='note10']").val(response.note10);
                $("input[name='note5']").val(response.note5);
                $("input[name='note2']").val(response.note2);
                $("input[name='note1']").val(response.note1);
                $("input[name='date']").val(response.date);
                $(".upid").val(response.id);
                var sum=0;
                var note_value=0;
                for(var i=0;i<$(".notes").length;i++){
                    note_value=parseInt($($(".notes")[i]).next().val());
                    sum+=parseInt($($(".notes")[i]).val()*note_value);
                }
                $("#d_amount").val(sum);
            }
        });
    });
    $(".closing_balance").click(function(){
        $(".amount_preview").html($(this).data("preview"));
        $(".date").prop("disabled",false);
        var now = new Date();
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
        $(".date").val(today);
        $(".do").val("AddBalanceEntry");
        $(".upid").val("");
        for(var i=0;i<$(".notes").length;i++){
            $($(".notes")[i]).val(0);
            $("#d_amount").val(0);
        }
    });
    
    //opening balance configuration
    $(".opening_edit_btn").click(function(){
        $(".opening_date").prop("disabled",true);
        $(".opening_do").val("EditOpeningBalance");
        var upid=$(this).data("val");
        $.ajax({
            cache:false,
            type:"post",
            url:"json_balance_entry.php",
            data:{'upid':upid,'do':"OpeningBalance"},
            dataType:"json",
            success:function(response){
                $("input[name='opening']").val(response.opening);
                $("input[name='opening_date']").val(response.date);
                $(".opening_upid").val(response.id);
            }
        });
    });
    $(".opening_balance").click(function(){
        $(".opening_date").prop("disabled",false);
        var now = new Date();
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
        $(".opening_date").val(today);
        $(".opening_do").val("AddOpeningBalance");
        $(".opening_upid").val("");
        $("#opening").val(0);
    });
});
</script>
                