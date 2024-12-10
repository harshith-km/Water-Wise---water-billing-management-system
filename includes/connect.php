<?php


    $conn = new mysqli("localhost","root","","wbms");
    if ($conn->connect_error) {
        die("Error". $conn->connect_error);
    }