<?php
    session_start();
    if(!isset($_SESSION['email'])){
        header('Location: login.php');
    }
    $email = $_SESSION['email'];
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
    .callbackrequestform, .callbackrequestform #ip1{
        display: flex;
        flex-direction: column;
    }
    #ip1 select{
        padding: 3px ;
        text-align: center;
    }
    #ip1 label{
        margin-bottom: 3px;
    }
    .callbackrequestform #ip2{
        display: flex;
        justify-content: space-between;
        align-items: end;
    }
    #ip2 input{
        padding: 1px 5px;
    }
    .callbackrequestform .inputgroup{
        width: 100%;
        margin-bottom: 10px;
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


            <form action="../public/callbackrequest_form.php" method="POST" class="container callbackrequestform" id="callbackrequestform">
                <h3>Callback Request Form</h3>
                <div class="inputgroup" id="ip1">
                    <label for="slectproblem">Select Your Problem</label>
                    <select name="problem" name="problem" required>
                        <option value="">-select your problem here-</option>
                        <option value="def">Water Bill</option>
                        <option value="ghi">Payment</option>
                        <option value="jkl">Water Usage date</option>
                        <option value="mno">Wallet</option>
                        <option value="pqr">Receipts</option>
                        <option value="stu">User data</option>
                        <option value="vw">Water leakage</option>
                        <option value="xyz">Login / Register</option>
                    </select>
                </div>

                <div class="inputgroup" id="ip1">
                    <label for="problemdescription">Description of the problem</label>
                    <textarea name="description" cols="20" rows="4" required></textarea>
                </div>

                <div class="inputgroup" id="ip2">
                    <label for="name" id="ipl">Name </label>
                    <input type="text" name="name" placeholder="Enter Your Name" required>
                </div>

                <div class="inputgroup" id="ip2">
                    <label for="phone" id="ipl">Phone NO </label>
                    <input type="number" name="phone_no" placeholder="Enter Your Phone NO" required>
                </div>

                <input type="hidden" name="email" value="<?php echo$email; ?>">
                <button type="submit" name="callbackrequestbtn" >Request Callback</button>
            </form>
           

        </div>

    </div>

    <footer >
        <?php include('../includes/footer.php'); ?>
    </footer>
    

</body>
</html>