<?php
	if(!isset($_SESSION)){
		session_start();
	  }
	if(!isset($_SESSION['accType'])){
	    $_SESSION['accType'] = null;
	}

	include_once 'php/createDb.php';
	include_once 'php/components.php';
	include_once 'includes/functions.inc.php';
	include_once 'includes/dbh.inc.php';
	include_once 'admin/in.db.php';
	
	if(!isset($pTitle)){
	    $pTitle = "PumkinGrey";
	    $pDescript = "Home Of Fashion, Creation & Design";
	    $pImg = "https://www.pumkingrey.com/images/PumkinGreyLongCropped.png";
	    $pLink = "https://www.pumkingrey.com/";
	}
	
	$text2 = 'On Orders Above R750*';
	$text1 = 'Free Delivery.';


	$time = time();
	checkOrders($conn, $time);
	if(isset($_SERVER['HTTP_REFERER'])){
		$location = $_SERVER['HTTP_REFERER'];
	}

	//auto logout 
	if(isset($_SESSION['useruid'])){
			// TIMEOUT CODE 
				if((time() - $_SESSION['l_l_time']) > 900){
					session_unset();
					session_destroy();
	
					header("location:/Login?error=timeout");
					exit();
				}
				else{
					$_SESSION['l_l_time'] = time();
				}
			// END OF TIMEOUT CODE

			// CART RETRIEVAL FROM DB
			if(!isset($_SESSION['cart']) && isset($_SESSION['cartFound'])){
				$_SESSION['cart'] = $_SESSION['cartFound'];
			}
			// END OF CART RETRIEVAL FROM DB
		
	}

	//create instance of CreateDb class
