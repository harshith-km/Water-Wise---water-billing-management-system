<?php
    include("../public/load_dashboard.php");
    if(session_status()==PHP_SESSION_NONE){
        session_start();
    }
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
        .payment {
            width: 300px;
            text-align: center;
        }
        .payment select{
            margin-top: 5px;
            width: 100%;
            text-align: center;
        }

        .payment span{
            text-align: center;
            font-size: 18px;
            font-weight: 600;
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
                list($bool,$bill) = load($_SESSION['email']);  

                if(isset($_GET['pay_type'])){
                    if($_GET['pay_type'] == 'pay_full'){
                        $pay = $bill['net_amount'];
                        $pay_type = 'pay_full';
                    }
                    if($_GET['pay_type'] == 'pay_due'){
                        $pay = $bill['due'];
                        $pay_type = 'pay_due';
                    }                    
                }              
                ?>

                <form action="../public/load_dashboard.php" method="post" class="container payment">
                    <span>Select The Payment Method</span>
                    <select name="payment_method" required>
                        <option>--Select Here--</option>
                        <option value="wallet">Wallet</option>
                        <option value="upi">UPI</option>
                        <option value="debit">Debit card</option>
                        <option value="paylater">Pay Later</option>
                    </select>
                    <input type="hidden" name="billing_date" value="<?php echo htmlspecialchars($bill['billing_date'])?>">
                    <input type="hidden" name="pay" value="<?php echo htmlspecialchars($pay)?>">
                    <input type="hidden" name="email" value="<?php echo htmlspecialchars($email)?>">
                    <input type="hidden" name="pay_type" value="<?php echo htmlspecialchars($pay_type); ?>">
                    <button type="submit" name="pay_bill" class="button">Pay <?php echo htmlspecialchars($pay); ?></button>
                </form>
     
        </div>

    </div>

    <footer >
        <?php include('../includes/footer.php'); ?>
    </footer>
    

</body>
</html>