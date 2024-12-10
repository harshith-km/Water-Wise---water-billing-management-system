<?php 
include("../includes/connect.php");
?>

<?php
    if (isset($_GET['user_id'])) {
        $id = $_GET['user_id']; 
    }
    $email = '';
?>
        

<div>
<h3>User Information</h3>
    <?php
        $fetch_user_data = "SELECT * FROM users
                        WHERE id = $id ";
        $res = $conn->query($fetch_user_data);
        if ($res->num_rows >0){
            while($row = $res->fetch_assoc()){  ?>
            <table border='1'>
                <tr>
                    <th>ID </th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Registerd date</th>
                </tr>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['fname']; ?></td>
                    <td><?php echo $row['lname']; ?></td>
                    <td><?php echo $row['email']; $email = $row['email']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['regdate']; ?></td>
                </tr>

            </table>
            <?php }
        }else{
            echo"No user data Found";
        }
    ?>
</div>
<br>
<br>

<div>
    <h3>Wallet Statements</h3>
    <?php 
        $fetch_wallet = "SELECT * FROM wallet WHERE `email` = '$email'"; 
        $res = $conn->query($fetch_wallet);
        
        if ($res->num_rows > 0) {
    ?>
        <table border='1'>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Credit</th>
                <th>Debit</th>
                <th>Wallet Balance</th>
                <th>Transaction Date</th>
            </tr>
            <?php while($row = $res->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['credit']; ?></td>
                <td><?php echo $row['debit']; ?></td>
                <td><?php echo $row['wallet_bal']; ?></td>
                <td><?php echo $row['added_on']; ?></td>
            </tr>
            <?php } ?>
        </table>
    <?php
        } else {
            echo "No records found.";
        }
    ?>
</div>
<br>
<br>

<div>
    <h3>Callback Requests</h3>
    <?php 
    $fetch_cbr = "SELECT * FROM callback_request WHERE `email`= '$email'";
    $res = $conn->query($fetch_cbr);

    if($res->num_rows >0){ ?>
    <table border='1'>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Problem</th>
                <th>Description</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Status</th>
                <th>date</th>
            </tr>
            <?php while($row=$res->fetch_assoc()){ ?>
                <tr>
                <th><?php echo $row['id'];  ?></th>
                <th><?php echo $row['email'];  ?></th>
                <th><?php echo $row['problem'];  ?></th>
                <th><?php echo $row['description'];  ?></th>
                <th><?php echo $row['name'];  ?></th>
                <th><?php echo $row['phone_no'];  ?></th>
                <th><?php echo $row['status'];  ?></th>
                <th><?php echo $row['createdon'];  ?></th>
                </tr>
            
            
            <?php } ?>
    </table>
    <?php }else{
        echo"No records found";
    } ?>
</div>
<br>
<br>

<div>
    <h3>Water Usage</h3>
    <?php 
    $fetch_water_usage = "SELECT * FROM water_usage WHERE `email` = '$email'";
    $res = $conn->query($fetch_water_usage);
    
    if($res->num_rows >0){ ?>
    <table border=1>
        <tr>
            <th>Usage ID</th>
            <th>Email</th>
            <th>Water Used</th>
            <th>Usage Type</th>
            <th>Billing Date</th>
        </tr>
   
    <?php while($row = $res->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $row['usage_id'];  ?></td>
            <td><?php echo $row['email'];  ?></td>
            <td><?php echo $row['water_used'];  ?></td>
            <td><?php echo $row['usage_type'];  ?></td>
            <td><?php echo $row['billing_date'];  ?></td>
        </tr>
        <?php } ?>
    </table>
    
        

    <?php }
  ?>
</div>

   
