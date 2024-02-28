<?php
session_start();

if(!isset($_SESSION['useruid'])) {
    
	$title = 'User Login: Pumkin';
	include_once 'header.php';
	
	?>
    <!-- Login Form -->
    <div class="center bg-img">
        <div class="container shadowStyle">
            <label for="" class="close-btn fas fa-tmes"></label>
            <div class="textStyle">
                <i class="fa fa-user fa-2x pb-2"></i>
				<h4>Login</h4>
			</div>
            <form class="formStyle" action="includes/login.inc.php" method="post">
                
                <label for="email">Username / Email 
					<input type="text" name="email" id="email" required>
				</label>
				<label for="pwd">Password
					<input type="password" name="pwd" id="pwd" required>
				</label>
					<input type="hidden" name="location" id="location" value="<?php
					if(isset($_SERVER['HTTP_REFERER'])) {
						echo $_SERVER['HTTP_REFERER'];
					}else{
						echo "";
					} 
					 ?>">
					<div  class="captca">
					    <div class="g-recaptcha" data-sitekey="6Lfz0RMkAAAAAN6JlqM9FqBlv2Rs4axPSkwRWez6"></div>
					</div>
					
					<!--<div class="g-recaptcha"-->
     <!--                     data-sitekey="6LfXTOElAAAAAGYXDEYItBgW5aN6JZsMV5ZZ1qG4"-->
     <!--                     data-callback="onSubmit"-->
     <!--                     data-size="invisible">-->
     <!--               </div>-->
					<?php
						if(isset($_GET["error"])){
							if($_GET["error"] == "wrongPassword"){
								echo "<font color='red'><p><small>Please enter correct password.</small></p></font>";
							}
							elseif($_GET["error"] == "wrongLogin"){
								echo "<font color='red'><p><small>Please check email/username.</small></p></font>";
							}
							elseif($_GET["error"] == "notchecked"){
								echo '<font color="red"><p><small>Please make sure you check the security CAPTCHA box.</small></p></font>';
							}
							elseif($_GET["error"] == "updated"){
								echo '<font color="green"><p><small>Password Updated.</small></p></font>';
							}
						}
					?> 

					<button class="btn btn-outline-light" type="submit" name="submit">Login</button>
				<div class="signup-link">
					<h5 >
						<a href="/Forgot_Password" style="color:black">Forgot Password?</a>
					</h5>
				</div>
                <div class="signup-link link">Don't have an account? <a href="Register">Sign Up Now</a>
				</div>
            </form>

			
        </div>
    </div>


<?php
	include_once 'footer.php';
	}
	else{
		header("location: Home");
	}
?>