<?php

include("../includes/connect.php");

include("../classes/User.class.php");

if (isset($_POST['login'])) {
    // echo "login<br>";
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email == 'wbms.admin@gmail.com' && $password == 'Password') {
        header("Location: ../views/admin.php");
        echo 'hello from admin';
    } else {

        $user = new Users($conn);
        list($val, $msg) = $user->login($email, $password);

        // echo $val . "<br>" . $msg;

        if ($val == 'true') {
            header("Location: ../index.php");
        } else {
            header("Location: ../views/login.php");
        }
    }
}

if (isset($_POST['register'])) {
    // echo "register<br>";
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $password = md5($_POST['password']);

    $sql = "INSERT INTO users(fname,lname,email,`address`,`password`)
            VALUES('$fname','$lname','$email','$address','$password')";
    $res = $conn->query($sql);
    if ($res) {
        if($_POST['from']=='admin'){
            echo"New user registered successfully <br> <a href='../views/admin.php'><button>Return To Admin Page</button></a>";
        }else{
            echo "New user registered successfully";
            echo "<form method = 'post'>
                    <button type = 'submit' name = 'loginpage'>Return to Login</button>
                <form>";
        }
        
    } else {
        echo "$conn->error";
    }
}

if (isset($_POST['logout'])) {
    header("Location: ../views/login.php");
}

if (isset($_POST['loginpage'])) {
    header("Location: ../views/login.php");
}
