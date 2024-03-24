<?php

class CreateDb{

    public $servername;
    public $username;
    public $password;
    public $dbname;
    public $tablename;
    public $con;

    

    public function __construct(
        $tablename = "producttb",
        // $servername = "srv1350.hstgr.io",
        // $username = "u849136244_pumkingrey",
        // $password = "G2O9+euM^c;",
        //$dbname = "u849136244_pumkin_grey"
        ) {
            //$this->dbname = $dbname;
            $this->tablename = $tablename;
            // $this->servername = $servername;
            // $this->username = $username;
            // $this->password = $password;
            
            
            //create connection;
            $serverName = "srv1350.hstgr.io";
            $dBUserName = "u849136244_pumkingrey";
            $dBPassword = "G2O9+euM^c;";
            $dBName = "u849136244_pumkin_grey";

            $conn = mysqli_connect($serverName,$dBUserName,$dBPassword,$dBName);

            if(!$conn){
                die("Connection Failed: " . mysqli_connect_error());
            }
            
            $this->con = $conn;//mysqli_connect($servername,$username,$password, $dbname);

            //check connection
            if(!$this->con){
                die("Connection failed: ".mysqli_connect_error());
            }
            $tablename = "producttb";
            //create query
            // $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

            // //EXECUTE QUERY
            // if(mysqli_query($this->con,$sql)){

            //     $this->con = $conn;//mysqli_connect($servername,$username,$password, $dbname);

                //sql create table
                $sql="CREATE TABLE IF NOT EXISTS $tablename(
                    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    product_name VARCHAR(25) NOT NULL,
                    product_brand_name VARCHAR(25) NOT NULL,
                    product_price FLOAT NOT NULL,
                    product_img VARCHAR(100),
                    product_shrt_discript VARCHAR(100),
                    product_sec_img VARCHAR(100),
                    product_third_img VARCHAR(100),
                    product_forth_img VARCHAR(100),
                    product_gender VARCHAR(6),
                    product_long_discript TEXT(300),
                    product_category VARCHAR(25),
                    product_size_type INT(1),
                    product_stock INT(3)
                );";
            //}

            if(!mysqli_query($this->con,$sql)){
                echo "Error creating table: ".mysqli_error($this->con);
            }
            else {
                return false;
            }
        }

        //get product from database
        public function getData(){
            $sql = "SELECT *  FROM $this->tablename";

            $result = mysqli_query($this->con,$sql);

            if(mysqli_num_rows($result)> 0){
                return $result;
            }
        }
    
}