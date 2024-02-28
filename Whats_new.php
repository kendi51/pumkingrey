<?php
	$title = 'What\'s New';
	include_once 'header.php';
    include_once 'php/components.php';

    carousel();

    $result = $link_db->getData();
    while($row = mysqli_fetch_assoc($result)){
        if(strcasecmp($row['link_search'], "tracksuit-d-none") == 0){
            leftImg($row['link_img'], $row['link_title'], $row['link_para'], $row['link_filter'], $row['link_search']);
        }
    }
?>

<!-- START OF   three IMAGES -->
<div class='container-fluid mt-3 mb-0' >
    <div class='row p5'>
        <?php

            $sql = "SELECT * FROM producttb WHERE active = 'yes' ORDER BY id DESC LIMIT 4;";
			
		    $results = mysqli_query($product_conn, $sql);
            $i = 0;
            while($row = mysqli_fetch_assoc($results)) {
                    fourImages($row['product_name'], $row['product_price'], $row['product_img'], $row['product_shrt_discript'], $row['product_brand_name']);
            }

        ?>
    </div>
</div>

<!--END OF THREE IMAGES-->

<?php
    $result = $link_db->getData();
    while($row = mysqli_fetch_assoc($result)){
        if(strcasecmp($row['link_search'], "zara") == 0){
            rightImg($row['link_img'], $row['link_title'], $row['link_para'], $row['link_filter'], $row['link_search']);
        }
    }
?>

    

<!-- START OF   three IMAGES -->
<div class='container-fluid my-3 mb-0' >
    <div class='row p5'>
        <?php

            $sql = "SELECT * FROM producttb WHERE active = 'yes' ORDER BY id DESC;";
			
		    $results = mysqli_query($product_conn, $sql);
            $i = 0;
            while($row = mysqli_fetch_assoc($results)) {
                if($i > 3 && $i <= 14){
                    fourImages($row['product_name'], $row['product_price'], $row['product_img'], $row['product_shrt_discript'], $row['product_brand_name']);
                }
                elseif($i == 14){
                    break;
                }
                $i++;
            }

        ?>
    </div>
</div>

<?php
	include_once 'footer.php';
?>