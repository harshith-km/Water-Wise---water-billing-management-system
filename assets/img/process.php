<?php
    $conn=new mysqli('localhost','root','','wbms');
    if($conn->connect_errno){
        die('Failed to connect Database'.$conn->connect_errno);
    }else{
        echo'connected succesfully';
    }

    //Login 
    if(isset($_POST['login'])){
        $email=$_POST['email'];
        $password=md5($_POST['password']);

        $sql="SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result=$conn->query($sql);

        if($result->num_rows==0){
            echo "Incorrect email or password";
        }
        else{
            session_start();
            $row=$result->fetch_assoc();
            $_SESSION['email']= $row['email'];
            header('Location: homepage.php');
        }
    }


    //Register
    if(isset($_POST['register'])){
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $email=$_POST['email'];
        $password=md5($_POST['password']);
        
        $checkemail="SELECT * FROM users WHERE email='$email'";
        $result=$conn->query($checkemail);

        if($result->num_rows!= 0){
            echo 'Email id already registered please login';
        }
        else{
            $insertquery="INSERT INTO users(fname,lname,email,password)
            VALUES('$fname','$lname','$email','$password')";

            if($conn->query($insertquery)){
                echo "Hello $fname, Your information has been registered successfully";
            }
            else{
                echo"$conn->error";
            }
        }
    }       
?>