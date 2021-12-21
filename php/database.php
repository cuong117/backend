<?php
$host = '192.168.1.28';
$user = 'root';
$pass = '19020238';
$database = 'web_population';

$connect = mysqli_connect($host, $user, $pass, $database);

if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}