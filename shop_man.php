<?php
	$title = 'Shop Everything MAN: Pumkin';
    $page = basename($_SERVER['PHP_SELF']); 

    include_once "header.php";

    carousel($text1, $text2);
    
    $result = $link_db->getData();
    while($row = mysqli_fetch_assoc($result)){
        if(strcasecmp($row['link_search'], "t-shirt") == 0){
            leftImg($row['link_img'], $row['link_title'], $row['link_para'], $row['link_filter'], $row['link_search']);
        }
    }

?>
    

<!--Threee Images -->
<div class="container-fluid mb-0" >
    <div class="row">
        <?php
            $filter = 'product_gender';
            $male = 'male';
            $uni = 'unisex';
            $sql = "SELECT * FROM producttb WHERE active = 'yes' AND $filter = '$male' OR $filter = '$uni' ORDER BY productVC DESC;";
			
	    	$results = mysqli_query($product_conn, $sql);
            $i = 0;
            
            while($row = mysqli_fetch_assoc($results)){
                if(strcasecmp($row['active'], "yes") === 0){
                        //foreach($row as $key => $value){
                            //if($key == "product_category" && strcasecmp($value, "Jackets")==0 || strcasecmp($value, "jersey")==0 ||strcasecmp($value, "t-shirt")==0){
                                if($i <=3){
                                    fourImages($row['product_name'], $row['product_price'], $row['product_img'], $row['product_shrt_discript'], $row['product_brand_name'], $page);
                                    $i++;
                                }
                            //}
                        //}
                    
                }

            }
        ?>
    </div>
</div>
<!--END OF THREE IMAGES-->


<!-- RIGHT IMG WITH RIGHT TEXT -->
<?php
    $result = $link_db->getData();
    while($row = mysqli_fetch_assoc($result)){
        if(strcasecmp($row['link_search'], "zando") == 0){
            rightImg($row['link_img'], $row['link_title'], $row['link_para'], $row['link_filter'], $row['link_search']);
        }
    }
?>
<!-- END OF RIGHT IMG RIGHT TEXT -->

<!-- START OF FOUR IMAGES -->
<div class="container-fluid mt-2 mb-3" >
    <div class="row ">
    <?php
            $sql = "SELECT * FROM producttb WHERE active = 'yes' AND $filter = '$male' ORDER BY RAND();";
			
	    	$results = mysqli_query($product_conn, $sql);
            $i = 0;
            $numRows = mysqli_num_rows($results);
          
            if(($numRows - 4) % 3){
                while($row = mysqli_fetch_assoc($results)){
                                
                    if($i > 3  && $i <= 18){
                        threeImages($row['product_name'], $row['product_price'], $row['product_img'], $row['product_shrt_discript'], $row['product_brand_name'] , $page);
                        $i++;
                    }
                    else{
                        $i++;
                    }
                }
            }
            else{
                while($row = mysqli_fetch_assoc($results)){
                                
                    if($i > 3  && $i <= 18){
                        fourImages($row['product_name'], $row['product_price'], $row['product_img'], $row['product_shrt_discript'], $row['product_brand_name'] , $page);
                        $i++;
                    }
                    else{
                        $i++;
                    }
        
                }
            }
        ?>
    </div>
</div>
<!--END OF FOUR IMAGES-->

<?php
	include_once 'footer.php';
?>