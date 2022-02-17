<?php
$title = "cart";
require_once "includes/header.php";
require_once "php/head.php";

//starting the session inorder to access the id stored in it
//accessing the createDb function
session_start();
require_once "php/createDb.php";
require_once "php/component.php";

//accessing the database
$db = new createDb("productdb", "productb");

//confirming if the user wants to remove some items from the cart
if (isset($_POST['remove'])) {
    if ($_GET['action'] == 'remove') {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value['product_id'] == $_GET['id']) {
                //removing that product from the session
                unset($_SESSION['cart'][$key]);
                echo "<script> alert('Product has been Removed') </script>";
                echo "<script>window.location='cart.php'</script>";
            }
        }
    }
}
?>

<div class="container-fluid">
    <div class="row px-5 py-4">
        <div class="col-md 7">
            <div class="shopping-cart">
                <h6> My Chart </h6><hr>
                <!--Creating a php script for the manipulation-->
                <?php

$total = 0; //variable for storing the total price of the product selected
//checking if the cart is not empty
if (isset($_SESSION['cart'])) {
    //accessing the id stored in the session and storing it in a variable
    $product_id = array_column($_SESSION['cart'], 'product_id');

    //getting the available data from the database
    $result = $db->getData();
    while ($row = mysqli_fetch_assoc($result)) {
        //comparing if the id stored in the session and the one on the database matches
        foreach ($product_id as $id) {
            if ($row['id'] == $id) {
                cartElement($row['product_image'], $row['product_name'], $row['product_price'], $row['id']);
                $total = $total + (int) $row['product_price'];
            }
        }
    }

} else {
    echo "<h5 class=\"bg-light text-success\"> Cart is empty </h5>";
}
?>
            </div>
        </div>
        <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">
            <div class="pt-4">
                <h6>PRICE DETAILS</h6><hr>
                <div class="row price-details">
                    <div class="col-md-6">
                        <?php
if (isset($_SESSION['cart'])) {
    $count = count($_SESSION['cart']);
    echo "<h6> Price ($count items) </h6>";
} else {
    echo "<h6> Price (0 items) </h6>";
}
?>
                        <h6>Delivery Charges</h6><hr>
                        <h6>Amount Payable</h6>
                    </div>
                    <div class="col-md-6">
                        <h6>
                            $<?php
echo $total;
?>
                        </h6>
                        <h6 class="text-success">FREE</h6><hr>
                        <h6>$<?php echo $total; ?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once "includes/footer.php";
?>