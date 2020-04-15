<?php
    include("include/header.php");
?>
        <table border="1" class="table table-info">
            <tr>
                <th>Sr.No</th>
                <th>Name</th>
                <th>Mobile No</th>
                <th>City</th>
                <th>Action</th>
            </tr>
            <?php
                $party=mysqli_query($con,"select * from party order by id desc");
                 $i=0;
                while($r=mysqli_fetch_array($party)){
               
                $i++;
            ?>
                <tr>
                        <td><?=$i?></td>
                        <td><?=$r['name'];?></td>
                        <td><?=$r['mobile'];?></td>
                        <td><?=$r['city'];?></td>
                        <td><a href="party.php?doid=<?=$r['id'];?>" class="text-success"><i class="fa fa-pencil"></i></a> &nbsp;&nbsp;&nbsp; <a href="party.php?did=<?=$r['id'];?>" class="text-danger"><i class="fa fa-close"></i></a></td>
                    </tr>            
            <?php
                }
            ?>
        </table>
            
<?php
include("include/footer.php")
?>