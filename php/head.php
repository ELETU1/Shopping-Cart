<header id="header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a href="index.php" class="navbar-brand">
            <h3 class="px-5">
                <i class="fas fa-shopping-basket"></i> Shopping Cart
            </h3>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="toggle"
        data-bs-target="#navbaralt" aria-controls="navbaralt" aria-expanded="false">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbaralt">
            <div class="ms-auto">
                <div class="navbar-nav">
                     <a href="cart.php" class="nav-item nav-link active">
                        <h5 class="px-5 cart">
                            <i class="fas fa-shopping-cart">Cart 
                                <?php
                                //setting the cart count
                                 if(isset($_SESSION['cart'])){
                                     $count = count($_SESSION['cart']);
                                     echo "<span id=\"cart_count\" class=\"text-success bg-light\">$count</span>";
                                 }
                                 else{
                                     echo "<span id=\"cart_count\" class=\"text-success bg-light\">0</span>";
                                 }
                                 
                                ?>
                            </i>
                        </h5>
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>