<?php
// For products 
$serverName = "srv1350.hstgr.io";
$dBUserName = "u849136244_pumkingrey";
$dBPassword = "G2O9+euM^c;";
$dBName = "u849136244_pumkin_grey";

$in_db = mysqli_connect($serverName,$dBUserName,$dBPassword,$dBName);

if(!$in_db){
    die("Connection Failed: " . mysqli_connect_error());
}
