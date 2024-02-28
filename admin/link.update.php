<?php
$title = "Update Product Links: Pumkin";
$page = "";
include_once "adminHeader.php";
$link_db = new CreateDb("u843931047_productdb", "linkstb"); //online db

if(isset($_POST['edit'])){
    
    $link_id = $_POST['id'];
    $result = $link_db->getData();
    while($row = mysqli_fetch_assoc($result)){
        if($row['id'] == $link_id){
            $img = $row['link_img'];
            $title = $row['link_title'];
            $para = $row['link_para'];
            $filter = $row['link_filter'];
            $search = $row['link_search'];
            $status = $row['link_status'];
            
            if(strcasecmp($filter, "product_gender") == 0){$f_header = "Gender";}
            elseif(strcasecmp($filter, "product_brand") == 0){$f_header = "Brand";}
            elseif(strcasecmp($filter, "product_category") == 0){$f_header = "Category";}
            elseif(strcasecmp($filter, "product_shrt_discript") == 0){$f_header = "Short Discript";}
            else{$f_header = "Select Filter";}
        }
    }
?>    
  <div class="container">
        <form action="/Admin/Updates" method="post" enctype="multipart/form-data">
            <!--<div class="row">-->
            <!--    <div class="col- pt-3">-->
                    
                    <!-- ADD IMAGES -->
                    <h4 class="heading pb-3">update links</h4>
                    <img src="../<?php echo $img; ?>" alt='' class='w-50 mb-3'>
                    <input type='hidden' name='oldImg' value='<?php echo $img; ?>'>
                    <div class="row">
                        <div class='col-6 col-md-4 col-lg-4 mb-3'>
                            <label for='firstName'>Cover</label>
                            <input type='file' class='form-control btn-dark' style='padding-bottom: 2.1rem' name='img'>
                        </div>
                        
                        <div class='col-6 col-md-4 col-lg-4 mb-3'>
                            <label for='firstName'>Choose Fliter</label>
                            <select name='filter' class='mt-3 form-control inputRound' required>
                                <option value='<?php echo $filter; ?>'><?php echo $f_header; ?></option>
                                <option value='product_gender'>Gender</option>
                                <option value='product_brand_name'>Brand</option>
                                <option value='product_category'>Category</option>
                                <option value='product_shrt_discript'>Short Discript</option>
                            </select>
                        </div>
                        
                        <div class='col-12 col-md-4 col-lg-4 mb-3'>
                            <label for='firstName'>Search</label>
                            <input type='text' class='form-control text-center' value='<?php echo $search; ?>' name='search' required>
                        </div>
                        
                        <div class='col-12 col-md-6 col-lg-6 mb-3'>
                            <div class='row'>
                                <div class='col-12 mb-3'>
                                    <label for='username'>Link Title</label>
                                    <input type='text' class='form-control text-center' value='<?php echo $title; ?>' name='title'>
                                </div>

                                <?php 
                                    if(strcasecmp($status, "active") == 0){
                                        echo "
                                        <div class='col-12 mb-3'>
                                            <label for='email'>Link Status</label>
                                            <select name='status' class='mt-3 form-control inputRound text-center' required>
                                                <option value='$status'>$status</option>
                                                <option value='Deactivated'>Deactivate</option>
                                            </select>

                                        </div>";
                                    }
                                    else{
                                        echo "
                                        <div class='col-12 mb-3'>
                                            <label for='email'>Link Status</label>
                                            <select name='status' class='mt-3 form-control inputRound text-center' required>
                                                <option value='$status'>$status</option>
                                                <option value='Active'>Active</option>
                                            </select>

                                        </div>";
                                    }
                                ?>
                                            <input type='hidden' name='id' value='<?php echo $link_id; ?>'>
                            </div>
                        </div>
                        
                        <div class='col-12 col-md-6 col-lg-6 mb-3'>
                            <label class='mb-4' for='email'>Link Paragraph Discription</label><br/>
                            <textarea type='text' class='form-control w-100 h-40' rows="6" cols="50"  name='para'><?php echo $para; ?></textarea>
                        </div>
                    </div>
                    
                    <button class='btn btn-light btn-text text-center' type='submit' name='updateLink'>UPDATE LINK</button>
                    <a href='links.admin.php' class='btn btn-outline-danger btn-text my-2' type='submit' >CANCEL</a>
        </form>
    </div>
 <?php  
}
include_once 'adminFooter.php';