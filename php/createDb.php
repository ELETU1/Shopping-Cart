<?php

//creating a script for creating database
class CreateDb
{
    /*creating the properties for localhost
    public $server_name = "localhost:3307";
    public $username = "root";
    public $password = "";
    public $db_name;
    public $table_name;
    public $con;
     */

    //creating the properties for remote
    public $server_name = "remotemysql.com";
    public $username = "WurS9LGxFo";
    public $password = "quPj8iA7RD";
    public $db_name = "WurS9LGxFo";
    public $table_name;
    public $con;

    //creating the class constructor
    public function __construct($table_name)
    {
        //initialing the properties
        $this->table_name = $table_name;

        //creating a new connection to the database
        $this->con = mysqli_connect($this->server_name, $this->username, $this->password);
        //connecting to the created database inorder to create a table
        $this->con = mysqli_connect($this->server_name, $this->username, $this->password, $this->db_name);
        if ($this->con) {
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
