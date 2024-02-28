<?php
session_start();
if(strcasecmp($_SESSION['accType'], "admin") == 0){
    if(isset($_SESSION['useruid'])){

        $title = "Welcome To Orders: Pumkin";
        
        
        if(isset($_GET['orderId'])) {
        
        	include_once 'adminHeader.php';
        
        	$orderId = $_GET['orderId'];
        
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
        					<h3>Order ref - <?php echo $orderRef ?></h3>
        					
        				</div>
        				<div class='row bg-dark text-white'>
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
        							if(strcasecmp($paySuccess, 'complete') == 0){
        								echo "
        								<form action='/admin/orderPlaced.php' method = 'POST'>
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
        				$resultsCheck = mysqli_num_rows($resultData);
        				// LOADING USER VARIABLES
        				while($row = mysqli_fetch_assoc($resultData)){
        					$phoneNumber = $row['usersPhoneNum'];
        					$email = $row['usersEmail'];
        					$fname = $row['usersName'];
        					$address = $row['usersBillingAddress'];
        
        				}
        
        				?>
        
        				<div class="container-fluid">
        					<div class="py-1 bg-dark text-white">
        						<h6>Order placed (<?php echo $newDate ?>)</h6>
        					</div>
        					<div class="row">
        						<div class="col-lg-5 text-left">
        							<h5 class="py-2 mb-0">Contact Details</h5>
        							<div class="row pt-1">
        								<div class="mb-2 col-12">
        								<input type="text" class="form-control disable" id="firstName" placeholder="Full Name" value="<?php echo $fname; ?>" disabled>
        								</div>
        								<div class="mb-2 col-12">
        								<input type="text" class="form-control disable" id="phoneNum" value="<?php echo $phoneNumber; ?>" disabled>
        								</div>
        							</div>
        
        							<div class="mb-2">
        								<input type="email" class="form-control disable" id="email" value="<?php echo $email; ?>" disabled>
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
        												echo "R 100";
        											} 
        											?>
        										</h6>
        									</div>
        								</div>
        								<input type="text" class="form-control disable" name="street" value="<?php echo $street; ?>" disabled>
        							</div>
        
        							<div class="my-2">
        								<input type="text" class="form-control disable" name="suburb" value="<?php echo $suburb; ?>" disabled>
        							</div>
        
        							<div class="row mb-2">
        								<div class="col-md-5">
        								<input type="text" class="form-control disable" name="city" value="<?php echo $city; ?>" disabled>
        								</div>
        								<div class="col-md-4">
        								<input type="text" class="form-control disable" name="province" value="<?php echo $province; ?>" disabled>
        								</div>
        								<div class="col-md-3">
        								<input type="text" class="form-control disable" name="postalCode" value="<?php echo $postalCode; ?>" disabled>
        								</div>
        							</div>
        							
        						</div>
        
        
        						<div class="col-lg-7">
        						<div class="row pt-2">
        							<div class="col-6 text-left">
        								<h5>Total Price:</h5>
        							</div>
        							<div class="col-6 text-right">
        								<h5>R <?php echo $totalPrice ?></h5>
        							</div>
        						</div>
        					<?php
        						$cart = unserialize($cart);
        						$total = 0;
        						$product_id = array_column($cart, 'product_id');
        						$size = array_column($cart, 'size');
        	  
        						$results = $database->getData();
        						while($row = mysqli_fetch_assoc($results)){
        						  foreach($product_id as $id){
        							if($row['id'] == $id){
        							    $i = array_search($row['id'], $product_id);
        							  //$qty = $_POST['qty-input'];
        							  orderElementAdmin($row['product_name'], $row['product_price'], $row['product_img'], $row['product_shrt_discript'], $row['id'], $size[$i]);
        							  $total += $row['product_price'];
        							}
        						  }
        						}
        					?>
        				</div>
        				</div>
        					<div class="py-1 bg-dark text-white">
        						<h6>For order cancelations please call 078 599 4394 or cancelations@pumkingrey.co.za</h6>
        					</div>
        				</div>
        			<?php
        
        			
        			include_once 'adminFooter.php';
        			
        }
        elseif(isset($_GET['filter'])){
            $filter = $_GET['filter'];
            
            include_once 'adminHeader.php';
        
        	?>
        				
        				<div class="container-fluid">
        					<h5 class='heading my-3'></h5>
        					
                    	    <nav class="navbar navbar-dark bg-dark justify-content-between">
                              <a class="navbar-brand text-white pl-4">Client Orders</a>
                              <form action="Orders" class="form-inline" style='justify-content: right' method="GET">
                                <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search" required>
                                <select name='filter' class='my-2 my-sm-0 form-control inputRound' required>
                                    <option value=''>Select Filter</option>
                                    <option value='orderRef'>OrderRef</option>
                                    <option value='userName'>Full Name</option>
                                </select>
                                <button class="btn btn-outline-success ml-2 my-2 my-sm-0" type="submit">Search</button>
                              </form>
                            </nav>
        					
        					<?php
        					if(isset($_GET["error"])){
        						if($_GET["error"] == "stmtfailed"){
        							echo "<font color='red'><p>Enter correct password</p></font>";
        						}
        						elseif($_GET["error"] == "none"){
        							echo '<font color="green"><p>Order Placed <i class="far fa-thumbs-up fa-sm pb-3"></i></p></font>';
        						}
        					}
        					
        					?>
        					<div class='col-6 mb-3 1 d-none'>
                                <label for='firstName'>Size Type</label>
                                <select name='filter' id='filter' class='form-control mt-3' required>
                                    <option value='none'>Select Size Type</option>
                                    <option value='pending'>Pending</option>
                                    <option value='completed'>Completed</option>
                                    <option value='placed'>Order Placed</option>
                                </select>
                            </div>
        				<?php
        				
        				        $searchVal = trim($_GET['search']);
        				
        						// CODE TO DISPLAY ALL USERS
        								$sql = "SELECT * FROM pumkinorderdetails WHERE $filter = '$searchVal';";
        			
        								$results = mysqli_query($conn, $sql);
        								$resultsCheck = mysqli_num_rows($results);
        								$count = 0;
        
        									echo"<div class='container-fluid'>
        									<div class='row'>";
        									
        									while($row = mysqli_fetch_assoc($results)){
        									    
        										
        										$orderId = $row['id']; 
        										echo"
        										<div class='col-12 col-md-4 col-lg-4 text-white p-3 '>
        										<div class='row '>
        										<div class='col-6 pending "; if(strcasecmp($row['paymentSuccess'],"Complete") == 0 ){ echo "bg-success"; }elseif($row['paymentSuccess']== "Order Placed"){ echo "bg-dark";} else{ echo "bg-danger";} echo " py-4 px-1'>
        											<h6> <a class'bder' href='orders.php?orderId=$orderId' style='text-decoration:underline; color: white'>
        												".$row['orderRef']."
        											</a></h6>
        										<h6>".date('d-m-Y', strtotime($row['dateOfTrans']))."</h6> 
        										</div>
        										<div class='col-6 "; if(strcasecmp($row['paymentSuccess'],"Complete") == 0 ){ echo "bg-success"; }elseif($row['paymentSuccess']== "Order Placed"){ echo "bg-dark";} else{ echo "bg-danger";} echo " py-4 px-1'>
        												<h6>R ".$row['orderTotalPrice']."</h6>
        												<h6 style='text-transform: uppercase;'>";
        												if($row['paymentSuccess']==null){
        													echo "pending";
        												}
        												else{
        													echo $row['paymentSuccess'];
        												}
        												echo "</h6>
        										</div>
        										</div>
        										</div>
        										";
        										$count++;
        									}
        									//echo "<h4 class='center'>Number of Users: $count</h4>";
        									echo"</div>";
        						echo"</div>";
        				    
        				?>
        			</div>
        		</div>
        	
        
        	<?php
        	include_once 'adminFooter.php';
            
        }
        else{
            
        	include_once 'adminHeader.php';
            
        	?>
        				
        				<div class="container-fluid">
        					<h5 class='heading my-3'></h5>
        					
                    	    <nav class="navbar navbar-dark bg-dark justify-content-between">
                              <a class="navbar-brand text-white pl-4">Client Orders</a>
                              <form action="Orders" class="form-inline" style='justify-content: right' method="GET">
                                <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search" required>
                                <select name='filter' class='my-2 my-sm-0 form-control inputRound' required>
                                    <option value=''>Select Filter</option>
                                    <option value='orderRef'>OrderRef</option>
                                    <option value='userName'>Full Name</option>
                                </select>
                                <button class="btn btn-outline-success ml-2 my-2 my-sm-0" type="submit">Search</button>
                              </form>
                            </nav>
        					
        					<?php
        					if(isset($_GET["error"])){
        						if($_GET["error"] == "stmtfailed"){
        							echo "<font color='red'><p>Enter correct password</p></font>";
        						}
        						elseif($_GET["error"] == "none"){
        							echo '<font color="green"><p>Order Placed <i class="far fa-thumbs-up fa-sm pb-3"></i></p></font>';
        						}
        					}
        					
        					?>
        					<div class='col-6 mb-3 1 d-none'>
                                <label for='firstName'>Size Type</label>
                                <select name='filter' id='filter' class='form-control mt-3' required>
                                    <option value='none'>Select Size Type</option>
                                    <option value='pending'>Pending</option>
                                    <option value='completed'>Completed</option>
                                    <option value='placed'>Order Placed</option>
                                </select>
                            </div>
        				<?php
        				
        						// CODE TO DISPLAY ALL USERS
        								$sql = "SELECT * FROM pumkinorderdetails ORDER BY id DESC LIMIT 12;";
        			
        								$results = mysqli_query($conn, $sql);
        								$resultsCheck = mysqli_num_rows($results);
        								$i = 0;
        
        									echo"<div class='container-fluid'>
        									<div class='row'>";
        									while($row = mysqli_fetch_assoc($results)){
        										$orderId = $row['id']; 
        								        
        										    	
            										echo "
            										<div class='col-12 col-md-4 col-lg-4 text-white p-3 '>
            										<div class='row '>
            										<div class='col-6 pending "; if(strcasecmp($row['paymentSuccess'],"Complete") == 0 ){ echo "bg-success"; }elseif($row['paymentSuccess']== "Order Placed"){ echo "bg-dark";} else{ echo "bg-danger";} echo " py-4 px-1'>
            											<h6> <a class'bder' href='/Admin/Orders?orderId=$orderId' style='text-decoration:underline; color: white'>
            												".$row['orderRef']."
            											</a></h6>
            										<h6>".date('d-m-Y', strtotime($row['dateOfTrans']))."</h6> 
            										</div>
            										<div class='col-6 "; if(strcasecmp($row['paymentSuccess'],"Complete") == 0 ){ echo "bg-success"; }elseif($row['paymentSuccess']== "Order Placed"){ echo "bg-dark";} else{ echo "bg-danger";} echo " py-4 px-1'>
            												<h6>R ".number_format($row['orderTotalPrice'], 2)."</h6>
            												<h6 style='text-transform: uppercase;'>";
            												if($row['paymentSuccess']==null){
            													echo "pending";
            												}
            												else{
            													echo $row['paymentSuccess'];
            												}
            												echo "</h6>
            										</div>
            										</div>
            										</div>
            										";
            							
        									}
        									exit;
        									//echo "<h4 class='center'>Number of Users: $count</h4>";
        									echo"</div>";
        						echo"</div>";
        				?>
        			</div>
        		</div>
        	
        
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

?>