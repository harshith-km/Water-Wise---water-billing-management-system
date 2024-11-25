<?php
    session_start();
    if(!isset($_SESSION['email'])){
        header('Location: login.php');
    }
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
    .settings_form{
        padding: 20px;
        border-radius: 10px;
    }
    .settings_form h3{
        text-align: center;
        margin-bottom: 15px;
    }
     .inputgroup{
        font-size: 17px;
        width: 340px;
        display: flex;
        justify-content: space-between;
        align-items: end;
        margin-bottom: 5px;
        /* border: 1px solid; */
    }
    .inputgroup input{
        padding: 2px 8px;
        width: 50%;
    }
    </style>
</head>
<body>
    <header>
        <?php include('../includes/header.php'); ?>
    </header>

    <div class="maindiv">

            <?php include('../includes/navbar.php'); ?>

        <div class="contentarea">

                <form action="../scripts/process.php" method="post" class="container settings_form">
                    <h3>Enter New Information To Update</h3>

                    <div class="inputgroup">
                        <label for="">Enter New Email Id</label>
                        <input type="email" placeholder="Enter New Email" required name="newemail">
                    </div>
                    <div class="inputgroup">
                        <label for="">Enter New Address</label>
                        <input type="text" placeholder="Enter New Address" required name="newaddress">
                    </div>
                    <div class="inputgroup">
                        <label for="">Enter New password</label>
                        <input type="password" placeholder="Enter New Password" required name="newpassword">
                    </div>
                    <div class="inputgroup">
                        <label for="">Confirm New password</label>
                        <input type="password" placeholder="Confirm New Password" required name="cpassword">
                    </div>

                    <button type="submit" name="updateDetails" id="settiingsbtn" >UPDATE</button>
                </form>

        </div>

    </div>

    <footer >
        <?php include('../includes/footer.php'); ?>
    </footer>
    

</body>
</html>