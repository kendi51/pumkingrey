<?php

include_once "in.db.php";
include_once "../php/createDb.php";
include_once "product.func.php";
require_once "files.admin.php";

$ftp_connection = ftp_connect($ftp_host, 21) or die("Couldn't connect to $ftp_host");
ftp_login($ftp_connection, $ftp_username, $ftp_pass) or die("Couldn't connect to server");
ftp_pasv($ftp_connection, true);

$remote_dir = "/home/u843931047/domains/pumkingrey.com/public_html/images/";


if(isset($_POST['saveProduct'])){
    $serverName = "localhost";
    $dBUserName = "u843931047_pumkinproducts";
    $dBPassword = "5P~PCQfN:g";
    $dBName = "u843931047_productdb";


    $conn = mysqli_connect($serverName, $dBUserName, $dBPassword, $dBName);
    


    $img = $_FILES['img']['name'];
    $img2 = $_FILES['img2']['name'];
    $img3 = $_FILES['img3']['name'];
    $img4 = $_FILES['img4']['name'];
    if(empty($img) || empty($img2) || empty($img3) || empty($img4)){
        header("location: products.php?error=emptyimages");
        exit;
    }
    
    $imgUpload = array($_FILES['img'], $_FILES['img2'], $_FILES['img3'], $_FILES['img4']);
    
    $imgUploadName = array($_FILES['img']['name'], $_FILES['img2']['name'], $_FILES['img3']['name'], $_FILES['img4']['name']);
    
    $imgUploadTmp = array($_FILES['img']['tmp_name'], $_FILES['img2']['tmp_name'], $_FILES['img3']['tmp_name'], $_FILES['img4']['tmp_name']);
    
    $imgUploadSize = array($_FILES['img']['size'], $_FILES['img2']['size'], $_FILES['img3']['size'], $_FILES['img4']['size']);
    
    $imgUploadError = array($_FILES['img']['error'], $_FILES['img2']['error'], $_FILES['img3']['error'], $_FILES['img4']['error']);

    
    /* FILES TYPE COMMENTED OUT
    $imgUploadType = $_FILES['img']['type'];
    $img2UploadType = $_FILES['img2']['type'];
    $img3UploadType = $_FILES['img3']['type'];
    $img4UploadType = $_FILES['img4']['type'];
    */
    $fileActualExt = array();
    
    for($i =0; $i<4; $i++){
        $fileExt = explode('.', $imgUploadName[$i]);
        $fileName = $fileExt[0];
        $fileActualExt[] = strtolower(end($fileExt));
        $allowed = array('jpg', 'jpeg', 'png');
        
        if(in_array($fileActualExt[$i], $allowed)){
            if($imgUploadError[$i] === 0){
                if($imgUploadSize[$i] < 200000){
                    $fileNameNew = $fileName.".".$fileActualExt[$i];
                    $fileDestination = $remote_dir.''.$fileNameNew;
                    move_uploaded_file($imgUploadTmp[$i], $fileDestination);
                }
                else{
                    echo "You file is too big";
                    exit;
                }
            }
            else{
                echo "There was an error uploading your file";
            
                exit;
            }
        }
        else{
            echo "You cannot upload files of this type";
        
            exit;
        }
    }
    
    
    $brand = $_POST['brand'];
    $product_name = $_POST['product_name'];
    $short_discript = $_POST['short_discript'];
    $long_discript = $_POST['long_discript'];
    $purchaseLink = $_POST['pLink'];
    if(empty($product_name) || empty($brand) || empty($short_discript) || empty($long_discript || empty($purchaseLink))){
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
    
    $img = "images/".$img;
    $img2 = "images/".$img2;
    $img3 = "images/".$img3;
    $img4 = "images/".$img4;

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
        $size_type,
        $purchaseLink
    );

    if($size_type == 1){
        $size28 = $_POST['size28'];
        $size30 = $_POST['size30'];
        $size32 = $_POST['size32'];
        $size34 = $_POST['size34'];
        $size36 = $_POST['size36'];
        $size38 = $_POST['size38'];
        $size40 = $_POST['size40'];

        $sql = "SELECT * FROM producttb WHERE product_name = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: /admin/products.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $product_name);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_assoc($resultData)){
            $foundId = $row['id'];
        }

        $sql = "INSERT INTO  inventorytb (product_id, size_type, size28, size30, size32, size34, size36, size38, size40) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: /admin/products.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "sssssssss", $foundId, $size_type, $size28, $size30, $size32, $size34, $size36, $size38, $size40);
        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
        header("location: products.php?error=none");
        exit;
    }
    elseif($size_type == 2){
        $xs = $_POST['size_XS'];
        $s = $_POST['size_S'];
        $m = $_POST['size_M'];
        $l = $_POST['size_L'];
        $xl = $_POST['size_XL'];
        $xxl = $_POST['size_XXL'];

        $sql = "SELECT * FROM producttb WHERE product_name = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: /admin/products.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $product_name);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_assoc($resultData)){
            $foundId = $row['id'];
        }

        $sql = "INSERT INTO  inventorytb (product_id, size_type, xs, s, m, l, xl, xxl) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: /admin/products.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "ssssssss", $foundId, $size_type, $xs, $s, $m, $l, $xl, $xxl);
        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
        header("location: /admin/products.php?error=none");
        exit;
    }
    else{
        $title = "Manage Inventory: Pumkin";
        $page = "";
        include_once "adminHeader.php";
        
        $serverName = "localhost";
        $dBUserName = "u843931047_pumkinproducts";
        $dBPassword = "5P~PCQfN:g";
        $dBName = "u843931047_productdb";
    
    
        $conn = mysqli_connect($serverName, $dBUserName, $dBPassword, $dBName);
        
        
        echo "<h5>No size type found</h5>
        
        
        <div class='container'>
            <div class='wrapper text-center mt-2'>
                <form action='/admin/addProduct.admin.php' method='post' enctype='multipart/form-data'>
                    <div class='row'>
                        <div class='col-6 mb-3'>
                            <label for='firstName'>Size Type</label>
                            <select name='sizeType' id='size' class='form-control mt-0' required>
                                <option value='none'>Select Size Type</option>
                                <option value='1'>1: Jeans/Trousers</option>
                                <option value='2'>2: Shirts/Jackets</option>
                            </select>
                        </div>
                        <div class='col-6'>
                            <div id='1' class='data'>
                                <div class='row'>";
                                        $s = 26;
                                        for($i = 0; $i < 7; $i++){
                                        
                                            ?>
                                            <div class='col-3 mt-3'>
                                                <label for='username'>Size <?php echo $s+=2; ?></label>
                                                <input type='text' class='form-control text-center mt-3' name='size<?php echo $s; ?>'>
                                            </div>
                                            <?php
                                        }
                                    echo '
                                </div>
                            </div>
                
                            <div id="2" class="data">
                                <div class="row">
                                    ';
                                    
                                        $sizeNames = array("XS", "S", "M", "L", "XL", "XXL");
                                        for($i = 0; $i < 6; $i++){
                                        echo"
                                            <div class='col-4 mt-3'>
                                                <label for='username'>Size <?php echo $sizeNames[$i]; ?></label>
                                                <input type='text' class='form-control text-center pt-2' name='size_<?php echo $sizeNames[$i]; ?>'>
                                            </div>
                                        ";
                                        }
                                    echo"
                                    
                                </div>
                            </div>
                        </div>
                    </div>  
                    
                    <button class='btn btn-light text-center' type='submit' name='addInventory'>ADD INVENTORY</button>
                    <a href='products.php' class='btn btn-outline-danger my-2' type='submit' >CANCEL</a>
                </form>
            </div>
        </div>";
        
        ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $(document).ready(function(){
                $("#size").on('change', function(){
                    $(".data").hide();
                    $("#" + $(this).val()).fadeIn(700);
                }).change();
            })
        </script>
        <?php
        exit;
    }
    
}

