<?php
session_start();
if(strcasecmp($_SESSION['accType'], "admin") == 0 || strcasecmp($_SESSION['accType'], "intern") == 0){
    if(isset($_SESSION['useruid'])){

        $title = 'Welcome To Users: Pumkin';
        
        include_once 'adminHeader.php';
        
        
        if(!isset($_GET["id"])){
        
        // 	if($_SESSION["useruid"]==="admin"){
        
                // $serverName = "localhost";
                // $dBUserName = "root";
                // $dBPassword = "";
                // $dBName = "pumpkin_users";
                
                // $conn = mysqli_connect($serverName,$dBUserName,$dBPassword,$dBName);
        
                // carousel();
        
                // HEADER
                // sideBarAdmin($page);
                //T TABLE HEADINGS
                ?>
                <nav class="navbar navbar-dark bg-dark m-3 justify-content-between">
                  <a class="navbar-brand"></a>
                  <form class="form-inline" style='justify-content: right'>
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <select name='filter' class='my-2 my-sm-0 form-control inputRound' required>
                        <option value='none'>Select Filter</option>
                        <option value='Email'>Email</option>
                        <option value='Name'>Full Name</option>
                        <option value='Uid'>Username</option>
                    </select>
                    <button class="btn btn-outline-success ml-2 my-2 my-sm-0" type="submit">Search</button>
                  </form>
                </nav>
                <?php
                echo "
                
        
                <div class='container-fliud'>
                    
        			<div class='text-center m-2'>
        			<div class='row'>
        		";
        	
                    // CODE TO DISPLAY ALL USERS
        					$sql = "SELECT * FROM users;";
        
        					$results = mysqli_query($conn, $sql);
        					$resultsCheck = mysqli_num_rows($results);
                            $count = 0;
        
        					if($resultsCheck > 0){
        
        						while($row = mysqli_fetch_assoc($results)){
        							echo"
        							<div class='col-12 col-md-4 col-lg-4 '>
        							<div class='border rounded bg-dark link py-2 m-2'>
        							<a href='users.php?id=".$row['usersId']."' class='text-white'>
        							<div class='row'>
        
                        				<div class='col-12 pt-2'>
                        					<h6 class='heading'>
                        					<i class='fas fa-user-circle fa-lg pr-1'></i>
                        						".$row['usersName']."
                        				    </h6>
                        				</div>
                        				<div class='col-12'>
                        					<h6 class=''>
                        						".$row['usersEmail']."
                        				    </h6>
                        				</div>
                                        <div class='col-12'>
                        					<h6 class=''>
                        						".$row['usersAccType']."
                        				    </h6>
                        				</div>
                        			</div>
                        			</a>
                        			</div>
                        			</div>
        							";
                                    $count++;
        						}
                                //echo "<h4 class='center'>Number of Users: $count</h4>";
        						echo"</tbody>";
                            }
                    echo"</table>";
                    echo"</div></div></div>";
                    ?>
                </div>
            </div>
                    
                    <?php
                    include_once 'adminFooter.php';
        }    
                    
        else{
                        $uid = $_GET['id'];
                                    $sql = "SELECT * FROM users WHERE usersId = ?;";
        
                                    $stmt = mysqli_stmt_init($conn);
        
                                    if(!mysqli_stmt_prepare($stmt, $sql)){
                                        header("location: users.php?error=stmtfailed");
                                        exit();
                                    }
                                    mysqli_stmt_bind_param($stmt, "s", $uid);
                                    mysqli_stmt_execute($stmt);
        
                                    $resultData = mysqli_stmt_get_result($stmt);
        
                                        echo"<div class='container'>
                                        <h5 class='heading my-3'>Update Account Type</h5>
                                        <form action='/admin/user.admin.php?id=$uid' class='' method='POST'> ";
                                        while($row = mysqli_fetch_assoc($resultData)){
                                            $phoneNumber = $row['usersPhoneNum'];
                                            $email = $row['usersEmail'];
                                            $name = $row['usersName'];
                                            $uid = $row['usersUid'];
                                            $accType = $row['usersAccType'];
                                            echo "
                                            <div class='row'>
                                            <div class='col-6 mb-3'>
                                              <label for='firstName'>Full name</label>
                                              <input type='text' class='form-control text-center disable' name='name' placeholder='Full Name' value='$name' disabled>
                                            </div>
        
                                            <div class='col-6 mb-3'>
                                                <label for='username'>Username</label>
                                                <div class=''>
                                                <input type='text' class='form-control text-center disable' name='username' value='$uid' disabled>
                                                </div>
                                            </div>
                                            
                            
                                            <div class='col-6 mb-3'>
                                                <label for='username'>Email </label>
                                                <div class=''>
                                                <input type='text' class='form-control text-center disable' name='phoneNum' value='$email' disabled>
                                                </div>
                                            </div>";
                                            
                                            if(strcasecmp($accType, "admin") == 0){
                                                echo "
                                                <div class='col-6 mb-3'>
                                                    <label for='email'>Account Type</label>
                                                    <select name='accType' class='mt-0 form-control inputRound text-center' required>
                                                        <option value='$accType'>$accType</option>
                                                        <option value='Client'>Client</option>
                                                        <option value='Intern'>Intern</option>
                                                    </select>
                                                    <input type='hidden' name'id' value='$uid'>
                                                </div>";
                                            }
                                            elseif(strcasecmp($accType, "intern") == 0){
                                                echo "
                                                <div class='col-6 mb-3'>
                                                    <label for='email'>Account Type</label>
                                                    <select name='accType' class='mt-0 form-control inputRound text-center' required>
                                                        <option value='$accType'>$accType</option>
                                                        <option value='Client'>Client</option>
                                                        <option value='Admin'>Admin</option>
                                                    </select>
                                                    <input type='hidden' name'id' value='$uid'>
                                                </div>";
                                            }
                                            else{
                                                echo "
                                                <div class='col-6 mb-3'>
                                                    <label for='email'>Account Type</label>
                                                    <select name='accType' class='mt-0 form-control inputRound text-center' required>
                                                        <option value='$accType'>$accType</option>
                                                        <option value='Admin'>Admin</option>
                                                        <option value='Intern'>Intern</option>
                                                    </select>
                                                    <input type='hidden' name'id' value='$uid'>
                                                </div>";
                                            }
                                            echo "
                                            </div>
                                                <button class='btn btn-light' type='submit' name='updateAccount'>Submit</button>
                                                <a href='/Admin/Users' class='btn btn-outline-danger my-2' >Cancel</a>
                                            </form>
                                            ";
                                        }
                            echo"</div>";
                            echo"</div>";
                        ?>
                    </div>
                </div>
            <?php

            include_once 'adminFooter.php';
        }
            
    }
    else{
        header("location: /Admin/Login");
    }
}
else{
    header("location: /Home");
}
            ?>