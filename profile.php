<?php

session_start();

	if(isset($_SESSION["useruid"])){

		if($_SESSION["useruid"]==="admin"){
		    
		    $title = 'Admin Profile: Pumkin';

	include_once 'header.php';

			carousel($text1, $text2);
		
			//Wecome Quote
			echo"
			<div class='container mt-3' style='font-weight:normal'>
				<h1 class='heading' style='font-size:2rem'>Welcome " . $_SESSION["username"] . " </h1>
			</div>
			";

			//User Options
			echo"
				<div class='container-fluid mt-3' style='font-weight:normal'>
					<div class='row' style='font-weight:normal'>
					<div class='col-md-6 col-lg-4'>
						<div class='anime bder border border-light'>
							<a class='' href='/Orders'>
								<h5 class=''>
								    ORDERS
								    
								    
								</h5>
								
							</a>
						</div>
						
					</div>


					<div class='col-md-6 col-lg-4'>
						<div class='anime bder border border-light'>
							<a class='' href='/Profile'>
								<h5 class=''>ACCOUNTS</h5>
								<h6 class='' style='font-weight:unset'>View user accounts.</h6>
							</a>
						</div>
					</div>


					<div class='col-md-6 col-lg-4'>
						<div class='anime bder border border-light'>
							<a class='' href='productHandler.php'>
								<h5 class=''>PRODUCT DETAILS</h5>
								<h6 class='' style='font-weight:unset'>Add and remove products</h6>
							</a>
						</div>
					</div>


					<div class='col-md-6 col-lg-4'>
						<div class='anime bder border border-light'>
							<a class='' href='returns.php'>
								<h5 class=''>RETURNS</h5>
								<h6 class='' style='font-weight:unset'>Check returned products</h6>
							</a>
						</div>
					</div>

					<div class='col-md-6 col-lg-4'>
						<div class='anime bder border border-light'>
							<a class='' href='comms.php'>
								<h5 class=''>COMMUNICATION</h5>
								<h6 class='' style='font-weight:unset'>Client Recommendations</h6>
							</a>
						</div>
					</div>
					</div>
				</div>
			";



			include_once 'footer.php';
		}
		else{
		    
		    $title = 'Profile: Pumkin';

        	include_once 'header.php';

			carousel($text1, $text2);

			//Wecome Quote
			echo"
			<div class='container mt-3'>
				<h1 class='heading' style='font-size:2rem'>Welcome " . $_SESSION["username"] . " </h1>
			</div>
			";

			//User Options
			echo"
				<div class='container-fluid mt-3'>
					<div class='row'>
					<div class='col-md-6 col-lg-4 py-2'>
						<div class='anime bder border border-light'>
							<a class='' href='/Orders'>
								<h5 class=''>ORDERS & RETURNS</h5>
								<span class=''>Track your orders or arrange a return.</span>
							</a>
						</div>
					</div>


					<div class='col-md-6 col-lg-4 py-2'>
						<div class='anime bder border border-light'>
							<a class='' href='#'>
								<h5 class=''>ACCOUNT</h5>
								<span class=''>View account history and statemants.</span>
							</a>
						</div>
					</div>


					<div class='col-md-6 col-lg-4 py-2'>
						<div class='anime bder border border-light'>
							<a class='' href='/Profile'>
								<h5 class=''>ACCOUNT DETAILS</h5>
								<span class=''>Change passwords and account details</span>
							</a>
						</div>
					</div>


					<div class='col-md-6 col-lg-4 py-2'>
						<div class='anime bder border border-light'>
							<a class='' href='#'>
								<h5 class=''>REFER A FRIEND</h5>
								<span class=''>Get account discounts when you refer a friend</span>
							</a>
						</div>
					</div>

					<div class='col-md-6 col-lg-4 py-2'>
						<div class='anime bder border border-light'>
							<a class='' href='#'>
								<h5 class=''>COMMUNICATION</h5>
								<span class=''>Choose you would like us to communicate with you</span>
							</a>
						</div>
					</div>
					</div>
				</div>
			";



			include_once 'footer.php';
		}
	}
	else{
		header("location: /Login");
    	exit();
	}
?>