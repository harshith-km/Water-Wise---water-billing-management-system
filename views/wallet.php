<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if(!isset($_SESSION['email'])){
        header('Location: pages/login.php');
    }
    include("../public/load_wallet.php");
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .wallet{
            display: flex;
            flex-direction: column;
            text-align: center;
            margin: 10px 0px;
        }
        .success_msg{
            color: green;
            font-weight: bold;
        }
        .error_msg{
            color: red;
            font-weight: bold;
        }
        .wallet span{
            font-size: 23px;
            margin-bottom: 20px;
        }
        .wallet label{
            font-size: 19px;
        }
        .wallet p{
            margin: 0px;
            font-size: 14px;
        }
        .wallet input{
            margin-top: 10px;
            border: none;
            padding: 5px 10px;
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
            if(isset($_SESSION['wallet_update_status']) && $_SESSION['wallet_update_status'] == 'false'){ ?>
                <div class="error_msg">
                    <span >
                        <?php echo $_SESSION['wallet_update_result']; 
                        unset($_SESSION['wallet_update_status']);
                        unset($_SESSION['wallet_update_result']);?>
                    </span>
                </div>
            <?php }else{
                        if(isset($_SESSION['wallet_update_status']) && $_SESSION['wallet_update_status'] == 'true'){ ?>
                            <div class="success_msg">
                                <span >
                                    <?php echo $_SESSION['wallet_update_result'];
                                        unset($_SESSION['wallet_update_status']);
                                        unset($_SESSION['wallet_update_result']); ?>
                                </span>
                            </div>
                        <?php } 
              } ?>
           <?php
            

            list($bool,$wallet_bal) = load_wallet($_SESSION['email']);
            if($bool == 'true'){  ?>
                
                <form action="../public/load_wallet.php" method="post" class="container wallet">
                    <span><b>Wallet Balance: </b><?php echo "$wallet_bal Rs"; ?></span>
                    <div>
                        <label for="add_amt">Enter the amount</label>
                        <p>(minimum amount: 100 Rs)</p>
                    </div>
                    
                    <input type="number" name="credit" placeholder="Enter the amount" required>
                    <button type="submit" name="add_amount">Add Amount</button>
                </form>

            <?php }else{  ?>

                <div class="error_msg">
                    <h5><?php echo $wallet; ?></h5>
                </div>

            <?php } ?>
        
        </div>

    </div>

    <footer >
        <?php include('../includes/footer.php'); ?>
    </footer>
    

</body>
</html>