<?php 
require 'configuration.php';
if (isset($_POST['submit'])){
    $stmt=$pdo->prepare('INSERT INTO  bookings (branch_id) VALUES (:branch_id)');
    $values=[
        'branch_id'=>$_POST['branch_id']
    ];
    $stmt->execute($values);
    } else { ?>

    <form action="booktest.php" method="POST" class="">
        <?php
            $select = $pdo->prepare('SELECT * FROM branches ORDER BY branch_id ASC');
            $select->execute();    

            echo '<label>Select Branch:</label><select class="" name="branch_id">'; 
            foreach ($select as $data) {
                echo '<option class="align" value="' . $data['branch_id'] . '">' . $data['branch_name'] . '</option>';
            }
            echo '</select>';
        ?>
        <input type="submit" name="submit" value="Submit">
    </form>
    <?php } ?>