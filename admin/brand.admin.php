<?php
$title = "Edit Brand Details: Pumkin";

include_once "adminHeader.php";

$product_id = $_POST['id'];

$results = $database->getData();
while($row = mysqli_fetch_assoc($results)){

        if($row['id'] == $product_id){
            $brand = $row['product_brand_name'];
            $product_name = $row['product_name'];
            $short_discript = $row['product_shrt_discript'];
            $long_discript = $row['product_long_discript'];
        }
}

?>

<div class="container">
    <div class="row">
    <div class="col-md-6 col-lg-6 mt-4">
            <h4 class="heading pb-3">current brand info</h4>
            <div class='wrapper  text-center'>
            <div class='row'>
                <div class='col-6 mb-3'>
                    <label for='firstName'>Brand</label>
                    <input type='text' class='form-control disable text-center' name='brand' placeholder='Full Name' value='<?php echo $brand; ?>' disabled>
                </div>

                <div class='col-6 mb-3'>
                    <label for='username'>Product Name</label>
                    <input type='text' class='form-control disable text-center' name='product_name' value='<?php echo $product_name; ?>' disabled>
                </div>
                </div>

                <div class='mb-3'>
                    <label for='username'>Product Short Discription</label>
                    <input type='text' class='form-control disable text-center' name='short_discript' value='<?php echo $short_discript; ?>' disabled>
                </div>

                <div class='mb-3'>
                    <label for='email'>Product Long Discription</label><br/>
                    <div class='p-2' style='background-color: #000; opacity: 1;border: 1px solid #ced4da;border-radius: 0.25rem; color: white'>
                    <small class=' w-100' name='long_discript'><?php echo $long_discript; ?></small>
                    </div>
                </div>
            </div>
            </div>

        

        <div class="col-md-6 col-lg-6 mt-4">
            <h4 class="heading pb-3">change brand info</h4>
            <form action="/Admin/Updates" method="POST">

                <div class='row'>
                    <div class='col-6 mb-3'>
                        <label for='firstName'>Brand</label>
                        <input type='text' class='form-control text-center' name='brand' placeholder='Full Name' value='<?php echo $brand; ?>' >
                    </div>

                    <div class='col-6 mb-3'>
                        <label for='username'>Product Name</label>
                        <input type='text' class='form-control text-center' name='product_name' value='<?php echo $product_name; ?>'>
                    </div>
                </div>

                    <div class='mb-3'>
                        <label for='username'>Product Short Discription</label>
                        <input type='text' class='form-control text-center' name='short_discript' value='<?php echo $short_discript; ?>' >
                    </div>

                    <div class='mb-3'>
                        <label for='email'>Product Long Discription</label><br/>
                        <textarea type='text' class='form-control w-100 h-40' rows="4" cols="50"  name='long_discript'><?php echo $long_discript; ?></textarea>
                    </div>
                <input type="hidden" name="id" value="<?php echo $product_id; ?>">

                <button class='btn btn-light text-center' type='submit' name='brands'>UPDATE</button>
                <a href='/admin/productHandler.php?id=<?php echo $product_id; ?>' class='btn btn-outline-danger my-2' type='submit' >CANCEL</a>
            
            </form>
        </div>

    </div>
</div>
<?php
    include_once 'adminFooter.php';
?>