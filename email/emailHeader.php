<?php
	if(!isset($_SESSION)){
		session_start();
	  }

	include_once 'php/createDb.php';
	include_once 'php/components.php';
	include_once 'includes/functions.inc.php';
	include_once 'includes/dbh.inc.php';


	//create instance of CreateDb class
// 	$database = new CreateDb("Productdb", "Producttb"); // Local db
	$database = new CreateDb("u843931047_productdb", "producttb"); //online db
	
?>

<html>
	<head>
    <title><?php echo $title ?></title>
	<meta name="viewport" content="width-device-width, initial-scale=1.0">
	<meta charset="utf-8">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/carousel.css">
		<link rel="stylesheet" href="../my-styles-shopping.css">
		<link rel="stylesheet" href="../master_CSS.css">
		<link rel="stylesheet" href="../my-styles.css">
		<link rel="stylesheet" href="../login-styles.css">
		<link rel="stylesheet" href="../whats-new-styles.css">
        
		<script src="../js/myJavaScript.js" type="text/javascript"></script>
        <script src="../js/jquery-slim.min.js" type="text/javascript"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script defer src="../js/bootstrap.min.js" type="text/javascript"></script>
		<script defer src="https://kit.fontawesome.com/f6fc0d15c7.js" crossorigin="anonymous" type="text/javascript"></script> <!-- FontAwesome Kit a076d05399 -->
		<script src="https://www.google.com/recaptcha/api.js"></script>
	</head>

<body class="text">
          

	<!-- Navigation -->
	<header id='header'>
		<?php $page = basename($_SERVER['PHP_SELF']); ?>
        <div class="jumbotron">
    		<nav class="navbar navbar-expand-lg navbar-light bg-light"> 
    			<a class=" header navbar-brand ml-sm-5 mb-1 text-center" href="Homepage.php" style="font-size: 4vw">
    			PumkinGrey</a> 
    				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"> 
    				<span class="navbar-toggler-icon">
    				</span> 
    				</button> 
    
    		</nav>
    	</div>		
	</header>
	
