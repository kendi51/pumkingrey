<?php

function emptyInput($product_name, 
    $product_brand_name,
    $product_price, 
    $product_img, 
    $product_shrt_discript,
    $product_gender,
    $product_long_discript,
    $product_category,
    $product_size_type
    ){
        $result;
        if(empty($product_name) || 
        empty($product_brand_name) || 
        empty($product_price)|| 
        empty($product_img)|| 
        empty($product_shrt_discript)||
        empty($product_gender)|| 
        empty($product_long_discript)|| 
        empty($product_category) ||
        empty($product_size_type) 
        ){
            $result = true;
        }
        else {
            $result = false;
        }
        return $result;
}

function createProduct(
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
    $product_size_type,
    $purchaseLink
    ){
    $sql = "INSERT INTO producttb (
        product_name,
        product_brand_name, 
        product_price, 
        product_img, 
        product_sec_img, 
        product_third_img, 
        product_forth_img,
        product_shrt_discript,
        product_gender,
        product_long_discript,
        product_category,
        product_size_type,
        purchaseLink
    ) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: products.php?error=stmtfailed");
        exit();
    }


    mysqli_stmt_bind_param($stmt, "sssssssssssss", 
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
        $product_size_type,
        $purchaseLink
    );
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    // header("location: products.php?error=none");
    // exit();
}