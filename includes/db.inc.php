<?php
$host = "localhost";
$username = "root";
$password = "password123!";
$database = "user_administration";

$con = new mysqli($host, $username, $password, $database);

if ($con->connect_error) {
    echo $con->connect_error;
}
