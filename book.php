<?php
require 'navigation.php';

$branch_id=$_REQUEST['id'];
$date_created=date('Y/m/d h:i:s');

if (isset($_POST['submit'])){
    $stmt=$pdo->prepare('INSERT INTO  bookings (user_id, service_id, branch_id, booking_time, booking_date, payment_amount, date_created) 
                            VALUES (:user_id, :service_id, :branch_id, :booking_time, :booking_date, :payment_amount, :date_created)');
    $values=[
        'user_id' => $_SESSION['loggedin'],
        'service_id' => $_POST['service_id'],
        'branch_id' => $branch_id,
        'booking_time' => $_POST['booking_time'],
        'booking_date' => $_POST['booking_date'],
        'payment_amount' => $_POST['payment_amount'],
        'date_created' => $date_created
    ];
    $stmt->execute($values);
    } else { ?>

    <form action="book.php?id=<?php echo $branch_id ?>" method="POST" class="">
        <?php
            $select = $pdo->prepare('SELECT * FROM branches WHERE branch_id=:branch_id');
            $values=[
                'branch_id' => $branch_id
            ];
            $select->execute($values);
            foreach($select as $data){
                echo '<label value="' . $branch_id . '">Branch: ' . $data['branch_name'] . '</label><p class="" name="branch_id">'; 

            }

            $select = $pdo->prepare('SELECT * FROM services ORDER BY service_id ASC');
            $select->execute();	

            echo '<label>Select Service:</label><select class="" name="service_id">'; 
            foreach ($select as $data) {
                echo '<option class="align" value="' . $data['service_id'] . '">' . $data['service_name'] . " for £" . $data['service_price'] . '</option>';
                echo '<input type="hidden" name="payment_amount" value="' . $data['service_price'] . '" />';
            }
            echo '</select>';

            $select = $pdo->prepare('SELECT * FROM employees WHERE branch_id=:branch_id ORDER BY employee_id ASC');
            $values = [
                'branch_id' => $branch_id
            ];
            $select->execute($values);

            echo '<label>Select stylist:</label><select class="" name="employee_id">'; 
            foreach ($select as $data) {
                echo '<option class="align" value="' . $data['employee_id'] . '">' . $data['employee_firstname'] . " " . $data['employee_surname'] . " " . $data['branch'] . '</option>';
            }
            echo '</select>';

        ?>
        <label for="start">Booking Date:</label>
        <input name="booking_date" type="date" id="start" name="trip-start" value="2021-08-21" min="2021-01-01" max="2021-12-31">
        <?php echo '<label>Booking time:</label><select class="" name="booking_time">';?>
            <option value="09:00">09:00</option>
            <option value="09:30">09:30</option>
            <option value="10:00">10:00</option>
            <option value="10:30">10:30</option>
            <option value="11:00">11:00</option>
            <option value="11:30">11:30</option>
            <option value="12:00">12:00</option>
            <option value="12:30">12:30</option>
            <option value="13:00">13:00</option>
            <option value="13:30">13:30</option>
        <?php echo '</select>'; ?>
    <?php } ?>
    <input type="submit" name="submit" value="Confirm"/>
    </form>
<?php require 'footer.php' ?>
    
