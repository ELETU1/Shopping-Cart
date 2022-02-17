<?php

//starting a session
session_start();

$title = "Shopping Cart";
require_once "includes/header.php";
require_once "php/createDb.php";
require_once "php/component.php";

//creating instance of the createDb class
$database = new createDb("Productb"); //NOTE: we oveeridde the da_name and table_name

if (isset($_POST['add'])) {
    //storing the hidden product_id into the session
    if (isset($_SESSION['cart'])) {
        //confirming if the index is selected already
        $item_array_id = array_column($_SESSION['cart'], "product_id");
        if (in_array($_POST['product_id'], $item_array_id)) {
            echo "<script> alert('Product is added in the cart') </script>";
            echo "<script> window.location = 'index.php' </script>";
        } else {
            //adding the product to the session if its not available
            $num = count($_SESSION['cart']);
            $item_array = array('product_id' => $_POST['product_id']);

            $_SESSION['cart'][$num] = $item_array;
        }
    } else {
        $item_array = array('product_id' => $_POST['product_id']);

        //create new session variable
        $_SESSION['cart'][0] = $item_array;
    }
}

?>
<!--Adding the navBar-->
<?php
require_once "php/head.php";
?>
<div class="container">
    <div class="row text-center py-5">
        <?php
//getting the content of the database
$result = $database->getData();

while ($row = mysqli_fetch_assoc($result)) {
    component($row['product_name'], $row['product_price'], $row['product_image'], $row['id']);
}
?>
    </div>
</div>

<?php
require_once "includes/footer.php";
?>