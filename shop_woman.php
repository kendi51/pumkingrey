<?php
	$title = 'Shop Everything LADIES: Pumkin';
    include_once "header.php";

    carousel($text1, $text2);

    $result = $link_db->getData();
    while($row = mysqli_fetch_assoc($result)){
        if(strcasecmp($row['link_search'], "female") == 0){
            leftImg($row['link_img'], $row['link_title'], $row['link_para'], $row['link_filter'], $row['link_search']);
        }
    }
?>

<!--Threee Images -->
<div class="container-fluid my-3 mb-0" >
    <div class="row p5">
        <?php
            $sql = "SELECT * FROM producttb WHERE active = 'yes' AND product_gender = 'female' OR product_gender = 'unisex' ORDER BY id DESC LIMIT 3;";
			
	    	$results = mysqli_query($product_conn, $sql);
            $i = 0;
            while($row = mysqli_fetch_assoc($results)){
                
                threeImages($row['product_name'], $row['product_price'], $row['product_img'], $row['product_shrt_discript'], $row['product_brand_name'], $page);
                                
            }
            
            $sql = "SELECT * FROM producttb WHERE active = 'yes' AND product_gender = 'female' OR product_gender = 'unisex' ORDER BY id DESC;";
			
	    	$results = mysqli_query($product_conn, $sql);
            $i = 0;
            while($row = mysqli_fetch_assoc($results)) {
                    if($i > 2 && $i <= 18){
                        fourImages($row['product_name'], $row['product_price'], $row['product_img'], $row['product_shrt_discript'], $row['product_brand_name']);
                    }
                    elseif($i == 18){
                        break;
                    }
                    $i++; 
            }
            
        ?>
    </div>
</div>
<!--END OF THREE IMAGES-->

<?php
	include_once 'footer.php';
?>