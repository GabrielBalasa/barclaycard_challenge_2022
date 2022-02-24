<?php
    require 'navigation.php';
    $date = new DateTime();
    $order_id=$_REQUEST['order_id'];
    $date_created = date('Y/m/d h:i:s');
    
    $orders = $pdo->prepare('SELECT order_total FROM orders WHERE order_id = :order_id LIMIT 1');
    $values = [
		'order_id' => $order_id
	];
	$orders->execute($values);
	$payment = $orders->fetch()['order_total'];
    
    if(isset($_POST['book'])){
    
        $ord = $pdo->prepare('UPDATE orders SET order_collection = :order_collection WHERE order_id =' . $order_id);
        $values = [
            'order_collection' => $_POST['booking_time']
        ];
        $ord->execute($values);
    
        $bookDate = explode(" ", $_POST['booking_time']);

        $book = $pdo->prepare('INSERT INTO bookings (user_id, branch_id, booking_time, booking_date, payment_amount, date_created, order_id) 
                                VALUES (:user_id, :branch_id, :booking_time, :booking_date, :payment_amount, :date_created, :order_id)');
        $values = [
            'user_id' => $_SESSION['loggedin'],
            'branch_id' => $_POST['selectbranch'],
            'booking_time' => $bookDate[1],
            'booking_date' => $bookDate[0],
            'payment_amount' => $payment,
            'date_created' => $date_created,
            'order_id' => $order_id
        ];
        $book->execute($values);
        echo '<meta http-equiv="Refresh" content="0; url=\'collectiontype.php?order_id=' . $order_id . '\'" />';
        //echo '<meta http-equiv="Refresh" content="0; url=\'HPPAuth.php?order_id=' . $order_id . '\'" />';
    }
    
    
    
?>

<div class="container-fluid pb-4">
    <div class="row d-flex justify-content-center ">
    <form class="col-10 bg-white"  method="POST">
        <?php 
        $select = $pdo->prepare('SELECT * FROM branches');
        $select->execute();

        for($i=0; $i<=6; $i++){ ?>
            <div class="h4 col-2 pt-4 pb-2 text-primary">
            <?php
                $time_slot = new DateTime('09:00:00');
                $date->modify('+1 day');
                echo '<th><label>' . $date->format('Y-m-d') . '</label></th>';
                ?>
            </div>
            
            <div class="col-10 d-flex justify-content-between h5">
                <?php
                    for($j=0; $j<=9; $j++){
                            $check = $pdo->prepare('SELECT booking_id FROM bookings WHERE booking_time = :booking_time AND booking_date = :booking_date');
                            $values = [
                                'booking_time' => $time_slot->format('H:i'),
                                'booking_date' => $date->format('Y-m-d'),
                            ];
                            $check->execute($values);
                            $exist = $check->fetch();
                            echo '<input type="radio" name="booking_time" value="' . $date->format('Y-m-d') . " " . $time_slot->format('H:i') .'" ' . ($exist ? 'disabled' : '') . '><label>' . $time_slot->format('H:i') . '</label></td>'; 
                            $time_slot=date_modify($time_slot, '+ 1 hour');
                    }
                ?>
            </div>
        <?php } ?>
                <div>
                    <?php
                        echo '<label>Select branch:</label><select class="" name="selectbranch">';
                        foreach ($select as $branch) {
                            echo '<option class="align" value="' . $branch['branch_id'] . '">' . $branch['branch_name'] . '</option>';
                        }
                        echo '</select>';
                    ?>
                </div>
                <div class="col-12 d-flex justify-content-center pb-4">
                    <button type="submit" name="book" class="btn">Book now</button>
                </div>
        </form>
    </div>
</div>



<?php require "footer.php" ?>