<?php
	
	$serverName = "localhost";
    $dBUserName = "u843931047_pumkinproducts";
    $dBPassword = "5P~PCQfN:g";
    $dBName = "u843931047_productdb";


    $product_conn = mysqli_connect($serverName, $dBUserName, $dBPassword, $dBName);
    

    if(isset($_GET['id'])) {
        
        $product_name = $_GET['id'];
        $link = "www.pumkingrey.com/Item/".$product_name;
        $productName = explode("_", $product_name);
        $product_name = implode(" ", $productName); 
        
        

        $sql = "SELECT * FROM producttb WHERE product_name = ?;";

        $stmt = mysqli_stmt_init($product_conn);
    
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: /Shop?error=stmtfaileditem");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $product_name);
        mysqli_stmt_execute($stmt);
    
        $resultData = mysqli_stmt_get_result($stmt);
    
        if($row = mysqli_fetch_assoc($resultData)){
            if(strcasecmp($row['active'], "yes") === 0){
                $productVC =  $row['productVC'];
                $productVC += 1;
                //$product_name = $row['product_name '];
                
                //SHARING
                $f = "https://www.facebook.com/sharer.php?u=".$link;
                $t = "https://twitter.com/share?url=".$link."&text=".$product_name ." - R".$row['product_price'];
                
                $title = $product_name;
                $pTitle = $product_name ." - R".$row['product_price'];
        	    $pDescript = $row['product_shrt_discript'];
        	    $pImg = "https://www.pumkingrey.com/".$row['product_img'];
        	    $pLink = $link;
        	    $copy = $pTitle ."<br>". $link;
        	    
                include_once 'header.php';
                carousel($text1, $text2);
                itemElement($row['product_name'], $row['product_price'], $row['product_img'], $row['product_shrt_discript'], $row['product_long_discript'], $row['id'],  $row['product_sec_img'], $row['product_third_img'], $row['product_forth_img'], $row['product_size_type'], $_SESSION['accType'], $f, $t, $link);
                $category = $row['product_category'];
                $gender = $row['product_gender'];
                if(strcasecmp($gender, "unisex") == 0){
                    $rand = rand(1,2);
                    
                    if($rand == 1){
                        $gender = "female";
                    }
                    elseif($rand == 2){
                        $gender = "male";
                    }
                }
            }
            else{
                $title = "Product no longer available";
                include_once 'header.php';
                carousel($text1, $text2);
                echo '
                <div class="container-fluid">
                    <h4 class="pt-5 mb-5">Product no longer available</h4> ';
                echo"
            	<!--Threee Images -->
        			<div class='row p-0 mb-3'>";
    					$sql = "SELECT * FROM producttb ORDER BY RAND();";
    			
    	    	        $results = mysqli_query($product_conn, $sql);
    					$i = 0;
    					while($row = mysqli_fetch_assoc($results)) {
    					    if(strcasecmp($row['active'], "yes") === 0){
        						if($i > 3){
        							break;
        						}
        						$i++;
        						fourImages($row['product_name'], $row['product_price'], $row['product_img'], $row['product_shrt_discript'], $row['product_brand_name']);
    					    }
    					}
				echo"
			        </div>
			    </div>";
                include_once 'footer.php';
                exit;
            }
        }
        else{
                $title = "Product no longer available";
                include_once 'header.php';
                carousel($text1, $text2);
                echo '
                <div class="container-fluid">
                    <h4 class="pt-5 mb-5">Product no longer available</h4> ';
                echo"
            	<!--Threee Images -->
        			<div class='row p-0 mb-3'>";
    					$sql = "SELECT * FROM producttb ORDER BY RAND();";
    			
    	    	        $results = mysqli_query($product_conn, $sql);
    					$i = 0;
    					while($row = mysqli_fetch_assoc($results)) {
    					    if(strcasecmp($row['active'], "yes") === 0){
        						if($i > 3){
        							break;
        						}
        						$i++;
        						fourImages($row['product_name'], $row['product_price'], $row['product_img'], $row['product_shrt_discript'], $row['product_brand_name']);
    					    }
    					}
				echo"
			        </div>
			    </div>";
                include_once 'footer.php';
                exit;
            }
        
        $sql = "UPDATE producttb 
        SET productVC = '$productVC'
        WHERE product_name = '$product_name';";
        
        $results = mysqli_query($product_conn, $sql);

        if(!$results) {
            echo "
                <script>
                    console.log('Product View Counter Failed');
                </script>
            ";
        }
    
?>

        <div class='container text-center pt-4'>

            <h6 class='text-uppercase'>Recommendations</h6>
            <hr class='px-auto'>
        </div>
        
        <!-- START OF FOUR IMAGES -->
        <div class='container-fluid mt-0 mb-3' >
            <div class='row'>
                <?php

                    // OUTPUT RECOMMENDATIONS BASED ON CATEGORY
                    if(strcasecmp($category, "t-shirt") == 0){
                        $category2 = "jeans";
                        $category3 = "jackets";
                    }
                    elseif(strcasecmp($category, "jackets") == 0){
                        $category2 = "jersey";
                        $category3 = "jeans";
                    }
                    elseif($category == "jeans" || $category == "denim"){
                        $category2 = "jersey";
                        $category3 = "t-shirt";
                    }
                    else{
                        $category2 = "jackets";
                        $category3 = "t-shirt";
                    }
                    
                    $i = 0;
                    $product_id = $_GET['id'];

                    $sql = "SELECT * FROM producttb ORDER BY RAND();";
			
					$results = mysqli_query($product_conn, $sql);

                    // GET ITEM BY RECOMMENDATION CATEGORY
                    while($row = mysqli_fetch_assoc($results)){
                        if(strcasecmp($row['active'], "yes") === 0){
                            if(strcasecmp($row['product_gender'], $gender) == 0 || strcasecmp($row['product_gender'], "unisex") == 0 ){
                                foreach($row as $key => $value){
        
                                    if($key == 'product_category' && strcasecmp($value, $category2)==0 || strcasecmp($value, $category3)==0){
                                        
                                        if($i<4){
                                            fourImages($row['product_name'], $row['product_price'], $row['product_img'], $row['id'], $row['product_brand_name']);
                                            $i++;
                                        }
        
        
                                    }
                                }
                            }
                        }
                    }

                ?>
            </div>
        </div>
        <!--END OF FOUR IMAGES-->
        
        <!-- Change Images JS/Jquery -->
        <script>

        	var mainImg = document.getElementById('mainImg');
        	var smallImg = document.getElementsByClassName('small-img');
        	
        	smallImg[0].onclick = function () {
        		mainImg.src = smallImg[0].src;
        	}
        	smallImg[1].onclick = function () {
        		mainImg.src = smallImg[1].src;
        	}
        	smallImg[2].onclick = function () {
        		mainImg.src = smallImg[2].src;
        	}
        	smallImg[3].onclick = function () {
        		mainImg.src = smallImg[3].src;
        	}
        	
        </script>
        
        <script>
            
            $(document).ready(function(){
            for(let j = 0; j < parkInfo.data[i].images.length; j++) {
              $('<div class="item"><img src="'+parkInfo.data[i].images[j].url+'" width="50%">   </div>').appendTo('.carousel-inner');
              $('<li data-target="#carousel" data-slide-to="'+j+'"></li>').appendTo('.carousel-indicators')
            
            }
              $('.item').first().addClass('active');
              $('.carousel-indicators > li').first().addClass('active');
              $('#carousel').carousel();
            });
            
        </script>
        <!-- End Of Change Images JS/Jquery -->
<?php

	include_once 'footer.php';
    } 
    else{
    echo "Please try again...";
    }
    
    
?>
