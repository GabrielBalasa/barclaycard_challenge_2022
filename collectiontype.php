<?php
    require 'navigation.php';
    $user_id = $_SESSION['loggedin'];
    $date = date('Y-m-d');
    $stamp = date('Y-m-d h:i:s');
    $order_id = $_REQUEST['order_id'];
        if(isset($_POST['online'])){
            $type=$pdo->prepare('UPDATE bookings SET payment_type = "online" WHERE order_id = :order_id');
            $values = [
                'order_id' => $order_id
            ];
            $type->execute($values);
            echo '<meta http-equiv="Refresh" content="0; url=\'HPPAuth.php?order_id=' . $order_id . '\'" />';
        }
        
        if(isset($_POST['instore'])){
            $type=$pdo->prepare('UPDATE bookings SET payment_type = "store" WHERE order_id = :order_id');
            $values = [
                'order_id' => $order_id
            ];
            $type->execute($values);
            echo '<meta http-equiv="Refresh" content="0; url=\'successorder.php?order_id=' . $order_id . '\'" />';
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
                                <h1 class="text-center">Choose payment option:</h1>
                                <form class="col-md-4 d-flex justify-content-center noRestrain" method="POST">
                                        <form action="orderdelivery.php" method="POST"><button class="btn btn-lg btn-block" name="online">Pay online (FREE)</button></form>
                                </form>
                                <form class="col-md-4 d-flex justify-content-center noRestrain" method="POST">
                                    <form action="orderdelivery.php" method="POST"><button class="btn btn-lg btn-block" name="instore">Pay in-store at collection (FREE)</button></form>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>



<?php require "footer.php" ?>