if(isset($_POST['saveLink'])){
    $serverName = "localhost";
    $dBUserName = "u843931047_pumkinproducts";
    $dBPassword = "5P~PCQfN:g";
    $dBName = "u843931047_productdb";


    $conn = mysqli_connect($serverName, $dBUserName, $dBPassword, $dBName);
    
    $img = $_FILES['img']['name'];
    
    if(empty($img)){
        header("location: links.admin.php?error=emptyimages");
        exit;
    }
    
    // IMAGES UPLOAD TO SERVERS
    // $imgUpload = $_FILES['img'];
    
    // $imgName = $_FILES['img']['name'];
    
    // $imgTmp = $_FILES['img']['tmp_name'];
    
    // $imgSize = $_FILES['img']['size'];
    
    // $imgError = $_FILES['img']['error'];
    
    // $fileExt = explode('.', $imgUploadName[$i]);
    // $fileName = $fileExt[0];
    // $fileActualExt = strtolower(end($fileExt));
    // $allowed = array('jpg', 'jpeg', 'png');
    
    // if(in_array($fileActualExt, $allowed)){
    //     if($imgUploadError === 0){
    //         if($imgUploadSize < 100000){
    //             $fileNameNew = $fileName.".".$fileActualExt;
    //             $fileDestination = $remote_dir.''.$fileNameNew;
    //             move_uploaded_file($imgUploadTmp[$i], $fileDestination);
    //         }
    //         else{
    //             echo "You file is too big";
    //             exit;
    //         }
    //     }
    //     else{
    //         echo "There was an error uploading your file";
        
    //         exit;
    //     }
    // }
    // else{
    //     echo "You cannot upload files of this type";
    
    //     exit;
    // }
    // END OF IMAGES UPLOAD TO SERVERS
    
    
    $filter = $_POST['filter'];
    $linkTitle = $_POST['title'];
    $search = $_POST['search'];
    $linkPara = $_POST['para'];
    if(empty($filter) || empty($search)){
        header("location: links.admin.php?error=emptybpsl");
        exit;
    }
    elseif(empty($linkPara) && empty($linkTitle)){
        header("location: links.admin.php?error=emptytext");
        exit;
    }
    
    $img = "images/".$img;
    
    $sql = "INSERT INTO  linkstb (link_img, link_title, link_para, link_filter, link_search) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: links.admin.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "sssss", $img, $linkTitle, $linkPara, $filter, $search);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    header("location: links.admin.php?error=none");
    exit;
}