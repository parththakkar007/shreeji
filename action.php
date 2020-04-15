<?php
    include('include/config.inc.php');
    session_start();
    $do=$_REQUEST['do'];
    switch($do){
        case "Bank":
            $name=$_REQUEST['name'];
            $holder=$_REQUEST['holder'];
            
            $q=mysqli_query($con,"insert into bank(name,holder) values ('$name','$holder')");
            
            if($q){
                $_SESSION['msg']="Record Inserted Succesfully";
                header("location:bank.php");
            }else{
                $_SESSION['msg']="Record Inserted Fail";
                header("location:bank.php");
            }
        break;
        case "EditBank":
            $name=$_REQUEST['name'];
            $holder=$_REQUEST['holder'];
            $doid=$_REQUEST['doid'];
            
            $q=mysqli_query($con,"update bank set name='$name',holder='$holder' where id=$doid");
            
            if($q){
                $_SESSION['msg']="Record Updated Succesfully";
                header("location:bank.php");
            }else{
                $_SESSION['msg']="Record Update Failed";
                header("location:bank.php");
            }
        break;
        case "AddEntry":
                $amount=$_REQUEST['amount'];
                $date=$_REQUEST['date'];
            
            $q=mysqli_query($con,"insert into initial_opening(amount,date)
                                    values('$amount','$date')");
            
            if($q){
                $_SESSION['msg']="Record Inserted Succesfully";
                header("location:initial_opening.php");
            }else{
                $_SESSION['msg']="Record Inserted Fail";
                header("location:initial_opening.php");
            }
            break;
            
        case "AddParty":
                    $name=$_REQUEST['name'];
                    $mobile=$_REQUEST['mobile'];
                    $city=$_REQUEST['city'];
                
                $q=mysqli_query($con,"insert into party(name,mobile,city)
                                        values('$name','$mobile','$city')");
                
                if($q){
                    $_SESSION['msg']="Record Inserted Succesfully";
                    header("location:party.php");
                }else{
                    $_SESSION['msg']="Record Inserted Fail";
                    header("location:party.php");
                }
                break;
        case "EditParty":
         
            $name=$_REQUEST['name'];
            $mobile=$_REQUEST['mobile'];
            $city=$_REQUEST['city'];
            $doid=$_REQUEST['doid'];
            
            $q=mysqli_query($con,"update party set name='".$name."',mobile='".$mobile."',city='".$city."' where id='$doid'");
            
            if($q){
                $_SESSION['msg']="Record Updated Succesfully";
                header("location:view_party.php");
            }else{
                $_SESSION['msg']="Record Updated Fail";
                header("location:view_party.php");
            }
            break;
        case "AddTransaction":
                $date=$_REQUEST['date'];
                $party_id=$_REQUEST['party_id'];
                $type=$_REQUEST['type'];
                $remark=$_REQUEST['remark'];
                $amount=$_REQUEST['amount'];
                $bank=$_REQUEST['bank'];
                if(!is_numeric($party_id)){
                    $Q=mysqli_query($con,"insert into party(name) values('$party_id')");
                    $party_id=$con->insert_id;
                    
                }
                if($type=="credit"){
                    $_SESSION['transaction_type']=$type;
                }
                if($type=="debit"){
                    $_SESSION['transaction_type']=$type;
                }
                $q=mysqli_query($con,"insert into transaction(date,party_id,type,amount,remark,bank)
                                        values('$date','$party_id','$type','$amount','$remark','$bank')");
                
                if($q){
                    $_SESSION['msg']="Record Inserted Succesfully";
                    header("location:transaction.php");
                }else{
                    $_SESSION['msg']="Record Insertion Fail";
                    header("location:transaction.php");
                }
                break;
        case "EditTransaction":
         
            $date=$_REQUEST['date'];
            $party_id=$_REQUEST['party_id'];
            $type=$_REQUEST['type'];
            $amount=$_REQUEST['amount'];
            $remark=$_REQUEST['remark'];
            $bank=$_REQUEST['bank'];
            $doid=$_REQUEST['doid'];
            
            $q=mysqli_query($con,"update transaction set bank='$bank',remark='$remark',date='".$date."',party_id='".$party_id."',type='".$type."',amount='".$amount."' where id='$doid'");
            
            if($q){
                $_SESSION['msg']="Record Updated Succesfully";
                header("location:view_transaction.php");
            }else{
                $_SESSION['msg']="Record Updated Fail";
                header("location:view_transaction.php");
            }
            break;
         case "AddUser":
            $username=$_REQUEST['username'];
            $password=$_REQUEST['password'];
            $permissionA=$_REQUEST['permission'];
            $permissoin=0;
            if(in_array('delete',$permissionA)&&in_array('edit',$permissionA)){
                $permission=3;
            }else if(in_array('delete',$permissionA)){
                $permission=2;
            }else if(in_array('edit',$permissionA)){
                $permission=1;
            }else{
                $permissoin=0;
            }
            
            $q=mysqli_query($con,"insert into user(username,password,permission)
                                    values('$username','$password',$permission)");
            
            if($q){
                $_SESSION['msg']="Record Inserted Succesfully";
                header("location:user.php");
            }else{
                $_SESSION['msg']="Record Inserted Fail";
                header("location:user.php");
            }
            break;
            
        case "EditUser":
         
            $username=$_REQUEST['username'];
            $password=$_REQUEST['password'];
            $permissionA=$_REQUEST['permission'];
            $permissoin=0;
            if(in_array('delete',$permissionA)&&in_array('edit',$permissionA)){
                $permission=3;
            }else if(in_array('delete',$permissionA)){
                $permission=2;
            }else if(in_array('edit',$permissionA)){
                $permission=1;
            }else{
                $permissoin=0;
            }
            $doid=$_REQUEST['doid'];
            
            $q=mysqli_query($con,"update user set permission=$permission,username='".$username."',password='".$password."' where id='$doid'");
            
            if($q){
                $_SESSION['msg']="Record Updated Succesfully";
                header("location:user.php");
            }else{
                $_SESSION['msg']="Record Updated Fail";
                header("loation:user.php");
            }
            break;
        case "EditBalanceEntry":
            $note200=$_REQUEST['note200'];
            $note50=$_REQUEST['note50'];
            $note20=$_REQUEST['note20'];
            $note10=$_REQUEST['note10'];
            $note5=$_REQUEST['note5'];
            $note2=$_REQUEST['note2'];
            $note1=$_REQUEST['note1'];
            $d_amount=$_REQUEST['d_amount'];
            $doid=$_REQUEST['upid'];
            $q=mysqli_query($con,"update opening_balance set note200='".$note200."',note50='".$note50."',note20='".$note20."',note10='".$note10."',note5='".$note5."',note2='".$note2."',note1='".$note1."',closing='".$d_amount."' where id='$doid'");
            
            if($q){
                $_SESSION['msg']="Record Updated Succesfully";
                header("location:balance_entry.php");
            }else{
                $_SESSION['msg']="Record Updated Fail";
                header("loation:balance_entry.php");
            }
            break;
        case "AddBalanceEntry":
                $note200=$_REQUEST['note200'];
                $note50=$_REQUEST['note50'];
                $note20=$_REQUEST['note20'];
                $note10=$_REQUEST['note10'];
                $note5=$_REQUEST['note5'];
                $note2=$_REQUEST['note2'];
                $note1=$_REQUEST['note1'];
                $date=$_REQUEST['date'];
                $d_amount=$_REQUEST['d_amount'];
                $upid=mysqli_fetch_array(mysqli_query($con,"select id from opening_balance order by id desc limit 1"))['id'];
                
            if(!empty(mysqli_fetch_array(mysqli_query($con,"select closing from opening_balance where date='$date'"))['closing'])){
                $_SESSION['msg']="Closing Balance already set for $date";
            }else{
                $todayopening=mysqli_fetch_array(mysqli_query($con,"select opening from opening_balance where date='$date'"))['opening'];
                $credit=mysqli_fetch_array(mysqli_query($con,"select sum(amount) as total from transaction where type='credit' AND date='$date'"))['total'];
                $debit=mysqli_fetch_array(mysqli_query($con,"select sum(amount) as total from transaction where type='debit' AND date='$date'"))['total'];
                $actual_closing=$totayopening+$credit-$debit;
                $q=mysqli_query($con,"update opening_balance set note200='$note200',note50='$note50',note20='$note20',
                    note10='$note10',note5='$note5',note2='$note2',note1='$note1',date='$date',closing='$d_amount',actual_closing='$actual_closing' where id='$upid'");
                if($q){
                    $_SESSION['msg']="Record Inserted Succesfully";
                }else{
                    $_SESSION['msg']="Record Inserted Fail";
                }
            }
            header("location:balance_entry.php");
            break;
        case "AddOpeningBalance":
                $amount=$_REQUEST['opening'];
                $date=$_REQUEST['opening_date'];
            if(mysqli_num_rows(mysqli_query($con,"select opening from opening_balance where date='$date'"))>0){
                $_SESSION['msg']="Opening Balance already set for $date";
            }else{
                $q=mysqli_query($con,"insert into opening_balance(opening,date)
                                        values('$amount','$date')");
                if($q){
                    $_SESSION['msg']="Record Inserted Succesfully";
                }else{
                    $_SESSION['msg']="Record Inserted Fail";
                }
            }
            header("location:balance_entry.php");
            break;
        case "EditOpeningBalance":
                $amount=$_REQUEST['opening'];
                $upid=$_REQUEST['upid'];
            $q=mysqli_query($con,"update opening_balance set opening='".$amount."' where id='$upid'");
            
            if($q){
                $_SESSION['msg']="Record Updated Succesfully";
            }else{
                $_SESSION['msg']="Record Updated Fail";
            }
            header("location:balance_entry.php");
            break;
    }
                
?>