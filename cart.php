<?php
    session_start();

    if(isset($_POST['remove'])){
		if($_GET['action'] == 'remove'){
			foreach($_SESSION['cart'] as $key => $value){
				if($value["product_id"] == $_GET['id']){
					unset($_SESSION['cart'][$key]);
					unset($_SESSION['cartFound']);
					
					// Cleaning Array and Re-inserting it
                    $newCart = array_values($_SESSION['cart']);
                    unset($_SESSION['cart']);
                    $_SESSION['cart'] = $newCart;
				}
			}
			if(count($_SESSION['cart']) == 0){
				unset($_SESSION['cart']);
				if(isset($_SESSION['useruid'])){
					deleteCart($conn, $_SESSION['useruid']);
					unset($_SESSION['cartFound']);
				}
			}
		}
	}
	
	$title = 'Shopping Cart: Pumkin';
	include_once 'header.php';
	
	$db = new CreateDb("u843931047_productdb", "producttb"); //online db
// 	$db = new CreateDb("Productdb", "Producttb"); //local db
?>

<div class="container-fluid text-left">
	<div class="row">
    		<div class="col-12 mt-3">
    				<h2 class="text-center">What's in your cart?</h2>
    				<hr>
        	<?php 	
        	    if(isset($_SESSION['cart'])){ 
        	?>
    		</div>
			<div class="shopping-cart col-lg-8">
				<div class="row px-4 px-md-0 px-lg-0">
					<?php
						$total = 0;
							$product_id = array_column($_SESSION['cart'], 'product_id');
							$size = array_column($_SESSION['cart'], 'size');

							$results = $db->getData();
							while($row = mysqli_fetch_assoc($results)){
								foreach($product_id as $id){
									if($row['id'] == $id){
										$i = array_search($row['id'], $product_id);
										cartElement($row['product_name'], $row['product_price'], $row['product_img'], $row['product_shrt_discript'], $row['id'], $size[$i]);
										$total += $row['product_price'];
									}
								}
							}
					?>

				</div>
			</div>
            
            <!-- Subtotal and Checkout -->
			<div class='col-lg-4 my-4'>
				<div class="border rounded bg-white px-2">
					<h3 class='heading text-center mt-1'>summary</h3>
					<hr>
					<div class="row">
						<div class="col-8 col-md-9 col-lg-7 ">
							<h6 class='price-details'>Subtotal (<?php
								$count = 0;
									if(isset($_SESSION['cart'])){
										$count = count($_SESSION['cart']);
										echo "$count";
									}
								?>
								items)
							</h6>				
						</div>
						<div class="col-4 col-md-3 col-lg-5 ">
							<h6>R <?php echo number_format($total, 2); ?></h6>
						</div>
						<div class="col-8 col-md-9 col-lg-7 mt-2">
							<h6>Delivery: </h6>
							<hr>
						</div>
						<div class="col-4 col-md-3 col-lg-5 mt-2">
							<h6>
								<?php 
								if($total > 750){
								    echo "FREE";
								}
								else{
								    echo "-";
								}
								?>
								</h6>
								<hr>
						</div>

						<div class="col-8 col-md-9 col-lg-7">
							<h6>Total: </h6>
							<hr>
						</div>
						<div class="col-4 col-md-3 col-lg-5">
							<h6>R <?php echo number_format($total, 2); $_SESSION['total'] = $total;?></h6>
							<hr>
						</div>
						

					<div class="col d-flex justify-content-center mb-3">
						<a href="/Delivery" name="submit" class="btn btn-outline-light">Go To Checkout</a>
					</div>
					

				</div>
				
				
        	</div>
        	
        	<div class="d-block mb-2 py-2">
                      <div class="custom-radio">
                       <img class="img-fluid w-100" src="images/payFast/PayFast_Images/720x90.png" alt="PayFast_Banner">
                      </div>
                    </div> 
		</div>
	</div>
</div>



<?php
	include_once 'footer.php';
}
else{
	echo"
	
	<div class='buttons text-center'>
	<h5 class='text-center'>CART IS EMPTY</h5>";
	
	if(!isset($_SESSION['useruid'])){
	    echo"
    	<p class='mt-2 text-center px-md-5 px-lg-5'>There’s nothing in your cart yet. Sign in or create an account to unlock members-only rewards and personalised recommendations.</p>
        <div class='row'>
                <div class='col-6 px-md-5 px-lg-5'>
            <a href='/Login' style=' padding: 10px' class='btn btn-outline-light rounded btn-block' name='buy'>Login</a>
            </div>
            <div class='col-6 px-md-5 px-lg-5'>
            <a href='/Register' style=' padding: 10px' class='btn btn-outline-light rounded btn-block' name='buy'>Signup</a>
            </div>
            </div>
        </div>";
	}
	echo"
	<!--Threee Images -->
			<div class='row p-0 mb-3'>
				";
					$sql = "SELECT * FROM producttb WHERE active = 'yes' ORDER BY RAND() DESC;";
			
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
		</div>
	</div>	
</div>
		<!-- END OF THREE IMAGES -->
		";
		?>
		<script>
          $(document).ready(function () {
             $(".product_data small").fitText();
          });
        </script>
        
        <?php
		include_once 'footer.php';
}
?>