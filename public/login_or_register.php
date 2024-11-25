<?php

    include("../includes/connect.php");

    include("../classes/User.class.php");

    if(isset($_POST['login'])){
        // echo "login<br>";
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new Users($conn);
        list($val,$msg) = $user->login($email, $password);

        echo $val."<br>".$msg;

        if($val=='true'){
            header("Location: ../index.php");

        }else{
            header("Location: ../views/login.php");
        }



    }

    if(isset($_POST['register'])){
        // echo "register<br>";
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $password = $_POST['password'];
        // echo "First Name: $fname<br>";
        // echo "Last Name: $lname<br>";
        // echo "Email: $email<br>";
        // echo "Address: $address<br>";
        // echo "Password: $password<br>";
    }
