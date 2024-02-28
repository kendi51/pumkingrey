<?php
include_once "in.db.php";
include_once "../php/createDb.php";
include_once "product.func.php";
require_once "files.admin.php";

$ftp_connection = ftp_connect($ftp_host, 21) or die("Couldn't connect to $ftp_host");
ftp_login($ftp_connection, $ftp_username, $ftp_pass) or die("Couldn't connect to server");
ftp_pasv($ftp_connection, true);

$remote_dir = "/home/u843931047/domains/pumkingrey.com/public_html/images/";

// $database = new CreateDb("productdb", "producttb"); // Local db
$database = new CreateDb("u843931047_productdb", "inventorytb"); //online db

if(isset($_POST['images'])){
    $product_id = $_POST['id'];
    $img = $_FILES['img']['name'];
    $img2 = $_FILES['img2']['name'];
    $img3 = $_FILES['img3']['name'];
    $img4 = $_FILES['img4']['name'];

    $images = array($img, $img2, $img3, $img4);

    if(empty($img) || empty($img2) || empty($img3) || empty($img4)){
        header("location: images.admin.php?id=$product_id?error=empty");
        exit;
    }
    
    $imgUpload = array($_FILES['img'], $_FILES['img2'], $_FILES['img3'], $_FILES['img4']);
    
    $imgUploadName = array($_FILES['img']['name'], $_FILES['img2']['name'], $_FILES['img3']['name'], $_FILES['img4']['name']);
    
    $imgUploadTmp = array($_FILES['img']['tmp_name'], $_FILES['img2']['tmp_name'], $_FILES['img3']['tmp_name'], $_FILES['img4']['tmp_name']);
    
    $imgUploadSize = array($_FILES['img']['size'], $_FILES['img2']['size'], $_FILES['img3']['size'], $_FILES['img4']['size']);
    
    $imgUploadError = array($_FILES['img']['error'], $_FILES['img2']['error'], $_FILES['img3']['error'], $_FILES['img4']['error']);


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


    $img = "images/".$img;
    $img2 = "images/".$img2;
    $img3 = "images/".$img3;
    $img4 = "images/".$img4;
    
    
    $sql = "UPDATE producttb 
    SET product_img = '$img', 
    product_sec_img = '$img2', 
    product_third_img = '$img3', 
    product_forth_img = '$img4'
    WHERE id = '$product_id';";

    $results = mysqli_query($in_db, $sql);

    if(!$results) {
        header("location: /admin/images.admin.php?id=$product_id&error=stmtfailed");
            exit();
    }
    header("location: /admin/productHandler.php?id=$product_id&error=none");
    exit;
}

if(isset($_POST['brand'])){
    $product_id = $_POST['id'];
    $brand = $_POST['brand'];
    $product_name = $_POST['product_name'];
    $short_discript = $_POST['short_discript'];
    $long_discript = $_POST['long_discript'];

    if(empty($product_name) || empty($brand) || empty($short_discript) || empty($long_discript)){
        header("location: /admin/meta.admin.php?id=$product_id?error=empty");
        exit;
    }

    $sql = "UPDATE producttb 
    SET product_brand_name = '$brand', 
    product_name = '$product_name', 
    product_shrt_discript = '$short_discript', 
    product_long_discript = '$long_discript'
    WHERE id = '$product_id';";

    $results = mysqli_query($in_db, $sql);

    if(!$results) {
        header("location: /admin/meta.admin.php?id=$product_id&error=stmtfailed");
            exit();
    }
    header("location: /admin/productHandler.php?id=$product_id&error=none");
    exit;
}

