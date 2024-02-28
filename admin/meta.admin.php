<?php
$title = "Edit Product Meta-Data: Pumkin";

include_once "adminHeader.php";

$serverName = "localhost";
$dBUserName = "u843931047_pumkinproducts";
$dBPassword = "5P~PCQfN:g";
$dBName = "u843931047_productdb";


$conn = mysqli_connect($serverName, $dBUserName, $dBPassword, $dBName);

$product_id = $_POST['id'];

$sql = "SELECT * FROM inventorytb WHERE product_id = $product_id;";
			
$results = mysqli_query($db, $sql);
$resultsCheck = mysqli_num_rows($results);

//$results = $db2->getData();
while($row = mysqli_fetch_assoc($results)){
    $size_type = $row['size_type'];
    if($row['size_type'] == 1){
        $size_type = $row['size_type'];
        $s28 =  $row['size28'];
        $s30 =  $row['size30'];
        $s32 =  $row['size32'];
        $s34 =  $row['size34'];
        $s36 =  $row['size36'];
        $s38 =  $row['size38'];
        $s40 =  $row['size40'];
        $sizes = array($s28, $s30, $s32, $s34, $s36, $s38, $s40);
    }
    elseif($row['size_type'] == 2){
        $size_type = $row['size_type'];
        $xs =  $row['xs'];
        $s =  $row['s'];
        $m =  $row['m'];
        $l =  $row['l'];
        $xl =  $row['xl'];
        $xxl =  $row['xxl'];
        $sizes = array($xs, $s, $m, $l, $xl, $xxl);
        $sizeNames = array("XS", "S", "M", "L", "XL", "XXL");
    }
    else{
        echo "ERROR FINDING INVENTORY!!!";
    }
    
}



