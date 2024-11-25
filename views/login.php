<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        
    </style>
</head>
<body class="maincontainer">
    <form action="../public/login_or_register.php" method="post" class="container login" id="loginform">
        <h3>Login</h3>
        <div class="input_group">
            <label for="email">Email Id</label>
            <input type="email" name="email" placeholder="Enter Email Id" required>  
        </div>

        <div class="input_group">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Enter Password" required>
        </div>
        <button type="submit" id="btn" name="login">LOGIN</button>
    
        <p>---------------or---------------<br>
        Don't Have Account Yet?<b><a href="register.php" id="showRegister"> Register Here</a></b></p>
    </form>
</body>
</html>