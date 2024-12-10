<?php
session_start(); // Start the session
include("../includes/connect.php");



$conn = new mysqli('localhost', 'root', '', 'wbms');
if ($conn->connect_error) {
    die('Failed to connect database' . $conn->connect_error);
}

$fetch = "SELECT id, fname, lname, email FROM users";
$result = $conn->query($fetch);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN PAGE</title>
    <link rel="stylesheet" href="files/style.css">
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        main {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        header {
            width: 100%;
            height: 10vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: aqua;
            text-align: center;
            font-size: larger;
        }

        table {
            border: 1px solid black;
            width: 80%;
            text-align: center;
            margin: 20px auto;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid black;
        }

        th {
            font-size: 20px;
        }

        button {
            padding: 3px;
        }

        .add_user,
        .add_bill,
        .callback_requests {
            display: none;
            margin: 20px auto;
        }

        .add_user form,
        .add_bill form {
            padding: 10px 0px;
            border: 1px solid black;
            width: 330px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .input_grp {
            width: 95%;
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .input_grp label {
            width: 150px;
        }

        #btn {
            width: 70%;
            padding: 3px;
        }

        select {
            width: 160px;
        }

        .nav {
            width: 100%;
            padding: 5px;
            border: 1px solid purple;
        }

        .nav ul {
            list-style: none;
            width: 100%;
            display: flex;
            justify-content: space-evenly;
        }

        #view {
            display: none;
            top: 500px;
            right: 100px;

        }
    </style>
</head>

<body>
    <script>
        function show_viewusers() {
            document.getElementById('view_users').style.display = 'block';
            document.getElementById('add_user').style.display = 'none';
            document.getElementById('add_bill').style.display = 'none';
            document.getElementById('callback_requests').style.display = 'none';
        }

        function show_adduser() {
            document.getElementById('view_users').style.display = 'none';
            document.getElementById('add_user').style.display = 'block';
            document.getElementById('add_bill').style.display = 'none';
            document.getElementById('callback_requests').style.display = 'none';
        }

        function show_addbill() {
            document.getElementById('view_users').style.display = 'none';
            document.getElementById('add_user').style.display = 'none';
            document.getElementById('add_bill').style.display = 'block';
            document.getElementById('callback_requests').style.display = 'none';
        }

        function show_callbackrequests() {
            document.getElementById('view_users').style.display = 'none';
            document.getElementById('add_user').style.display = 'none';
            document.getElementById('add_bill').style.display = 'none';
            document.getElementById('callback_requests').style.display = 'block';
        }

        function showview() {
            document.getElementById('view').style.display = 'block';
            window.location.href = "?id=" + id;
        }

        function offview() {
            document.getElementById('view').style.display = 'none';
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (new URLSearchParams(window.location.search).has('id')) {
                document.getElementById("view").style.display = "block";
            }
        });
    </script>

    <header>
        <h3>WELCOME TO ADMIN PAGE</h3>
        <p>Easily Manage Your Customers At One Place</p>
    </header>

    <div class="nav">
        <ul>
            <li><button onclick="show_viewusers()">View Users</button></li>
            <li><button onclick="show_adduser()">Add User</button></li>
            <li><button onclick="show_addbill()">Add Bill</button></li>
            <li><button onclick="show_callbackrequests()">Callback Requests</button></li>
            <form method="post" action="../public/login_or_register.php">
                <li><button onclick="submit" name="logout">Logout</button></li>
            </form>
        </ul>
    </div>

    <main>

        <div id="view_users" class="view_users">
            <table>
                <tr>
                    <th>Customer ID</th>
                    <th>Name</th>
                    <th>Email ID</th>
                    <th>Operations</th>
                </tr>
                <?php
                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {
                        $id = $row['id'];
                        $email = $row['email'];
                        echo "<tr>
                            <td>" . $row['id'] . "</td>
                            <td>" . $row['fname'] . " " . $row['lname'] . "</td>
                            <td>" . $row['email'] . "</td>
                            <td>
                                <a href='for_future_implementation.php'> <button>EDIT</button> </a>
                                <a href='../public/admin_view.php?user_id=$id&email=$email'><button>VIEW</button></button></a>
                                <a href='../public/admin_delet.php?user_id=$id&email=$email'><button>DELETE</button></a>
                                <a href='for_future_implementation.php'> <button>PAYMENT REMINDER</button></a></td>
                            </tr>";
                    }
                }
                ?>
            </table>
        </div>

        <div id="add_user" class="add_user">
            <form action="../public/login_or_register.php" method="post">
                <h3><b>Fill User Information</b></h3>
                <div class="input_grp">
                    <label for="id">USER ID</label>
                    <input type="text" name="id" placeholder="Enter the customer id"><br>
                </div>
                <div class="input_grp">
                    <label for="fname">FIRST NAME</label>
                    <input type="text" name="fname" placeholder="Enter the first name"><br>
                </div>
                <div class="input_grp">
                    <label for="lname">LAST NAME</label>
                    <input type="text" name="lname" placeholder="Enter the last name"><br>
                </div>
                <div class="input_grp">
                    <label for="email">EMAIL ID</label>
                    <input type="email" name="email" placeholder="Enter the email id"><br>
                </div>
                <div class="input_grp">
                    <label for="password">PASSWORD</label>
                    <input type="text" name="password" placeholder="Enter the password"><br>
                </div>
                <div class="input_grp">
                    <label for="address">ADDRESS</label>
                    <input type="text" name="address" placeholder="Enter the address"><br>
                </div>

                <input type="hidden" name="from" value='admin'>
                <input type="submit" name="register" id="btn">
            </form>
        </div>

        <div id="add_bill" class="add_bill">
            <form action="../public/admin_add_bill.php" method="post">
                <h3><b>Fill Bill Information</b></h3>

                <div class="input_grp">
                    <label for="email">GMAIL ID</label>
                    <input type="text" name="email" placeholder="Enter the email id"><br>
                </div>

                <div class="input_grp">
                    <label for="">Water Used</label>
                    <input type="number" name='water_used' placeholder='Enter the Water used'>
                </div>
             
                <div class="input_grp">
                    <label for="">Usage Type</label>
                    <select name="usage_type" id="">
                        <option value="normal">Normal</option>
                        <option value="moderate">Moderate</option>
                        <option value="high">High</option>
                    </select>
                </div>
                <div class="input_grp">
                    <label for="">Billing Date</label>
                    <input type="date" name='billing_date' placeholder='Enter the Billing Date'>
                </div>

                <div class="input_grp">
                    <label for="">Due (Optional)</label>
                    <input type="number" name='due' placeholder='Enter the Due'>
                </div>

                <div class="input_grp">
                    <label for="payment_status">PAYMENT STATUS</label>
                    <select id="dropdown" name="payment_status">
                        <option>Select Status</option>
                        <option value="paid">PAID</option>
                        <option value="pending">PENDING</option>
                    </select>
                </div>
                <input type="submit" name="add_bill" id="btn">
            </form>
        </div>

        <div id="callback_requests" class="callback_requests">
            <table border=1px black">
                <tr id="tablerow">
                    <th>Status</th>
                    <th>Id</th>
                    <th>Email ID</th>
                    <th>Problem</th>
                    <th>Description</th>
                    <th>Name</th>
                    <th>Phone NO</th>
                    <th>Operations</th>
                </tr>
                <?php
                $sql = "SELECT * FROM callback_request 
                ORDER BY status ASC";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                        <td id='status'>" . $row['status'] . "</td>
                        <td>" . $row['id'] . "</td>
                        <td>" . $row['email'] . "</td>
                        <td>" . $row['problem'] . "</td>
                        <td>" . $row['description'] . "</td>
                        <td>" . $row['name'] . "</td>
                        <td>" . $row['phone_no'] . "</td>
                        <td>
                            <form method='get'>
                            <input type='hidden' value=" . $row['id'] . ">
                            <button onclick='showview()' >View</button>
                            <button >Update</button> 
                        </td>
                        </tr>";
                    }
                }
                ?>

        </div>

        
    </main>
</body>

</html>