<?php
	$title = 'Items: Pumkin';

	include_once 'header.php';

// 	$db = new CreateDb("Productdb", "Producttb"); // Local db
	$db = new CreateDb("u843931047_productdb", "producttb"); //online db


    if(isset($_GET['id'])) {

        $product_id = $_GET['id'];

        $results = $db->getData();
        while($row = mysqli_fetch_assoc($results)){


                if($row['id'] == $product_id){
                    $id = $row['id'];
                    $product_name = $row["product_name"]; 
                    $product_brand_name = $row["product_brand_name"];
                    $product_price = $row["product_price"]; 
                    $product_img = $row["product_img"]; 
                    $product_shrt_discript = $row["product_shrt_discript"];
                    $product_sec_img = $row["product_sec_img"];
                    $product_third_img = $row["product_third_img"];
                    $product_forth_img = $row["product_forth_img"];
                    $product_gender = $row["product_gender"];
                    $product_long_discript = $row["product_long_discript"];
                    $product_category = $row["product_category"];
                    $product_size_type = $row["product_size_type"];

                    if(isset($_GET["error"])){
                        if($_GET["error"] == "emptyinput"){
                            echo "<p class='mt-2' style='color:red'>Fill in all fields</p>";
                        }
                        elseif($_GET["error"] == "stmtfailed"){
                            echo "<p class='mt-2' style='color:#fd7e14'>Something went wrong. Try again...</p>";
                        }
                    }
                    echo"
                        <div class='container mt-3'>
                            <h1 class='heading' style='font-size:2rem'>Product UPDATE</h1>
                        </div>
                        

                        <div class=''>
                            <form class='formStyle' action='edit.php' method='POST'>
                                    <input type='hidden' name='id' value='$id'>
                                    <label for='name'>Product Name
                                        <input class='inputStyle' type='text' name='product_name' value='$product_name' required>
                                    </label>
                                    <label for='name'>Brand Name
                                        <input class='inputStyle' type='text' name='product_brand_name' value='$product_brand_name' required>
                                    </label>
                                    <label for='email'>Product Price
                                        <input type='text' name='product_price' value='$product_price' required>
                                    </label>
                                    <label for='uid'>Image Location
                                        <input type='file' class=' btn-outline-light' name='product_img'  value='$product_img' required>
                                    </label>
                                    <label for='pwd'>Product Short Discription
                                        <input type='text' name='product_shrt_discript' value='$product_shrt_discript' required>
                                    </label>
                                    <label for='pwdrepeat'>Second Image
                                        <input type='file' class=' btn-outline-light' name='product_sec_img' value='$product_sec_img'>
                                    </label>
                                    <label for='pwdrepeat'>Third Image
                                        <input type='file' class=' btn-outline-light' name='product_third_img' value='$product_third_img'>
                                    </label>
                                    <label for='pwdrepeat'>Forth Image
                                        <input type='file' class=' btn-outline-light' name='product_forth_img' value='$product_forth_img'>
                                    </label>
                                    <label for='pwdrepeat'>Gender (MALE / FEMALE / UNISEX)
                                        <input type='text' name='product_gender' value='$product_gender' required>
                                    </label>
                                    <label for='pwdrepeat'>Product Long Discription <br/>
                                        <textarea type='text' class='w-50' name='product_long_discript' value=''>$product_long_discript</textarea>
                                    </label>
                                    <label for='name'>Category
                                        <input class='inputStyle' type='text' name='product_category' value='$product_category' required>
                                    </label>
                                    <label for='email'>Size Type (1  =  Jeans / 2 = Shirts)
                                        <input type='text' name='product_size_type' value='$product_size_type' required>
                                    </label>
                                    <button class='btn btn-outline-light my-2' type='submit' name='update'>UPDATE PRODUCT</button>
                                    <a href='productHandler.php' class='btn btn-outline-danger my-2' type='submit' >CANCEL</a>
                                </form>
                            </div>
                        </div>
                    ";
                    }
            
        }

        
        include_once 'footer.php';
    }
    else{
        echo "The Product Could Not Be Found...";
    }   
    


    if(isset($_POST["update"])){
        $id = $_POST['id'];
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
    
        require_once 'admin/product.func.php';

        $dbServername = "localhost";
		$dbUsername = "u843931047_pumkinproducts";
		$dbPassword = "5P~PCQfN:g";
		$dbname = "u843931047_productdb";

		$conn2 = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbname);
        
    
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
            header("location: edit.php?id=$id&error=emptyinput");
            exit();
        }

        $sql = "UPDATE producttb 
        SET product_name = '$product_name',
        product_brand_name = '$product_brand_name', 
        product_price = '$product_price', 
        product_img = '$product_img', 
        product_sec_img = '$product_sec_img', 
        product_third_img = '$product_third_img', 
        product_forth_img = '$product_forth_img',
        product_shrt_discript = '$product_shrt_discript',
        product_gender = '$product_gender',
        product_long_discript = '$product_long_discript',
        product_category = '$product_category',
        product_size_type = '$product_size_type'
        WHERE id = '$id';";

        $results = mysqli_query($conn2, $sql);

        if(!$results) {
            header("location: edit.php?id=$id&error=stmtfailed");
                exit();
        }

        header("location: productHandler.php?error=none");
                exit();
    }
?>

