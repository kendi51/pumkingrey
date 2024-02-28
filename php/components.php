<?php


function threeImages($productName, $productPrice, $productImg, $productId, $brand) {
    $product_name = explode(" ", $productName);
    $product_name = implode("_", $product_name);

    echo "

        <div class='col-6 col-md-4 col-lg-4 wrapper mt-3'>

                <div class='card'>
                    <a href='/Item/$product_name' name='item'>
                        <img src='/$productImg' name='item' class='width-set' alt='$product_name' style=' aspect-ratio: 1 / 1;'>
                    </a> 
                        <div class='content'>
                            <div class='row text-center'>
                                <div class='details col-12 px-1 mt-3'>
                                    <h6 style='font-size: 14px;'>$productName</h6>
                                    <h6 class='' style='font-size: 12px; font-weight: 100;text-transform: uppercase'>$brand<h6>
                                </div>
                                <div class='priceTags col-12'>
                                    <h6>
                                    R $productPrice</h6>
                                </div>
                            </div>

                            <input type='hidden' name='product_id' value='$productId'>
                        </div>
                    
                </div>
        </div >
    
    ";

}

function fourImages($productName, $productPrice, $productImg, $productId, $brand){
    $product_name = explode(" ", $productName);
    $product_name = implode("_", $product_name);

    echo "
    
        <div class='col-6 col-md-3 col-lg-3 wrapper mt-3'>
           
                
                <div class='card'>
                    <a href='/Item/$product_name' name='item'>
                        <img src='/$productImg' name='item' class='width-set' alt='$product_name' style=' aspect-ratio: 1 / 1;'>
                    </a> 
                        <div class='content'>
                            <div class='row text-center'>
                                <div class='details col-12 px-1 mt-3'>
                                    <h6 style='font-size: 14px;'>$productName</h6>
                                    <h6 class='' style='font-size: 12px;font-weight: 100;text-transform: uppercase'>$brand<h6>
                                </div>
                                <div class='priceTags col-12'>
                                <h6>R $productPrice</h6>
                                </div>
                            </div>

                            <input type='hidden' name='product_id' value='$productId'>
                        </div>
                      
                </div>
                
            </form>
        </div >
    
    ";
}

function fourImagesAdmin($productName, $productPrice, $productImg, $productId, $active, $link){

    echo "
    
        <div class='col-6 col-md-3 col-lg-3 wrapper mt-3'>
           
                
                <div class='card'>
                    <a href='/admin/productHandler.php?id=$productId' name='item'>
                        <img src='../$productImg' name='item' class='width-set' alt='$productName' style='border: 1em solid #343a40; aspect-ratio: 1 / 1;'>
                    </a> 
                        <div class='contentAdmin'>
                            <div class='row text-center'>
                                <div class='details col-12 px-1'>
                                    <h6 style='font-size: 1.5vmax;'>$productName</h6>
                                    $active
                                </div>
                                <div class='priceTags col-12'>
                                <h6>
                                R $productPrice\0</h6>
                                </div>
                            </div>

                            <input type='hidden' name='product_id' value='$productId'>
                            <a href='$link' class='btn btn-dark my-2' target='_blank'>Purchase</a>
                        </div>
                        
                </div>
                
            </form>
        </div >
    
    ";
}

function welcomeImg($wImg,$wText,$wLink,$wAltText){
    echo "
        <div class='container-fluid mt-4'>
            <!---->               
                <div class='col-lg-12'>
                    <a href='$wLink'>
                        <img src='$wImg' alt='$wAltText' class='intro_im w-50'>
                    </a>
                </div>
        
        </div>

        <div class='container'>
            <h1 class='mt_ctrl_60 txt_ctrl para'>
                $wText
            </h1>
            <a class='label-2' href='Shopping page.php'>Shop NOW
                <button type='button' class='btn btn-outline-dark mt-3 btn-text' style='text-align: center;'>Shop Now</button>
            </a>
        </div>
    ";
}

function carousel($text1, $text2){

    echo "
    <div class='container-fluid mb-0 mt-3'>
        <div class='row mb-0 mt-0 bg-light'>
            <div class='col-sm-12 mb-0 mt-0'>
            
                <div class='carousel slide mb-0 mt-0' data-ride='carousel'>
                
                    <!-- indicators dots and nav -->
                
                
                    <!-- wrapper for images in the slide -->
                    <div class='carousel-inner mb-0 mt-0'style='height:50px;' role='listbox'>
                
                        <div class='carousel-item active no-margin'>
                            <p class='m-0 p-0' style='text-align: center; color: #00B0BA;'>
                            <small><strong>$text2</strong></small>
                            <br>
                            
                            <small style='color:black'>$text1</small>
                            </p>
                        </div>
                        
                        <div class='carousel-item no-margin'>
                            <p class='m-0 p-0' style='text-align: center; color: black;'>
                            <small><strong>$text1<strong></small>
                            <br>
                            
                            <small style='color: red'>$text2</small>
                            </p>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    ";
}

