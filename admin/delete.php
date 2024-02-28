<?php 
    if(isset($_POST['delete'])) {
        $id = $_POST['id'];

        $serverName = "localhost";
        $dBUserName = "u843931047_pumkinproducts";
        $dBPassword = "5P~PCQfN:g";
        $dBName = "u843931047_productdb";
        
        $conn2 = mysqli_connect($serverName,$dBUserName,$dBPassword,$dBName);

        $sql = "DELETE FROM producttb 
        WHERE id = '$id';";

        $results = $conn2->query($sql);

        if(!$results) {
            header("location: productHandler.php?id=$id&error=stmtfailed");
                exit();
        }

        header("location: products.php?error=none");
                exit();
    }
    
    if(isset($_POST['deactivate'])) {
        $id = $_POST['id'];

        $serverName = "localhost";
        $dBUserName = "u843931047_pumkinproducts";
        $dBPassword = "5P~PCQfN:g";
        $dBName = "u843931047_productdb";
        
        $conn2 = mysqli_connect($serverName,$dBUserName,$dBPassword,$dBName);

        $sql = "UPDATE producttb SET active = 'no' 
        WHERE id = '$id';";

        $results = $conn2->query($sql);

        if(!$results) {
            header("location: productHandler.php?id=$id&error=stmtfailed");
                exit();
        }

        header("location: products.php?error=none");
                exit();
    }
    
    if(isset($_POST['activate'])) {
        $id = $_POST['id'];

        $serverName = "localhost";
        $dBUserName = "u843931047_pumkinproducts";
        $dBPassword = "5P~PCQfN:g";
        $dBName = "u843931047_productdb";
        
        $conn2 = mysqli_connect($serverName,$dBUserName,$dBPassword,$dBName);

        $sql = "UPDATE producttb SET active = 'yes' 
        WHERE id = '$id';";

        $results = $conn2->query($sql);

        if(!$results) {
            header("location: productHandler.php?id=$id&error=stmtfailed");
                exit();
        }

        header("location: products.php?error=none");
                exit();
    }