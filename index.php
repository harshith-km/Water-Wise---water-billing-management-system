<?php
    session_start();
    if(!isset($_SESSION['email'])){
        header('Location: views/login.php');
    }
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body{
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            align-items: center;
            
        }
        .maindiv{
            width: 100%;
            height: 81vh;
            margin: 5px 0px;
            display: flex;
            justify-content: center;
            align-items: center ;
            background-color: #AAB8B6;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <header>
        <?php include('includes/header.php'); ?>
    </header>

    <div class="maindiv">

        <a href="views/dashboard.php"><button>Goto Dashboard</button></a>

    </div>

    <footer >
        <?php include('includes/footer.php'); ?>
    </footer>
    

</body>
</html>