function cartElement($productName, $productPrice, $productImg, $productDiscript, $productId, $size) {
    $qty = 1;
    echo"
        <div class='col-12 col-md-4 col-lg-4'>
        <form action='cart.php?action=remove&id=$productId' method='post' class='cart-item mb-4 mb-md-2 mb-lg-2'>
            
            <!-- <div class='row bg-white'> -->
                <div class='product_data'>
                <div class='border rounded'>
                
                <div class='row'>
                    <div class='col-12'>
                        <img src='$productImg' alt='$productName' class='img-fluid w-100'/>
                    </div>
                    
                    <div class='col-12 product_data'>
                        <div class='row p-2'>
                            <div class='col-10'>
                                <h5 class='' style='font-size:small'>$productName</h5>
                                <p class='text-secondary' style='font-size:11px; line-height: 1; max-height: 5'>$productDiscript</p>
                            </div>
                            <div class='col-2 pl-0'>
                                <button type='submit' class='btn btn-danger ml-1' name='remove' style='padding: 0 0.3em'><i class='fas fa-plus text-center close-btn'></i></button>
                            </div>
    
                            <div class='price-data col-5 pb-3'>
                                <h6 name='price'  class='mt-2' id='price' style='font-size:small'>R ". $productPrice = $productPrice * $qty ."</h6>
    
                                <h6 class='mb-0 mt-2 mt-md-4 mt-lg-4 mt-xl-4' style='font-size:small'>Size: $size</h6>
                            </div>
                        
                    
                    
                            <div class='col-7 text-right quantity'>
                                
        
                                <div class='mt-2'>
                                    <h6 class='' style='font-size: small'>Quantity</h6>
        
                                <button type='button' class='btn btn-light px-2 py-0 minus-btn'>
                                    <i class='fas fa-minus fa-xs'></i>
                                </button>
                                            
                                <input name='qty-input' value='$qty' class='form-control d-inline px-1 bg-white qty-input' disabled>
                                            
                                <button type='button' class='btn btn-light px-2 py-0 plus-btn'>
                                    <i class='fas fa-plus fa-xs'></i>
                                </button>
        
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
		</div>
    </form>

    ";
}

function linkImagesAdmin($linkId, $linkTitle, $linkPara, $linkImg, $filter, $search, $status){
 
    echo"
    
    <form action='/Admin/UpdateLinks' method='POST' enctype='multipart/form-data'>
            <div class='border-top border-bottom m-5 m-md-0 m-lg-0'>
                    
                        <div class='row '>
                            <div class='col-md-3 col-lg-3 col-xs-3'>
                                <img src='../$linkImg' alt='$search' class='img-fluid w-100'/>
                            </div>
                            <div class='col-lg-4 col-sm-4'>
                                <h5 class='pt-2' >$linkTitle</h5>
                                <small class='text-secondary'>$linkPara</small>
                            </div>
    
                            <div class='price-data col-lg-4 col-sm-4 col-xs-2'>
                                <h6 name='price'  class='mt-2' id='price'>
                                <span style='color:#00B0BA;'>Search Filter:</span><br>$filter</h6>
    
                                <h6 class='mb-0 mt-4'>
                                <span style='color:#00B0BA;'>Search Value:</span><br>$search</h6>
                                <input type='hidden' name='id' value='$linkId'>
                            </div>
                    
                            <div class='col-lg-1 col-sm-1 quantity pt-2'>
                                <button type='submit' class='btn btn-primary ' name='edit'><i class='fas fa-edit'></i> Edit</button>";
                                if(strcasecmp($status, "active") == 0){echo "<i class='fa-solid fa-circle p-4' style='color: #19b849;'></i>";}
                                else{echo "<i class='fa-solid fa-circle p-4' style='color: #b81919;'></i>";}
                                echo "
                            </div>
                        </div>

            </div>
    </form>

    ";
}

