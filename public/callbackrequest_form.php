<?php
    include("../includes/connect.php");


    if(isset($_POST['callbackrequestbtn'])){
        $email = $_POST['email'];
        $problem = $_POST['problem'];
        $description = $_POST['description'];
        $name = $_POST['name'];
        $phone_no = $_POST['phone_no'];
        
        $add_cbr = "INSERT INTO callback_request(email,problem,`description`,`name`,phone_no)
                    VALUES('$email','$problem','$description','$name','$phone_no')";

        if($conn->query($add_cbr)){
            echo"Call back Request Added successfully<br> <a href='../views/support.php?status=done'><button>Back</button></a>";
        }else{
            echo"Error:".$conn->error;
        }
        
    }