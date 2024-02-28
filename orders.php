<?php
session_start();

if(isset($_SESSION['useruid'])){

$title = "Orders and Cart Details : Pumkin";


if(isset($_GET['u']) && $_SESSION['useruid'] !== 'admin') {
        
    $orderId = $_GET['u'];
    
    
    include_once 'php/createDb.php';
    include_once 'php/components.php';
    include_once 'includes/functions.inc.php';
    include_once 'includes/dbh.inc.php';
    
    $db = new CreateDb("u843931047_productdb", "producttb"); //online db
    // $db = new CreateDb("Productdb", "Producttb"); //local db
    
    $sql = "SELECT * FROM pumkinorderdetails WHERE id = $orderId;";
			
	$results = mysqli_query($conn, $sql);
	$resultsCheck = mysqli_num_rows($results);
	while($row = mysqli_fetch_assoc($results)){

			if($row['id'] == $orderId){
				$orderRef = $row['orderRef'];
				$totalPrice = $row['orderTotalPrice'];
				$paySuccess = $row['paymentSuccess'];
				$cart = $row['orderContent'];
				$newDate = date('d-m-Y', strtotime($row['dateOfTrans']));
				$orderUserId = $row['userId'];

			}
	}
    
    if($_SESSION['userid'] == $orderUserId){
    	//******************************************************* */ 
    	/**
    	* @param array $data
    	* @param null $passPhrase
    	* @return string
    	*/
    	function generateSignature($data, $passPhrase) {
    		// Create parameter string
    		$pfOutput = '';
    		foreach( $data as $key => $val ) {
    			if($val !== '') {
    				$pfOutput .= $key .'='. urlencode( trim( $val ) ) .'&';
    			}
    		}
    		// Remove last ampersand
    		$getString = substr( $pfOutput, 0, -1 );
    		if( $passPhrase !== null ) {
    			$getString .= '&passphrase='. urlencode( trim( $passPhrase ) );
    		}
    		return md5( $getString );
    	}
    
    	include_once 'header.php';
    
    	carousel($text1, $text2);

    
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
    								echo "Awaiting Payment";
    							}
    							else{
    								echo $paySuccess;
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
    	
    				<div class='payment mt-2'>
    
    				<?php
    
    				$userId = $_SESSION["userid"];
                    $sql = "SELECT * FROM users WHERE usersId = ?;";
    			
    				$stmt = mysqli_stmt_init($conn);
    			
    				if(!mysqli_stmt_prepare($stmt, $sql)){
    					echo "Error stmt failed";
    					exit();
    				}
    				mysqli_stmt_bind_param($stmt, "s", $userId);
    				mysqli_stmt_execute($stmt);
    			
    				$resultData = mysqli_stmt_get_result($stmt);
    				// LOADING USER VARIABLES
    				while($row = mysqli_fetch_assoc($resultData)){
    					$phoneNumber = $row['usersPhoneNum'];
    					$email = $row['usersEmail'];
    					$fname = $row['usersName'];
    					$address = $row['usersBillingAddress'];
    				}
                        
                        $nameStrArray = explode(" ", $fname);
                        if(count($nameStrArray)>2) {
                          $firstName = $nameStrArray[0]." ".$nameStrArray[1];
                          $lastName = $nameStrArray[2]; 
                        }
                        elseif(count($nameStrArray)>3){
                          $firstName = $nameStrArray[0]." ".$nameStrArray[1];
                          $lastName = $nameStrArray[2]." ".$nameStrArray[3];
                        }
                        else{
                          $firstName = $nameStrArray[0];
                          $lastName = $nameStrArray[1]; 
                        }
                        // ORDER NUMBERS/DETAILS
    
    
                        // Construct variables
                        $cartTotal = $totalPrice; // This amount needs to be sourced from your application
                        $passphrase = 'NkoSiYomZi20May7519'; // NkoSiYomZi20May7519 - TestpUmKintEst';
                        $data = array(
                            // Merchant details
                            'merchant_id' => '21730041', // sand - 10028383
                            'merchant_key' => 'smrdos4s88cna', // sand - chts2w118450h
                            'return_url' => 'https://pumkingrey.com/success.php',
                            'cancel_url' => 'https://pumkingrey.com/orders.php',
                            'notify_url' => 'https://pumkingrey.com/notify.php',
                            // Buyer details
                            'name_first' => $firstName,
                            'name_last'  => $lastName,
                            'email_address'=> $email,
                            // Transaction details
                            'm_payment_id' => $orderId, //Unique payment ID to pass through to notify_url
                            'amount' => number_format( sprintf( '%.2f', $cartTotal ), 2, '.', '' ),
                            'item_name' => $orderRef
                        );
    
                        $signature = generateSignature($data, $passphrase);
                        $data['signature'] = $signature;
    	
    				// If in testing mode make use of either sandbox.payfast.co.za or www.payfast.co.za
    				$testingMode = false;
    				$pfHost = $testingMode ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';
    				$htmlForm = '<form action="https://'.$pfHost.'/eng/process" method="post">';
    				foreach($data as $name=> $value)
    				{
    					$htmlForm .= '<input name="'.$name.'" type="hidden" value=\''.$value.'\' />';
    				}
    				$htmlForm .= '<button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</buttom>';
    				if($paySuccess == null){
    					echo '<img class="img-fluid w-100 mb-2" src="images/payFast/PayFast_Images/720x90.png" alt="PayFast_Banner">';
    					echo $htmlForm;
    					
    				}
    				?>
    				</div>
    
    				<div class="container-fluid">
    					<div class="py-1" style="background-color: #f8f9f9">
    						<h6>Order placed (<?php echo $newDate ?>)</h6>
    					</div>
    					<div class="row px-0">
    						<div class="col-lg-5 text-left">
    							<h5 class="py-2 mb-0">Contact Details</h5>
    							<div class="row pt-1">
    								<div class=" mb-2 col-12">
    								<input type="text" class="form-control" id="firstName" placeholder="Full Name" value="<?php echo $fname; ?>" disabled>
    								</div>
    								<div class="mb-2 col-12">
    								<input type="text" class="form-control" id="phoneNum" value="<?php echo $phoneNumber; ?>" disabled>
    								</div>
    							</div>
    
    							<div class="mb-2">
    								<input type="email" class="form-control" id="email" value="<?php echo $email; ?>" disabled>
    							</div>
    
    							<!-- END OF ADDRESS SORTING -->
    						<?php
    							$addressArray = explode("#", $address);
    							$street = $addressArray[0];
    							$suburb = $addressArray[1];
    							$city = $addressArray[2];
    							$province = $addressArray[3];
    							$postalCode = $addressArray[4];
    
    							?>
    							<!-- END OF ADDRESS SORTING -->
    
    							<div class="my-2">
    								<div class="row">
    									<div class="col-6 text-left">
    										<h5>Delivery:</h5>
    									</div>
    									<div class="col-6 text-right">
    										<h6>
    											<?php 
    											if($totalPrice> 1500) {
    												echo "<p><font color=green>FREE</font></p>";
    												
    											}
    											elseif(strcasecmp('cape town', $city) == 0){
    												echo "R 100";
    											}
    											else{
    												echo "R 250";
    											} 
    											?>
    										</h6>
    									</div>
    								</div>
    								<input type="text" class="form-control" name="street" value="<?php echo $street; ?>" disabled>
    							</div>
    
    							<div class="my-2">
    								<input type="text" class="form-control" name="suburb" value="<?php echo $suburb; ?>" disabled>
    							</div>
    
    							<div class="row mb-2">
    								<div class="col-md-5">
    								<input type="text" class="form-control mb-2" name="city" value="<?php echo $city; ?>" disabled>
    								</div>
    								<div class="col-md-4">
    								<input type="text" class="form-control mb-2" name="province" value="<?php echo $province ?>" disabled>
    								</div>
								    <div class="col-md-3">
    								<input type="text" class="form-control" name="postalCode" value="<?php echo $postalCode; ?>" disabled>
    								</div>
    							</div>
    							
    						</div>
    
    
    						<div class="col-lg-7">
    						<div class="row pt-2 ">
    							<div class="col-6 text-left">
    								<h5>Total Price:</h5>
    							</div>
    							<div class="col-6 text-right">
    								<h5>R <?php echo number_format($totalPrice, 2); ?></h5>
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
    				</div>
    			<?php
    include_once 'footer.php';
    			}
    			
    	
	
	else{
	    header("location: /Orders");
	    exit;
	}
}
elseif(isset($_GET['u']) && $_SESSION['useruid'] == 'admin') {

	include_once 'header.php';
	$db = new CreateDb("u843931047_productdb", "producttb"); //online db

    // $db = new CreateDb("Productdb", "Producttb"); //local db

	carousel($text1, $text2);

	$orderId = $_GET['u'];

	$sql = "SELECT * FROM pumkinorderdetails WHERE id = $orderId;";
			
	$results = mysqli_query($conn, $sql);
	$resultsCheck = mysqli_num_rows($results);
	while($row = mysqli_fetch_assoc($results)){

			if($row['id'] == $orderId){
				$orderRef = $row['orderRef'];
				$totalPrice = $row['orderTotalPrice'];
				$paySuccess = $row['paymentSuccess'];
				$cart = $row['orderContent'];
				$newDate = date('d-m-Y', strtotime($row['dateOfTrans']));
				$userId = $row['userId'];
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
							<span>Status</span>
						</div>
						<div class='content'>
							<h6>
							<?php
							if($paySuccess == null){
								echo "Awaiting Payment";
							}
							else{
								echo $paySuccess;
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

					
						<div class="orderPlaced my-3">
							<?php
							if((strcasecmp($paySuccess, 'order placed') !== 0) && $paySuccess !== null){
								echo "
								<form action='admin/orderPlaced.php' method = 'POST'>
									<input type='hidden' value='$orderId' name='orderId'>
									<button class='btn btn-primary btn-lg btn-block' type='submit' name='orderPlaced'>Place Order</button>
								</form>";
							}
							?>
						</div>

	
				</div>

				<?php

	
				$sql = "SELECT * FROM users WHERE usersId = ?;";
			
				$stmt = mysqli_stmt_init($conn);
			
				if(!mysqli_stmt_prepare($stmt, $sql)){
					echo "Error stmt failed";
					exit();
				}
				mysqli_stmt_bind_param($stmt, "s", $userId);
				mysqli_stmt_execute($stmt);
			
				$resultData = mysqli_stmt_get_result($stmt);
				// LOADING USER VARIABLES
				while($row = mysqli_fetch_assoc($resultData)){
					$phoneNumber = $row['usersPhoneNum'];
					$email = $row['usersEmail'];
					$fname = $row['usersName'];
					$address = $row['usersBillingAddress'];
				}

				?>

				<div class="container-fluid">
					<div class="py-1" style="background-color: #f8f9f9">
						<h6>Order placed (<?php echo $newDate ?>)</h6>
					</div>
					<div class="row px-0">
						<div class="col-lg-5 text-left">
							<h5 class="pt-2 mb-0">Contact Details</h5>
							<div class="row">
								<div class="mb-1 col-12">
								<input type="text" class="form-control" id="firstName" placeholder="Full Name" value="<?php echo $fname; ?>" disabled>
								</div>
								<div class="mb-1 col-12">
								<input type="text" class="form-control" id="phoneNum" value="<?php echo $phoneNumber; ?>" disabled>
								</div>
							</div>

							<div class="mb-1">
								<input type="email" class="form-control" id="email" value="<?php echo $email; ?>" disabled>
							</div>

							<!-- END OF ADDRESS SORTING -->
						<?php
							$addressArray = explode("#", $address);
							$street = $addressArray[0];
							$suburb = $addressArray[1];
							$city = $addressArray[2];
							$province = $addressArray[3];
							$postalCode = $addressArray[4];

							?>
							<!-- END OF ADDRESS SORTING -->

							<div class="mt-3">
								<div class="row">
									<div class="col-6 text-left">
										<h5>Delivery:</h5>
									</div>
									<div class="col-6 text-right">
										<h6>
											<?php 
											if($totalPrice> 1500) {
												echo "<p><font color=green>FREE</font></p>";
												
											}
											elseif(strcasecmp('cape town', $city) !== 0){
												echo "R 250";
											}
											else{
												echo "R 100";
											} 
											?>
										</h6>
									</div>
								</div>
								<input type="text" class="form-control" name="street" value="<?php echo $street; ?>" disabled>
							</div>

							<div class="mb-3">
								<input type="text" class="form-control" name="suburb" value="<?php echo $suburb; ?>" disabled>
							</div>

							<div class="row">
								<div class="col-md-5">
								<input type="text" class="form-control" name="city" value="<?php echo $city; ?>" disabled>
								</div>
								<div class="col-md-4">
								<input type="text" class="form-control" name="province" value="<?php echo $province; ?>" disabled>
								</div>
								<div class="col-md-3">
								<input type="text" class="form-control" name="postalCode" value="<?php echo $postalCode; ?>" disabled>
								</div>
							</div>
							
						</div>


						<div class="col-lg-7">
						<div class="row pt-2">
							<div class="col-6 text-left">
								<h5>Total Price:</h5>
							</div>
							<div class="col-6 text-right">
								<h5>R <?php echo number_format($totalPrice, 2); ?></h5>
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
elseif($_SESSION['useruid'] == 'admin'){

	include_once 'header.php';
	$db = new CreateDb("u843931047_productdb", "producttb"); //online db

    // $db = new CreateDb("Productdb", "Producttb"); //local db

	carousel($text1, $text2);
	
	sideBarAdmin($page);

	?>
	<div class="col-lg-8 col-md-8 text-center">
				<h5 class='heading mb-4' style='text-decoration: underline; text-decoration-color: #ffc107; text-decoration-style:wavy'>My Orders</h5>
				<div class="container">
				<?php
				
						// CODE TO DISPLAY ALL USERS
						$userid = $_SESSION['userid'];
								$sql = "SELECT * FROM pumkinorderdetails;";
			
								$results = mysqli_query($conn, $sql);
								$resultsCheck = mysqli_num_rows($results);
								$count = 0;

									echo"<div class='row p-3'>";
									while($row = mysqli_fetch_assoc($results)){
										
										$orderId = $row['id']; 
										echo"
										<div class='col-6'>
											<h6> <a href='/Orders?u=$orderId' name='orderId' style='text-decoration:underline'>
												".$row['orderRef']."
											</a></h6>
										<h6>".date('d-m-Y', strtotime($row['dateOfTrans']))."</h6> 
										</div>
										<div class='col-6'>
												<h6>R ".$row['orderTotalPrice']."</h6>
												<h6>";
												if($row['paymentSuccess']==null){
													echo "<font color='red'>pending</font>";
												}
												else{
													echo $row['paymentSuccess'];
												}
												echo "</h6>
										</div>
										<div class='col-12'><hr></div>
										
										";
										$count++;
									}
									//echo "<h4 class='center'>Number of Users: $count</h4>";
									echo"</div>";
						echo"</div>";
				?>
			</div>
		</div>
	</div>

	<?php
	include_once 'footer.php';
}
else{

	include_once 'header.php';

	carousel($text1, $text2);
	
	sideBar($page);
	?>
	

			<div class="col-lg-8 col-md-8 text-center">
				<h5 class='heading mb-4' style='text-decoration: underline; text-decoration-color: #ffc107; text-decoration-style:wavy'>My Orders</h5>
				<div class="container">
				<?php
				$uid = $_SESSION['useruid'];
					
				
						// CODE TO DISPLAY ALL USERS
						$userid = $_SESSION['userid'];
								$sql = "SELECT * FROM pumkinorderdetails WHERE userId = '$userid' ORDER BY id DESC LIMIT 8;";
			
								$results = mysqli_query($conn, $sql);
								$resultsCheck = mysqli_num_rows($results);
								$count = 0;

									echo"<div class='row p-3'>";
									while($row = mysqli_fetch_assoc($results)){
										
										$orderId = $row['id']; 
										echo"
										<div class='col-6 pending text-left'>
											<h6> <a href='/Orders?u=$orderId' name='orderId' style='text-decoration:underline'>
												".$row['orderRef']."
											</a></h6>
										<h6>".date('d-m-Y', strtotime($row['dateOfTrans']))."</h6> 
										</div>
										<div class='col-6 text-right'>
												<h6>R ".number_format($row['orderTotalPrice'], 2)."</h6>
												<h6>";
												if($row['paymentSuccess']==null){
													echo "<font color='red'>pending</font>";
												}
												else{
													echo $row['paymentSuccess'];
												}
												echo "</h6>
										</div>
										<div class='col-12'><hr></div>
										
										";
										$count++;
									}
									//echo "<h4 class='center'>Number of Users: $count</h4>";
									echo"</div>";
						echo"</div>";
				?>
			</div>
		</div>
	</div>

	<?php
	include_once 'footer.php';
}
}
else{
    header('location: login.php');
    exit;
}