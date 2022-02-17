<?php

//creating a script for creating database
class CreateDb
{
    //creating the properties
    public $server_name = "localhost:3307";
    public $username = "root";
    public $password = "";
    public $db_name;
    public $table_name;
    public $con;

    //creating the class constructor
    public function __construct($db_name, $table_name)
    {
        //initialing the properties
        $this->db_name = $db_name;
        $this->table_name = $table_name;

        //creating a new connection to the database
        $this->con = mysqli_connect($this->server_name, $this->username, $this->password);

        //checking if the connection is successful
        if (!$this->con) {
            die("Connection failed : " . mysqli_connect_error());
        }

        //writing the query to create new database to store the product chosen
        $sql = "create database if not exists $db_name";

        //executing the query
        if (mysqli_query($this->con, $sql)) {
            //connecting to the created database inorder to create a table
            $this->con = mysqli_connect($this->server_name, $this->username, $this->password, $db_name);

            //writing query to create new table
            $sql = "create table if not exists $table_name
               (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
               product_name VARCHAR(25) NOT NULL,
               product_price FLOAT,
               product_image VARCHAR(100)
            );";

            //checking if the query executed successfully
            if (!mysqli_query($this->con, $sql)) {
                echo "Error creating the table : " . mysqli_error($this->con);
            }

        } else {
            return false;
        }
    }

    //creating a method to get product from database
    public function getData()
    {
        $sql = "select * from $this->table_name";

        $result = mysqli_query($this->con, $sql);

        if (mysqli_num_rows($result) > 0) {
            return $result;
        }
    }
}
