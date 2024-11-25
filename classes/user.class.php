<?php

class Users {
    protected $conn;
    protected $email;
    protected $password;

    public function __construct($conn) {
         $this->conn = $conn;
    }

    public function login($email, $password) {
        $fetch_user = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($fetch_user);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows > 0) {
            $user = $res->fetch_assoc();
            if (md5($password) == $user["password"]) {
                session_start();
                $_SESSION["email"] = $user["email"];
                $_SESSION["fname"] = $user["fname"];
                $_SESSION["lname"] = $user["lname"];
                $_SESSION["address"] = $user["address"];
                return array('true', "hi $email, Now you are logged in");
            } else {
                return array('false', 'incorrect email id or password');
            }
        } else {
            return array('false', 'email id not registered');
        }
    }

    public function fetch_bill($email) {
        $fetch_bill = "SELECT * FROM `billing_transactions` WHERE email= ? AND payment_status = 'pending' ORDER BY `billing_date` ASC LIMIT 1";
        $stmt = $this->conn->prepare($fetch_bill);
        if ($stmt === false) {
            die('Prepare failed: ' . $this->conn->error);
        }
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $res = $stmt->get_result();
    
        if ($res->num_rows > 0) {
            $bill = $res->fetch_assoc();
            $billing_date = $bill['billing_date'];
            
            $fetch_water_usage = "SELECT * FROM `water_usage` WHERE email= ? AND billing_date = ?";
            $stmt2 = $this->conn->prepare($fetch_water_usage);
            if ($stmt2 === false) {
                die('Prepare failed: ' . $this->conn->error);
            }
            $stmt2->bind_param('ss', $email, $billing_date);
            $stmt2->execute();
            $res1 = $stmt2->get_result();
            
            if ($res1->num_rows > 0) {
                $water_usage = $res1->fetch_assoc();
                $bill['water_used'] = $water_usage['water_used'];
                return array('true', $bill);
            } else {
                $bill['error'] = "No water usage data found for the bill.";
                return array('false', $bill);
            }
        } else {
            $bill['error'] = "No bills are due.";
            return array('false', $bill);
        }
    }

    public function pay_bill($email,$bill,$pay ){
        $billing_date = $bill['billing_date'];

        list($bool,$wallet_bal) = $this->fetch_wallet($email);
       
        if($bool == true){
            if($pay < $wallet_bal){
                $update_bill = "UPDATE `billing_transactions` 
                                SET `payment_status` = 'paid', 
                                `payment_date` = NOW() 
                                WHERE `email` = '$email' 
                                AND `billing_date` = '$billing_date'";
                // $bill = $this->conn->query($update_bill);
                
                $wallet_bal = $wallet_bal - $pay;

                $update_wallet = "INSERT INTO wallet(email, debit, wallet_bal)
                        VALUES('$email', '$pay', '$wallet_bal')";
                
                // $wall = $this->conn->query($update_wallet);

                if($bill = $this->conn->query($update_bill) && $wall = $this->conn->query($update_wallet)){
                    return array('true',$wallet_bal);
                }else{
                    return array('false', $this->conn->error);
                }
            }else{
                return array("false","Insufficient wallet funds");
            }
        }else{
            return array('false',"can't fetch balance from the wallet");
        }   
    }

    public function fetch_wallet($email){
        $fetch_wallet = "SELECT * FROM wallet WHERE email = '$email' ORDER BY `added_on` DESC LIMIT 1";
        $result = $this->conn->query($fetch_wallet);
        if($fetch_wallet){
            if($wallet = $result->fetch_assoc()){
                return array('true',$wallet['wallet_bal']);
            }else{
                return array('false','error while fetching the wallet balance');
            }
        }
        
    }


    public function update_wallet($email,$credit){
        list($bool,$wallet_bal) = $this->fetch_wallet($email);
       
        if($bool == true){
            $wallet_bal = $wallet_bal + $credit ; 
            $sql="INSERT INTO wallet(email, credit, wallet_bal)
                    VALUES('$email','$credit','$wallet_bal')";

            $res=$this->conn->query($sql);
            if($res){
                return array('true',"Successfull, Rs $credit has been credited to your wallet");
            }else{
                return array('false',$this->conn->error);
            }
        }else{
            return array('false', $wallet_bal);
        }
    }

    public function fetch_receipts($email){
        $fetch_receipts = "SELECT DATE_FORMAT(billing_date, '%d-%M-%Y') AS formatted_date 
                FROM `billing_transactions` 
                WHERE email='$email' 
                AND payment_status ='paid' ORDER BY billing_date DESC";
        
        $result = $this->conn->query($fetch_receipts);
        $receipt_dates = [];

        if($result) {
            if($result->num_rows > 0){
                while ($row = $result->fetch_assoc()) {
                    $receipt_dates[] = $row;
                }
                return array('true' , $receipt_dates);
            }else{
                return array('false', 'No paid receipts available');
            }
            
        }else{
            return array('false', "Error $this->conn->error " );
        }

    }


    public function usage_anaytics($email){
        $sql = "SELECT billing_date, water_used 
                FROM `water_usage` 
                WHERE email='$email'
                ORDER BY billing_date ASC 
                LIMIT 6";

        $result = $this->conn->query($sql);

        $months = [];
        $usages = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $months[] = $row['billing_date'];
                $usages[] = $row['water_used'];
            }

            // Prediction Logic
            $n = count($usages);
            if ($n > 0) {
                $x_sum = array_sum(range(1, $n));
                $y_sum = array_sum($usages);
                $xy_sum = 0;
                $x_squared_sum = 0;

                for ($i = 0; $i < $n; $i++) {
                    $xy_sum += ($i + 1) * $usages[$i];
                    $x_squared_sum += ($i + 1) * ($i + 1);
                }

                if (($n * $x_squared_sum - $x_sum * $x_sum) != 0) {
                    $slope = ($n * $xy_sum - $x_sum * $y_sum) / ($n * $x_squared_sum - $x_sum * $x_sum);
                    $intercept = ($y_sum - $slope * $x_sum) / $n;
                } else {
                    $slope = 0;
                    $intercept = 0;
                }

                $next_month_usage = $slope * ($n + 1) + $intercept;
                return array('true',$months, $usages, $next_month_usage);
                exit();

            } else {
                $slope = 0;
                $intercept = 0;
                $next_month_usage = 0;
                return array('false',$months, $usages, $next_month_usage);
            }
        } else {
            $slope = 0;
            $intercept = 0;
            $next_month_usage = 0;
            return array('false',$months,$usages,$next_month_usage);
        }
    }
    public function fetch_invoice($email, $billing_date){
        $sql = "SELECT * FROM `billing_transactions` 
                WHERE email='$email'
                AND payment_status = 'paid'
                AND billing_date = '$billing_date'"; 

        if($result = $this->conn->query($sql)){
            if ($result->num_rows > 0){
                $invoice = $result->fetch_assoc();
                return array('true',$invoice);
            }else{
                return array('false',"No such records found");
            }
        }else{
            return array('false',"Error : ".$this->conn->error);
        }
    }
    

}
