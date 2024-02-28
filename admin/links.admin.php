<?php

session_start();
if(strcasecmp($_SESSION['accType'], "admin") == 0){
    if(isset($_SESSION['useruid'])){
        $title = "Manage Product Links: Pumkin";
        $page = "";
        include_once "adminHeader.php";
        $link_db = new CreateDb("u843931047_productdb", "linkstb"); //online db
        if(!isset($_POST['addLink'])){
        ?>
        
        <div class="container-fluid mt-3 mb-0">
            <!--<div class="text-center">-->
            <!--    <h4 class="col-12 mb-3">Manage Products</h4>-->
            <!--</div>-->
        
            <!--<form action="products.php" method="post">-->
                <!-- BUTTONS -->
            <!--    <button type="submit" class="btn btn-outline-dark" name="women">Woman</button>-->
            <!--    <button type="submit" class="btn btn-outline-dark" name="men">Man</button>-->
            <!--    <button type="submit" class="btn btn-outline-dark" name="addProduct">Add Product</button>-->
                <!-- END OF BUTTONS -->
            <!--</form>-->
            
            <nav class="navbar navbar-dark bg-dark mt-3">
        
              
              <form class="form-inline center flex-container"  action="links.admin.php" method="post" style='justify-content: center'>
                <!-- BUTTONS -->
                
                <button type="submit" class="btn btn-outline-success mx-1 mx-lg-2" name="women">Deactivated</button>
                
                
                <button type="submit" class="btn btn-outline-success mx-1 mx-lg-2" name="men">Active</button>
                
                <button type="submit" class="btn btn-outline-success mx-1 mx-lg-2" name="addLink">Add Link</button>
                
                <!-- END OF BUTTONS -->
            </form>
              <form class="form-inline" style='justify-content: right'>
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <select name='filter' class='my-2 my-sm-0 form-control inputRound' required>
                    <option value='none'>Select Filter</option>
                    <option value='Name'>Product Name</option>
                    <option value='Brand'>Brand</option>
                </select>
                <button class="btn btn-outline-success ml-2 my-2 my-sm-0" type="submit">Search</button>
              </form>
            </nav>
        </div>
        
        
        <!--ALL LINKS -->
        <div class="container mt-3 mb-0" >
            <div class="row">
                <?php
                
                    $result = $link_db->getData();
                    while($row = mysqli_fetch_assoc($result)){
                        linkImagesAdmin($row['id'], $row['link_title'], $row['link_para'], $row['link_img'], $row['link_filter'], $row['link_search'], $row['link_status']);
                    }
                ?>
            </div>
        </div>
        <?php
        }
        
        else{
        
        ?>
            <div class="container">
                <form action="addProduct.admin.php" method="post" enctype="multipart/form-data">
                    <!--<div class="row">-->
                    <!--    <div class="col- pt-3">-->
                            
                            <!-- ADD IMAGES -->
                            <h4 class="heading pb-3">create links</h4>
                            
                            <div class="row">
                                <div class='col-6 col-md-4 col-lg-4 mb-3'>
                                    <label for='firstName'>Cover</label>
                                    <input type='file' class='form-control btn-dark' style='padding-bottom: 2.1rem' name='img'  required>
                                </div>
                                
                                <div class='col-6 col-md-4 col-lg-4 mb-3'>
                                    <label for='firstName'>Choose Fliter</label>
                                    <select name='filter' class='mt-3 form-control inputRound' required>
                                        <option value='none'>Select Filter</option>
                                        <option value='product_gender'>Gender</option>
                                        <option value='product_brand_name'>Brand</option>
                                        <option value='product_category'>Category</option>
                                        <option value='product_shrt_discript'>Short Discript</option>
                                    </select>
                                </div>
                                
                                <div class='col-6 col-md-4 col-lg-4 mb-3'>
                                    <label for='firstName'>Search</label>
                                    <input type='text' class='form-control text-center' name='search' required>
                                </div>
                                
                                <div class='col-6 mb-3'>
                                    <label for='username'>Link Title</label>
                                    <input type='text' class='form-control text-center' name='title'>
                                </div>
                                
                                <div class='col-12 col-md-6 col-lg-6 mb-3'>
                                    <label class='mb-4' for='email'>Link Paragraph Discription</label><br/>
                                    <textarea type='text' class='form-control w-100 h-40' rows="3" cols="50"  name='para'></textarea>
                                </div>
                            </div>
                            
                            <button class='btn btn-light btn-text text-center' type='submit' name='saveLink'>ADD LINK</button>
                            <a href='links.admin.php' class='btn btn-outline-danger btn-text my-2' type='submit' >CANCEL</a>
                </form>
            </div>
        <?php
        }
        
        include_once 'adminFooter.php';
        
        }
    else{
        header("location: /Admin/Login");
    }
}
else{
    header("location: /Home");
}

?>