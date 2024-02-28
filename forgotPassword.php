<?php
session_start();
if(isset($_SESSION['useruid'])){
    header('location: /Home');
    exit;
}
else{
	$title = 'Forgot Password?';
	include_once 'header.php';
?>
<div class="center bg-dark">
<div class='container shadowStyle'>
	<div class="wrapper p-3">
		<div class="">
		    <i class="fa fa-unlock fa-2x pb-2"></i>
			<h4 class="heading">Forgot Password</h4>
			<p style='font-size: 13px'>Enter your email below. An email will be sent to your email address with instructions on how you can change your password.</p>
		</div>
		<hr>
		<div class="content">
			<form class="formStyle" action="includes/reset-request.inc.php" method='POST'>
				<label class='' for="email" style='font-size:16px'>E-mail </label>
					<input class='mt-1' type="text" name="email" required>
					<!--<div  class="captca">-->
					<!--    <div class="g-recaptcha" data-sitekey="6Lfz0RMkAAAAAN6JlqM9FqBlv2Rs4axPSkwRWez6"></div>-->
					<!--</div>-->
					<?php 
					if(isset($_GET["error"])){

							if($_GET["error"] == "noUser"){

							echo "<font color='red'><p class='mt-3'>Email address not found. </p></font>";
							}
							
							if($_GET["error"] == "success"){

							echo "<font color='green'><p class='mt-3'>Reset has been sent to your email. </p></font>";
							}
					}
					?>
					<button class="btn btn-outline-light mt-2" type="submit" name="reset-request-submit">Submit</button>
				
			</form>
		</div>
	</div>
</div>
</div>
<?php
	include_once 'footer.php';
}
?>