function itemElement($productName, $productPrice, $productImg, $productShrtDiscript, $productLongDiscript, $productId, $product2ndImg, $product3rdImg, $product4thImg, $sizeType, $accType, $f, $t, $link){
    
    $product_name = explode(" ", $productName);
    $product_name = implode("_", $product_name);
    
    echo "
    
    <section class='container sprodut'>
        <form action='/Item/$product_name' method='post'>
            <div class='row py-3'>
                <div class='col-lg-6 col-md-6 col-sm-12 '>
                
                    <div class='bd-example'>
                        <div id='carouselExampleIndicators' class='carousel slide' data-ride='carousel' style='margin-bottom: 0'>
                          <ol class='carousel-indicators'>
                            <li data-target='#carouselExampleIndicators' data-slide-to='0' class=''></li>
                            <li data-target='#carouselExampleIndicators' data-slide-to='1' class='active'></li>
                            <li data-target='#carouselExampleIndicators' data-slide-to='2' class=''></li>
                            <li data-target='#carouselExampleIndicators' data-slide-to='2' class=''></li>
                          </ol>
                          <div class='carousel-inner p-1'>
                            <div class='carousel-item' style='height:36vmax'>
                              <img class='d-block w-100 ratio' style='height:auto' data-src='holder.js/800x400?auto=yes&amp;bg=777&amp;fg=555&amp;text=First slide' alt='$productImg' src='/$productImg' data-holder-rendered='true'>
                            </div>
                            <div class='carousel-item' style='height: 36vmax'>
                              <img class='d-block w-100 ratio' style='height:auto' data-src='holder.js/800x400?auto=yes&amp;bg=666&amp;fg=444&amp;text=Second slide' alt='$product2ndImg' src='/$product2ndImg' data-holder-rendered='true'>
                            </div>
                            <div class='carousel-item active' style='height:36vmax'>
                              <img class='d-block w-100 ratio' style='height:auto' data-src='holder.js/800x400?auto=yes&amp;bg=555&amp;fg=333&amp;text=Third slide' alt='$product3rdImg' src='/$product3rdImg' data-holder-rendered='true'>
                            </div>
                            <div class='carousel-item' style='height:36vmax'>
                              <img class='d-block w-100 ratio' style='height:auto' data-src='holder.js/800x400?auto=yes&amp;bg=555&amp;fg=333&amp;text=Third slide' alt='$product4thImg' src='/$product4thImg' data-holder-rendered='true'>
                            </div>
                          </div>
                          <a class='carousel-control-prev' href='#carouselExampleIndicators' role='button' data-slide='prev'>
                            <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                            <span class='sr-only'>Previous</span>
                          </a>
                          <a class='carousel-control-next' href='#carouselExampleIndicators' role='button' data-slide='next'>
                            <span class='carousel-control-next-icon' aria-hidden='true'></span>
                            <span class='sr-only'>Next</span>
                          </a>
                        </div>
                    </div>
                    
                </div
                
                <div class='col-lg-6 col-md-6 col-sm-12 '>
                <div class='col-lg-6 col-md-6 col-sm-12 text-left price-data'>
                    <h3 class='pb-2'>$productName</h3>
                    
                    <h6 class='price mb-3 bg-white' name='price' id='price'>R $productPrice\0 </h6>

                    <div class='icons mb-2 mt-1'>
                        <a href='$f' target='_blank'><i class='fab fa-facebook fa-xl'></i></a>
                        <a href='$t' target='_blank'><i class='fab fa-x-twitter fa-xl px-2'></i></a>
                        <a href='whatsapp://send?text=https://$link' data-action='share/whatsapp/share' target='_blank'><i class='fab fa-whatsapp fa-xl'></i></a>
                    </div>
                    
                    ";
                    
                    if($sizeType == 1){
                        echo jeanSize($productId);
                    }
                    elseif($sizeType == 2) {
                        echo shirtSize($productId);
                    }
                    else{
                        echo "SIZE TYPE ERROR...";
                    }

                    
                echo
                    "<div class='buttons'>
                        <button style=' padding: 10px' class='border border rounded' name='buy'>Buy Now</button>
                        <button style=' padding: 10px' class='border border rounded' name='add'>Add Cart</button>
                    </div>
                    <h6 id=\"addedToCart\"></h6>
                    <input type='hidden' name='product_id' value='$productId'>
                    <input type='hidden' name='product_name' value='$productName'>

                    <h4 class='mt-4 mb-3'>Product Details</h4>
                    <h6>$productShrtDiscript </h6>
                    <hr>
                    <h6>$productLongDiscript </h6>
                </div>
            </div>
        </form>
    </section>
    
    ";
}

