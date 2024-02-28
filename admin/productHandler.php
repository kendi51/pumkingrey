<?php 

session_start();
if(strcasecmp($_SESSION['accType'], "admin") == 0){
    if(isset($_SESSION['useruid'])){
        
        $title = "Welcome To Product: Pumkin";
        include_once "adminHeader.php";


        if(isset($_GET['id'])) {
        
            $product_id = $_GET['id'];
            $results = $database->getData();
            while($row = mysqli_fetch_assoc($results)){
        
                    if($row['id'] == $product_id){
                        
                        $product_name = explode(" ", $row['product_name']);
                        $product_name = implode("_", $product_name);
                        $link = "www.pumkingrey.com/Item/".$product_name;
                        $f = "https://www.facebook.com/sharer.php?u=".$link;
                        $t = "https://twitter.com/share?url=".$link."&text=".$row['product_name'] ." - R".$row['product_price'];
        ?>
        
        <div class="container mt-3">
            <form action="delete.php" method="POST">
                <div class="row">
                    <div class="col-4">
                <input type="hidden" name="id" value="<?php echo $product_id; ?>">
                <button type='submit' name="delete" class='btn btn-outline-danger btn-lg btn-block my-2 btn-text'>Delete</button>
                </div>
                <?php 
                    if(strcasecmp($row['active'], "yes") === 0){
                        ?>
                        <div class="col-4">
                            <input type="hidden" name="id" value="<?php echo $product_id; ?>">
                            <button type='submit' name="deactivate" class='btn btn-outline-warning btn-lg btn-block my-2 btn-text'>Deactivate</button>
                        </div>
                        
                        <?php 
                    }
                    elseif(strcasecmp($row['active'], "no") === 0){
                        ?>
                        <div class="col-4">
                            <input type="hidden" name="id" value="<?php echo $product_id; ?>">
                            <button type='submit' name="activate" class='btn btn-outline-success btn-lg btn-block my-2 btn-text'>Activate</button>
                        </div>
                        
                        <?php
                    }
                ?>
                <div class='col-4'>
                    <a href="<?php echo $row['purchaseLink']; ?>" class="btn btn-outline-primary btn-lg btn-block my-2 btn-text" target='_blank'>Purchase</a>
                </div>
            </form>
        </div>
        
        <?php
        
        
            
        
                        
        
                        productHandlerElement($row['product_name'], $row['product_price'], $row['product_img'], $row['product_shrt_discript'], $row['product_long_discript'], $row['id'],  $row['product_sec_img'], $row['product_third_img'], $row['product_forth_img'], $row['product_size_type'], $row['product_brand_name'], $row['product_gender'],  $row['product_category'], $f, $t, $link);
                        $category = $row['product_category'];
        
                        $sql = "SELECT * FROM inventorytb WHERE product_id = $product_id;";
        			
                        $results = mysqli_query($db, $sql);
                        $resultsCheck = mysqli_num_rows($results);
        	
                        //$results = $db2->getData();
                        while($row = mysqli_fetch_assoc($results)){
                           
                                if($row['size_type'] == 1){
                                    $size_type = $row['size_type'];
                                    $s28 =  $row['size28'];
                                    $s30 =  $row['size30'];
                                    $s32 =  $row['size32'];
                                    $s34 =  $row['size34'];
                                    $s36 =  $row['size36'];
                                    $s38 =  $row['size38'];
                                    $s40 =  $row['size40'];
                                }
                                elseif($row['size_type'] == 2){
                                    $size_type = $row['size_type'];
                                    $xs =  $row['xs'];
                                    $s =  $row['s'];
                                    $m =  $row['m'];
                                    $l =  $row['l'];
                                    $xl =  $row['xl'];
                                    $xxl =  $row['xxl'];
                                }
                                else{
                                    echo "ERROR FINDING INVENTORY!!!";
                                }
                            
                        }
                        if($size_type == 1){
                            echo inventoryJeanSize($s28, $s30, $s32, $s34, $s36, $s38, $s40);
                        }
                        elseif ($size_type == 2) {
                            echo inventoryShirtSize($xs, $s, $m, $l, $xl, $xxl);
                        }
                        else{
                            echo "ERROR NO SIZES AVAILABLE: CHECK SIZE TYPE.";
                        }
        
                        echo "
                        <input type='hidden' name='product_id' value='$product_id'>
                        <button type='submit' class='btn btn-light btn-lg btn-block my-2'>Update Meta-Data</button>
        
                    </form>
                </div>
            </div>
        </section>";
                    }
                
            }
            ?>
            
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
        
            <?php
            include_once 'adminFooter.php';
        }
    }
    else{
        header("location: /Admin/Login");
    }
}
else{
    header("location: /Home");
}