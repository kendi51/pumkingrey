<?php
if(!isset($_SESSION)){
	session_start();
  }
if(!isset($_SESSION['accType'])){
    $_SESSION['accType'] = null;
}

$text2 = 'On Orders Above R750*';
$text1 = 'Free Delivery.';
	
	
// if(strcasecmp($_SESSION['accType'], "admin") == 0 || strcasecmp($_SESSION['accType'], "intern") == 0){
// //     header('location:/Home');
// //     exit;
// echo'inside if statement';
// }
include_once "../php/components.php";
include_once "../php/createDb.php";
include_once "../includes/functions.inc.php";
include_once "../includes/dbh.inc.php";
//include_once "../includes/login.inc.php";
include_once "in.db.php";

$serverName = "localhost";
$dBUserName = "u843931047_pumkinproducts";
$dBPassword = "5P~PCQfN:g";
$dBName = "u843931047_productdb";

$db = mysqli_connect($serverName,$dBUserName,$dBPassword,$dBName);

if(!$db){
    die("Connection Failed: " . mysqli_connect_error());
}

//create instance of CreateDb class
// $database = new CreateDb("Productdb", "Producttb"); // Local db
$database = new CreateDb("u843931047_productdb", "producttb"); //online db
$link_db = new CreateDb("u843931047_productdb", "linkstb"); //online db


if(isset($_SESSION['useruid'])){
    // TIMEOUT CODE 
	if((time() - $_SESSION['l_l_time']) > 900){
		session_unset();
		session_destroy();

		header("location:/Admin/Login?error=timeout");
		exit();
	}
	else{
		$_SESSION['l_l_time'] = time();
	}
}	


    $page = basename($_SERVER['PHP_SELF']);
    
    ?>
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title ?></title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../my-styles-shopping.css">
    	<link rel="stylesheet" href="../master_CSS.css">
    	<link rel="stylesheet" href="../my-styles.css">
    	<link rel="stylesheet" href="../login-styles.css">
    	<link rel="stylesheet" href="../whats-new-styles.css">
    	<link rel="icon" type="image/x-icon" href="../images/logoLight.png" media="(prefers-color-scheme: light)">
    	<link rel="icon" type="image/x-icon" href="../images/logoDark.png" media="(prefers-color-scheme: dark)">
    	
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <script defer src="https://kit.fontawesome.com/f6fc0d15c7.js" crossorigin="anonymous" type="text/javascript"></script> <!-- FontAwesome Kit a076d05399 -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
        
        <script src="https://www.google.com/recaptcha/api.js"></script>
		
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
           
        }
        </style>
    </head>
    <body class="text-white bg-dark ">
    
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand pl-lg-5" href="/Admin/Dashboard">
                <img src="../images/PumkinGreyLongCroppedLight.png" alt="" width="200vw" height="auto">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item me-3 me-lg-0">
                        <a class="nav-link text-white" href="/Admin/Orders"><i class="fa fa-bag-shopping mx-1"></i> Orders</a>
                    </li>
                    <li class="nav-item me-3 me-lg-0">
                        <a class="nav-link text-white" href="/Admin/Products"><i class="fa-solid fa-barcode mx-1"></i> Products</a>
                    </li>
                    <li class="nav-item me-3 me-lg-0">
                        <a class="nav-link text-white" href="/Admin/Users"><i class="fa fa-users mx-1"></i> Users</a>
                    </li>
                    <li class="nav-item me-3 me-lg-0">
                        <a class="nav-link text-white" href="/Admin/Links"><i class="fa fa-link mx-1"></i> Links</a>
                    </li>
                    <li class="nav-item me-3 me-lg-0">
                        <a class="nav-link text-white" href="#"><i class="fa fa-phone mx-1"></i> Communication</a>
                    </li>
    
                    <li class="nav-item dropdown">
                        <?php 
                        if(isset($_SESSION['useruid'])){ ?>
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false" style='text-transform: uppercase'>
                            <i class="fas fa-user mx-1"></i>
                            <?php echo $_SESSION['useruid']; ?>
                            </a>
                            <div class="dropdown-menu" style="min-width: 5rem">
                                <a class='dropdown-item' href='/Home'>Home</a> 
                            
                                <a class='dropdown-item' href='/admin/admin.logout.inc.php'>Log Out</a> 
                            </div>
                        <?php
                        }
                        else{
                            
                        ?>
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user mx-1"></i>
                            Log in</a>
                            <div class="dropdown-menu" style="min-width: 5rem">
                            
                                <a class='dropdown-item' href='/Admin/Login'>Log in</a> 
                                <a class='dropdown-item' href='/Home'>Home</a> 
                            </div>
                        <?php
                        }
                        ?>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Navbar -->
        <?php
        carousel($text1, $text2);
        