function productHandlerElement($productName, $productPrice, $productImg, $productShrtDiscript, $productLongDiscript, $productId, $product2ndImg, $product3rdImg, $product4thImg, $sizeType, $productBrand, $gender, $category, $f, $t, $link){
    
    echo "
    <div class='container-fluid'>
        <div class='heading my-3'>
            <h4></h4>
        </div>
    </div>

    <section class='container sproduct'>
        <div class='row p-3'>
            <!-- IMAGES DATA & SHARE LINKS -->
            <div class='col-lg-3 col-md-5 col-12 p-lg-0 p-md-0 p-sm-2'>
                <form action='/Admin/ImagesUpdate' method='POST'>
                    <img src='../$productImg' class='img-fluid w-100 pb-1' id='mainImg' alt='$productName'>

                    <div class='small-img-group'>
                        <div class='small-col'>
                            <img src='../$productImg' width='100%' class='small-img' alt='$productImg'>
                        </div>

                        <div class='small-col'>
                            <img src='../$product2ndImg' width='100%' class='small-img' alt='$product2ndImg'>
                        </div>

                        <div class='small-col'>
                            <img src='../$product3rdImg' width='100%' class='small-img' alt='$product3rdImg'>
                        </div>

                        <div class='small-col'>
                            <img src='../$product4thImg' width='100%' class='small-img' alt='$product4thImg'>
                        </div>
                        <input type='hidden' name='id' value='$productId'>
                    </div>
                    <button type='submit' name='update-images' class='btn btn-light btn-lg btn-block my-2'>Update Images</button>
                </form>
                
                <div class='icons pt-2'>
                    <a href='$f' target='_blank'><i class='fab fa-facebook fa-xl p-2' style='color: #426782;'></i></a>
                    <a href='$t' target='_blank'><i class='fab fa-x-twitter fa-xl p-2' style='color: white;'></i></a>
                    <a href='whatsapp://send?text=https://$link' data-action='share/whatsapp/share' target='_blank'><i class='fab fa-whatsapp fa-xl p-2' style='color: #25D366;'></i></a>
                </div>
            </div>
            
            <!-- BRAND DATA -->
            <div class='col-lg-5 col-md-7 col-12 text-left price-data py-2'>
                <form action='/Admin/Brand' method='POST'>
                    <span style='color:#00B0BA;'>Brand</span>
                    <h5 class=''>$productBrand</h5>
                    <hr>
                    <span style='color:#00B0BA;'>Product Name</span>
                    <h5 class=''>$productName</h5>
                    <hr>

                    <span style='color:#00B0BA;'>Short Discription</span>
                    <h6>$productShrtDiscript </h6>
                    <hr>
                    <span style='color:#00B0BA;'>Long Discription</span>
                    <h6>$productLongDiscript </h6>
                    <input type='hidden' name='id' value='$productId'>
                    <button type='submit' class='btn btn-light btn-lg btn-block my-2'>Update Brand</button>
                    <input type='hidden' name='product_id' value='$productId'>
                </form>
            </div>
            
            <!-- META DATA  -->
            <div class='col-lg-4 col-md-12 col-12 text-left price-data py-2'>
                <form action='/Admin/Meta-Data' method='POST'>
                    <div class='row'>
                        <div class='col-6'>
                            <span style='color:#00B0BA;'>Size Type</span>
                            <h6>"; if($sizeType == 1) {echo $sizeType.": Trouser";} elseif($sizeType == 2) {echo $sizeType.": Upper/Shirt";}else { echo $sizeType.": Error";} echo "</h6>
                        </div>

                        <div class='col-6'>
                            <span style='color:#00B0BA;'>Gender</span>
                            <h6>$gender</h6>
                        </div>
                    </div>

                    <hr>
                
                    <div class='row'>
                        <div class='col-6'>
                            <span style='color:#00B0BA;'>Category</span>
                            <h6 class=''>$category</h6>
                        </div>

                        <div class='col-6'>
                            <span style='color:#00B0BA;'>Price</span>
                            <h6 class=''>R $productPrice\0</h6>
                        </div>
                        
                    </div>
                    <input type='hidden' name='id' value='$productId'>
                    <hr>
                    <span style='color:black; font-size: 15px; text-decoration: underline' class='mb-2'>Inventory ID: $productId</span>
                    
                    
    
    ";
}

function inventoryShirtSize($xs, $s, $m, $l, $xl, $xxl){

    echo "
    
        <div class='row'>

            <div class='col-4'>
                <span style='color:#00B0BA;'>XS</span>
                <h6>$xs</h6>
            </div>

            <div class='col-4'>
                <span style='color:#00B0BA;'>Small</span>
                <h6>$s</h6>
            </div>

            <div class='col-4'>
                <span style='color:#00B0BA;'>Medium</span>
                <h6>$m</h6>
            </div>

            <div class='col-4'>
                <span style='color:#00B0BA;'>Large</span>
                <h6 class=''>$l</h6>
            </div>

            <div class='col-4'>
                <span style='color:#00B0BA;'>XL</span>
                <h6 class=''>$xl</h6>
            </div>

            <div class='col-4'>
                <span style='color:#00B0BA;'>XXL</span>
                <h6 class=''>$xxl</h6>
            </div>
            
        </div>
    ";
}

