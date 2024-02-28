<?php
session_start();

if(isset($_SESSION['orderId'])){
    $orderId = $_SESSION['orderId'];
    $title = 'Successful Payment: Pumkin';
    include_once 'header.php';

    $db = new CreateDb("u843931047_productdb", "producttb"); //online db
    // $db = new CreateDb("Productdb", "Producttb"); //local db
    
    // COLLECTING ORDER INFO
    $sql = "SELECT * FROM pumkinorderdetails WHERE id = $orderId;";
	$results = mysqli_query($conn, $sql);
	$resultsCheck = mysqli_num_rows($results);
	while($row = mysqli_fetch_assoc($results)){
	    if($row['id'] == $orderId){
	        $userId = $row['userId'];
	        $orderRef = $row['orderRef'];
			$totalPrice = $row['orderTotalPrice'];
			$delAddress = $row['deliveryAddress'];
			$paySuccess = $row['paymentSuccess'];
			$newDate = date('d-m-Y', strtotime($row['dateOfTrans']));
			$cart = $row['orderContent'];
	    }
	}
	$address = explode('#', $delAddress);
	
	// COLLECTING USERS INFO
	$sql = "SELECT * FROM users WHERE usersId = $userId;";
	$results = mysqli_query($conn, $sql);
	$resultsCheck = mysqli_num_rows($results);
	while($row = mysqli_fetch_assoc($results)){
	    if($row['usersId'] == $userId){
	        $name = $row['usersName'];
	        $email = $row['usersEmail'];
	        $phoneNum = $row['usersPhoneNum'];
	    }
	}
?>
    <div class='container-fluid'>
		<div class='heading my-3'>
			<h3>Order Number - <?php echo $orderRef ?></h3>
		</div>
		<div class='row' style='background-color: #f8f9fa;'>
			<div class='col-lg-3 col-md-3 col-6 p-3'>
				<div class='sub'>
						<span>Shipping Method</span>
				</div>
				<div class='content'>
					<h6>Delivery</h6>
				</div>
			</div>
	
			<div class='col-lg-3 col-md-3 col-6 p-3'>
				<div class='sub'>
					<span>Shipping Option</span>
				</div>
				<div class='content'>
					<h6>Standard</h6>
				</div>
			</div>

			<div class='col-lg-3 col-md-3 col-6 p-3'>
				<div class='sub'>
					<span>Payment Status</span>
				</div>
				<div class='content'>
					<h6>
					<?php
					if($paySuccess == null){
					    echo "<font color='red'>Payment Error<br><small>Do not make another payment</small></font> ";
					}
					else{
						echo "<font color='#00B0BA'>$paySuccess</font>";
					}
					?>
					</h6>
				</div>
			</div>
	
			<div class='col-lg-3 col-md-3 col-6 p-3'>
				<div class='sub'>
					<span>Order Date</span>
				</div>
				<div class='content'>
					<h6><?php echo $newDate ?></h6>
				</div>
			</div>
		</div>
		
		<div class="container-fluid mt-2">
			<div class="py-1" style="background-color: #f8f9f9">
				<h6>Order placed (<?php echo $newDate ?>)</h6>
			</div>
			<div class="row">
				<div class="col-lg-5 text-left">
					<h5 class="pt-2 mb-0">Contact Details</h5>
					<div class="row">
						<div class="mb-1 col-12">
    						<input type="text" class="form-control" id="firstName" placeholder="Full Name" value="<?php echo $name; ?>" disabled>
						</div>
						<div class="mb-1 col-12">
							<input type="text" class="form-control" id="phoneNum" value="<?php echo $phoneNum; ?>" disabled>
						</div>
					</div>

					<div class="mb-1">
						<input type="email" class="form-control" id="email" value="<?php echo $email; ?>" disabled>
					</div>
					
					<div class="mt-3">
						<div class="row">
							<div class="col-6 text-left">
								<h5>Delivery Address:</h5>
							</div>
						</div>
						<input type="text" class="form-control" name="street" value="<?php echo $address[0]; ?>" disabled>
					</div>

					<div class="mb-3">
						<input type="text" class="form-control" name="suburb" value="<?php echo $address[1]; ?>" disabled>
					</div>

					<div class="row">
						<div class="col-md-5">
    						<input type="text" class="form-control" name="city" value="<?php echo $address[2]; ?>" disabled>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control" name="province" value="<?php echo $address[3]; ?>" disabled>
						</div>
						<div class="col-md-3">
							<input type="text" class="form-control" name="postalCode" value="<?php echo $address[4]; ?>" disabled>
						</div>
					</div>			
				</div>

				<div class="col-lg-7">
					<div class="row pt-2 px-0">
						<div class="col-6 text-left">
							<h5><font color="#00B0BA">Total Price: </font></h5>
						</div>
						<div class="col-6 text-right">
							<h5><font color="#00B0BA">R <?php echo $totalPrice ?></font></h5>
						</div>
					</div>
					
					<?php
						$cart = unserialize($cart);
						$total = 0;
						$product_id = array_column($cart, 'product_id');
						$size = array_column($cart, 'size');
						
						$results = $db->getData();
						while($row = mysqli_fetch_assoc($results)){
						  foreach($product_id as $id){
							if($row['id'] == $id){
							    $i = array_search($row['id'], $product_id);
							  //$qty = $_POST['qty-input'];
							  orderElement($row['product_name'], $row['product_price'], $row['product_img'], $row['product_shrt_discript'], $row['id'], $size[$i]);
							  $total += $row['product_price'];
							}
						  }
						}
					?>
				</div>
			    </div>
					<div class="py-1" style="background-color: #f8f9f9">
						<h6>For order cancelations please call 078 599 4394 or cancelations@pumkingrey.co.za</h6>
					</div>
				</div>
    
<?php
    include_once 'footer.php';   
}
?>