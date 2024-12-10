<?php
    include("../includes/connect.php");

    if(isset($_POST['add_bill'])){
        $email =  $_POST['email'];
        $water_used = $_POST['water_used'];
        $usage_type = $_POST['usage_type'];
        $billing_date = $_POST['billing_date'];
        $usage_cost = (int)$water_used*0.0075;
        $due = (int)0;
        if(isset($_POST['due'])){
            $due = $_POST['due'];
        }

        $net_amount = (int)$usage_cost + (int)$due;
        $payment_status = $_POST['payment_status'];

        $add_water_usage = "INSERT INTO water_usage(email,water_used,usage_type,billing_date)
                            VALUES('$email','$water_used','$usage_type','$billing_date')";
        
        $add_billing_transactions = "INSERT INTO billing_transactions(email,billing_date,usage_cost,due,net_amount,payment_status)
                                    VALUES('$email','$billing_date','$usage_cost','$due','$net_amount','$payment_status')";
        if($conn->query($add_water_usage) && $conn->query($add_billing_transactions)){
            echo"Water usage data and Water Bill Added successfully<br> <a href='../views/admin.php'><button>Back to Admin Page</button></a>";
        }else{
            echo"Error while adding bill".$conn->error;
        }
    }