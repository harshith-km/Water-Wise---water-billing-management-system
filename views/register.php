<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../assets/css/style.css">

</head>
<body class="maincontainer">

   
    <form action="../public/login_or_register.php" method="post" class="container register" id="registerform">
        <h3>Register</h3>
        <div class="input_group">
            <label for="fname">First Name</label>
            <input type="text" name="fname" placeholder="Enter First Name" required>  
        </div>

        <div class="input_group">
            <label for="lname">Last Name</label>
            <input type="text" name="lname" placeholder="Enter Last Name" required>
        </div>
        <div class="input_group">
            <label for="email">Email Id</label>
            <input type="email" name="email" placeholder="Enter Email Id" required>  
        </div>
        <div class="input_group">
            <label for="address">Address</label>
            <input type="text" name="address" placeholder="Enter Your Address/City" required>  
        </div>

        <div class="input_group">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Enter Password" required>
        </div>
        <button type="submit" id="btn"  name="register">REGISTER</button>

        <p>---------------or---------------<br>
        Already Have Account?<b><a href="login.php" id="showLogin"> Login Here</a></b></p>
    </form>
    


</body>
</html>