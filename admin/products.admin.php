<?php

if(isset($_POST["submit"])){
    $product_name = $_POST["product_name"];
    $product_brand_name = $_POST["product_brand_name"];
    $product_price = $_POST["product_price"];
    $product_img = 'images/'.$_POST["product_img"];
    $product_shrt_discript = $_POST["product_shrt_discript"];
    $product_sec_img = 'images/'.$_POST["product_sec_img"];
    $product_third_img = 'images/'.$_POST["product_third_img"];
    $product_forth_img = 'images/'.$_POST["product_forth_img"];
    $product_gender = $_POST["product_gender"];
    $product_long_discript = $_POST["product_long_discript"];
    $product_category = $_POST["product_category"];
    $product_size_type = $_POST["product_size_type"];

    require_once 'product.func.php';

    $serverName = "localhost";
    $dBUserName = "u843931047_pumkinproducts";
    $dBPassword = "5P~PCQfN:g";
    $dBName = "u843931047_productdb";


    $conn = mysqli_connect($serverName, $dBUserName, $dBPassword, $dBName);


    if(emptyInput($product_name, 
    $product_brand_name,
    $product_price, 
    $product_img, 
    $product_shrt_discript,
    $product_gender,
    $product_long_discript,
    $product_category,
    $product_size_type
    ) !== FALSE){
        header("location: ../productHandler.php?error=emptyinput");
        exit();
    }

    createProduct(
        $conn,
        $product_name,
        $product_brand_name,
        $product_price,
        $product_img,
        $product_sec_img,
        $product_third_img,
        $product_forth_img,
        $product_shrt_discript,
        $product_gender,
        $product_long_discript,
        $product_category,
        $product_size_type
    );
    
}