<?php 
    require 'navigation.php';
    $subtotal = 0;
    $empty = true;
    if(isset($_POST['checkout'])) {
        $check=$pdo->prepare('SELECT * FROM carts JOIN products ON carts.product_id = products.product_id WHERE user_id = :user_id');
        $values=[
            'user_id' => $_SESSION['loggedin']
        ];
        $check->execute($values);
        foreach ($check as $row){
            if(!$row){
                $empty = true;
            } else {
                $empty = false;
            }
        }
        if($empty){
            echo '<script>alert("Your cart is empty")</script>';
            echo '<meta http-equiv="Refresh" content="0; url=\'cart.php\'" />';
        } else {
            // $cart_id = $_SESSION['loggedin'];
            // $item=$pdo->prepare('SELECT * FROM carts JOIN products ON carts.product_id = products.product_id WHERE user_id = :user_id');
            // $values=[
            //     'user_id' => $_SESSION['loggedin']
            // ];
            // $item->execute($values);
            // foreach ($item as $product){
            //     $cart = $pdo->prepare('INSERT INTO cart_products (cart_id, user_id, product_id, quantity)
            //                             VALUES (:cart_id, :user_id, :product_id, :quantity)');
            //     $values = [
            //         'cart_id' => (int) $cart_id,
            //         'user_id' => (int) $_SESSION['loggedin'],
            //         'product_id' => (int) $product['product_id'],
            //         'quantity' => (int) $product['quantity']
            //     ];
            //     $cart->execute($values);
                
            // }
            echo '<meta http-equiv="Refresh" content="0; url=\'checkout.php\'" />';
        }
    }
?>

<div class="cart-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="cart-page-inner">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle">
                                <?php
                                    $item=$pdo->prepare('SELECT * FROM carts JOIN products ON carts.product_id = products.product_id WHERE user_id = :user_id');
                                    $values=[
                                        'user_id' => $_SESSION['loggedin']
                                    ];
                                    $item->execute($values);
                                    foreach ($item as $product){
                                        require 'cartitem.php';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart-page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="cart-summary">
                                <div class="cart-content">
                                    <h1>Cart Summary</h1>
                                    <h2>Grand Total<span>£<?php echo $total = $subtotal; ?></span></h2>
                                </div>
                                <div class="cart-btn text-center">
                                    <form action="cart.php" method="POST"><button name="checkout">Checkout</button></form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require "footer.php" ?>