// 	$database = new CreateDb("Productdb", "Producttb"); // Local db
	$database = new CreateDb("u843931047_productdb", "producttb"); //online db
	$link_db = new CreateDb("u843931047_productdb", "linkstb"); //online db
	
	$serverName = "srv1350.hstgr.io";
	$dBUserName = "u849136244_pumkingrey";
	$dBPassword = "G2O9+euM^c;";
	$dBName = "u849136244_pumkin_grey";


    $product_conn = mysqli_connect($serverName, $dBUserName, $dBPassword, $dBName);

	// ADD TO CART BUTTON PHP
	if(isset($_POST['add'])){

		if($_POST['size'] !== 'none'){

			if(isset($_SESSION['cart'])){
				
				$item_array_id = array_column($_SESSION['cart'], "product_id");
				

				if (in_array($_POST['product_id'], $item_array_id)){
					echo '<script>alert("Product already in array")</script>';
				}
				else{
					$count = count($_SESSION['cart']);

					$item_array = array(
						'product_id' => $_POST['product_id'],
						'size' => $_POST['size']
					);
					
					$_SESSION['cart'][$count] = $item_array;

					$cart = $_SESSION['cart'];

					// ADD CART TO USER DB
					if(isset($_SESSION['useruid'])){
						updateCart($conn, $_SESSION['useruid'], $cart);
					}
					
					echo "<h6 style='color:#28a745'>Item added to cart</h6>";
				}
			}
			else{

				$item_array = array(
					'product_id' => $_POST['product_id'],
					'size' => $_POST['size']
				);

				//create new session variable
				$_SESSION['cart'][0] = $item_array;

				$cart = $_SESSION['cart'];
				
				// ADD CART TO USER DB
				if(isset($_SESSION['useruid'])){
					updateCart($conn, $_SESSION['useruid'], $cart);
				}
				echo "<h6 style='color:#28a745'>Item added to cart</h6>";

			}
		}
		else {
			echo "<h6 style='color:red'>Please select size</h6>";
		}
	}
	// END OF ADD TO CART BUTTON

	// PHP FOR BUY PRODUCT BUTTON
	if(isset($_POST['buy'])){

		if($_POST['size'] !== 'none'){

			if(isset($_SESSION['cart'])){
				
				$item_array_id = array_column($_SESSION['cart'], "product_id");
				

				if (in_array($_POST['product_id'], $item_array_id)){
					header("location: /Cart");
				}
				else{
					$count = count($_SESSION['cart']);

					$item_array = array(
						'product_id' => $_POST['product_id'],
						'size' => $_POST['size']
					);
					
					$_SESSION['cart'][$count] = $item_array;

					$cart = $_SESSION['cart'];

					// ADD CART TO USER DB
					if(isset($_SESSION['useruid'])){
						updateCart($conn, $_SESSION['useruid'], $cart);
					}
					
					header("location: /Cart");
					exit;
				}
			}
			else{

				$item_array = array(
					'product_id' => $_POST['product_id'],
					'size' => $_POST['size']
				);

				//create new session variable
				$_SESSION['cart'][0] = $item_array;

				$cart = $_SESSION['cart'];

				// ADD CART TO USER DB
				if(isset($_SESSION['useruid'])){
					updateCart($conn, $_SESSION['useruid'], $cart);
				}
				
				header("location: /Cart");
				exit();
			}
		}
		else {
			echo "<h6 style='color:red'>Please select size</h6>";
		}
	}
	// END OF PHP FOR BUY PRODUCT BUTTON
	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	    <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-FKLJPEX9HW"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
        
          gtag('config', 'G-FKLJPEX9HW');
        </script>
    <title><?php echo $title ?></title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<meta property="og:title" name="twitter:title" itemprop="name" content="<?php echo $pTitle; ?>">-->
    <!--<meta property="og:site_name" content="<?php echo $pTitle; ?>">-->
    <!--<meta property="og:description" name="twitter:description" itemprop="description" content="<?php echo $pDescript; ?>">-->
    <!--<meta property="og:image" name="twitter:image:src" itemprop="image" content="<?php echo $pImg; ?>"> -->
    <!--<meta property="og:type" content="website">-->
    <!--<meta property="og:image:type" content="image/png">-->
    <!--<meta property="og:width" content="300">-->
    <!--<meta property="og:height" content="300">-->
    <!--<meta property="og:url" content="<?php echo $pLink; ?>">-->
    <!--<meta name="twitter:card" content="summary_large_image">-->
    <!--<meta property="og:image:alt" name="twitter:image:alt" content="PREVIEW">-->
    

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo $pLink; ?>" />
    <meta property="og:title" content="<?php echo $pTitle; ?>" />
    <meta property="og:description" content="<?php echo $pDescript; ?>" />
    <meta property="og:image" content="<?php echo $pImg; ?>" />
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="<?php echo $pLink; ?>" />
    <meta property="twitter:title" content="<?php echo $pTitle; ?>" />
    <meta property="twitter:description" content="<?php echo $pDescript; ?>" />
    <meta property="twitter:image" content="<?php echo $pImg; ?>" />
    <meta name="twitter:creator" content="@pumkingrey">
    <meta property="og:width" content="500">

    <meta property="og:height" content="500">
    
    <!-- Meta Tags Generated with https://metatags.io -->
    
	
		<link rel="stylesheet" href="/css/bootstrap.min.css" media="screen">
		<link rel="stylesheet" href="/css/carousel.css" media="screen">
		<link rel="stylesheet" href="/my-styles-shopping.css" media="screen">
		<link rel="stylesheet" href="/master_CSS.css" media="screen">
		<link rel="stylesheet" href="/my-styles.css" media="screen">
		<!--<link rel="stylesheet" href="/login-styles.css">-->
		<link rel="stylesheet" href="/whats-new-styles.css" media="screen">
		<link rel="icon" type="image/x-icon" href="/images/logoLight.png" media="(prefers-color-scheme: light)">
		<link rel="icon" type="image/x-icon" href="/images/logoDark.png" media="(prefers-color-scheme: dark)">
        
		<!--<script src="/js/myJavaScript.js" type="text/javascript"></script>-->
        <script defer src="/js/jquery-slim.min.js" type="text/javascript"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script defer src="/js/bootstrap.min.js" type="text/javascript"></script>
		<script defer src="https://kit.fontawesome.com/f6fc0d15c7.js" crossorigin="anonymous" type="text/javascript"></script> <!-- FontAwesome Kit a076d05399 -->
		<script src="https://www.google.com/recaptcha/api.js"></script>
		<script defer src="https://cdnjs.cloudflare.com/ajax/libs/FitText.js/1.2.0/jquery.fittext.min.js"></script>
		
		<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback" async defer></script>
        <script>
          function onSubmit(token) {
            document.getElementById("demo-form").submit();
          }
          var onloadCallback = function () {
              grecaptcha.execute();
          }
          
          var setResponse(response){
              document.getElementById('captcha-response').value = response;
          }
        </script>
		
		<style>
        .navbar-nav {
            margin-left: auto;
            margin-right: auto;
            
        }
        .cqw{
            font-size: 1.9cqh;
        }
        strong, b{
            font-weight: normal;
        }
        .ratio{
            aspect-ratio: 1 / 1;
        }
    </style>
	</head>