function inventoryJeanSize($s28, $s30, $s32, $s34, $s36, $s38, $s40){

    echo "
    
        <div class='row'>

            <div class='col-3'>
                <span style='color:#00B0BA;'>Size 28</span>
                <h6>$s28</h6>
            </div>

            <div class='col-3'>
                <span style='color:#00B0BA;'>Size 30</span>
                <h6>$s30</h6>
            </div>

            <div class='col-3'>
                <span style='color:#00B0BA;'>Size 32</span>
                <h6>$s32</h6>
            </div>

            <div class='col-3'>
                <span style='color:#00B0BA;'>Size 34</span>
                <h6 class=''>$s34</h6>
            </div>

            <div class='col-3'>
                <span style='color:#00B0BA;'>Size 36</span>
                <h6 class=''>$s36</h6>
            </div>

            <div class='col-3'>
                <span style='color:#00B0BA;'>Size 38</span>
                <h6 class=''>$s38</h6>
            </div>

            <div class='col-3'>
                <span style='color:#00B0BA;'>Size 40</span>
                <h6 class=''>$s40</h6>
            </div>
            
        </div>
    ";
}

function shirtSize($id) {
    $serverName = "localhost";
    $dBUserName = "u843931047_pumkinproducts";
    $dBPassword = "5P~PCQfN:g";
    $dBName = "u843931047_productdb";


    $product_conn = mysqli_connect($serverName, $dBUserName, $dBPassword, $dBName);


    $sql = "SELECT * FROM inventorytb WHERE product_id = $id;";
			
    $results = mysqli_query($product_conn, $sql);
    $resultsCheck = mysqli_num_rows($results);

    //$results = $db2->getData();
    while($row = mysqli_fetch_assoc($results)){
        $xs =  $row['xs'];
        $s =  $row['s'];
        $m =  $row['m'];
        $l =  $row['l'];
        $xl =  $row['xl'];
        $xxl =  $row['xxl'];
    }
    echo "
        <select name='size' id='size' class='my-3 mb-2 inputRound bg-white p-2' required>
            <option value=''>Select Size</option>
            <option value='XS'";if($xs <= 0){echo "style='background-color: rgb(211,211,211,0.7)' disabled";} echo">XS</option>
            <option value='S'";if($s <= 0){echo "style='background-color: rgb(211,211,211,0.7)' disabled";} echo">S</option>
            <option value='M'";if($m <= 0){echo "style='background-color: rgb(211,211,211,0.7)' disabled";} echo">M</option>
            <option value='L'";if($l <= 0){echo "style='background-color: rgb(211,211,211,0.7)' disabled";} echo">L</option>
            <option value='XL'";if($xl <= 0){echo "style='background-color: rgb(211,211,211,0.7)' disabled";} echo">XL</option>
            <option value='XXL'";if($xxl <= 0){echo "style='background-color: rgb(211,211,211,0.7)' disabled";} echo">XXL</option>
        </select>
    ";
}

function jeanSize($id) {
    $serverName = "localhost";
    $dBUserName = "u843931047_pumkinproducts";
    $dBPassword = "5P~PCQfN:g";
    $dBName = "u843931047_productdb";


    $product_conn = mysqli_connect($serverName, $dBUserName, $dBPassword, $dBName);


    $sql = "SELECT * FROM inventorytb WHERE product_id = $id;";
			
    $results = mysqli_query($product_conn, $sql);
    $resultsCheck = mysqli_num_rows($results);

    //$results = $db2->getData();
    while($row = mysqli_fetch_assoc($results)){
        $s28 =  $row['size28'];
        $s30 =  $row['size30'];
        $s32 =  $row['size32'];
        $s34 =  $row['size34'];
        $s36 =  $row['size36'];
        $s38 =  $row['size38'];
        $s40 =  $row['size40'];
    }
    echo "
        <select name='size' id='size' class='my-3 mb-2 inputRound bg-white p-2' required>
            <option value=''>Select Size</option>
            <option value='28'";if($s28 <= 0){echo "style='background-color: rgb(211,211,211,0.7)' disabled";} echo">28</option>
            <option value='30'";if($s30 <= 0){echo "style='background-color: rgb(211,211,211,0.7)' disabled";} echo">30</option>
            <option value='32'";if($s32 <= 0){echo "style='background-color: rgb(211,211,211,0.7)' disabled";} echo">32</option>
            <option value='34'";if($s34 <= 0){echo "style='background-color: rgb(211,211,211,0.7)' disabled";} echo">34</option>
            <option value='36'";if($s36 <= 0){echo "style='background-color: rgb(211,211,211,0.7)' disabled";} echo">36</option>
            <option value='38'";if($s38 <= 0){echo "style='background-color: rgb(211,211,211,0.7)' disabled";} echo">38</option>
            <option value='40'";if($s40 <= 0){echo "style='background-color: rgb(211,211,211,0.7)' disabled";} echo">40</option>
        </select>
    ";
}

