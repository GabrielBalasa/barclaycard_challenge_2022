<?php

$stmt = $pdo->prepare('SELECT * FROM users WHERE user_id = :user_id');
            $values = [
                'user_id' => $_SESSION['loggedin']
            ];
            $stmt->execute($values);
            $data = $stmt->fetch();

if(empty($_SESSION['loggedin']) || $data['user_access']=="0"){
    exit;
}

if(isset($_POST['refund'])) {
    $update=$pdo->prepare('UPDATE orders SET order_status = :order_status WHERE order_id = :order_id');
    $values=[
        'order_id' => $_POST['order_id'],
        'order_status' => "Refunded"
    ];
    $update->execute($values);
}?>

<form action="my-account.php" method="POST" class="">
    <?php
        $select = $pdo->prepare('SELECT * FROM orders WHERE order_status = "Confirmed" GROUP BY order_id ORDER BY order_date DESC');
        $select->execute();	

        echo '<label>Confirmed Orders:</label></br><select class="w-50 mb-3" name="order_id">';
        foreach ($select as $data) {
            echo '<option class="align" value="' . $data['order_id'] . '"> ID:' . $data['order_id'] . " - £" . $data['order_total'] . '</option>';
        } ?>
        </select>
        <br>
        
    <input class="mx-3" type="submit" name="refund" value="Refund">
</form>