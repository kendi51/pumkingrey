<?php

$serverName = "srv1350.hstgr.io";
$dBUserName = "u849136244_pumkingrey";
$dBPassword = "G2O9+euM^c;";
$dBName = "u849136244_pumkin_grey";

$conn = mysqli_connect($serverName,$dBUserName,$dBPassword,$dBName);

if(!$conn){
    die("Connection Failed: " . mysqli_connect_error());
}