<?php
session_start();
if(!isset($_SESSION['email'])){
    header('Location: pages/login.php');
    exit();
}
include("../public/load_usage_analytics.php");

list($bool, $months, $usages, $prediction) = load_usage_analytics($_SESSION['email']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Water Usage Analytics</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .container{
            width: 80%;
            text-align: center;
        }
        .prediction{
            width: 100%;
            background-color: #cfe9e7;
            margin-top: 15px;
        }
        .prediction h3{
            margin: 0px;
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
            <?php 
                if(count($months) > 0){ ?>

                    <div class="container">
                        <canvas id="barChart"></canvas>
                        <div class="container prediction">
                            <h3>Water Usage Prediction</h3>
                            <?php echo"Next month's predicted usage: ".$prediction." L"; ?>
                        </div>
                    </div>

            <?php }else{ ?>
                
                    <div class="container">
                        <h3>No previous usage data found to display the usage graph & prediction</h3>
                    </div>

           <?php } ?> 

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                // Get data from PHP
                const months = <?php echo json_encode($months); ?>;
                const usages = <?php echo json_encode($usages); ?>;

                // Create bar chart using Chart.js
                const ctx = document.getElementById('barChart').getContext('2d');
                const barChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: months,
                        datasets: [{
                            label: 'Water Usage (L)',
                            data: usages,
                            backgroundColor: 'rgb(135, 201, 196)',
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

            </script>

        </div>
    </div>

    <footer>
        <?php include('../includes/footer.php'); ?>
    </footer>
</body>
</html>