function leftImg($img, $title, $para, $filter, $searchVal) {

    echo "

        <div class='container-fluid'>
            <form action='/Shop' method='POST'>
                <div class='row center-img m-3'>
                    <div class='col-sm-12 col-md-6 col-lg-6 p-3'>
                        <img src='$img' class='img-fluid w-75' name='link_img' alt='$searchVal'>
                    </div>
    
                    <div class='col-sm-12 col-md-6 col-lg-6 mt-2 para'>
                        <h1 class='head title' name='title'>$title</h1>
                        <p class='para' name='para'>$para</p>
                        <input type='hidden' name='filter' value='$filter'>
                        <input type='hidden' name='searchVal' value='$searchVal'>
                        <input type='hidden' name='title' value='$title'>
                        <input type='hidden' name='para' value='$para'>
                        <input type='hidden' name='link_img' value='$img'>
                        
                        <div class='container text-center'>
                            <button type='submit' class='btn btn-outline-light' name='link'>Shop Now</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    ";
}

function rightImg($img, $title, $para, $filter, $searchVal) {

    echo "
    
        <div class='container-fluid'>
            <form action='/Shop' method='POST'>
                <div class='row center-img m-3'>
                    <div class='col-sm-12 col-md-6 col-lg-6 p-3 order-sm-12'>
                        <img src='$img' class='img-fluid w-75' name='link_img' alt='$searchVal'>
                    </div>
    
                    <div class='col-sm-12 col-md-6 col-lg-6 mt-2 para order-sm-1'>
                        <h1 class='head title' name='title'>$title</h1>
                        <p class='para' name='para'>$para</p>
                        <input type='hidden' name='filter' value='$filter'>
                        <input type='hidden' name='searchVal' value='$searchVal'>
                        <input type='hidden' name='title' value='$title'>
                        <input type='hidden' name='para' value='$para'>
                        <input type='hidden' name='link_img' value='$img'>
                        
                        <div class='container text-center'>
                            <button type='submit' class='btn btn-outline-light' name='link'>Shop Now</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    
    ";

}
function productHandler() {

    echo"
			<div class='container mt-3'>
				<h1 class='heading' style='font-size:2rem'>Product Handling</h1>
			</div>

			<div class=''>
				<form class='formStyle' action='admin/products.admin.php' method='POST'>
						<label for='name'>Product Name
							<input class='inputStyle' type='text' name='product_name' required>
						</label>
						<label for='name'>Brand Name
							<input class='inputStyle' type='text' name='product_brand_name' required>
						</label>
						<label for='email'>Product Price
							<input type='text' name='product_price' required>
						</label>
						<label for='uid'>Image Location
							<input type='file' class=' btn-outline-light' name='product_img'  required>
						</label>
						<label for='pwd'>Product Short Discription
							<input type='text' name='product_shrt_discript' required>
						</label>
						<label for='pwdrepeat'>Second Image
							<input type='file' class=' btn-outline-light' name='product_sec_img'>
						</label>
						<label for='pwdrepeat'>Third Image
							<input type='file' class=' btn-outline-light' name='product_third_img'>
						</label>
						<label for='pwdrepeat'>Forth Image
							<input type='file' class=' btn-outline-light' name='product_forth_img'>
						</label>
						<label for='pwdrepeat'>Gender (MALE / FEMALE / UNISEX)
							<input type='text' name='product_gender' required>
						</label>
						<label for='pwdrepeat'>Product Long Discription <br/>
							<textarea type='text' class='w-50' name='product_long_discript'></textarea>
						</label>
						<label for='name'>Category
							<input class='inputStyle' type='text' name='product_category' required>
						</label>
						<label for='email'>Size Type (1  =  Jeans / 2 = Shirts)
							<input type='text' name='product_size_type' required>
						</label>
						<button class='btn btn-outline-light btn-text' type='submit' name='submit'>ADD PRODUCT</button>
					</form>
			</div>
		</div>";
}

function checkOutElement($productName, $productPrice, $productImg, $productId) {
    $qty =1; //$_POST['qty-input'];
    echo"
    
        <div class='border rounded pl-2 pr-2'>
            <div class='row bg-white '>
                <div class='col-lg-12' col-sm-12 product_data'>
                
                    <div class='row'>
                        <div class='col-sm-3 col-md-3 col-lg-3 col-xs-6 center '>
                            <img src='$productImg' alt='$productName' class='img-fluid w-5'/>
                        </div>
                        <div class='col-lg-5 col-sm-5 col-xs-5'>
                            <h6 class='pt-3'>$productName</h6>
                        </div>

                        <div class='price-data col-lg-4 col-sm-4 col-xs-4 '>
                            <h6 name='price'  class='pt-3' id='price'>R ". $productPrice = $productPrice * $qty ."</h6> 


                                <small>Quantity: </small>
                                            
                                <input name='qty-input' value='$qty' class='form-control d-inline px-1 bg-white qty-input' id='qty' style='margin: 0 0 0 0'/>
                              
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

    ";
}

