<?php 
    include("../includes/connect.php");
    $user_id = '';
    $email = '';

    if(isset($_GET['user_id'])){
        $user_id = $_GET['user_id'];
        $email = $_GET['email'];
        echo"User id = $user_id <br> Email = $email <br>";
        $del_user = "DELETE FROM users WHERE `id` = '$user_id'";
        if($conn->query($del_user)){
            echo"User data Deleted successfully <br>";
        }else{
            echo"Erro while deleting user information".$conn->error."<br>";
        }

        $fetch_wallet = "SELECT * FROM  wallet WHERE  `email`='$email'";
        $res = $conn->query($fetch_wallet);
        if($res->num_rows > 0){
            $del_wallet = "DELETE FROM wallet WHERE `email`='$email'";
            if($conn->query($del_wallet)){
                echo"Wallet data deleted successfully <br>";
            }else{
                echo"Error in deleting Wallet Data <br>";
            }
        }else{
            echo"You have no wallet transactions to delete <br>";
        }

        $fetch_cbr = "SELECT * FROM callback_request WHERE `email`='$email'";
        $res = $conn->query($fetch_cbr);
        if($res->num_rows>0){
            $del_cbr = "DELETE FROM callback_request WHERE `email`='$email'";
            if($conn->query($del_cbr)){
                echo"Callback request data deleted successfully";
            }else{
                echo"Error in deleting Callback request data";
            }

        }else{
            echo"You have no callback request data to delete <br>";
        }

        echo"<a href='../views/admin.php'><button>Return To Admin Page</button></a>";
    }