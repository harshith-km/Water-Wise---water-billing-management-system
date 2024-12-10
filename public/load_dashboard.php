<?php 
if(session_status()==PHP_SESSION_NONE){
    session_start();
}
require("../includes/connect.php");
include("../classes/user.class.php");

$user = new Users($conn);
function load($email){
    global $conn;
    $user = new Users($conn);
    
    list($bool,$bill) = $user->fetch_bill($email);
    return array($bool,$bill);
}

if(isset($_POST['pay_full']) || isset($_POST['pay_due'] )){
    list($bool,$bill) = load($_POST['email']);
    $user = new Users($conn);
    
    if(isset($_POST['pay_full']) && $_POST['net_amount'] == $bill['net_amount']){
        header('Location: ../views/payment.php?pay_type=pay_full ');
        exit();
    }
    if(isset($_POST['pay_due']) && $_POST['due'] == $bill['due'] > 0){
        header('Location: ../views/payment.php?pay_type=pay_due '); 
        exit();       
     }
}

if(isset($_POST['pay_bill'])){
    list($bool,$bill) = load($_POST['email']);
    $user = new Users($conn);

    if($_POST['pay'] == $bill['net_amount'] || $_POST['pay'] == $bill['due'] && $_POST['billing_date'] == $bill['billing_date']){    
        list($bool,$msg) = $user->pay_bill($_POST['email'],$bill,$_POST['pay']);
        // echo $bool."<br>";
        // echo $msg ."<br>";
        $_SESSION['bill_pay_status'] = $bool;
        $_SESSION['bill_pay_result'] = $msg;
        $_SESSION['bill_pay_amount'] = $_POST['pay'];
        header("Location: ../views/dashboard.php");
        exit();        
    }else{
        
        echo $_SESSION['bill_pay_status'] = 'false';
        echo $_SESSION['bill_pay_result'] = 'bill information not matching with data base information';

        header("Location: ../views/dashboard.php");
        exit();
    } 

}