function pendingOrder($conn, $userid){
    $sql = "SELECT * FROM pumkinorderdetails WHERE userId = $userid;";
		
	$results = mysqli_query($conn, $sql);
	$resultsCheck = mysqli_num_rows($results);
    $count = 0;

	while($row = mysqli_fetch_assoc($results)){
        if($row['paymentSuccess'] == null){
            $count++;
        }
    }
    if($count>0){
        echo "
            <div class='container mt-2 pending'>
                <a href='orders.php'><h4>You have ".$count." pending orders. Click here.</h4></a>
            </div>
        ";
    }
}

function sideBar($page){
    echo 
        "
        <div class='container mt-3'>
		<div class='row'>
			<div class='col-lg-4 col-md-4 d-none d-md-block text-left' '>
            <div class='p-2 mb-2 mt-5' <!-- style='border: 1px black solid -->'>
				<h4 class='heading mt-3' style='text-decoration: underline'>My account</h4>
				
                <div class=' mt-4'>
					<li class='mb-3 "; if($page == 'orders.php'):echo 'fouss';endif; echo" ' style='list-style: none'> 
                    <i class='pr-2 ml-1 fa fa-bag-shopping'></i>
						<a class='' href='orders.php'"; if($page == 'orders.php'):echo 'style="text-transform: uppercase;font-weight:500;"';endif; echo " >Order & Returns
						<span class='sr-only'>
						</span>
						</a> 
					</li> 
					<hr>
					<li class='mb-3 "; if($page == 'acctransact.php'):echo 'fouss';endif; echo"' style='list-style: none'> 
                    <i class='pr-2 ml-1 fa-solid fa-credit-card'></i>
						<a class='' href='acctransact.php'"; if($page == 'acctransact.php'):echo 'style="text-transform: uppercase;font-weight:500;"';endif; echo" >Account Transactions
						</a> 
					</li> 
					<hr>	
					<li class='mb-3 "; if($page == 'users.php' ):echo 'fouss';endif; echo"' style='list-style: none'> 
                    <i class='pr-2 ml-1 fa fa-user'></i>
						<a class='pl-1' href='users.php'"; if($page == 'users.php' ):echo "style='text-transform: uppercase;font-weight:500;'";endif; echo" >Account Details
						</a> 
					</li> 
					<hr>
					<li class='mb-3 "; if($page == 'refer.php'):echo 'fouss';endif; echo"' style='list-style: none'> 
                    <i class='pr-2 fa fa-group'></i>
						<a class='' href='refer.php'"; if($page == 'refer.php'):echo 'style="text-transform: uppercase;font-weight:500;"';endif; echo" >Refer A Friend
						</a> 
					</li> 
					<hr>
					<li class='mb-3 "; if($page == 'comms.php'):echo 'fouss';endif; echo"' style='list-style: none'> 
                    <i class='pr-2 ml-1 fa fa-at'></i>
						<a class='' href='comms.php'"; if($page == 'comms.php'):echo 'style="text-transform: uppercase;font-weight:500;"';endif; echo" >Communication
						</a> 
					</li> 
				</div>
                </div>
			</div>
        ";
}
function sideBarAdmin($page){
    echo 
        "
        <div class='container'>
            <div class='row'>
                <div class='col-lg-3 col-md-3 d-none d-md-block text-left'>
                    <div class='' <!-- style='border: 1px black solid -->'>
                        <h5 class='heading mt-3' style='text-decoration: underline'>Menu</h5>
                        
                        <div class=' mt-4'>
                            <li class='mb-3 "; if($page == 'orders.php'):echo 'fouss';endif; echo" ' style='list-style: none'> 
                            <i class='pr-2 ml-1 fa fa-bag-shopping'></i>
                                <a class='' href='orders.php'"; if($page == 'orders.php'):echo 'style="text-transform: uppercase;font-weight:500;"';endif; echo " >Orders
                                <span class='sr-only'>
                                </span>
                                </a> 
                            </li> 
                            <hr>
                            <li class='mb-3 "; if($page == 'productHandler.php'):echo 'fouss';endif; echo"' style='list-style: none'> 
                            <i class='pr-2 ml-1 fa-solid fa-barcode'></i>
                                <a class='' href='productHandler.php'"; if($page == 'acctransact.php'):echo 'style="text-transform: uppercase;font-weight:500;"';endif; echo" >Product Handler
                                </a> 
                            </li> 
                            <hr>	
                            <li class='mb-3 "; if($page == 'users.php' ):echo 'fouss';endif; echo"' style='list-style: none'> 
                            <i class='pr-2 ml-1 fa fa-user'></i>
                                <a class='pl-1' href='users.php'"; if($page == 'users.php' ):echo "style='text-transform: uppercase;font-weight:500;'";endif; echo" >User Accounts
                                </a> 
                            </li> 
                            <hr>
                            <li class='mb-3 "; if($page == 'returns.php'):echo 'fouss';endif; echo"' style='list-style: none'> 
                            <i class='pr-2 ml-1 fa fa-rotate-left'></i>
                                <a class='' href='returns.php'"; if($page == 'returns.php'):echo 'style="text-transform: uppercase;font-weight:500;"';endif; echo" >Returns
                                </a> 
                            </li> 
                            <hr>
                            <li class='mb-3 "; if($page == 'comms.php'):echo 'fouss';endif; echo"' style='list-style: none'> 
                            <i class='pr-2 ml-1 fa fa-phone'></i>
                                <a class='' href='comms.php'"; if($page == 'comms.php'):echo 'style="text-transform: uppercase;font-weight:500;"';endif; echo" >Communication
                                </a> 
                            </li> 
                        </div>
                    </div>
                </div>
        ";
}

