<?php
	$title = 'User Self Service: Pumkin';

include_once 'header.php';


if(isset($_SESSION["useruid"])){

	if($_SESSION["useruid"]==="admin"){

        // $serverName = "localhost";
        // $dBUserName = "root";
        // $dBPassword = "";
        // $dBName = "pumpkin_users";
        
        // $conn = mysqli_connect($serverName,$dBUserName,$dBPassword,$dBName);

        carousel($text1, $text2);

        // HEADER
        sideBarAdmin($page);
        //T TABLE HEADINGS
        echo "

        <div class='col-lg-8 col-md-8 d-flex justify-content-center pl-5 mt-4'>
            
			<table class='content-table'>
			<theader class=''>
				<tr class='tStyle'>
					<th class=''>
						Full Name
					</th>
					<th class=''>
						E-mail
					</th>
					<th class=''>
						UserID
					</th>
                    <th class=''>
						REMOVE
					</th>
				</tr>
			</theader>
		";
	
            // CODE TO DISPLAY ALL USERS
					$sql = "SELECT * FROM users;";

					$results = mysqli_query($conn, $sql);
					$resultsCheck = mysqli_num_rows($results);
                    $count = 0;

					if($resultsCheck > 0){
						echo"<tbody>";
						echo"<div class='row'>";
						while($row = mysqli_fetch_assoc($results)){
							echo"
							<div class
								<tr>
								
									<td>".$row['usersName']."</td>
									<td>".$row['usersEmail']."</td>
									<td>".$row['usersUid']."</td>
                                    <td>
										<button  class='btn btn-danger ml-1' name='remove'><i class='fas fa-plus  text-center close-btn'></i></button>
									</td>
								</tr>
							";
                            $count++;
						}
                        //echo "<h4 class='center'>Number of Users: $count</h4>";
						echo"</tbody>";
                    }
            echo"</table>";
            echo"</div>";
            ?>
        </div>
    </div>
            
            <?php
            include_once 'footer.php';
    }
    // DISPLAY USER INFO
    elseif($_SESSION["useruid"]!=="admin"){

 

                // $serverName = "localhost";
                // $dBUserName = "root";
                // $dBPassword = "";
                // $dBName = "pumpkin_users";
                
                // $conn = mysqli_connect($serverName,$dBUserName,$dBPassword,$dBName);

                carousel($text1, $text2);

                // HEADER
               

                
                
                // SIDEBAR
                sideBar($page);
            
                // Container DIV
                echo "
                <div class='col-lg-8 col-md-8  justify-content-center'>";
            
                if(isset($_POST['editUser'])) {
                    $uid = $_SESSION["useruid"];
                            $sql = "SELECT * FROM users WHERE usersUid = ?;";

                            $stmt = mysqli_stmt_init($conn);

                            if(!mysqli_stmt_prepare($stmt, $sql)){
                                header("location: users.php?error=stmtfailed");
                                exit();
                            }
                            mysqli_stmt_bind_param($stmt, "s", $uid);
                            mysqli_stmt_execute($stmt);

                            $resultData = mysqli_stmt_get_result($stmt);
                            $checkOut = "/Checkout";
                            $location = $_SERVER['HTTP_REFERER'];

                                echo"<div class=''>
                                <h5 class='heading mb-4' style='text-decoration: underline; text-decoration-color: #ffc107; text-decoration-style:wavy'>Update My Details</h5>
                                <form action='/Admin/UserUpdate' class='' method='POST'> ";
                                while($row = mysqli_fetch_assoc($resultData)){
                                    $phoneNumber = $row['usersPhoneNum'];
                                    $email = $row['usersEmail'];
                                    $name = $row['usersName'];
                                    $uid = $_SESSION['useruid'];
                                    $location = $_SERVER['HTTP_REFERER'];
                                    echo "
                                    <div class='row'>
                                    <div class='col-md-6 mb-3'>
                                      <label for='firstName'>Full name</label>
                                      <input type='text' class='form-control text-center' name='name' placeholder='Full Name' value='$name' >
                                    </div>

                                    <div class='col-md-6 mb-3'>
                                        <label for='username'>Username</label>
                                        <div class=''>
                                        <input type='text' class='form-control text-center' name='username' value='$uid' disabled>
                                        </div>
                                    </div>
                                    </div>
                    
                                    <div class='mb-3'>
                                        <label for='username'>Phone Number</label>
                                        <div class=''>
                                        <input type='text' class='form-control text-center' name='phoneNum' value='$phoneNumber' >
                                        </div>
                                    </div>
                    
                                    <div class='mb-3'>
                                        <label for='email'>Email </label>
                                        <input type='email' class='form-control text-center' name='email' value='$email' >
                                        <input type='hidden' name='location' value='$location'>
                                    </div>
                    
                                        <button class='btn btn-outline-light' type='submit' name='updateUser'>Submit</button>
                                        <a 
                                        href=' "; 
                                            if(strcasecmp($location, $checkOut)!==0){
                                            echo $location;;
                                            }
                                            else{
                                                 $location = $_SERVER['HTTP_REFERER'];
                                                 echo $location;
                                             
                                            } 
                                            echo " ' class='btn btn-outline-danger my-2' >Cancel</a>
                                    </form>
                                    ";
                                }
                    echo"</div>";
                    echo"</div>";
                ?>
            </div>
        </div>
                    <?php

                    include_once 'footer.php';
                }
                // UPDATE USER PASSWORD
                elseif(isset($_POST['updatePassword'])){


                    echo "
                        <div class='col-lg-10'>
                        <h5 class='heading mb-5' style='text-decoration: underline; text-decoration-color: #ffc107; text-decoration-style:wavy'>Update My Password</h5> 
                            <form action='/Admin/UserUpdate' class='formStyle mt-5 pt-4' method='POST'> 
                                <label for='name'>Current Password
                                    <input type='password' name='currentPassword' required>
                                </label>
                                <hr>
                                <label for='email'>New Passowrd
                                    <input type='password' name='newPassword' required>
                                </label>
                                <label for='uid'>Confirm New Password
                                    <input type='password' name='confirmPassword' required>
                                </label>
                                <button  class='btn btn-primary ml-1' name='changePassword'>Update Password</button>
                                <a href='/Profile' class='btn btn-outline-danger my-2'>Back</a>
                            </form>
                        </div>
                    </div>
                    ";
                    ?>
                  </div>
                </div>

                    <?php

                    include_once 'footer.php';
                }

                // UPDATE USER INFO
                else{
                    // CODE TO DISPLAY USERS INFO
                    $uid = $_SESSION["useruid"];
                    $sql = "SELECT * FROM users WHERE usersUid = ?;";

                    $stmt = mysqli_stmt_init($conn);

                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        header("location: users.php?error=stmtfailed");
                        exit();
                    }
                    mysqli_stmt_bind_param($stmt, "s", $uid);
                    mysqli_stmt_execute($stmt);

                    $resultData = mysqli_stmt_get_result($stmt);

                        echo"<div class='text-center'>
                        <h5 class='heading mb-4' style='text-decoration: underline; text-decoration-color: #ffc107; text-decoration-style:wavy'>My Details</h5>
                        <form action='/Profile' class='users text-center' method='POST'> ";
                        while($row = mysqli_fetch_assoc($resultData)){
                            $phoneNumber = $row['usersPhoneNum'];
                            $email = $row['usersEmail'];
                            $name = $row['usersName'];
                            $uid = $_SESSION['useruid'];
                            
                            echo "
                            <div class='row center'>
                            <div class='col-md-6 mb-3'>
                              <label for='firstName'>Full name</label>
                              <input type='text' class='form-control text-center' id='firstName' placeholder='Full Name' value='$name' disabled>
                            </div>

                            <div class='col-md-6 mb-3'>
                            <label for='username'>Username</label>
                            <div class='input-group'>
                              <input type='text' class='form-control text-center' id='username' value='$uid' disabled>
                            </div>
                          </div>

          
                          <div class='col-md-6 mb-3'>
                            <label for='username'>Phone Number</label>
                            <div class='input-group'>
                              <input type='text' class='form-control text-center' id='phoneNum' value='$phoneNumber' disabled>
                            </div>
                          </div>
          
                          <div class='col-md-6 mb-3'>
                            <label for='email'>Email </label>
                            <input type='email' class='form-control text-center' id='email' value='$email' disabled>
                          </div>
                          <div class='col-md mb-2'>
                          <label for='pwd'>Password</label>
                            <input type='password' class='form-control text-center' name='pwd' id='pwd' value='********' disabled>";
                            
                            // ERROR HANDLERS
                            if(isset($_GET["error"])){
                                if($_GET["error"] == "wrongPassword"){
                                    echo "<p><font color=red>Enter correct password</font></p>";
                                }
                                elseif($_GET["error"] == "passwordshort"){
                                    echo "<p><font color=red>Password too short. Ensure 8 and above alphanumeric keys</font></p>";
                                }
                                elseif($_GET["error"] == "passworddontmatch"){
                                    echo "<p><font color=red>Password does not match. Please try again...</font></p>";
                                }
                                elseif($_GET["error"] == "stmtfailed2"){
                                    echo "<p><font color=red>Something went wrong on our side :(</font></p>";
                                }
                                elseif($_GET["error"] == "none"){
                                    echo "<p><font color= #28a745>PASSWORD UPDATED SUCCESSFULLY!</font></p>";
                                }
                            }
                            
                            echo "<button  class='btn btn-warning ml-1 mt-2' name='updatePassword'>Update Password</button>
                        
                        </div>
                        </div>
                                <button  class='btn btn-outline-primary ml-1' name='editUser'>Update User Info</button>
                                <a href='/Account' class='btn btn-outline-danger my-2' >Back</a>
                            ";
                        }
                        //echo "<h4 class='center'>Number of Users: $count</h4>";
                        echo"</form>
                        </div>
                        </div>
                        </div>";
                    

                        echo"</div>";

                        include_once 'footer.php';
            

                }
                
    }

}
else{
    header("location: /Home");
    exit;
}