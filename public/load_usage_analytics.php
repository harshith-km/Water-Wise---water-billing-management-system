<?php 

include("../includes/connect.php");
include("../classes/user.class.php");

function load_usage_analytics($email){
    global $conn;
    $user = new Users($conn);

    list($bool,$months, $usages, $next_month_usage) = $user->usage_anaytics($email);
    return array($bool,$months, $usages, $next_month_usage);

}
