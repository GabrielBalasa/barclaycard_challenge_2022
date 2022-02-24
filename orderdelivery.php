<?php
    require 'navigation.php';
    $user_id = $_SESSION['loggedin'];
    $date = date('Y-m-d');
    $stamp = date('Y-m-d h:i:s');
    $order_id = $_REQUEST['order_id'];
        if(isset($_POST['delivery'])){
            $type=$pdo->prepare('UPDATE orders SET order_type = "delivery" WHERE order_id = :order_id');
            $values = [
                'order_id' => $order_id
            ];
            $type->execute($values);
            echo '<meta http-equiv="Refresh" content="0; url=\'HPPAuth.php?order_id=' . $order_id . '\'" />';
        }
        
        if(isset($_POST['collection'])){
            $type=$pdo->prepare('UPDATE orders SET order_type = "collection" WHERE order_id = :order_id');
            $values = [
                'order_id' => $order_id
            ];
            $type->execute($values);
            echo '<meta http-equiv="Refresh" content="0; url=\'collection.php?order_id=' . $order_id . '\'" />';
        }
    
    
    
?>

<div class="col-lg-12">
    <div class="checkout-inner">
        <div class="checkout-summary">
            <div class="cart-page">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart-page-inner">
                                <h1 class="text-center">Choose delivery option:</h1>
                                <form class="col-md-4 d-flex justify-content-center noRestrain" method="POST">
                                        <form action="orderdelivery.php" method="POST"><button class="btn btn-lg btn-block" name="delivery">Delivery (£5)</button></form>
                                </form>
                                <form class="col-md-4 d-flex justify-content-center noRestrain" method="POST">
                                    <form action="orderdelivery.php" method="POST"><button class="btn btn-lg btn-block" name="collection">Collection (FREE)</button></form>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>



<?php require "footer.php" ?>