<?php
session_start();

if(!isset($_SESSION['useruid'])) {
    
    
	$title = 'Admin Login: Pumkin';
	include_once 'adminHeader.php';
	
	?>
    <!-- Login Form -->
    <div class="px-4 pb-4 bg-light">
        <div class='container-fluid bg-dark mt-0 pb-3' style="border: 2px solid white; border-radius: 25px">
            <label for="" class="close-btn fas fa-tmes"></label>
            <div class="textStyle">
                <i class="fa fa-user-gear fa-2x"></i>
				<h4 class="pt-2">Admin</h4>
			</div>
            <form class="formStyle" action="/includes/login.inc.php" method="post">
                
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
								echo "<font color='red'><p>Please enter correct password.</p></font>";
							}
							elseif($_GET["error"] == "wrongLogin"){
								echo "<font color='red'><p>Please check email/username.</p></font>";
							}
							elseif($_GET["error"] == "notchecked"){
								echo '<font color="red"><p>Please make sure you check the security CAPTCHA box.</p></font>';
							}
							elseif($_GET["error"] == "updated"){
								echo '<font color="green"><p>Password Updated.</p></font>';
							}
						}
					?> 

					<button class="btn btn-light" type="submit" name="submit">Login</button>
				<div class="signup-link">
					<h5 >
						<a href="/Forgot_Password" style="color:white">Forgot Password?</a>
					</h5>
				</div>
            </form>

			
        </div>
    </div>


<?php
	include_once 'adminFooter.php';
	}
	else{
		header("location: /Admin/Dashboard");
	}
?>