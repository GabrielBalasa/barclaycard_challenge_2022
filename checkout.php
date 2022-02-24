<?php
    require 'navigation.php';
    $user_id = $_SESSION['loggedin'];
    $date = date('Y-m-d');
    $stamp = date('Y-m-d h:i:s');
    $total = 0;
    $unique_id = time() . mt_rand();
    $user = $pdo->prepare('SELECT * FROM users WHERE user_id = :user_id LIMIT 1');
    $values = [
        'user_id' => $user_id
    ];
    $user->execute($values);
    
?>
        
<!-- Checkout Start -->
<div class="checkout">
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-lg-12">
                <div class="checkout-inner">
                    <div class="billing-address">
                        <h2>Personal details</h2>
                        <?php foreach($user as $form){ ?>
                        <div class="row">
                            <div class="col-md-6">
                                <label>First Name</label>
                                <input class="form-control" type="text" value="<?=$form['first_name'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label>Last Name</label>
                                <input class="form-control" type="text" value="<?=$form['surname'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label>E-mail</label>
                                <input class="form-control" type="text" value="<?=$form['email'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label>Phone number</label>
                                <input class="form-control" type="text" value="<?=$form['phone'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label>Address</label>
                                <input class="form-control" type="text" value="<?=$form['address'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label>Country</label>
                                <input class="form-control" type="text" value="<?=$form['country'] ?>"">
                            </div>
                            <div class="col-md-6">
                                <label>City</label>
                                <input class="form-control" type="text" value="<?=$form['city'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label>Postcode</label>
                                <input class="form-control" type="text" value="<?=$form['postcode'] ?>">
                            </div>
                            <?php } ?>
                            <div class="col-md-12">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="newaccount">
                                    <label class="custom-control-label" for="newaccount">Create an account</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="shipto">
                                    <label class="custom-control-label" for="shipto" >Ship to different address</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="shipping-address">
                        <h2>Shipping Address</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <label>First Name</label>
                                <input class="form-control" type="text" placeholder="First Name">
                            </div>
                            <div class="col-md-6">
                                <label>Last Name</label>
                                <input class="form-control" type="text" placeholder="Last Name">
                            </div>
                            <div class="col-md-6">
                                <label>E-mail</label>
                                <input class="form-control" type="text" placeholder="E-mail">
                            </div>
                            <div class="col-md-6">
                                <label>Phone number</label>
                                <input class="form-control" type="text" placeholder="Phone number">
                            </div>
                            <div class="col-md-6">
                                <label>Address</label>
                                <input class="form-control" type="text" placeholder="Address">
                            </div>
                            <div class="col-md-6">
                                <label>Country</label>
                                <select class="custom-select">
                                    <option selected>United States</option>
                                    <option>Afghanistan</option>
                                    <option>Albania</option>
                                    <option>Algeria</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>City</label>
                                <input class="form-control" type="text" placeholder="City">
                            </div>
                            <div class="col-md-6">
                                <label>Postcode</label>
                                <input class="form-control" type="text" placeholder="Postcode">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                $data = $pdo->prepare('SELECT * FROM carts JOIN products ON carts.product_id = products.product_id WHERE user_id = :user_id');
                $values = [
                    'user_id' => $user_id
                ];
                $data->execute($values);
                $user = $data->fetch();
            ?>
            <div class="col-lg-12">
                <div class="checkout-inner">
                    <div class="checkout-summary">
                        <div class="cart-page">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="cart-page-inner">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Price</th>
                                                            <th>Quantity</th>
                                                            <th>Total</th>
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
                                                                require 'cartitem2.php';
                                                                $total = $total + $itemtotal;
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                        <h1 class="text-right pr-5 mr-2">Cart Total: £<?php echo $total; ?></h1>
                    </div>

                    <div class="checkout-payment">
                        <div class="payment-methods">
                            <?php 
                                if(isset($_POST['createorder'])){
                                    $ord=$pdo->prepare('INSERT INTO orders (order_id, user_id, order_date, order_total, product_id, quantity)
                                                            VALUES (' . $unique_id . ', :user_id, :order_date, :order_total, :product_id, :quantity)');
                                    
                                    $item2=$pdo->prepare('SELECT * FROM carts JOIN products ON carts.product_id = products.product_id WHERE user_id = :user_id');
                                    $values=[
                                        'user_id' => $_SESSION['loggedin']
                                    ];
                                    $item2->execute($values);
                                    $updateStock = $pdo->prepare('UPDATE products SET stock = :stock WHERE product_id = :product_id');
                                    
                                    foreach ($item2 as $final){
                                        $values = [
                                            'user_id' => $_SESSION['loggedin'],
                                            'order_date' => $stamp,
                                            'order_total' => $total,
                                            'product_id' => $final['product_id'],
                                            'quantity' => $final['quantity']
                                        ];
                                        $ord->execute($values);
                                        
                                        $stockQ = $final['stock'];
                                        $stockM = $final['quantity'];
                                        $newStock = $stockQ - $stockM;
                                        $productID = $final['product_id'];
                                        $values = [
                                            'stock' => $newStock,
                                            'product_id' => $productID
                                        ];
                                        $updateStock->execute($values);
                                        
                                    }
                                    echo '<meta http-equiv="Refresh" content="0; url=\'orderdelivery.php?order_id=' . $unique_id . '\'" />';
                                }
                            ?>
                            <form class="col-md-4 d-flex justify-content-center noRestrain" method="POST">
                                <form action="orderdelivery.php?order_id=<?php echo $unique_id; ?>" method="POST"><button class="btn btn-lg btn-block" name="createorder">Next</button></form>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Checkout End -->
<?php require "footer.php" ?>