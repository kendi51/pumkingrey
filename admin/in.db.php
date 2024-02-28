<?php

$serverName = "localhost";
$dBUserName = "u843931047_pumkinproducts";
$dBPassword = "5P~PCQfN:g";
$dBName = "u843931047_productdb";

$in_db = mysqli_connect($serverName,$dBUserName,$dBPassword,$dBName);

if(!$in_db){
    die("Connection Failed: " . mysqli_connect_error());
}
