<?php
    require 'navigation.php';
    //error_reporting(0);
    $select = $pdo->prepare('SELECT * FROM users WHERE user_id=:user_id');
    $values=[
        'user_id' => $_SESSION['loggedin']
    ];
    $select->execute($values);
    $product_id =$_REQUEST['product_id']
?>

<!-- Product Detail Start -->
<div class="product-detail">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="product-detail-top">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="product-slider-single normal-slider">
                            <?php
                                $data = $pdo->prepare('SELECT * FROM products WHERE product_id = :product_id');
                                $values=[
                                    'product_id' => $product_id
                                ];
                                $data->execute($values);
                                foreach($data as $product) {
                            ?>
                                <img src="img/<?php echo $product['image_source']; ?>" alt="image" class="thumbnail">
                            </div>
                        </div>
                        <div class="col-md-3 d-flex justify-items-center">
                            <div class="product-content">
                                <div class="title"><h2><?php echo $product['title']; ?></h2></div>
                                <div class="price">
                                    <h4>Price:</h4>
                                    <p>£<?php echo $product['price']; ?></p><br>
                                    <h4>Stock amount:</h4> <p><?=$product['stock']?></p>
                                </div>
                                <div class="action">
                                <?php
                                    if(isset($_POST['addtocart'])){
                                        $check=$pdo->prepare('SELECT * FROM carts');
                                        $check->execute();
                                        $stmt=$pdo->prepare('INSERT INTO carts (user_id, product_id)
                                                                VALUES (:user_id, :product_id)');
                                        $values = [
                                            'user_id' => $_SESSION['loggedin'],
                                            'product_id' => $product_id
                                        ];
                                        foreach($check as $row){
                                            if(($row['user_id'] == $values['user_id']) && ($row['product_id'] == $values['product_id'])){
                                                $stmt=$pdo->prepare('UPDATE carts SET quantity = :quantity WHERE user_id = :user_id AND product_id = :product_id');
                                                $values = [
                                                    'user_id' => $_SESSION['loggedin'],
                                                    'product_id' => $product_id,
                                                    'quantity' => $row['quantity'] + 1
                                                ];
                                            }
                                        }
                                        $stmt->execute($values);
                                    }
                                ?>
                                <form class="col-md-4" method="POST">
                                    <input class="btn" type="submit" value="Add to cart" name="addtocart" />
                                </form>
                                </div>
                            </div>
                        </div>
                        <div class="product-detail-bottom col-md-6">
                            <ul class="nav nav-pills nav-justified">
                                <li class="nav-item">
                                    <a class="nav-link active text-white" data-toggle="pill" href="#description">Product description</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div id="description" class="container tab-pane active">
                                    <p>
                                        <?php echo $product['description']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="product">
                    <div class="section-header">
                        <h1>Related Products</h1>
                    </div>
                    <div class="row align-items-center product-slider product-slider-4">
                    <?php $items=$pdo->prepare('SELECT * FROM products');
                        $items->execute();
                        foreach ($items as $product){
                        ?>
                        <div class="col-lg-3">
                            <?php
                                require 'product-test.php';
                            ?> 
                        </div> <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Detail End -->    
<?php require "footer.php" ?>
