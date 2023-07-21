<?php
//error_reporting(E_ALL); ini_set('display_errors', 1);
//mysqli_report(MYSQLI_REPORT_ERROR);

$host = "localhost:3307";
$user = "root";
$pass = "";
$database = "db_alusi";

$conn= mysqli_connect($host, $user, $pass, $database) or die("gagal koneksi ke database");    