function orderElement($productName, $productPrice, $productImg, $productDiscript, $productId, $size){
    $qty = 1;
    echo"
    
        <div class='border rounded mb-2 mt-1'>
            <div class='row bg-white pl-3 pr-3'>
                <div class='col-lg-12' col-sm-12 product_data'>
                
                    <div class='row text-left'>
                            
                        <div class='col-2 p-0'>
                            <img src='../$productImg' alt='$productName' class='img-fluid ' width='100%' height='auto'/>
                        </div>
                        <div class='col-5'>
                            <h6 class='pt-2 smallerTxt'>$productName</h6>
                        </div>

                        <div class='price-data col-3'>
                            <h6 name='price'  class='mt-2 smallerTxt' id='price'>R ". $productPrice = $productPrice * $qty ."</h6>

                            <h6 class='mb-0 mt-2 smallerTxt'>Size: $size</h6>
                        </div>

                        <div class='col-2 quantity'>
                            

                            <div class='mt-2'>
                                <h6 class='smallerTxt'>Qty: 
                                            
                                $qty</h6>

                            </div>
                              
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    ";
}

function orderElementAdmin($productName, $productPrice, $productImg, $productDiscript, $productId, $size){
    $qty = 1;
    echo"
    
        <div class='border rounded mb-2 mt-1'>
            <div class='row bg-dark pl-3 pr-3'>
                <div class='col-12 product_data'>
                
                    <div class='row bg-dark text-left'>
                    
                        <div class='col-2 p-0'>
                            <img src='../$productImg' alt='$productName' class='img-fluid ' width='100%' height='auto'/>
                        </div>
                        <div class='col-5'>
                            <h6 class='pt-2 smallerTxt text-white'>$productName</h6>
                        </div>

                        <div class='price-data col-3'>
                            <h6 name='price'  class='mt-2 smallerTxt text-white' id='price'>R ". $productPrice = $productPrice * $qty ."</h6>

                            <h6 class='mb-0 mt-2 smallerTxt text-white'>Size: $size</h6>
                        </div>

                        <div class='col-2 quantity'>
                            

                            <div class='mt-2'>
                                <h6 class='smallerTxt text-white'>Qty: 
                                            
                                $qty</h6>

                            </div>
                              
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    ";
}

function contactUsSideBar(){

    echo '
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-3 ">
                <div class="header text-left mt-2">
                    <h4 class="">Quick Menu</h4>

                <form action="contact us.php" method="post">
                    <div class="row mt-2 text-left pending">
                        <div class="col-5 col-md-12 col-lg-12">
                            <button class="btn btn-link mt-2" type="submit" name="return" style="font-size: 18px; text-transform: none; font-weight: 300">Refund Policy</button>
                        </div>

                        <div class="col-5 col-md-12 col-lg-12">
                            <button class="btn btn-link mt-2" type="submit" name="" style="font-size: 18px; text-transform: none; font-weight: 300">How-to-order</button>
                        </div>
                        
                        <div class="col-4 col-md-12 col-lg-12">
                            <button class="btn btn-link mt-2" type="submit" name="" style="font-size: 18px; text-transform: none; font-weight: 300">Cancellation</button>
                        </div>

                        <div class="col-6 col-md-12 col-lg-12">
                            <button class="btn btn-link mt-2" type="submit" name="" style="font-size: 18px; text-transform: none; font-weight: 300">Pricing & Delivery</button>
                        </div>
                        
                        <div class="col-5 col-md-12 col-lg-12">
                            <button class="btn btn-link mt-2" type="submit" name="" style="font-size: 18px; text-transform: none; font-weight: 300">About Us</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    ';
}

function shareBtn(){
    
}