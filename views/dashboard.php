<?php
    session_start();
    if(!isset($_SESSION['email'])){
        header('Location: login.php');
    }
    $email = $_SESSION['email'];
    include("../public/load_dashboard.php");
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .bill{
            width: 260px;
            margin: 15px;
        }
        .bill .item {
            padding: 5px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
        }
        .dashboard_msg{
            margin: 15px;
        }
        .success_msg{
            color: green;
        }
        .error_msg{
            color: red;
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
           
        <?php 
            if(isset($_SESSION['bill_pay_status']) ){
                if($_SESSION['bill_pay_status'] == 'true') {?>
                    <div class="success_msg">
                        <h5><?php echo "Success! You have paid your water bill of ₹".$_SESSION['bill_pay_amount']." using your wallet. <br>Your Current wallet balance is ".$_SESSION['bill_pay_result']; ?></h5>
                    </div>
                <?php }else { ?>
                    <div class="error_msg">
                            <h5><?php echo $_SESSION['bill_pay_result']; ?></h5>
                    </div>
            <?php }
            unset($_SESSION['bill_pay_status']);
            unset($_SESSION['bill_pay_result']); 
            } 
            if(list($bool,$bill) = load($_SESSION['email']) ){ 
                if($bool == 'true'){  ?>

                    <form action="../public/load_dashboard.php" method="post"  class="container bill">
                        <div class="item"><span><b>Billing Date:</b></span> <?php echo htmlspecialchars($bill['billing_date']); ?></div>
                        <div class="item"><span><b>Water Used:</b></span> <?php echo htmlspecialchars($bill['water_used']); ?> L</div>
                        <div class="item"><span><b>Usage Cost:</b></span> <?php echo htmlspecialchars($bill['usage_cost']); ?> Rs</div>
                        <div class="item"><span><b>Previous balance:</b></span> <?php echo htmlspecialchars($bill['due']); ?> Rs</div>
                        <div class="item"><span><b>Total amount:</b></span> <?php echo htmlspecialchars($bill['net_amount']); ?> Rs</div>
                        
                        <input type="hidden" name="billing_date" value="<?php echo htmlspecialchars($bill['billing_date']); ?>">
                        <input type="hidden" name="due" value="<?php echo htmlspecialchars($bill['due']); ?>">
                        <input type="hidden" name="net_amount" value="<?php echo htmlspecialchars($bill['net_amount']); ?>">
                        <input type="hidden" name="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>">
                        
                        <button type="submit" name="pay_full" value="Pay Full" class="button">Pay Full <?php echo htmlspecialchars($bill['net_amount']); ?> rs</button>
                        <?php if($bill['due']>0){ ?>
                            <button type="submit" name="pay_due"  class="button">Pay Due <?php echo htmlspecialchars($bill['due']); ?> Rs</button>
                        <?php } ?>
                    </form>

                <?php }else{
                    if($bool == 'false') { ?>
                        <div class="container dashboard_msg">
                            <h3><?php echo $bill['error']; ?></h3>
                        </div>
                    <?php } 
                } 
            }?>

        </div>

    </div>

    <footer >
        <?php include('../includes/footer.php'); ?>
    </footer>
    

</body>
</html>