$results = $database->getData();
while($row = mysqli_fetch_assoc($results)){

        if($row['id'] == $product_id){
            $sizeType = $row['product_size_type'];
            $product_gender = $row['product_gender'];
            $product_category = $row['product_category'];
            $product_price = $row['product_price'];
            $foundId = $product_id;
            
            if(!isset($size_type)){
                $size_type = $sizeType;
                if($size_type == 1){
                    $s28 =  0;
                    $s30 =  0;
                    $s32 =  0;
                    $s34 =  0;
                    $s36 =  0;
                    $s38 =  0;
                    $s40 =  0;
                    $sizes = array($s28, $s30, $s32, $s34, $s36, $s38, $s40);
                    
                    $sql = "INSERT INTO  inventorytb (product_id, size_type, size28, size30, size32, size34, size36, size38, size40) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        header("location: /admin/products.php?error=stmtfailed");
                        exit();
                    }
                    mysqli_stmt_bind_param($stmt, "sssssssss", $foundId, $size_type, $s28, $s30, $s32, $s34, $s36, $s38, $s40);
                    mysqli_stmt_execute($stmt);
            
                    mysqli_stmt_close($stmt);
                }
                elseif($size_type == 2){
                    $xs =  0;
                    $s =  0;
                    $m =  0;
                    $l =  0;
                    $xl =  0;
                    $xxl =  0;
                    $sizes = array($xs, $s, $m, $l, $xl, $xxl);
                    $sizeNames = array("XS", "S", "M", "L", "XL", "XXL");
                    
                    $sql = "INSERT INTO  inventorytb (product_id, size_type, xs, s, m, l, xl, xxl) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        header("location: /admin/products.php?error=stmtfailed");
                        exit();
                    }
                    mysqli_stmt_bind_param($stmt, "ssssssss", $foundId, $size_type, $xs, $s, $m, $l, $xl, $xxl);
                    mysqli_stmt_execute($stmt);
            
                    mysqli_stmt_close($stmt);
                }
            }
        }
        
        
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-lg-6 mt-4">
            <h4 class="heading pb-3">current meta-data</h4>
            <div class='wrapper  text-center'>
                <div class='row'>
                    <div class='col-6 mb-3'>
                        <label for='firstName'>Size Type</label>
                        <input type='text' class='form-control disable text-center' name='brand' placeholder='Full Name' value='<?php echo $sizeType; ?>'disabled>
                    </div>

                    <div class='col-6 mb-3'>
                        <label for='username'>Gender</label>
                        <input type='text' class='form-control disable text-center' name='product_name' value='<?php echo $product_gender; ?>' disabled>
                    </div>

                    <div class='col-6 mb-3'>
                        <label for='firstName'>Category</label>
                        <input type='text' class='form-control disable text-center' name='brand' placeholder='Full Name' value='<?php echo $product_category; ?>' disabled>
                    </div>

                    <div class='col-6 mb-3'>
                        <label for='username'>Price</label>
                        <input type='text' class='form-control disable text-center' name='product_name' value='<?php echo "R " .$product_price; ?>' disabled>
                    </div>

                    <?php
                        $s = 26;
                        if($size_type == 1){
                            for($i = 0; $i < 7; $i++){
                                
                                ?>
                                <div class='col-3 mb-3'>
                                    <label for='username'>Size <?php echo $s+=2; ?></label>
                                    <input type='number' class='form-control disable text-center' name='product_name' value='<?php echo $sizes[$i]; ?>' disabled>
                                </div>
                                <?php
                            }
                            //echo inventoryJeanSize($s28, $s30, $s32, $s34, $s36, $s38, $s40);
                        }
                        elseif ($size_type == 2) {
                            for($i = 0; $i < 6; $i++){
                            ?>
                                <div class='col-4 mb-3'>
                                    <label for='username'>Size <?php echo $sizeNames[$i]; ?></label>
                                    <input type='number' class='form-control disable text-center' name='product_name' value='<?php echo $sizes[$i]; ?>' disabled>
                                </div>
                            <?php
                            }
                            //echo inventoryShirtSize($xs, $s, $m, $l, $xl, $xxl);
                        }
                        else{
                            echo "ERROR NO SIZES AVAILABLE: CHECK SIZE TYPE.";
                        }

                    ?>

                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-6 mt-4">
            <h4 class="heading pb-3">change meta-data</h4>
            <form action="/Admin/Updates" method="post">

                <div class='wrapper  text-center'>
                    <div class='row'>
                        <div class='col-6 mb-3'>
                            <label for='firstName'>Size Type</label>
                            <input type='text' class='form-control text-center' name='sizeType' placeholder='Full Name' value='<?php echo $sizeType; ?>'>
                        </div>

                        <div class='col-6 mb-3'>
                            <label for='username'>Gender</label>
                            <input type='text' class='form-control text-center' name='gender' value='<?php echo $product_gender; ?>'>
                        </div>

                        <div class='col-6 mb-3'>
                            <label for='firstName'>Category</label>
                            <input type='text' class='form-control text-center' name='category' placeholder='Full Name' value='<?php echo $product_category; ?>'>
                        </div>

                        <div class='col-6 mb-3'>
                            <label for='username'>Price</label>
                            <input type='text' class='form-control text-center' name='price' value='<?php echo $product_price; ?>'>
                        </div>

                        <?php
                            $s = 26;
                            if($size_type == 1){
                                for($i = 0; $i < 7; $i++){
                                    
                                    ?>
                                    <div class='col-3 mb-3'>
                                        <label for='username'>Size <?php echo $s+=2; ?></label>
                                        <input type='text' class='form-control text-center' name='size<?php echo $s; ?>' value='<?php echo $sizes[$i]; ?>'>
                                    </div>
                                    <?php
                                }
                                //echo inventoryJeanSize($s28, $s30, $s32, $s34, $s36, $s38, $s40);
                            }
                            elseif ($size_type == 2) {
                                for($i = 0; $i < 6; $i++){
                                ?>
                                    <div class='col-4 mb-3'>
                                        <label for='username'>Size <?php echo $sizeNames[$i]; ?></label>
                                        <input type='text' class='form-control text-center' name='size_<?php echo $sizeNames[$i]; ?>' value='<?php echo $sizes[$i]; ?>'>
                                    </div>
                                <?php
                                }
                                //echo inventoryShirtSize($xs, $s, $m, $l, $xl, $xxl);
                            }
                            else{
                                echo "ERROR NO SIZES AVAILABLE: CHECK SIZE TYPE.";
                            }

                        ?>
                        <input type="hidden" name="id" value="<?php echo $product_id; ?>">
                    </div>
                    <button class='btn btn-light btn-text text-center' type='submit' name='meta'>UPDATE</button>
                    <a href='/admin/productHandler.php?id=<?php echo $product_id; ?>' class='btn btn-outline-danger btn-text my-2' type='submit' >CANCEL</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php

include_once 'adminFooter.php';

?>