<body class="text">
          

	<!-- Navigation -->
	<header id='header'>
		<?php $page = basename($_SERVER['PHP_SELF']); ?>

		<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light "> 
			<a class="navbar-brand pl-lg-3" href="/Home">
                <img src="/images/PumkinGreyLongCropped.png" alt="" width="200cqw" height="auto" style="margin-left:2vmax">
            </a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"> 
				<span class="navbar-toggler-icon">
				</span> 
				</button> 

			<div class="collapse navbar-collapse cqw" id="navbarNav"> 
				<ul class="navbar-nav ml-auto justify-content-space-between"> 
					<li class="nav-item <?php if($page == 'Homepage.php'):echo 'focuss';endif;?> "> 
						<a class="nav-link" href="/Home" <?php if($page == 'Homepage.php'):echo 'style="color:#ffc107;"';endif;?> >
						    <i class="fa-solid fa-home"></i>
						 Home   
						<span class="sr-only">
						</span>
						</a> 
					</li> 

					<li class="nav-item <?php if($page == 'Shopping_page.php'):echo 'focuss';endif;?>"> 
						<a class="nav-link" href="/Shop" <?php if($page == 'Shopping_page.php'):echo 'style="color:#ffc107;"';endif;?> >
						    <i class="fas fa-tshirt"></i>
						    Shop
						</a> 
					</li> 
	                <!--
					<li class="nav-item <?php if($page == 'Whats_new.php'):echo 'focuss';endif;?>"> 
						<a class="nav-link cqw" href="/New" <?php if($page == 'Whats_new.php'):echo 'style="color:white;"';endif;?> >
						    <i class="fa-solid fa-star"></i>
						    What's New?
						</a> 
					</li> 

					<li class="nav-item <?php if($page == 'Contact_us.php'):echo 'focuss';endif;?>"> 
						<a class="nav-link" href="/Contact" <?php if($page == 'Contact_us.php'):echo 'style="color:white;"';endif;?> >
						    <i class="fa-solid fa-phone"></i>
						    Contact us
						</a> 
					</li> 
					
					-->
					<?php
					if(isset($_SESSION['accType']) && strcasecmp($_SESSION['accType'], "admin") == 0 || strcasecmp($_SESSION['accType'], "intern") == 0){
					    echo "
					    
					    <li class='nav-item'> 
    						<a class='nav-link' href='/Admin/Dashboard' >
    						<i class='fa-solid fa-screwdriver-wrench'></i>
    						Dev-Tools
    						</a> 
    					</li> 
					    
					    ";
					}
					?>
				</ul> 
			
				<?php
					if(isset($_SESSION["useruid"])){
						echo"<ul class='nav navbar-nav navbar-right'> 
							  <li class='nav-item'> 
								<a class='nav-link' href='/Account'>
							    <i class='fa-solid fa-heart'></i>
									". $_SESSION["useruid"] . "
								</a> 
							  </li>

						 	  <li class='nav-item'> 
								<a class='nav-link' href='/includes/logout.inc.php'>
						 	    <i class='fa-solid fa-sign-out-alt'></i>
									Log Out 
								</a> 
							  </li>
							</ul>";
					}
					else {
						echo "<ul class='nav navbar-nav navbar-right'> 
								<li class='nav-item'> 
									<a class='nav-link' href='/Register'>
									<i class='fa-solid fa-heart'></i>
									<span class='glyphicon glyphicon-user'></span>
										Sign Up
									</a> 
								</li>

								<li class='nav-item'> 
									<a class='nav-link' href='/Login'>
									<i class='fa-solid fa-user'></i>
									<span class='glyphicon glyphicon-log-in'></span>
										Log In
									</a> 
								</li>
							</ul>";
					}

				?>

				<div class="mr-auto">
					<div class="navbar-nav">
						<a href='/Cart' class='nav-item nav-link'>
							<li class="cart">
								<i class="fas fa-shopping-cart"></i>
								<?php

									if(isset($_SESSION['cart'])){
										$count = count($_SESSION['cart']);

										echo"<span id='cart_count' class='text-light bg-success py-1'>$count</span>";
									}
									else{
										echo '<span id="cart_count" class="text-light bg-success py-1">0</span>';
									}
								?>
							</li>
						</a>
					</div>
				</div>
			</div> 
		</nav>

		<?php
		if(isset($_SERVER['HTTP_REFERER']) && isset($_SESSION['useruid'])){
			if($location !== 'checkout.php'){
				pendingOrder($conn, $_SESSION['userid']);
			}
		}
		?>
	</header>
	
