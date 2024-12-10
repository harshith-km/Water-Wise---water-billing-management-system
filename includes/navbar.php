<!-- <link rel="stylesheet" href="../assets/css/style.css"> -->
<?php 
    if(session_status()==PHP_SESSION_NONE){
        session_start();
    }
    // $fname = $_SESSION['fname'];
    // $lname = $_SESSION['lname'];
    // echo "$fname <br> $lname";

?>

<div class="navbar">
    <div class="navbar_profile">
        <img src="../assets/img/profile.png" alt="">
        <div class="navbar_profile_name_and_address">
            <span class="profile_name"><?php echo $_SESSION['fname']." ".$_SESSION['lname']; ?></span>
            <span class="profile_address"><?php echo $_SESSION['address']; ?></span>
        </div>
    </div>
    <div class="navbar_menu">

        <a href="dashboard.php" class="navbar_menu_item"><img src="../assets/img/dashboard.png" alt=""><span id="">Dashboard</span></a>
        <a href="receipts.php" class="navbar_menu_item"><img src="../assets/img/receipt.png" alt=""><span id="">Receipts</span></a>
        <a href="usage_analytics.php" class="navbar_menu_item"><img src="../assets/img/usage_analytics.png" alt=""><span id="">Usage Analytics</span></a>
        <a href="wallet.php" class="navbar_menu_item"><img src="../assets/img/wallet.png" alt=""><span id="">Wallet</span></a>
        <a href="support.php" class="navbar_menu_item"><img src="../assets/img/support.png" alt=""><span id="">Support</span></a>

    </div>
    <div class="navbar_footer">
        <a href="settings.php" class="navbar_footer_items"><img src="../assets/img/settings.png" alt=""><span id="">Settings</span></a>
        <a href="../includes/logout.php" class="navbar_footer_items"><img src="../assets/img/logout.png" alt=""><span id="">Logout</span></a>
    </div>
</div>

<style>
    .navbar{
        width: 350px ;
        height: 100%;        
    }
    .navbar_profile{
        background-color: #AAB8B6;
        display: flex;
        justify-content: space-evenly;
        align-items: center;
        width: 100%;
        height:10vh ;
        border-radius: 10px;
        margin-bottom: 5px;
    }
    .navbar_profile img{
        width:19% ;
        height: 68%;
        border-radius: 25%;
    }
    .navbar_profile_name_and_address{
        display: flex;
        flex-direction: column;
        width: 70%;
    }
    .profile_name{
        font-size: 1.8rem;
        font-weight: 600;
    }
    .profile_address{
        font-size: 1rem;
    }


    .navbar_menu{
        width: 100%;
        height: 59.6vh;
        padding: 5px 0px;
        background-color: #AAB8B6;
        display: flex;
        flex-direction: column;
        justify-content: space-evenly;
        align-items: center;
        border-radius: 10px;
        margin-bottom:5px ;
    }
    .navbar_menu_item{
        width: 85%;
        height: 9vh;
        display: flex;
        align-items: center;
        list-style: none;
        font-size: 2em;
        text-decoration: none;
        border-radius: 20px;
        transition: all .5s ease;
    }
    .navbar_menu_item:hover{
        background-color: #E9ECE6;
        transform: translate(5px);
        border-radius: 10px;
        padding-left: 10px;
    }
    .navbar_menu img{
        width: 30px;
        margin: 0px 10px;
    }


    .navbar_footer{
        width: 100%;
        height: 10vh;
        border-radius: 10px;
        background-color: #AAB8B6;
        display: flex;
        justify-content: space-evenly;
        align-items: center;
    }
    .navbar_footer_items{
        width: 100px;
        transition: all .5s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .navbar_footer_items img{
        width: 25px;
    }
    .navbar_footer_items:hover {
        background-color: #E9ECE6;
        border-radius: 10px;
        padding: 10px 0px;
    }
    .navbar_footer a{
        text-decoration: none;
        font-size: 20px;
    }

</style>