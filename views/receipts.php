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
            include("../public/load_receipts.php");

            list($bool,$dates) = load_receipts($_SESSION['email']);
            
            if($bool == 'true') { ?>
            
            <div class="container billing_div" >
                <h3>Your Previous Bills (Paid)</h3>
                <?php foreach ($dates as $d): ?>
                    <form action="../public/load_receipts.php" method="post">
                        <input type="hidden" name="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>">
                        <input type="hidden" name="billing_date" value="<?php echo htmlspecialchars($d['formatted_date']); ?>">
                        <button type="submit" name="show_receipt"><?php echo htmlspecialchars($d['formatted_date']); ?></button><br>
                    </form>
                <?php endforeach; ?>
            </div>
            <?php } else {?>
                <div class="container error_msg">
                    <h3><?php echo $dates; ?></h3>
                </div>
            <?php } ?>


        </div>

    </div>

    <footer >
        <?php include('../includes/footer.php'); ?>
    </footer>
    

</body>
</html>