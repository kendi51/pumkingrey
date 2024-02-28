<?php
session_start();

if(!isset($_SESSION['useruid'])){
	$title = 'Reset Your Password: Pumkin';
	include_once 'header.php';
?>
    <div class="center bg-dark">
        <div class='container shadowStyle'>
        	<div class="wrapper p-3">
        		<?php 
        		    $selector = $_GET['selector'];
        		    $validator = $_GET['validator'];
        		    
        		    if(empty($selector) || empty($validator)){
        		        echo "Could not validate your request";
        		    }
        		    else{
        		        if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false){
        		?>
        		        
        		        <h4 class='heading'>Reset My Password</h4> 
        		        <hr>
                        <form action='includes/reset-password.inc.php' class='formStyle pt-3' method='POST'> 
                            <input type='hidden' name='selector' value='<?php echo $selector ?>' >
        		            <input type='hidden' name='validator' value='<?php echo $validator ?>' >
        		            <input type='hidden' name='location' value='<?php echo $_SERVER['HTTP_REFERER'] ?>' >
                            
                            <label for='newPwd'>New Password
                                <input type='password' name='newPwd' required>
                            </label>
                            <label for='confirmPwd'>Confirm New Password
                                <input type='password' name='confirmPwd' required>
                            </label>
                            <button  class='btn btn-primary ml-1' type='submit' name='reset-password-submit'>Reset Password</button>
                        </form>
    
        		
        		<?php
        		        }
        		    }
        		?>
        	</div>
        </div>
    </div>
    <?php
    	include_once 'footer.php';
}
else{
    header('location: /Home');
    exit;
}
    ?>