if(isset($_POST['meta'])){
    $product_id = $_POST['id'];

    $size_type = $_POST['sizeType'];
    $gender = $_POST['gender'];
    $catergory = $_POST['category'];
    $price = $_POST['price'];

    if($size_type == 1){
        $size28 = $_POST['size28'];
        $size30 = $_POST['size30'];
        $size32 = $_POST['size32'];
        $size34 = $_POST['size34'];
        $size36 = $_POST['size36'];
        $size38 = $_POST['size38'];
        $size40 = $_POST['size40'];

        $sql = "UPDATE inventorytb 
        SET size28 = '$size28', 
        size30 = '$size30',
        size32 = '$size32',
        size34 = '$size34',
        size36 = '$size36',
        size38 = '$size38',
        size40 = '$size40'
        WHERE product_id = '$product_id';";

        $results = mysqli_query($in_db, $sql);

        if(!$results) {
            header("location: /admin/meta.admin.php?id=$product_id&error=stmtfailedSif1");
                exit();
        }
    }
    elseif($size_type == 2){
        $xs = $_POST['size_XS'];
        $s = $_POST['size_S'];
        $m = $_POST['size_M'];
        $l = $_POST['size_L'];
        $xl = $_POST['size_XL'];
        $xxl = $_POST['size_XXL'];

        $sql = "UPDATE inventorytb 
        SET xs = '$xs', 
        s = '$s',
        m = '$m',
        l = '$l',
        xl = '$xl',
        xxl = '$xxl'
        WHERE product_id = '$product_id';";

        $results = mysqli_query($in_db, $sql);

        if(!$results) {
            header("location: /admin/meta.admin.php?id=$product_id&error=stmtfailedSif2");
                exit();
        }
    }



    $sql = "UPDATE producttb 
    SET product_size_type = '$size_type', 
    product_gender = '$gender',
    product_price = '$price',
    product_category = '$catergory'
    WHERE id = '$product_id';";

    $results = mysqli_query($in_db, $sql);

    if(!$results) {
        header("location: /admin/meta.admin.php?id=$product_id&error=stmtfailedmeta");
            exit();
    }
    header("location: /admin/productHandler.php?id=$product_id&error=none");
    exit;
}

if(isset($_POST['updateLink'])){
    $serverName = "localhost";
    $dBUserName = "u843931047_pumkinproducts";
    $dBPassword = "5P~PCQfN:g";
    $dBName = "u843931047_productdb";


    $conn = mysqli_connect($serverName, $dBUserName, $dBPassword, $dBName);
    
    $link_id = $_POST['id'];
    
    $img = $_FILES['img']['name'];
    
    if(empty($img)){
        $img = $_POST['oldImg'];
    }
    else{
    // IMAGES UPLOAD TO SERVERS
    $imgUpload = $_FILES['img'];
    
    $imgName = $_FILES['img']['name'];
    
    $imgTmp = $_FILES['img']['tmp_name'];
    
    $imgSize = $_FILES['img']['size'];
    
    $imgError = $_FILES['img']['error'];
    
    $fileExt = explode('.', $imgName);
    $fileName = $fileExt[0];
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png');
    
    if(in_array($fileActualExt, $allowed)){
        if($imgError === 0){
            if($imgUploadSize < 100000){
                $fileNameNew = $fileName.".".$fileActualExt;
                $fileDestination = $remote_dir.''.$fileNameNew;
                move_uploaded_file($imgTmp, $fileDestination);
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
    // END OF IMAGES UPLOAD TO SERVERS
    $img = "images/".$img;
    }
    
    $filter = $_POST['filter'];
    $linkTitle = $_POST['title'];
    $search = $_POST['search'];
    $linkPara = $_POST['para'];
    $status = $_POST['status'];
    if(empty($filter) || empty($search) || empty($status)){
        header("location: /admin/links.admin.php?error=emptybpsl");
        exit;
    }
    elseif(empty($linkPara) && empty($linkTitle)){
        header("location: /admin/links.admin.php?error=emptytext");
        exit;
    }
    
    
    
    $sql = "UPDATE linkstb  SET 
    link_status = '$status', 
    link_img = '$img', 
    link_title = '$linkTitle', 
    link_para = '$linkPara',
    link_filter = '$filter',
    link_search = '$search'
    WHERE id = '$link_id';";
    
    $results = mysqli_query($conn, $sql);

    if(!$results) {
        header("location: /admin/links.admin.php?error=stmtfailed2");
        exit();
    }
    
    header("location: /admin/links.admin.php?error=none");
    exit;
    
}

