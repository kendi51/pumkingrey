<?php
	$title = 'Home: Pumkin';
	include_once 'header.php';

	carousel($text1, $text2);
?>
<style>
    .centered {
      position: absolute;
      top: 70%;
      left: 50%;
      transform: translate(-50%, -50%);
    }
    .ratio{
        aspect-ratio: 3 / 2;
    }
</style>


<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-12 col-md-6 pb-2">
            <a href="/Man">
                <img src="images/Shop-for-men.jpg" alt="Shop Mens' Clothes" style="width: 100%; height:auto;" class="ratio" />
                <h4 class="carousel-caption centered">SHOP<br/>MENSWEAR</h4>
            </a>
        </div>
        
        <div class="col-12 col-md-6">
            <a href="/Woman">
                <img src="images/Shop-for-women.jpg" alt="Shop Womens' Clothes" width="100%" height="auto" class="ratio"/>
                <h4 class="carousel-caption centered">  SHOP<br/>WOMENSWEAR</h4>
            </a>
        </div>
    </div>
</div>

<div class="container-fluid my-3">
	<div class="row">
		<div class="col-lg-4 col-md-4">
			<div class="anime bder border border-light">
				<a href="Contact" style="color: black;">
					<h4>
						F.A.Q
					</h4>
				</a>
			</div>
		</div>

		<div class="col-lg-4 col-md-4">
			<div class="anime bder border border-light">
				<a href="Contact" style="color: black;">
					<h4>
						Contact US
					</h4>
				</a>
			</div>	
		</div>

		<div class="col-lg-4 col-md-4">
			<div class="anime bder border border-light">
				<a href="#" style="color: black;">
					<h4>
						Returns
					</h4>
				</a>
			</div>
		</div>
	</div>
</div>

<?php
	include_once 'footer.php';
?>