<?php 
    require 'navigation.php';
    $date = new DateTime();
    $branch_id=$_REQUEST['id'];
    $date_created = date('Y/m/d h:i:s');
    if(isset($_POST['book'])){
        $price = $pdo->prepare('SELECT service_price FROM services WHERE service_id = :service_id');
        $values2 = [
            'service_id' => $_POST['service_id']
        ];
        $price->execute($values2);
        $payment = $price->fetch()['service_price'];

        $bookDate = explode(" ", $_POST['booking_time']);

        $book = $pdo->prepare('INSERT INTO bookings (user_id, service_id, branch_id, booking_time, booking_date, payment_amount, date_created) 
                            VALUES (:user_id, :service_id, :branch_id, :booking_time, :booking_date, :payment_amount, :date_created)');
        $values = [
            'user_id' => $_SESSION['loggedin'],
            'service_id' => $_POST['service_id'],
            'branch_id' => $branch_id,
            'booking_time' => $bookDate[1],
            'booking_date' => $bookDate[0],
            'payment_amount' => $payment,
            'date_created' => $date_created
        ];
        $book->execute($values);
        echo '<meta http-equiv="Refresh" content="0; url=\'HPPAuthBillTo.php\'" />';
    }
?>

<div class="container-fluid pb-4">
    <div class="row d-flex justify-content-center ">
    <form class="col-10 bg-white" action="bookings.php?id=<?php echo $branch_id ?>" method="POST">
        <?php 
        $select = $pdo->prepare('SELECT * FROM branches WHERE branch_id=:branch_id');
        $values=[
            'branch_id' => $branch_id
        ];
        $select->execute($values);
        foreach($select as $data){
            echo '<label value="' . $branch_id . '">Branch: ' . $data['branch_name'] . '</label><p class="" name="branch_id">'; 

        }

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
                    $same = false;
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
                <div class="col-12 d-flex justify-content-end pb-4">
                <button type="submit" name="book" class="btn">Book now</button>
                </div>
        </form>
    
</div>
</div>

<?php require 'footer.php' ?>