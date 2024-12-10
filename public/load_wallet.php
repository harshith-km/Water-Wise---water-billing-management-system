<?php

include("../includes/connect.php");
include("../classes/user.class.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(isset($_POST['add_amount'])){
    $credit = $_POST['credit'];
    $email = $_SESSION['email'];
    
    if($credit < 100){
        $_SESSION['wallet_update_status'] = 'false';
        $_SESSION['wallet_update_result'] = 'Please enter the amount greater than or equal to 100 Rs';
        echo $_SESSION['wallet_update_status'];
        echo $_SESSION['wallet_update_result'];
        header("Location: ../views/wallet.php");
    }
    else{
        $user = new Users($conn);
        list($bool,$wallet) = $user->update_wallet($email,$credit);
        $_SESSION['wallet_update_status'] = $bool;
        $_SESSION['wallet_update_result'] = $wallet;      
        header("Location: ../views/wallet.php");
    }
}

function load_wallet($email){
    global $conn;
    $user = new Users($conn);
    
    if(list($bool , $wallet) = $user->fetch_wallet($email)){
        return array($bool , $wallet);
    }
   
    
}