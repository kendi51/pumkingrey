<?php

$serverName = "localhost";
$dBUserName = "u843931047_pumkingrey";
$dBPassword = "G2O9+euM^c;";
$dBName = "u843931047_pumpkin_users";

$conn = mysqli_connect($serverName,$dBUserName,$dBPassword,$dBName);

if(!$conn){
    die("Connection Failed: " . mysqli_connect_error());
}