<?php
	$title = 'Product Handling: Pumkin';

include_once 'header.php';

if(isset($_SESSION["useruid"])){

	if($_SESSION["useruid"]==="admin"){

			$dbServername = "localhost";
			$dbUsername = "u843931047_pumkinproducts";
			$dbPassword = "5P~PCQfN:g";
			$dbname = "u843931047_productdb";


			$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbname);

			if(isset($_GET["error"])){
				if($_GET["error"] == "none"){
					echo "<p class='mt-2'><font color= #28a745>PRODUCT UPDATED SUCCESSFULLY!</font></p>";
				}
			}

			if(!isset($_POST['addProduct'])){
				$add = true;
			}
			else{
				$add = false;
			}

			if(!$add){
				echo productHandler();
			}
			else{
				echo "
				<div class='container mt-3'>
					<h4 class='heading' style='font-size:2rem'>Product Handling</h4>
				</div>

				
				<form class='formStyle mt-4' action='productHandler.php' method='POST'>

					<button class='btn btn-outline-light' type='submit' name='addProduct'>ADD PRODUCT</button>
				</form>
			";
			}

			echo "
			<table class='content-table'>
			<theader class=''>
				<tr class='tStyle'>
					<th class=''>
						id
					</th>
					<th class=''>
						product img
					</th>
					<th class=''>
						product name
					</th>
					<th class=''>
						product price
					</th>
					<th class=''>
						product discript
					</th>
					<th class=''>
						2nd img
					</th>
					<th class=''>
						3rd img
					</th>
					<th class=''>
						4th img
					</th>
					<th class=''>
						C.R.U.D
					</th>
				</tr>
			</theader>
		";
	

					$sql = "SELECT * FROM producttb;";

					$results = mysqli_query($conn, $sql);
					$resultsCheck = mysqli_num_rows($results);

					if($resultsCheck > 0){
						echo"<tbody>";
						echo"<div class='row'>";
						while($row = mysqli_fetch_assoc($results)){
							echo"
							<div class
								<tr>
								
									<td>".$row['id']."</td>
									<td><img src=".$row['product_img']." style='width:100px'/></td>
									<td>".$row['product_name']."</td>
									<td>R ".$row['product_price']."</td>
									<td>".$row['product_shrt_discript']."</td>
									<td><img src=".$row['product_sec_img']." style='width:100px'/></td>
									<td><img src=".$row['product_third_img']." style='width:100px'/></td>
									<td><img src=".$row['product_forth_img']." style='width:100px'/></td>

									<td>
										<a  class='btn btn-warning ml-1' name='remove' href='edit.php?id=$row[id]'><i class='fas fa-edit text-right ' style='width:15px'></i></a>
										<hr/>
										<a  class='btn btn-danger ml-1' name='remove' href='admin/delete.php?id=$row[id]'><i class='fas fa-plus  text-right close-btn'></i></a>
									</td>
								</tr>
							";
						}
						echo"</tbody>";
					}

			
		echo"</table>";


		include_once 'footer.php';
	}
	else{
		echo"<script>alert(\"ACCESS DENIED!\");</script>";
		header("location:../pumpkinGrey/profile.php");
    	exit();
	}

}
else{
	header("location:../pumpkinGrey/login.php");
    exit();
}