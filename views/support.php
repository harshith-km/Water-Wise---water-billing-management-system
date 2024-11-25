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
    .callbackrequestform, .callbackrequestform #ip1{
        display: flex;
        flex-direction: column;
    }
    #ip1 select{
        padding: 3px ;
        text-align: center;
    }
    #ip1 label{
        margin-bottom: 3px;
    }
    .callbackrequestform #ip2{
        display: flex;
        justify-content: space-between;
        align-items: end;
    }
    #ip2 input{
        padding: 1px 5px;
    }
    .callbackrequestform .inputgroup{
        width: 100%;
        margin-bottom: 10px;
    }
    </style>
</head>
<body>
    <header>
        <?php include('../includes/header.php'); ?>
    </header>

    <div class="maindiv">

            <?php include('../includes/navbar.php'); ?>

        <div class="contentarea">


            <form action="../public/callbackrequest_settings.php" method="POST" class="container callbackrequestform" id="callbackrequestform">
                <h3>Callback Request Form</h3>
                <div class="inputgroup" id="ip1">
                    <label for="slectproblem">Select Your Problem</label>
                    <select name="problem" name="problem" required>
                        <option value="">-select your problem here-</option>
                        <option value="def">def</option>
                        <option value="ghi">ghi</option>
                        <option value="jkl">jkl</option>
                        <option value="mno">mno</option>
                        <option value="pqr">pqr</option>
                        <option value="stu">stu</option>
                        <option value="vw">vw</option>
                        <option value="xyz">xyz</option>
                    </select>
                </div>

                <div class="inputgroup" id="ip1">
                    <label for="problemdescription">Description of the problem</label>
                    <textarea name="description" cols="20" rows="4" required></textarea>
                </div>

                <div class="inputgroup" id="ip2">
                    <label for="name" id="ipl">Name </label>
                    <input type="text" name="name" placeholder="Enter Your Name" required>
                </div>

                <div class="inputgroup" id="ip2">
                    <label for="phone" id="ipl">Phone NO </label>
                    <input type="number" name="phone_no" placeholder="Enter Your Phone NO" required>
                </div>

                <button type="submit" name="callbackrequestbtn" >Request Callback</button>
            </form>
           

        </div>

    </div>

    <footer >
        <?php include('../includes/footer.php'); ?>
    </footer>
    

</body>
</html>