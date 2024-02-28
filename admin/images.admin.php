<?php
$title = "Edit Product Images: Pumkin";

include_once "adminHeader.php";

$product_id = $_POST['id'];

$results = $database->getData();
while($row = mysqli_fetch_assoc($results)){

        if($row['id'] == $product_id){
            $img = $row['product_img'];
            $img2 = $row['product_sec_img'];
            $img3 = $row['product_third_img'];
            $img4 = $row['product_forth_img'];
        }
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-lg-6 pt-md-5 pt-lg-0">
            <div class="row">

                <div class='col-6 wrapper mt-3'>

                    <div class='card'>
                            <img src='../<?php echo $img ?>' name='item' class='width-set' alt='Jacket' style='border: 1em solid #343a40'>
                    </div>

                </div>

                <div class='col-6 wrapper mt-3'>

                    <div class='card'>
                            <img src='../<?php echo $img2 ?>' name='item' class='width-set' alt='Jacket' style='border: 1em solid #343a40'>
                    </div>

                </div>

                <div class='col-6 wrapper mt-3'>

                    <div class='card'>
                            <img src='../<?php echo $img3 ?>' name='item' class='width-set' alt='Jacket' style='border: 1em solid #343a40'>
                    </div>

                </div>

                <div class='col-6 wrapper mt-3'>

                    <div class='card'>
                        <img src='../<?php echo $img4 ?>' name='item' class='width-set' alt='Jacket' style='border: 1em solid #343a40'>
                    </div>

                </div>

            </div>
        </div>
        <div class="col-md-6 col-lg-6 mt-4">
            <h4 class="heading pb-3">change images</h4>
            <form action="/Admin/Updates" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class='col-6 mb-5'>
                    <label for='firstName'>Cover</label>
                    <input type='file' class='form-control btn-dark' style='padding-bottom: 2.5rem' name='img'  required>
                </div>

                <div class='col-6 mb-5'>
                    <label for='username'>2nd Image</label>
                    <input type='file' class='form-control btn-dark' style='padding-bottom: 2.5rem' name='img2'  required>
                </div>

                <div class='col-6 mb-3 pt-3'>
                    <label for='firstName'>3rd Image</label>
                    <input type='file' class='form-control btn-dark' style='padding-bottom: 2.5rem' name='img3'  required>
                </div>

                <div class='col-6 mb-3 pt-3'>
                    <label for='username'>4th Image</label>
                    <input type='file' class='form-control btn-dark' style='padding-bottom: 2.5rem' name='img4'  required>
                    <input type="hidden" name="id" value="<?php echo $product_id; ?>">
                </div>
            </div>
            
            <button class='btn btn-light btn-text text-center' type='submit' name='images'>UPDATE</button>
            <a href='/admin/productHandler.php?id=<?php echo $product_id; ?>' class='btn btn-outline-danger btn-text my-2' type='submit' >CANCEL</a>
            </form>
        </div>
    </div>
</div>
<?php
    include_once 'adminFooter.php';

?>