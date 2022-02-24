<?php 
    require 'navigation.php';
    $order_id = $_REQUEST['order_id'];
    $order = $pdo->prepare('SELECT * FROM orders WHERE order_id = :order_id LIMIT 1');
    $values = [
        'order_id' => $order_id
    ];
    $order->execute($values);
    $data = $order->fetch();
    $newDate = date("d-m-Y", strtotime($data['order_collection'])); 
?>

<div class="cart-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="cart-page-inner">
                    <div class="table-responsive">
                    <h1>Thank you for you order!</h1>
                    <p>Your order ID is: <?=$order_id?></p>
                    <p>We expect you on <?=$newDate?> for you collection.</p>
                    <p>Your order total is £<?=$data['order_total']?>.</p>
                    <p><a href="index.php">Go to homepage.</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require "footer.php" ?>