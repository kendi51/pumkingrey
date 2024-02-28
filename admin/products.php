<?php

session_start();
if(strcasecmp($_SESSION['accType'], "admin") == 0 || strcasecmp($_SESSION['accType'], "intern") == 0){
    if(isset($_SESSION['useruid'])){

        $title = "Manage Products: Pumkin";
        $page = "";
        include_once "adminHeader.php";
        
        
        ?>
        
        <div class="container-fluid mt-3 mb-0">
            <!--<div class="text-center">-->
            <!--    <h4 class="col-12 mb-3">Manage Products</h4>-->
            <!--</div>-->
        
            <!--<form action="products.php" method="post">-->
                <!-- BUTTONS -->
            <!--    <button type="submit" class="btn btn-outline-dark" name="women">Woman</button>-->
            <!--    <button type="submit" class="btn btn-outline-dark" name="men">Man</button>-->
            <!--    <button type="submit" class="btn btn-outline-dark" name="addProduct">Add Product</button>-->
                <!-- END OF BUTTONS -->
            <!--</form>-->
            
            <nav class="navbar navbar-dark bg-dark mt-3">
        
              
              <form class="form-inline center flex-container"  action="/Admin/Products" method="post" style='justify-content: center'>
                <!-- BUTTONS -->
                
                <button type="submit" class="btn btn-outline-success mx-1 mx-lg-2" name="women">Woman</button>
                
                
                <button type="submit" class="btn btn-outline-success mx-1 mx-lg-2" name="men">Man</button>
                
                <button type="submit" class="btn btn-outline-success mx-1 mx-lg-2" name="addProduct">Add Product</button>
                
                <!-- END OF BUTTONS -->
            </form>
              <form class="form-inline" style='justify-content: right'>
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <select name='filter' class='my-2 my-sm-0 form-control inputRound' required>
                    <option value='none'>Select Filter</option>
                    <option value='Name'>Product Name</option>
                    <option value='Brand'>Brand</option>
                    <option value='Category'>Category</option>
                </select>
                <button class="btn btn-outline-success ml-2 my-2 my-sm-0" type="submit">Search</button>
              </form>
            </nav>
        </div>
        
        
        <!--ALL PRODUCTS  -->
        <div class="container-fluid mt-3 mb-0" >
            <div class="row">
                <?php
        
                    if(isset($_POST['men'])){
        
                        $sql = "SELECT * FROM producttb ORDER BY id DESC;";
        			
        		        $result = mysqli_query($db, $sql);
                        $i = 0;
                        while($row = mysqli_fetch_assoc($result)){
                            if(strcasecmp($row['active'], "yes") === 0){
                                $active = "<h6 class='' style='font-size: 14px;font-weight: 500; color: green'>ACTIVED</h6>";
                            }
                            elseif(strcasecmp($row['active'], "no") === 0){
                                $active = "<h6 class='' style='font-size: 14px;font-weight: 100; color: red'>DEACTIVED</h6>";
                            }
                            else{
                                $active = "error";
                            }
                            foreach($row as $key => $val){
                                //threeImages($row['product_name'], $row['product_price'], $row['product_img'], $row['id'], $active);
                                if($key == "product_gender" && strcasecmp($val, "unisex")==0 || strcasecmp($val, "man")==0 || strcasecmp($val, "male")==0 ){
                                    fourImagesAdmin($row['product_name'], $row['product_price'], $row['product_img'], $row['id'], $active, $row['purchaseLink']);
                                    $i++;
                                }
                            }
        
                        }
                    }
        
                    elseif(isset($_POST['women'])){
        
                        $result = $database->getData();
                        $i = 0;
                        while($row = mysqli_fetch_assoc($result)){
                            if(strcasecmp($row['active'], "yes") === 0){
                                $active = "<h6 class='' style='font-size: 14px;font-weight: 500; color: green'>ACTIVED</h6>";
                            }
                            elseif(strcasecmp($row['active'], "no") === 0){
                                $active = "<h6 class='' style='font-size: 14px;font-weight: 100; color: red'>DEACTIVED</h6>";
                            }
                            else{
                                $active = "error";
                            }
                            foreach($row as $key => $val){
                                //threeImages($row['product_name'], $row['product_price'], $row['product_img'], $row['id'], $page);
                                if($key == "product_gender" && strcasecmp($val, "unisex")==0 || strcasecmp($val, "woman")==0 || strcasecmp($val, "female")==0 ){
                                    fourImagesAdmin($row['product_name'], $row['product_price'], $row['product_img'], $row['id'], $active, $row['purchaseLink']);
                                    $i++;
                                }
                            }
        
                        }
                    }
        
                    elseif (isset($_POST['addProduct'])) {
                        # code...
                        ?>
                        <div class="container">
                            <form action="/admin/addProduct.admin.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col- pt-3">
                                        
                                        <h4 class="heading pb-3">add images</h4>
                                        
                                        <div class="row p-3">
                                            <div class='col col-6 mb-3'>
                                                <label for='firstName'>Cover</label>
                                                <input type='file' class='form-control btn-dark' style='padding-bottom: 2.5rem' name='img'  required>
                                            </div>
        
                                            <div class='col col-6 mb-3' >
                                                <label for='username'>2nd Image</label>
                                                <input type='file' class='form-control btn-dark' style='padding-bottom: 2.5rem' name='img2'  required>
                                            </div>
        
                                            <div class='col col-6 mb-3'>
                                                <label for='firstName'>3rd Image</label>
                                                <input type='file' class='form-control btn-dark' style='padding-bottom: 2.5rem' name='img3'  required>
                                            </div>
        
                                            <div class='col col-6 mb-3'>
                                                <label for='username'>4th Image</label>
                                                <input type='file' class='form-control btn-dark' style='padding-bottom: 2.5rem' name='img4'  required>
                                                <input type="hidden" name="id" value="<?php echo $product_id; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class='col-12 mb-3'>
                                        <h5 class="heading pb-3">Purchase Link</h5>
                                        <input type='text' class='form-control text-center' name='pLink' required>
                                    </div>
        
                                    <div class="col-md-6 col-lg-6 ">
                                        <h4 class="heading pb-3">add brand info</h4>
        
                                            <div class='row'>
                                                <div class='col-6 mb-3'>
                                                    <label for='firstName'>Brand</label>
                                                    <input type='text' class='form-control text-center' name='brand' required>
                                                </div>
        
                                                <div class='col-6 mb-3'>
                                                    <label for='username'>Product Name</label>
                                                    <input type='text' class='form-control text-center' name='product_name' required>
                                                </div>
                                            </div>
        
                                                <div class='mb-3'>
                                                    <label for='username'>Product Short Discription</label>
                                                    <input type='text' class='form-control text-center' name='short_discript' required>
                                                </div>
        
                                                <div class='mb-3'>
                                                    <label class='mb-4' for='email'>Product Long Discription</label><br/>
                                                    <textarea type='text' class='form-control w-100 h-50' rows="5" cols="50"  name='long_discript' required></textarea>
                                                </div>
                                    </div>
        
                                    <div class="col-md-6 col-lg-6">
                                    <h4 class="heading pb-3">add meta-data</h4>
        
                                        <div class='wrapper  text-center'>
                                            <div class='row'>
                                                <div class='col-6 mb-3'>
                                                    <label for='firstName'>Size Type</label>
                                                    <select name='sizeType' id='size' class='form-control mt-0' required>
                                                        <option value='none'>Select Size Type</option>
                                                        <option value='1'>1: Jeans/Trousers</option>
                                                        <option value='2'>2: Shirts/Jackets</option>
                                                    </select>
                                                </div>
        
                                                <div class='col-6 mb-3 2'>
                                                    <label for='username'>Gender</label>
                                                    <input type='text' class='form-control text-center' name='gender' required>
                                                </div>
        
                                                <div class='col-6 mb-0 3'>
                                                    <label for='firstName'>Category</label>
                                                    <input type='text' class='form-control text-center' name='category' required>
                                                </div>
        
                                                <div class='col-6 mb-0 4'>
                                                    <label for='username'>Price</label>
                                                    <input type='text' class='form-control text-center' name='price' required>
                                                </div>
                                            </div>
        
                                            <div class='wrapper text-center mt-2'>
                                                <div id="1" class="data">
                                                    <div class='row'>
                                                        <?php
                                                            $s = 26;
                                                            for($i = 0; $i < 7; $i++){
                                                            
                                                                ?>
                                                                <div class='col-3 mt-3'>
                                                                    <label for='username'>Size <?php echo $s+=2; ?></label>
                                                                    <input type='text' class='form-control text-center mt-3' name='size<?php echo $s; ?>'>
                                                                </div>
                                                                <?php
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
        
                                                <div id="2" class="data">
                                                    <div class='row'>
                                                        
                                                        <?php
                                                            $sizeNames = array("XS", "S", "M", "L", "XL", "XXL");
                                                            for($i = 0; $i < 6; $i++){
                                                            ?>
                                                                <div class='col-4 mt-2'>
                                                                    <label for='username'>Size <?php echo $sizeNames[$i]; ?></label>
                                                                    <input type='text' class='form-control text-center mt-3' name='size_<?php echo $sizeNames[$i]; ?>'>
                                                                </div>
                                                            <?php
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                            <button class='btn btn-light text-center' type='submit' name='saveProduct'>ADD PRODUCT</button>
                                            <a href='products.php' class='btn btn-outline-danger my-2' type='submit' >CANCEL</a>
                            </form>
                        </div>
                        <?php
                    }
        
                    else{
        
                        $sql = "SELECT * FROM producttb ORDER BY id DESC;";
        			
        		        $result = mysqli_query($db, $sql);
                        while($row = mysqli_fetch_assoc($result)){
                            if(strcasecmp($row['active'], "yes") === 0){
                                $active = "<h6 class='' style='font-size: 14px;font-weight: 500; color: green'>ACTIVED</h6>";
                            }
                            elseif(strcasecmp($row['active'], "no") === 0){
                                $active = "<h6 class='' style='font-size: 14px;font-weight: 100; color: red'>DEACTIVED</h6>";
                            }
                            else{
                                $active = "error";
                            }
                            fourImagesAdmin($row['product_name'], $row['product_price'], $row['product_img'], $row['id'], $active, $row['purchaseLink']);
                        }
                    }
                ?>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $(document).ready(function(){
                $("#size").on('change', function(){
                    $(".data").hide();
                    $("#" + $(this).val()).fadeIn(700);
                }).change();
            })
        </script>
        <!--END OF ALL PRODUCTS-->
        <?php
        include_once 'adminFooter.php';
    }
    else{
        header("location: /Admin/Login");
    }
}
else{
    header("location: /Home");
}


if(isset($_POST['saveProduct'])){
    // $serverName = "localhost";
    // $dBUserName = ""; //"u843931047_pumkinproducts";
    // $dBPassword = ""; //"5P~PCQfN:g";
    // $dBName = "productdb"; //"u843931047_productdb";


    // $conn = mysqli_connect($serverName, $dBUserName, $dBPassword, $dBName);


    $img = "images/" .$_POST['img'];
    $img2 = "images/" .$_POST['img2'];
    $img3 = "images/" .$_POST['img3'];
    $img4 = "images/" .$_POST['img4'];
    if(empty($img) || empty($img2) || empty($img3) || empty($img4)){
        header("location: images.admin.php?error=emptyimages");
        exit;
    }


    $brand = $_POST['brand'];
    $product_name = $_POST['product_name'];
    $short_discript = $_POST['short_discript'];
    $long_discript = $_POST['long_discript'];
    if(empty($product_name) || empty($brand) || empty($short_discript) || empty($long_discript)){
        header("location: meta.admin.php?error=emptybpsl");
        exit;
    }

    $size_type = $_POST['sizeType'];
    $gender = $_POST['gender'];
    $catergory = $_POST['category'];
    $price = $_POST['price'];
    if(empty($size_type) || empty($gender) || empty($catergory) || empty($price)){
        header("location: meta.admin.php?error=emptysgcp");
        exit;
    }

    createProduct(
        $conn,
        $product_name, 
        $brand, 
        $price, 
        $img, 
        $img2, 
        $img3, 
        $img4,
        $short_discript,
        $gender,
        $long_discript,
        $catergory,
        $size_type
    );

    // if($size_type == 1){
    //     $size28 = $_POST['size28'];
    //     $size30 = $_POST['size30'];
    //     $size32 = $_POST['size32'];
    //     $size34 = $_POST['size34'];
    //     $size36 = $_POST['size36'];
    //     $size38 = $_POST['size38'];
    //     $size40 = $_POST['size40'];

    //     $sql = "SELECT * FROM producttb WHERE product_name = $product_name;";
			
    //     $results = mysqli_query($conn, $sql);
    //     $resultsCheck = mysqli_num_rows($results);
    //     while($row = mysqli_fetch_assoc($results)){
    //         $foundId = $row['id'];
    //     }

    //     $sql = "INSERT INTO  inventorytb 
    //     WHERE product_id = '$foundId',
    //     size28 = '$size28', 
    //     size30 = '$size30',
    //     size32 = '$size32',
    //     size34 = '$size34',
    //     size36 = '$size36',
    //     size38 = '$size38',
    //     size40 = '$size40';";

    //     $results = mysqli_query($in_db, $sql);

    //     if(!$results) {
    //         header("location: meta.admin.php?id=$foundId&error=stmtfailed");
    //             exit();
    //     }
    // }
    // elseif($size_type == 2){
    //     $xs = $_POST['size_XS'];
    //     $s = $_POST['size_S'];
    //     $m = $_POST['size_M'];
    //     $l = $_POST['size_L'];
    //     $xl = $_POST['size_XL'];
    //     $xxl = $_POST['size_XXL'];

    //     $sql = "SELECT * FROM producttb WHERE product_name = $product_name;";
			
    //     $results = mysqli_query($conn, $sql);
    //     $resultsCheck = mysqli_num_rows($results);
    //     while($row = mysqli_fetch_assoc($results)){
    //         $foundId = $row['id'];
    //     }


    //     $sql = "INSERT INTO  inventorytb 
    //     WHERE product_id = '$foundId',
    //     s = '$s',
    //     m = '$m',
    //     l = '$l',
    //     xl = '$xl',
    //     xxl = '$xxl';";

    //     $results = mysqli_query($in_db, $sql);

    //     if(!$results) {
    //         header("location: meta.admin.php?id=$foundId&error=stmtfailed");
    //             exit();
    //     }
    // }
    // else{
    //     echo "No size type found";
    // }

}
?>

}
?>