<?php
	$title = 'Shopping Page: Pumkin';
	include_once 'header.php';
	
	if(isset($_POST['link'])){
	    
	    $link_img = $_POST['link_img'];
	    $title = $_POST['title'];
	    $para = $_POST['para'];
	    $filter = $_POST['filter'];
	    $searchVal = $_POST['searchVal'];
	    
	    carousel($text1, $text2);
?>
        <!-- Link Card on Searched Shopping Page -->
        <div class='container-fluid my-3 bg-dark'>
            <div class='row center-img m-1 bg-dark text-white'>
                <div class='col-6 p-2 d-block d-md-none d-lg-none d-xl-none'>
                    <img src="<?php echo $link_img; ?>" class='img-fluid w-100' style='border: 0.5em solid #f8f9fa'>
                </div>
                <div class='col-6 p-4 d-none d-md-block d-lg-block d-xl-block'>
                    <img src="<?php echo $link_img; ?>" class='img-fluid w-50' style='border: 0.5em solid #f8f9fa'>
                </div>
                
                <div class='col-6 mt-2 pl-0 d-none d-md-block d-lg-block d-xl-block'>
                    <h2 class=''><?php echo $title; ?></h2>
                    <p style='font-size: 2vmax'><?php echo $para; ?></p>
                </div>
                <div class='col-6 mt-2 pl-0 d-block d-md-none d-lg-none d-xl-none'>
                    <h4 class=''><?php echo $title; ?></h4>
                    <p style='font-size: 1.2vmax'><?php echo $para; ?></p>
                </div>
            </div>
        </div>
        
        <!-- Row Of Searched Products-->
        <div class="container-fluid mt-0 mb-0" >
            <div class="row p5">

<?php
        $sql = "SELECT * FROM producttb WHERE $filter = '$searchVal' ORDER BY id DESC;";
			
		$results = mysqli_query($product_conn, $sql);
        while($row = mysqli_fetch_assoc($results)) {
            if(strcasecmp($row['active'], "yes") === 0){
                fourImages($row['product_name'], $row['product_price'], $row['product_img'], $row['product_shrt_discript'], $row['product_brand_name']);
            }
        }
        echo "
            </div>
        </div>
        </div>";
	}
	else{
?>

<!-- Text Banner -->
<?php
    carousel($text1, $text2);

    // $result = $link_db->getData();
    // while($row = mysqli_fetch_assoc($result)){
    //     if(strcasecmp($row['link_title'], "zulu mafia") == 0){
    //         leftImg($row['link_img'], $row['link_title'], $row['link_para'], $row['link_filter'], $row['link_search']);
    //     }
    // }
    
?>
<!--END OF Text Banner -->


<!--Threee Images -->
<div class="container-fluid  mb-0" >
    <div class="row p5">
        <?php
        
            $sql = "SELECT * FROM producttb WHERE active = 'yes' ORDER BY RAND() LIMIT 3;";
			
		    $results = mysqli_query($product_conn, $sql);
            $i = 0;
            while($row = mysqli_fetch_assoc($results)) {
                    $img = $row['product_img'];
                    $productName = $row['product_name'];
                    $short = $row['product_shrt_discript'];
                    $brand =$row['product_brand_name'];
                    $price = $row['product_price'];
                    $storeId[] = $row['id'];
                    
                    if($i<2){
                    threeImages($row['product_name'], $row['product_price'], $row['product_img'], $row['product_shrt_discript'], $row['product_brand_name']);
                    }
                    $i++;
                
            }
            $product_name = explode(" ", $productName);
            
            $product_name = implode("_", $product_name);

        ?>
        
                <div class='col-6 col-md-4 col-lg-4 wrapper mt-3 d-none d-lg-block d-md-block'>



                <div class='card'>
                    <a href='/Item/<?php echo $product_name ?>' name='item'>
                        <img src='/<?php echo $img ?>' name='item' class='width-set' alt='<?php echo $productName ?>' style='' width='100%' height='auto'>
                    </a> 
                                            <div class='content'>

                            <div class='row text-center'>

                                <div class='details col-12 px-1 mt-3'>
                                    <h6 style='font-size: 14px;'><?php echo $productName ?></h6>
                                    <h6 class='' style='font-size: 12px; font-weight: 100;text-transform: uppercase'><?php echo $brand ?><h6>
                                </div>
                                <div class='priceTags col-12'>
                                    <h6>
                                    R <?php echo $price ?></h6>
                                </div>
                            </div>

                            <input type='hidden' name='product_id' value='$productId'>
                        </div>
                    
                </div>
        </div >
    </div>
</div>

<!-- END OF THREE IMAGES -->

<!--four Images -->
<div class="container-fluid mt-3 mb-0" >
    <div class="row p5">

<?php
            $sql = "SELECT * FROM producttb WHERE active = 'yes' ORDER BY productVC DESC LIMIT 4;";
			
		    $results = mysqli_query($product_conn, $sql);
            $i = 0;
            $found = false;
            while($row = mysqli_fetch_assoc($results)) {
                if(strcasecmp($row['active'], "yes") === 0){
                    $id = $row['id'];
                    //for($i =0; $i < 3; $i++){
                        
                    //if($id == $storeId[$i]){
                     //   $found = true;
                   //     echo $row['id'];
                        
                        
                    //}
                    //else{
                      //  $found = false;
                        
                    
                    
                    
                    fourImages($row['product_name'], $row['product_price'], $row['product_img'], $row['product_shrt_discript'], $row['product_brand_name']);
                   // echo $row['id'];
                        
                    //}
                    //}
                }
            }
            
            
        ?>
    </div>
</div></div>
<!--END OF FOUR IMAGES-->

<!-- Animated Style Images  NOT VISIBILE d-none--> 
<div class="container-fluid textCenter mt-5 d-none" style="padding-left: 5em;padding-right: 5em;">
  <div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="fashion-week images textCenter" style="border: 1em solid #f8f9fa">
            <!-- text on the outside of the picture -->
            <div class ="label">Fresh Off-The Runway <br>
            <!-- text on hover of the picture -->
            <a class="label-2" href="Shopping page.php">Shop NOW</a>
            </div>
        </div>
        <p>South African Fashion Week 2018 / #StyleBySA / Cape Town, South Africa
            </p>
    </div>
        
    <div class="col-sm-6 col-md-6" >
        <div class="never-get-cold images textCenter" style="border: 1em solid #f8f9fa">
            <div class ="never-label">NEVER GET COLD <br>
            <a class="never-label-2" href="Shopping page.php">Shop NOW</a>
            
            </div>
        </div>
        <p>Maaike Bakker, a amazing artist, illustrated this awesome design's. 
        </p>
    </div>
    
  </div>
</div>
<!--END OF Animated Style Images-->

<!-- LEFT IMG WITH RIGHT TEXT -->
<?php
    // $result = $link_db->getData();
    // while($row = mysqli_fetch_assoc($result)){
    //     if(strcasecmp($row['link_search'], "female") == 0){
    //         leftImg($row['link_img'], $row['link_title'], $row['link_para'], $row['link_filter'], $row['link_search']);
    //     }
    // }
?>
<!-- END OF LEFT IMG RIGHT TEXT -->



<!-- Text Banner -->
<?php
    carousel($text1, $text2);
?>
<!--END OF Text Banner -->



<!-- RIGHT IMG WITH RIGHT TEXT -->
<?php
    // $result = $link_db->getData();
    // while($row = mysqli_fetch_assoc($result)){
    //     if(strcasecmp($row['link_search'], "zando") == 0){
    //         rightImg($row['link_img'], $row['link_title'], $row['link_para'], $row['link_filter'], $row['link_search']);
    //     }
    // }
?>
<!-- END OF RIGHT IMG RIGHT TEXT -->



<div class="container textCenter mt-4 d-none">
    <div class="container col-sm-12">
           <!-- <div class="row mx-0" >
                <img src="images/download (21).jpg" class="mx-0 px-0" alt="Zulu COCAINE " width="33.3%" height="auto"/>
                <img src="images/download (23).jpg" class="mx-0 px-0" alt="Zulu COCAINE " width="33.3%" height="auto"/>-->
                <img src="images/patta-ss18-lookbook-09-640x427.jpg" class="mx-0 px-0" alt="Zulu COCAINE " width="80%" height="auto"style="border: 1em solid #f8f9fa"/>
                <p class="mb-3 mt-1">This is where text describe why someone should the displayed above clothes.
                    This is where text describe why someone should the displayed above clothes.
                 </p>
                <a class="label-2" href="#">Shop NOW
                    <button type="button" class="btn btn-outline-light" style="font-size: 20px;text-align:center">Show Collection</button>
                </a>
                <div class="carousel-caption textCenter">
                    <p style="text-transform: bold">
                        
                    </p>
                </div>
            
        </div>
</div>




<!-- START OF FOUR IMAGES -->
<div class="container-fluid mt-2 mb-0" >
    <div class="row p5">
        <?php
            $sql = "SELECT * FROM producttb WHERE active = 'yes' ORDER BY RAND() DESC;";
			
	    	$results = mysqli_query($product_conn, $sql);
            $i = 0;
            $numRows = mysqli_num_rows($results);
            //$numRows -= 4;
            
            if(($numRows - 4) % 3 === 0){
                while($row = mysqli_fetch_assoc($results)){
                    if(strcasecmp($row['active'], "yes") === 0){
                        if($i > 3  && $i <= 14){
                            threeImages($row['product_name'], $row['product_price'], $row['product_img'], $row['product_shrt_discript'], $row['product_brand_name'] , $page);
                            $i++;
                        }
                        else{
                            $i++;
                        }
                    }
                }
            }
            else{
                while($row = mysqli_fetch_assoc($results)){
                    if(strcasecmp($row['active'], "yes") === 0){
                        if($i > 3  && $i <= 18){
                            fourImages($row['product_name'], $row['product_price'], $row['product_img'], $row['product_shrt_discript'], $row['product_brand_name'] , $page);
                            $i++;
                        }
                        else{
                            $i++;
                        }
                    }
                }
            }
    
        ?>
    </div>
</div>

<!--END OF FOUR IMAGES-->

<!-- LINK FOR MEN-->
<?php   

$result = $link_db->getData();
    while($row = mysqli_fetch_assoc($result)){
        leftImg($row['link_img'], $row['link_title'], $row['link_para'], $row['link_filter'], $row['link_search']);
        break;
    }

}
	include 'footer.php';
	

?>

