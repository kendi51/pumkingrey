<?php
	$title = 'Sign Up: Pumkin';
	include_once 'header.php';

	if(!isset($_SESSION['useruid'])) {
?>
    <!-- SignUp Form -->
    <div class="center bg-img">
        <div class="container font_color shadowStyle">
            <label for="" class=""></label> 
            <div class="smallerTxt signup-link link">
                <i class="fa fa-heart fa-2x pb-2"></i>
				<h4>Sign up</h4>
				<?php
    				if(isset($_GET["error"])){
    					if($_GET["error"] == "emptyInput"){
    						echo "<p><font color= red>Fill in all fields</font></p>";
    					}
    					elseif($_GET["error"] == "passwordshort"){
    						echo "<p class='px-4'><font color= red>Password has to have 8+ characters</font></p>";
    					}
    					elseif($_GET["error"] == "invalidUid"){
    						echo "<p class='px-4'><font color= red>Please use alphanumeric characters(A-Z/a-z/0-9)</font></p>";
    					}
    					elseif($_GET["error"] == "invalidEmail"){
    						echo "<p><font color= red>Choose proper email</font></p>";
    					}
    					elseif($_GET["error"] == "passworddontmatch"){
    						echo "<p><font color= red>Passwords don't match</font></p>";
    					}
    					elseif($_GET["error"] == "stmtfailed"){
    						echo "<p><font color= red>Something went wrong. Try again...</font></p>";
    					}
    					elseif($_GET["error"] == "usernametaken"){
    						echo "<p><font color= red>Username already taken. Try something else</font></p>";
    					}
    					elseif($_GET["error"] == "none"){
    						echo '<p><font color= #00B0BA>You have successfully signed up... <br/>Please Login <a href="/Login" style="color:black">Here</a></font></p>';
    					}
    				}
    			?> 
			</div>
            <form class="formStyle" action="includes/signup.inc.php" method="post">
				<label for="name">Full Name
            		<input class="inputStyle" type="text" name="name" required>
				</label>
				<label for="email">Email
					<input type="email" name="email" required>
				</label>
				<label for="uid">Username
					<input type="text" name="uid"  required>
				</label>
				<label for="pwd">Password
					<input type="password" name="pwd" required>
				</label>
				<label for="pwdrepeat">Confirm Passord
					<input type="password" name="pwdrepeat" required>
				</label>
				
				<div  class="captca">
				    <div class="g-recaptcha" data-sitekey="6Lfz0RMkAAAAAN6JlqM9FqBlv2Rs4axPSkwRWez6"></div>
				</div>
				<button class="btn btn-outline-light" type="submit" name="submit">Submit</button>
				
			</form>
			<form action="/Contact" method="post">
				<div class="signup-link link">
					<p class="" style="font-size:11px"><em>By clicking submit you accept our <button type="submit" name="t&c" class="btn-link" style="font-size:11px">Terms & Conditions</button>,<br>aswell as our <button type="submit" name="privacy" class="btn-link" style="font-size:11px">Privacy Policy</button>.</em></p>
				</div>
			</form>
			<div class="signup-link link">
				Already have an account? <a href="Login">Login</a>
			</div>

			
		</div>
    </div>

	
<?php
	include_once 'footer.php';
	}
	else{
		header("location: Home");
	}
?>